<?php

namespace Appointment\Form;

use Zend\Form\Form;


class AppointmentForm extends Form
{
    public function __construct()
    {
        parent::__construct('appointment');

        $this->add(array(
            'name' => 'appointment_id',
            'type' => 'Hidden',
        ));
        $this->add(array(
            'name' => 'user_id',
            'type' => 'Text',
            'options' => array(
                'label' => 'User ID'
            ),
        ));
        $this->add(array(
            'name' => 'start_time',
            'type' => 'Text',
            'options' => array(
                'label' => 'Start Time'
            ),
        ));
        $this->add(array(
            'name' => 'end_time',
            'type' => 'Text',
            'options' => array(
                'label' => 'End Time'
            ),
        ));
        $this->add(array(
            'name' => 'checkin_time',
            'type' => 'Text',
            'options' => array(
                'label' => 'Checkin Time'
            ),
        ));
        $this->add(array(
            'name' => 'checkout_time',
            'type' => 'Text',
            'options' => array(
                'label' => 'Checkout Time'
            ),
        ));
        $this->add(array(
            'name' => 'exam_id',
            'type' => 'Text',
            'options' => array(
                'label' => 'Exam ID'
            ),
        ));
        $this->add(array(
            'name' => 'seat_number',
            'type' => 'Text',
            'options' => array(
                'label' => 'Seat Number'
            ),
        ));
        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Go',
                'id' => 'submitbutton',
            ),
        ));
    }
}