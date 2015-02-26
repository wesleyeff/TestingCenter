<?php
/**
 * Created by PhpStorm.
 * User: wfredrickson
 * Date: 2/25/2015
 * Time: 9:27 PM
 */

namespace Appointment\Controller;

use Appointment\Form\ExamForm;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ExamController extends AbstractActionController
{
    protected $examTable;

    public function indexAction()
    {
        return new ViewModel(
            array(
                'exams' => $this->getExamTable()->fetchAll(),
            )
        );
    }

    public function addAction()
    {
        $form = new ExamForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $exam = new Exam();
            $form->setInputFilter($exam->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $exam->exchangeArray($form->getData());
                $this->getAppointmentTable()->saveAppointment($exam);

                //$mail = new Mail\Message();
//                $mail->setSubject('New Test Scheduled at CS Testing Center');
//                $mail->setBody('You have added an appointment at '.$appt->start_time.'. ');
//                $mail->setFrom('cstestcenter@test.com');
//                $mail->setTo('wesleyeff@gmail.com');

                //$transport = new Mail\Transport\Sendmail();
//                $transport->send($mail);


                // Redirect to list of Exams
                return $this->redirect()->toRoute('exam');
            }
        }
        return array(
            'form' => $form,
            //'teachers' => $this->getUserTable()->getGroup(1),
        );
    }

    public function getExamTable()
    {
        if(!$this->examTable)
        {
            $this->examTable = $this->getServiceLocator()->get('Appointment\Model\ExamTable');
        }
        return $this->examTable;
    }
}