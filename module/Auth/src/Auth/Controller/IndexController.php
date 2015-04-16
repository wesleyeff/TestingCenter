<?php
namespace Auth\Controller;

use Appointment\Model\User;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Zend\Authentication\Result;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Storage\Session as SessionStorage;

//use Zend\Db\Adapter\Adapter as DbAdapter;

//use Zend\Authentication\Adapter\DbTable as AuthAdapter;
use Zend\Authentication\Adapter\Ldap as AuthAdapter;

use Zend\Log\Logger;
use Zend\Log\Writer\Stream as LogWriter;
use Zend\Log\Filter\Priority as LogFilter;

use Zend\Debug\Debug;

use Auth\Model\Auth;
use Auth\Form\AuthForm;

class IndexController extends AbstractActionController
{
    protected $userTable;

    public function indexAction()
    {
		return new ViewModel();
	}	
	
    public function loginAction()
	{
		$user = $this->identity();
		$form = new AuthForm();
		$form->get('submit')->setValue('Login');
		$messages = null;
        $options = array(
            'server1' => array(
                'host' => '137.190.19.17',
                'accountDomainName' => 'cs.weber.edu',
                'accountDomainNameShort' => 'apollo',
                'accountCanonicalForm' => '4',
                'baseDn' => 'dc=cs,dc=weber,dc=edu',
            ),
        );
        $log_path = './tmp/ldap.log';

		$request = $this->getRequest();
        if ($request->isPost()) {
			$authForm = new Auth();
            $form->setInputFilter($authForm->getInputFilter());
			$form->setData($request->getPost());
//<<<<<<< HEAD
			if ($form->isValid()) {

                $authForm->exchangeArray($form->getData());
//				$data = $form->getData();
//                Debug::dump($authForm, 'form', true);
//				$sm = $this->getServiceLocator();
//				$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');

//                echo 'username'. $form->getData()->usr_name;
//                echo 'usr2' . $authForm->usr_name;
//                echo $data->usr_password;
                $authAdapter = new AuthAdapter($options, $authForm->usr_name, $authForm->usr_password);
				
				$auth = new AuthenticationService();
				// or prepare in the globa.config.php and get it from there. Better to be in a module, so we can replace in another module.
				// $auth = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
				// $sm->setService('Zend\Authentication\AuthenticationService', $auth); // You can set the service here but will be loaded only if this action called.
				$result = $auth->authenticate($authAdapter);

                // Write to log
                 if ($log_path) {
                     $messages = $result->getMessages();

                     $logger = new Logger;
                     $writer = new LogWriter($log_path);

                     $logger->addWriter($writer);

                     $filter = new LogFilter(Logger::DEBUG);
                     $writer->addFilter($filter);

                     foreach ($messages as $i => $message) {
                         if ($i-- > 1) { // $messages[2] and up are log messages
                             $message = str_replace("\n", "\n  ", $message);
                             $logger->debug("Ldap: $i: $message");
                         }
                     }
                 }
				
				switch ($result->getCode()) {
					case Result::FAILURE_IDENTITY_NOT_FOUND:
						// do stuff for nonexistent identity
                        $messages .= '\nFailure Identity Not Found\n';
						break;

					case Result::FAILURE_CREDENTIAL_INVALID:
						// do stuff for invalid credential
                        $messages .= '\nFailure invalid credential\n';
						break;

					case Result::SUCCESS:
						$storage = $auth->getStorage();
						$storage->write($authAdapter->getAccountObject());
                        $messages .= ' ident: ' . $authAdapter->getIdentity() . ' close ident. ';
						$time = 1209600; // 14 days 1209600/3600 = 336 hours => 336/24 = 14 days
//<<<<<<< HEAD
                        $id = $authAdapter->getAccountObject()->cn;
                        echo $id. '   ';
                        $firstName = $authAdapter->getAccountObject()->givenname;
                        echo $firstName . ' ';
                        $lastName = $authAdapter->getAccountObject()->sn;
                        echo $lastName . ' ';
                        $emailAddress = $authAdapter->getAccountObject()->mail;
                        echo $emailAddress. ' ';
                        Debug::dump($authAdapter->getAccountObject(), 'storage', true);
//						if ($data['rememberme']) $storage->getSession()->getManager()->rememberMe($time); // no way to get the session
						if ($authForm->remember_me) {
							$sessionManager = new \Zend\Session\SessionManager();
							$sessionManager->rememberMe($time);
						}

                        $user = $this->getUserTable()->getUser($id);
                        if($user)
                        {
                            Debug::dump($user, 'user', true);
//                            return $this->redirect()->toRoute('appointment');
                            return $this->redirect()->toRoute('appointment', array('controller' => 'index', 'action' => 'login'));
                        }
                        else
                        {
                            $user = new User();
                            $user->exchangeArray(array(
                                'user_id' => $id,
                                'first_name' => $firstName,
                                'last_name' => $lastName,
                                'email_address' => $emailAddress,
                                'role' => '',
                            ));
                            $this->getUserTable()->saveUser($user);
                            return $this->redirect()->toRoute('appointment');
                        }
						break;
					default:
						// do stuff for other failure
                        $messages .= '\nFailure other failure\n';
						break;
				}				
				foreach ($result->getMessages() as $message) {
					$messages .= "$message\n";
				}			
			 }
		}
		return new ViewModel(array('form' => $form, 'messages' => $messages));
	}
	
	public function logoutAction()
	{
		$auth = new AuthenticationService();
		
		if ($auth->hasIdentity()) {
			$identity = $auth->getIdentity();
		}			
		
		$auth->clearIdentity();
		$sessionManager = new \Zend\Session\SessionManager();
		$sessionManager->forgetMe();
		
		return $this->redirect()->toRoute('auth/default', array('controller' => 'index', 'action' => 'login'));
	}

    public function getUserTable()
    {
        if(!$this->userTable)
        {
            $this->userTable = $this->getServiceLocator()->get('Appointment\Model\UserTable');
        }
        return $this->userTable;
    }
}