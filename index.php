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
        <h1 class="titulo mt-4">Consulta de CEP</h1>

        <div class="row">
            <form action="controller/pesquisa_cep.php" method="post">
                <div class="pesquisa">
                    <input type="text" class="mt-3" required name="cep" id="cep" maxlength="9" placeholder="Digite o CEP" onkeypress="$(this).mask('00000-000')">
                    <button type="submit" class="mt-3"><img src="img/search.png" alt="" srcset=""></i></button>
                </div>
            </form>
        </div>
    </div>
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>