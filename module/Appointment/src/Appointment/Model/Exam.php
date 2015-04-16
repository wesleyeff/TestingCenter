<?php
/**
 * Created by PhpStorm.
 * User: wfredrickson
 * Date: 2/25/2015
 * Time: 9:29 PM
 */

namespace Appointment\Model;


use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\Factory as InputFactory;

class Exam implements InputFilterAwareInterface
{
    public $exam_id;
    public $exam_name;
    public $instructor_id;
    public $allowance_time;
    public $comments;
    public $allowed_items;

    protected  $inputFilter;

    public function exchangeArray($data)
    {
        $this->exam_id = (!empty($data['exam_id'])) ? $data['exam_id'] : null;
        $this->exam_name = (!empty($data['exam_name'])) ? $data['exam_name'] : null;
        $this->instructor_id = (!empty($data['instructor_id'])) ? $data['instructor_id'] : null;
        $this->allowance_time = (!empty($data['allowance_time'])) ? $data['allowance_time'] : null;
        $this->comments = (!empty($data['comments'])) ? $data['comments'] : null;
        $this->allowed_items = (!empty($data['allowed_items'])) ? $data['allowed_items'] : null;
    }

    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("not used");
    }

    public function getInputFilter()
    {
        if(!$this->inputFilter)
        {
            $inputFilter = new InputFilter();
            $factory = new InputFactory();

            $inputFilter->add($factory->createInput(array(
                'name' => 'exam_name',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                        ),
                    ),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name' => 'allowance_time',
                'required' => true,
                'filters' => array(
                    array('name' => 'Int'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'Between',
                        'options' => array(
                            'min'      => 1,
                            'max'      => 120,
                        ),
                    ),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name' => 'comments',
                'required' => false,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 1000,
                        ),
                    ),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name' => 'allowed_items',
                'required' => false,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 1000,
                        ),
                    ),
                ),
            )));
            $this->inputFilter = $inputFilter;
        }
        return $inputFilter;
    }
}