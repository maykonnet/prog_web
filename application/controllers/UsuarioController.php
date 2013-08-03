<?php

class UsuarioController extends Zend_Controller_Action
{

    public function init()
    {
		/* Initialize action controller here */
    }

    public function indexAction()
    {		
		$SessionNamespace = new Zend_Session_Namespace('Usuario');
		
		if(empty($SessionNamespace->usuario_id)){
			$this->_helper->redirector('cadastro','usuario');
		}else{
			$this->_helper->redirector('visualizar','usuario');
		}
		 
		$model_usuario = new Application_Model_Usuario();
		$this->view->usuarios = $model_usuario->getUsuarios();
    }

    public function loginAction()
    {				
		$request = $this->getRequest();
		$model_usuario = new Application_Model_Usuario();

		if ($request->isPost()) {
			$formDados = $request->getPost();
			if ($formDados) {
				$resultado = false;
				try {
					$usuario_dados = $model_usuario->login($formDados);
					$SessionNamespace = new Zend_Session_Namespace('Usuario');
					
					$SessionNamespace->usuario_id = $usuario_dados['usuario_id'];
					$SessionNamespace->usuario_nome = $usuario_dados['usuario_nome'];
					$SessionNamespace->usuario_sexo = $usuario_dados['usuario_sexo'];
					$SessionNamespace->usuario_login = $usuario_dados['usuario_login'];
					$SessionNamespace->usuario_perfil = $usuario_dados['usuario_perfil'];

					$this->_helper->redirector('index','index'); // action index, controller usuario
					
				} catch (Exception $ex) {
					$this->view->erro = $ex->getMessage();
				}
			}
		}else{

			$SessionNamespace = new Zend_Session_Namespace('Usuario');
			
			if(empty($SessionNamespace->usuario_id)){
				$this->_helper->redirector('cadastro','usuario');
			}else{
				$this->_helper->redirector('visualizar','usuario');
			}
		}
    }

    public function logoutAction()
    {
		//if (Zend_Session:: namespaceIsset('Usuario')) {
		if(empty($SessionNamespace->usuario_id)){	
    		$Session = new Zend_Session_Namespace('Usuario');
			$Session->unsetAll('');
		}

		$this->_helper->redirector('index', 'index');
    }

    public function cadastroAction()
    {		
		$request = $this->getRequest();
		$model_usuario = new Application_Model_Usuario();
		 
		if ($request->isPost()) {
			$formDados = $request->getPost();
			if ($formDados) {
				try {
					$usuario_id = $model_usuario->inserirUsuario($formDados);
				} catch (Exception $ex) {
					$this->view->erro = $ex->getMessage();
				}
				 
				$this->_helper->redirector('index','usuario');
			}
		}
    }

    public function editarAction()
    {
		$request = $this->getRequest();
		$model_usuario = new Application_Model_Usuario();
		 
		if($request->isPost()) {
			$formDados = $request->getPost();
			if ($formDados) {
				$resultado = false;
				try {
					$usuario_id = $model_usuario->editarUsuario($formDados);
					$this->_helper->redirector('index','usuario');
				} catch (Exception $ex) {
					$this->view->erro = $ex->getMessage();
				}
				 
				// $this->_helper->redirector('index','index');
			}
		}else{
			$usuario_id = $request->getParam('id');

			$dados_usuario = $model_usuario->getDadosUsuario($usuario_id);
			$this->view->usuario_id = $usuario_id;
			$this->view->usuario_nome = $dados_usuario['usuario_nome'];
			$this->view->usuario_sexo = $dados_usuario['usuario_sexo'];
			$this->view->usuario_login = $dados_usuario['usuario_login'];
			$this->view->usuario_senha = $dados_usuario['usuario_senha'];
		}
    }

    public function removerAction()
    {
		$request = $this->getRequest();
		$model_usuario = new Application_Model_Usuario();
		 
		$usuario_id = $request->getParam('id');

		try {
			$model_usuario->excluirUsuario($usuario_id);
			$this->_helper->redirector('index','administrador');
		} catch (Exception $ex) {
			$this->view->erro = $ex->getMessage();
		}
    }

    public function visualizarAction()
    {
		$request = $this->getRequest();
		$model_usuario = new Application_Model_Usuario();
		 
		$usuario_id = $request->getParam('id');
		if(empty($usuario_id)){
    		$Session = new Zend_Session_Namespace('Usuario');
			$usuario_id = $Session->usuario_id;
		}
		$dados_usuario = $model_usuario->getDadosUsuario($usuario_id);
		$this->view->usuario_id = $dados_usuario['usuario_id'];
		$this->view->usuario_nome = $dados_usuario['usuario_nome'];
		$this->view->usuario_sexo = $dados_usuario['usuario_sexo'];
		$this->view->usuario_login = $dados_usuario['usuario_login'];
		$this->view->usuario_perfil = $dados_usuario['usuario_perfil'];
    }


}













