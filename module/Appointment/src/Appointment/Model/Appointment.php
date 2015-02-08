<?php

namespace Appointment\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Appointment implements InputFilterAwareInterface
{
    public $appointment_id;
    public $user_id;
    public $start_time;
    public $end_time;
    public $checkin_time;
    public $checkout_time;
    public $exam_id;
    public $seat_number;

    protected $inputFilter;

    public function exchangeArray($data)
    {
        $this->appointment_id = (!empty($data['appointment_id'])) ? $data['appointment_id'] : null;
        $this->user_id = (!empty($data['user_id'])) ? $data['user_id'] : null;
        $this->start_time = (!empty($data['start_time'])) ? $data['start_time'] : null;
        $this->end_time = (!empty($data['end_time'])) ? $data['end_time'] : null;
        $this->checkin_time = (!empty($data['checkin_time'])) ? $data['checkin_time'] : null;
        $this->checkout_time = (!empty($data['checkout_time'])) ? $data['checkout_time'] : null;
        $this->exam_id = (!empty($data['exam_id'])) ? $data['exam_id'] : null;
        $this->seat_number = (!empty($data['seat_number'])) ? $data['seat_number'] : null;
    }

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();

            $inputFilter->add(array(
                'name'     => 'appointment_id',
                'required' => false,
            ));
            $inputFilter->add(array(
                'name'     => 'user_id',
                'required' => false,
            ));
            $inputFilter->add(array(
                'name'     => 'start_time',
                'required' => false,
            ));
            $inputFilter->add(array(
                'name'     => 'end_time',
                'required' => false,
            ));
            $inputFilter->add(array(
                'name'     => 'checkin_time',
                'required' => false,
            ));
            $inputFilter->add(array(
                'name'     => 'checkout_time',
                'required' => false,
            ));
            $inputFilter->add(array(
                'name'     => 'exam_id',
                'required' => false,
            ));
            $inputFilter->add(array(
                'name'     => 'seat_number',
                'required' => false,
            ));


            $this->inputFilter = $inputFilter;
        }
        return $this->inputFilter;
    }
}