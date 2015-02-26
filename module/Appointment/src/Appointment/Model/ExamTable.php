<?php
/**
 * Created by PhpStorm.
 * User: wfredrickson
 * Date: 2/25/2015
 * Time: 9:29 PM
 */

namespace Appointment\Model;

use Zend\Db\TableGateway\TableGateway;

class ExamTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        return $this->tableGateway->select();
    }

    public function getExam($id)
    {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if(!$row)
        {
            throw new \Exception("Could not find Exam id: $id");
        }
        return $row;
    }

    public function saveExam(Exam $exam)
    {
        $data = array(
            'exam_name' => $exam->exam_name,
            'instructor_id' => $exam->instructor_id,
            'allowance_time' => $exam->allowance_time,
            'comments' => $exam->comments,
            'allowed_items' => $exam->allowed_items,
        );

        $id = (int) $exam->exam_id;
        if($id == 0)
        {
            $this->tableGateway->insert($data);
        }
        else
        {
            if($this->getExam($id))
            {
                $this->tableGateway->update($data, array('exam_id' => $id));
            }
            else
            {
                throw new \Exception('Exam id does not exist');
            }
        }
    }

    public function deleteExam($id)
    {
        $this->tableGateway->delete(array('exam_id' => (int) $id));
    }
}