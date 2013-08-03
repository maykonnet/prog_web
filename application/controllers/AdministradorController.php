<?php

class AdministradorController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
    	$model_usuario = new Application_Model_Usuario();
    	$this->view->usuarios = $model_usuario->getUsuarios();
    }


}

