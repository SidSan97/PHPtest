<?php
    include('conexao.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>


    <title>Home</title>
</head>
<body>
    <div class="container">
        <section class="pesquisa-cep mb-4">
            <div class="d-flex justify-content-center mb-5 mt-3">

                <!--CEP NÃO ENCONTRADO-->
                <?php
                    if(isset($_GET['errorcep'])):
                ?>
                    <div class="notification error" id="notification">
                        <span align="center">ERRO: CEP não encontrado</span>
                        <button onclick="fecharNotificacao()">X</button>
                    </div>        
                <?php
                    endif;
                ?>

                <!--ERRO INTERNO-->
                <?php
                    if(isset($_GET['senhaerror'])):
                ?>
                    <div class="notification error" id="notification2">
                        <span align="center">Lamentamos o ocorrido. Tente novamente</span>
                        <button onclick="fecharNotificacao2()">X</button>
                    </div>        
                <?php
                    endif;
                ?>
            </div>

            <h1 class="titulo mt-4">Consulta de CEP</h1>

            <div class="row">
                <form action="controller/pesquisa_cep.php" method="post">
                    <div class="pesquisa">
                        <input type="text" class="mt-3" required name="cep" id="cep" maxlength="9" placeholder="Digite o CEP" onkeypress="$(this).mask('00000-000')">
                        <button type="submit" class="mt-3" id="btnPesquisa"><img src="img/search.png" alt="" srcset=""></button>
                    </div>
                </form>
            </div>
        </section>

        <hr>

        <section class="resultado-cep mt-4">
            <?php 
                if(isset($_GET['q']))
                {
                    $sql = "SELECT * FROM dados_cep WHERE id = $_GET[q] or num_cep = '$_GET[q]'";
                    $resultados = mysqli_query($conexao, $sql);

                    if(mysqli_num_rows($resultados) > 0)
                    {
                        while($linha = mysqli_fetch_assoc($resultados))
                        {
                          echo '
                            <h2 align="center">Resultado da Busca por CEP</h2> <br>

                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label for="cep">Cep:</label>
                                    <input type="text" value="'.$linha["num_cep"].'" class="form-control" id="cep" readonly>
                                </div>
                
                                <div class="col-md-6 mb-2">
                                    <label for="cidade">Cidade:</label>
                                    <input type="text" value="'.$linha['cidade'].'" class="form-control" id="cidade" readonly>
                                </div>
                            </div>
                
                            <div class="row">
                                <div class="col-md-2 mb-2">
                                    <label for="uf">UF:</label>
                                    <input type="text" value="'.$linha['uf'].'" class="form-control" id="uf" readonly>
                                </div>
                
                                <div class="col-md-6 mb-2">
                                    <label for="rua">Rua:</label>
                                    <input type="text" value="'.$linha['rua'].'" class="form-control" id="rua" readonly>
                                </div>
                
                                <div class="col-md-4 mb-2">
                                    <label for="ibge">IBGE:</label>
                                    <input type="text" value="'.$linha['ibge'].'" class="form-control" id="ibge" readonly>
                                </div>
                            </div>';
                        }
                    }
                }
            ?>
        </section>
       
    </div>
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>