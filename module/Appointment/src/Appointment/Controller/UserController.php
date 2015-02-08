<?php
namespace Appointment\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\View;

class UserController extends AbstractActionController
{
    protected $userTable;

    public function indexAction()
    {
//        return new ViewModel();
        return new ViewModel(
            array(
                'users' => $this->getUserTable()->fetchAll(),
            )
        );
    }

    public function addAction()
    {

    }

    public function editAction()
    {
        return new ViewModel();
    }

    public  function deleteAction()
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