<?php
namespace Appointment\Controller;

use Appointment\Form\AppointmentForm;
use Appointment\Model\Appointment;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\View;

class AppointmentController extends AbstractActionController
{
    protected $appointmentTable;

    public function indexAction()
    {
//        return new ViewModel();
        return new ViewModel(
            array(
                'appointments' => $this->getAppointmentTable()->fetchAll(),
            )
        );
    }

    public function addAction()
    {
        $form = new AppointmentForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $appt = new Appointment();
            $form->setInputFilter($appt->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $appt->exchangeArray($form->getData());
                $this->getAppointmentTable()->saveAppointment($appt);

                // Redirect to list of albums
                return $this->redirect()->toRoute('appointment');
            }
        }
        return array('form' => $form);
    }

    public function editAction()
    {
        return new ViewModel();
    }

    public  function deleteAction()
    {

    }

    public function getAppointmentTable()
    {
        if(!$this->appointmentTable)
        {
            $sm = $this->getServiceLocator();
            $this->appointmentTable = $sm->get('Appointment\Model\AppointmentTable');
        }
        return $this->appointmentTable;
    }

}