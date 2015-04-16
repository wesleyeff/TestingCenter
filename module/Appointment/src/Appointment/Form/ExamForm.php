<?php
/**
 * Created by PhpStorm.
 * User: wfredrickson
 * Date: 2/26/2015
 * Time: 1:46 PM
 */

namespace Appointment\Form;

use Zend\Form\Form;

class ExamForm extends Form
{
    public function __construct()
    {
        parent::__construct('exam');

        $this->add(array(
            'name' => 'exam_id',
            'type' => 'Hidden',
        ));
//        $this->add(array(
//            'name' => 'exam_id',
//            'type' => 'Text',
//            'options' => array(
//                'label' => 'Exam ID',
//            ),
//            'attributes' => array(
//                //'class' => 'col-md-4',
//            )
//        ));
        $this->add(array(
            'name' => 'exam_name',
            'type' => 'Text',
            'options' => array(
                'label' => 'Exam Name',
            ),
            'attributes' => array(
            ),
        ));
        $this->add(array(
            'name' => 'instructor_id',
            'type' => 'hidden',
            'options' => array(
                'label' => 'Instructor Id'
            ),
            'attributes' => array(
            ),
        ));
        $this->add(array(
            'name' => 'allowance_time',
            'type' => 'Text',
            'options' => array(
                'label' => 'Allowance Time'
            ),
            'attributes' => array(
            ),
        ));
        $this->add(array(
            'name' => 'comments',
            'type' => 'Textarea',
            'options' => array(
                'label' => 'Comments'
            ),
            'attributes' => array(
            ),
        ));
        $this->add(array(
            'name' => 'allowed_items',
            'type' => 'Textarea',
            'options' => array(
                'label' => 'Allowed Items'
            ),
            'attributes' => array(
            ),
        ));
        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Go',
                'id' => 'submitbutton',
                'class' => 'btn btn-default',
            ),
        ));
    }
}