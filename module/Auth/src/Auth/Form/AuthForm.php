<?php
namespace Auth\Form;

use Zend\Form\Form;

class AuthForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('auth');
        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'usr_name',
            'type' => 'text',
            'options' => array(
//                'placeholder' => 'w#',
            ),
            'attributes' => array(
                'placeholder' => 'Username',
//                'class' => 'form-control input-lg',
            ),
        ));
        $this->add(array(
            'name' => 'usr_password',
            'type'  => 'password',
            'options' => array(
//                'label' => 'Password',
            ),
            'attributes' => array(
                'placeholder' => 'Password',
//                'class' => 'form-control input-lg',
            ),
        ));
        $this->add(array(
            'name' => 'rememberme',
			'type' => 'checkbox',
            'attributes' => array(
                'class' => 'rememberme',
            ),
            'options' => array(
                'label' => 'Remember Me?',
            ),
        ));			
        $this->add(array(
            'name' => 'submit',
            'type'  => 'submit',
            'attributes' => array(
                'value' => 'Go',
                'id' => 'submitbutton',
                'class' => 'btn btn-default',
            ),
        )); 
    }
}