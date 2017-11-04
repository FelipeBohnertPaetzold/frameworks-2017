<?php

namespace Application\Form;

use Zend\Form\Form;

class Login extends Form
{
    public function __construct()
    {
        parent::__construct();
        $this->add([
                'name' => 'name',
                'options' => [
                        'label' => 'Name',
                ],
                'attributes' => [
                        'class' => 'form-control',
                ],
        ]);
        $this->add([
                'name' => 'password',
                'options' => [
                        'label' => 'Password',
                ],
                'attributes' => [
                        'class' => 'form-control'
                ],
                'type' => 'password',
        ]);
        $this->add([
                'name' => 'send',
                'type' => 'submit',
                'attributes' => [
                        'value' => 'Entrar',
                        'class' => 'btn btn-primary'
                ]
        ]);
        $this->setAttribute('action', '/login/index');
        $this->setAttribute('method', 'post');
    }
}