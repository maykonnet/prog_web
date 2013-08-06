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
	
	public function editarUsuario($dados)
	{
		$_db_usuario = new Application_Model_DbTable_Usuario();
		
		if(empty($dados['senha_C'])){
			$dados_banco = array('usuario_nome' => $dados['nome'],
								'usuario_sexo' => $dados['sexo'],
								'usuario_login' => $dados['login_C']);
		}else{
			$dados_banco = array('usuario_nome' => $dados['nome'],
					'usuario_sexo' => $dados['sexo'],
					'usuario_login' => $dados['login_C'],
					'usuario_senha' => md5($dados['senha_C']));
		}
		
		$_db_usuario->update($dados_banco, 'usuario_id = '.$dados['usuario_id']);
	}
	
	public function getDadosUsuario($usuario_id)
	{
		$_db_usuario = new Application_Model_DbTable_Usuario();

		$dados_banco = $_db_usuario->fetchRow('usuario_id ='.$usuario_id);
		
		$dados = array(		'usuario_id' => $dados_banco['usuario_id'],
							'usuario_nome'   => $dados_banco['usuario_nome'],
							'usuario_sexo'   => $dados_banco['usuario_sexo'],
							'usuario_login'  => $dados_banco['usuario_login'],
							'usuario_senha'  => $dados_banco['usuario_senha'],
							'usuario_perfil' => $dados_banco['usuario_perfil']
		);
		
		return $dados;			
	}
	
	public function getUsuarios()
	{
		$_db_usuario = new Application_Model_DbTable_Usuario();
		
		$dados_banco = $_db_usuario->fetchAll();
		
		$dados_usuarios = array();
		foreach($dados_banco as $usuario){
			$dados_usuarios[] = array('usuario_id' => $usuario['usuario_id'],
					'usuario_nome' => $usuario['usuario_nome'],
					'usuario_sexo' => $usuario['usuario_sexo'],
					'usuario_login' => $usuario['usuario_login'],
					'usuario_senha' => $usuario['usuario_senha']);
		}
		
		return $dados_usuarios;
		
	}
	
	public function login($dados_login)
	{
		$_db_usuario = new Application_Model_DbTable_Usuario();
		$login = $dados_login['login'];
		$senha = $dados_login['senha'];
	
		$dados_banco = $_db_usuario->fetchRow("usuario_login = '".$login."' and usuario_senha = '".md5($senha)."'");
	
		$dados = array('usuario_id' => $dados_banco['usuario_id'],
				'usuario_nome' => $dados_banco['usuario_nome'],
				'usuario_sexo' => $dados_banco['usuario_sexo'],
				'usuario_login' => $dados_banco['usuario_login'],
				'usuario_senha' => $dados_banco['usuario_senha'],
				'usuario_perfil' => $dados_banco['usuario_perfil']
		);
	
		return $dados;
	}
	
	public function excluirUsuario($usuario_id)
	{
		$_db_usuario = new Application_Model_DbTable_Usuario();
		$_db_usuario->delete('usuario_id ='.$usuario_id);		
	}
	
}

