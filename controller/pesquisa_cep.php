<?php

include('../conexao.php');

$cep = mysqli_real_escape_string($conexao, $_POST['cep']);

$sql = "SELECT * FROM dados_cep WHERE num_cep = '$cep'";
$resultados = mysqli_query($conexao, $sql);

if(mysqli_num_rows($resultados) > 0)
{
    //SE ENCONTRADO NO BD, RETORNA PARA A INDEX E ENCERRA A CONEXÃO
    $linha = mysqli_fetch_assoc($resultados);
    header('location: ../index.php?q='.$linha['id']);
    exit;
}
else
{
    //SE NÃO ENCONTRADO NO BD, CONSULTA VIA URL O CEP E O INSERE NO BANCO DE DADOS
    $cep = str_replace("-","",$cep);
    $xml = simplexml_load_file("https://viacep.com.br/ws/".$cep."/xml/");

    //SE CEP NAO ENCONTRADO, RETORNA ERRO PARA INDEX E ENCERRA CONEXÃO
    if($xml->erro == true)
    {
        header('Location:../index.php?errorcep');
        die();
    }
    else
    {
        $inserir = "INSERT INTO dados_cep (num_cep, cidade, uf, bairro, rua, ibge)
                    VALUES ('$xml->cep', '$xml->localidade', '$xml->uf', '$xml->bairro', '$xml->logradouro', '$xml->ibge')";
        
        if($conexao->query($inserir) === TRUE)
        {
            header('Location:../index.php?q='.$xml->cep);
            die();
        }
        else
        {
            //header('Location:../index.php?errorinterno');
            die($conexao->error);
        }
    }
}


