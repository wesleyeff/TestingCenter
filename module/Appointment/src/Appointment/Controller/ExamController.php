<?php
/**
 * Created by PhpStorm.
 * User: wfredrickson
 * Date: 2/25/2015
 * Time: 9:27 PM
 */

namespace Appointment\Controller;

use Appointment\Form\ExamForm;
use Appointment\Model\Exam;
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
                $this->getExamTable()->saveExam($exam);

                // Redirect to list of Exams
                return $this->redirect()->toRoute('exam');
            }
        }
        return array(
            'form' => $form,
        );
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('exam', array(
                'action' => 'add'
            ));
        }
        $exam = $this->getExamTable()->getExam($id);

        $form  = new ExamForm();
        $form->bind($exam);
        $form->get('submit')->setAttribute('value', 'Save');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($exam->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->getExamTable()->saveExam($form->getData());

                // Redirect to list of albums
                return $this->redirect()->toRoute('exam');
            }
        }

        return array(
            'exam_id' => $id,
            'form' => $form,
        );
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('exam');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->getExamTable()->deleteExam($id);
            }

            // Redirect to list of albums
            return $this->redirect()->toRoute('exam');
        }

        return array(
            'id'    => $id,
            'exam' => $this->getExamTable()->getExam($id)
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