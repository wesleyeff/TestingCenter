<?php
/**
 * Created by PhpStorm.
 * User: wfredrickson
 * Date: 2/25/2015
 * Time: 9:29 PM
 */

namespace Appointment\Model;


class Exam
{
    public $exam_id;
    public $exam_name;
    public $instructor_id;
    public $allowance_time;
    public $comments;
    public $allowed_items;

    public function exchangeArray($data)
    {
        $this->exam_id = (!empty($data['exam_id'])) ? $data['exam_id'] : null;
        $this->exam_name = (!empty($data['exam_name'])) ? $data['exam_name'] : null;
        $this->instructor_id = (!empty($data['instructor_id'])) ? $data['instructor_id'] : null;
        $this->allowance_time = (!empty($data['allowance_time'])) ? $data['allowance_time'] : null;
        $this->comments = (!empty($data['comments'])) ? $data['comments'] : null;
        $this->allowed_items = (!empty($data['allowed_items'])) ? $data['allowed_items'] : null;
    }
}