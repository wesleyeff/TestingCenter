<?php

namespace Appointment\Model;

class User
{
    public $user_id;
    public $first_name;
    public $last_name;
    public $email_address;
    public $role;

    public function exchangeArray($data)
    {
        $this->user_id = (!empty($data['user_id'])) ? $data['user_id'] : null;
        $this->first_name = (!empty($data['first_name'])) ? $data['first_name'] : null;
        $this->last_name = (!empty($data['last_name'])) ? $data['last_name'] : null;
        $this->email_address = (!empty($data['email_address'])) ? $data['email_address'] : null;
        $this->role = (!empty($data['role'])) ? $data['role']: null;
    }
}