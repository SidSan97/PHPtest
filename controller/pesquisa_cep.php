<?php

include('../conexao.php');

$cep = $_POST['cep'];

$sql = "SELECT * FROM dados_cep WHERE num_cep = '$cep'";
$resultados = mysqli_query($conexao, $sql);

if(mysqli_num_rows($resultados) > 0)
{
    $linha = mysqli_fetch_assoc($resultados);
    header('location: ../index.php?id='.$linha['id']);
    exit;
}
else
{
    $cep = str_replace("-","",$cep);
    $xml = simplexml_load_file("https://viacep.com.br/ws/".$cep."/xml/");

    $inserir = "INSERT INTO dados_cep VALUES (num_cep, cidade, uf, bairro, rua, ibge)
                VALUES ('$xml->cep', '$xml->cidade', '$xml->uf', '$xml->bairro', '$xml->logradouro', '$xml->ibge')";
    
    if($conexao->query($sql) === TRUE)
    {
        header('Location:../index.php?cep='.$xml->cep);
        die();
    }
    else
    {
        header('Location:../index.php?errorcep');
        die();
    }
}


