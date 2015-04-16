<?php
namespace Appointment\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Zend\Json\Json;

#auth
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Adapter\Ldap as AuthAdapter;
use Zend\Config\Reader\Ini as ConfigReader;
use Zend\Config\Config;
use Zend\Log\Logger;
use Zend\Log\Writer\Stream as LogWriter;
use Zend\Log\Filter\Priority as LogFilter;

class UserController extends AbstractActionController
{
    protected $userTable;
    protected $auth;

    public function __construct()
    {
        if(!$this->auth)
        {
            $this->auth = new AuthenticationService();
        }
    }

    public function indexAction()
    {
//        return new ViewModel();
        return new ViewModel(
            array(
                'users' => $this->getUserTable()->fetchAll(),
            )
        );
    }

    public function thingAction()
    {
        $results = $this->getUserTable()->fetchAll();
        $data = array();
        foreach($results as $result) {
            $data[] = $result;
        }

        return new JsonModel(array(
            'users' => $data, //$this->getUserTable()->fetchAll(),
            'success' => true,
            'title' => 'Some Tite',
        ));
    }

    public function addAction()
    {

    }

    public function editAction()
    {
        return new ViewModel();
    }

    public function deleteAction()
    {

    }

    public function loginAction()
    {

    }

    public function getUserTable()
    {
        if(!$this->userTable)
        {
            $sm = $this->getServiceLocator();
            $this->userTable = $sm->get('Appointment\Model\UserTable');
        }
        return $this->userTable;
    }
}