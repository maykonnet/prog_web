
<?php
		$cep = $_POST['cep'];
        $resultado_busca = busca_cep($cep);  
        //echo "<pre> Array Retornada: ".print_r($resultado_busca, true)."</pre>";  
  
        switch($resultado_busca['resultado']){  
            case '2':  
                $texto = " 
                Cidade com logradouro único 
                <b>Cidade: </b> ".$resultado_busca['cidade']." 
                <b>UF: </b> ".$resultado_busca['uf']." 
                ";    
                break;  
      
            case '1':  
                $texto = " 
                Cidade com logradouro completo 
                <b>Tipo de Logradouro: </b> ".$resultado_busca['tipo_logradouro']." 
                <b>Logradouro: </b> ".$resultado_busca['logradouro']." 
                <b>Bairro: </b> ".$resultado_busca['bairro']." 
                <b>Cidade: </b> ".$resultado_busca['cidade']." 
                <b>UF: </b> ".$resultado_busca['uf']." 
                ";  
            break;  

            default:  
                $texto = "Fala ao buscar cep: ".$resultado_busca['resultado'];
            break;  
        }  
        
        $array_dados = array($resultado_busca['resultado'],
        		$resultado_busca['tipo_logradouro'], 
        		utf8_encode($resultado_busca['logradouro']),
        		utf8_encode($resultado_busca['bairro']),
        		utf8_encode($resultado_busca['cidade']),
        		$resultado_busca['uf']);
     //echo $texto;  
     echo implode('-', $array_dados);
   
    function busca_cep($cep){  
        $resultado = @file_get_contents('http://republicavirtual.com.br/web_cep.php?cep='.urlencode($cep).'&formato=query_string');  
        if(!$resultado){  
            $resultado = "&resultado=0&resultado_txt=erro+ao+buscar+cep";  
        }  
        parse_str($resultado, $retorno);   
        return $retorno;  
    } 
    
 ?>  