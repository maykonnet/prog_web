<?php

class Application_Model_Servicos
{

    public function inserirServico($dados)
	{
		$_db_servico = new Application_Model_Servicos();
		
		$dados_banco = array('servico_nome' => $dados['servico_nome'],
							'servico_descricao' => $dados['descricao']);
		
		$_db_servico->insert($dados_banco);
	}
        
public function editarServico($dados){
    
    
    
}

}

