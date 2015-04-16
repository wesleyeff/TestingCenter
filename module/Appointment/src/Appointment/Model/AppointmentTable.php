<?php
namespace Appointment\Model;

use Zend\Db\TableGateway\TableGateway;

class AppointmentTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function getAppointment($id)
    {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(array('appointment_id' => $id));
        $row = $rowset->current();
        if(!$row)
        {
            throw new \Exception("Could not find user id: $id");
        }
        return $row;
    }

    public function saveAppointment(Appointment $appointment)
    {
        $data = array(
            'appointment_id' => $appointment->appointment_id,
            'user_id' => $appointment->user_id,
            'start_time' => $appointment->start_time,
            'end_time' => $appointment->end_time,
            'checkin_time' => $appointment->checkin_time,
            'checkout_time' => $appointment->checkout_time,
            'exam_id' => $appointment->exam_id,
            'seat_number' => $appointment->seat_number,
        );

        $id = (int) $appointment->appointment_id;
        if ($id == 0)
        {
            $this->tableGateway->insert($data);
        }
        else
        {
            if($this->getAppointment($id))
            {
                $this->tableGateway->update($data,array('appointment_id' => $id));
            }
            else
            {
                throw new \Exception('User id does not exist');
            }
        }
    }

    public function deleteAppointment($id)
    {
        $this->tableGateway->delete(array('appointment_id' => (int) $id));
    }
}