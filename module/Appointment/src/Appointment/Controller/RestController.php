<?php
/**
 * Created by PhpStorm.
 * User: wfredrickson
 * Date: 3/15/2015
 * Time: 7:13 PM
 */

namespace Appointment\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;

use Zend\Mvc\View\Http\ViewManager;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;

class RestController extends AbstractRestfulController
{
    protected $userTable;

    public function indexAction()
    {
        return new ViewModel();
    }

    public function getList()
    {
        $results = $this->getUserTable()->fetchAll();
        $data = array();
        foreach($results as $result) {
            $data[] = $result;
        }

        return new JsonModel(array(
            'users' => $data, //$this->getUserTable()->fetchAll(),
            'success' => true,
            'title' => 'Some Title',
        ));
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