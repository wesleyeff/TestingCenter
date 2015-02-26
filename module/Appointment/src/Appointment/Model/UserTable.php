<?php
namespace Appointment\Model;

use Zend\Db\TableGateway\TableGateway;

class UserTable
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

    public function getUser($id)
    {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if(!$row)
        {
            throw new \Exception("Could not find user id: $id");
        }
        return $row;
    }

    public function saveUser(User $user)
    {
        $data = array(
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email_address' => $user->email_address,
            'role' => $user->role,
        );

        $id = (int) $user->user_id;
        if ($id == 0)
        {
            $this->tableGateway->insert($data);
        }
        else
        {
            if($this->getUser($id))
            {
                $this->tableGateway->update($data,array('user_id' => $id));
            }
            else
            {
                throw new \Exception('User id does not exist');
            }
        }
    }

    public function deleteUser($id)
    {
        $this->tableGateway->delete(array('user_id' => (int) $id));
    }
}