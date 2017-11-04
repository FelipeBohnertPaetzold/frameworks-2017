<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AuthController extends AbstractActionController
{
    public $tableGateway;
    public $sessionContainer;

    public function __construct($tableGateway, $sessionContainer)
    {
        $this->tableGateway = $tableGateway;
        $this->sessionContainer = $sessionContainer;
    }

    public function indexAction()
    {
        $form = new \Application\Form\Login;
        $form->setAttribute('action', '/login/index');
        $request = $this->getRequest();

        if ($request->isPost()) {
            $user = new \Application\Model\User;

            $form->setInputFilter($user->getInputFilter());

            $form->setData($request->getPost());

            if ($form->isValid()) {
                $data = $form->getData();
                $exist = $this->tableGateway->select(['name' => $data['name']]);
                $ok = true;
                if (count($exist) == 0) {
                    $form->get('name')->setMessages(['Nome inválido']);
                    $ok = false;
                }
                $credentials = $this->tableGateway->select(['name' => $data['name'], 'password' => $data['password']]);
                if (count($credentials) == 0) {
                    $form->get('password')->setMessages(['Senha incorreta']);
                    $ok = false;
                }
                if ($ok) {
                    $this->sessionContainer->user = $data['name'];
                    return $this->redirect()->toUrl('/beer');
                }

            }
        }
        $view = new ViewModel(['form' => $form]);
        $view->setTemplate('application/login/login.phtml');

        return $view;
    }
}