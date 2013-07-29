<?php

class Application_Model_Usuario
{

	public function inserirUsuario($dados)
	{
		$_db_usuario = new Application_Model_DbTable_Usuario();
		
		$dados_banco = array('usuario_nome' => $dados['nome'],
							'usuario_sexo' => $dados['sexo'],
							'usuario_login' => $dados['login_C'],
							'usuario_senha' => md5($dados['senha_C']));
		
		$_db_usuario->insert($dados_banco);
	}

}

