<?php
namespace Appointment\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;

class UserTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
//        $resultSet = $this->tableGateway->select();
//        return $resultSet;
        return $this->tableGateway->select();

//        $select = new Select();
//        $select->from('users');
//        $select->columns(array('first' => 'first_name'));
//        $resultSet = $this->tableGateway->selectWith($select);
//        return $resultSet;
    }

    public function getGroup($group_id)
    {
        $group_id = (int)$group_id;
        $resultSet = $this->tableGateway->select(array('role' => $group_id));
        if(!$resultSet)
        {
            throw new \Exception("No users in the group: $group_id");
        }
        return $resultSet;
    }

    public function getUser($id)
    {
        //$id = (int) $id;
        $rowset = $this->tableGateway->select(array('user_id' => $id));
        $row = $rowset->current();
        if(!$row)
        {
            return false;
            throw new \Exception("Could not find user id: $id");
        }
        return $row;
    }

    public function saveUser(User $user)
    {
        $data = array(
            'user_id' => $user->user_id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email_address' => $user->email_address,
            'role' => $user->role,
        );

        $id = $user->user_id;
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