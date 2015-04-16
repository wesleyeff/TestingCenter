<?php
namespace Appointment\Controller;

use Appointment\Form\AppointmentForm;
use Appointment\Model\Appointment;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Mail;

class AppointmentController extends AbstractActionController
{
    protected $appointmentTable;
    protected $userTable;

    public function indexAction()
    {
//        return new ViewModel();
        return new ViewModel(
            array(
                'appointments' => $this->getAppointmentTable()->fetchAll(),
            )
        );
    }

    public function apiAction()
    {
        return array(
                'appointments' => $this->getAppointmentTable()->fetchAll(),
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

//                $mail = new Mail\Message();
//                $mail->setSubject('New Test Scheduled at CS Testing Center');
//                $mail->setBody('You have added an appointment at '.$appt->start_time.'. ');
//                $mail->setFrom('cstestcenter@test.com');
//                $mail->setTo('wesleyeff@gmail.com');
//
//                $transport = new Mail\Transport\Sendmail();
//                $transport->send($mail);


                // Redirect to list of albums
                return $this->redirect()->toRoute('appointment');
            }
        }
        return array(
            'form' => $form,
            'teachers' => $this->getUserTable()->getGroup(1),
        );
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('appointment', array(
                'action' => 'add'
            ));
        }
        $appt = $this->getAppointmentTable()->getAppointment($id);

        $form = new AppointmentForm();
        $form->bind($appt);
        $form->get('submit')->setAttribute('value', 'Save');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($appt->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->getAppointmentTable()->saveAppointment($form->getData());

                // Redirect to list of albums
                return $this->redirect()->toRoute('appointment');
            }
        }

        return array(
            'appointment_id' => $id,
            'form' => $form,
        );
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('appointment');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->getAppointmentTable()->deleteAppointment($id);
            }

            // Redirect to list of albums
            return $this->redirect()->toRoute('appointment');
        }

        return array(
            'id'    => $id,
            'appt' => $this->getAppointmentTable()->getAppointment($id),
        );
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