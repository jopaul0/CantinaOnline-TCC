<?php
require './app/scripts/DirUrl.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cantina Online</title>

    <!--JQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!--Bootstrap3-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!--SweetAlert2-->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.2/dist/sweetalert2.min.css" rel="stylesheet" defer>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.2/dist/sweetalert2.all.min.js"></script>

    <!--Bibliotecas Nossas-->
    <link rel="icon" href="<?php echo $diretorio . "/public/assets/style/basic/image/logos/logopng.png" ?>">
    <link rel="stylesheet" href="<?php echo $diretorio . "/public/assets/style/login/login.css" ?>">
    <link rel="stylesheet" href="<?php echo $diretorio . "/public/assets/style/basic/modal.css" ?>">

    <script src="<?php echo $diretorio . "/public/assets/scripts/login/view.js" ?>"></script>
    <script src="<?php echo $diretorio . "/public/assets/scripts/login/form.js" ?>"></script>
</head>

<body>

    <div id="transition-custom"></div>
    <!--Centraliza-->
    <div id="login-content">

        <!--Logo Responsiva-->
        <div>
            <a href='<?php echo $diretorio . "/Home" ?>'>
                <img src="<?php echo $diretorio . "/public/assets/style/basic/image/logos/letreiropng.png" ?>"
                    id="responsive-image" alt="logo">
            </a>
        </div>

        <!--Logo Normal-->
        <div id="login-left-content">
            <a href='<?php echo $diretorio . "/Home" ?>'>
                <img src="<?php echo $diretorio . "/public/assets/style/basic/image/logos/logobranco.png" ?>"
                    id="login-left-image" alt="logo">
            </a>
        </div>

        <!--Login-->
        <div id="card-login" class="right-login">
            <div class="card-login-custom">

                <h1 class='card-title-custom'>LOGIN</h1>

                <form method="POST" id='logar'>
                    <!--CPF Login-->
                    <div class="textfield-custom">
                        <label for="usuario">CPF ou Email</label>
                        <input type="text" name="usuario" required id="usuario-logar" placeholder="123.456.789-10"
                            autocomplete='off'>
                    </div>

                    <!--Senha Login-->
                    <div class="textfield-custom">
                        <label for="senha">Senha</label>
                        <div class="password"><input type="password" name="senha" placeholder="oswaldo123"
                                id="senha-logar" required class='senha' autocomplete='off'><span
                                class="glyphicon glyphicon-eye-open icon versenha" id="showPassword-login"></span></div>
                    </div>

                    <input type="submit" class="btn_login" value="enviar" id="btn-logar"></input>
                </form>

                <p id="teste">Não tem uma conta?</p>
                <button id="cadastro" class='btn_cadastro'>Faça cadastro!</button>
            </div>
        </div>






        <!--Cadastro-->
        <div id="card-cadastro" class="right-login cadastro">
            <div class="card-login-custom">
                <h1 class='card-title-custom'>CADASTRO</h1>
                <form method="POST" id="cadastrar" action="<?php echo $diretorio . "/Login/registrar" ?>">

                    <div class="cadastro-org">
                        <div class="textfield-custom">
                            <label for="cpf">CPF</label>
                            <input type="text" name="cpf" placeholder="123.456.789-00" id="cpf-cadastro" required
                                pattern="^\d{3}\.\d{3}\.\d{3}-\d{2}$" autocomplete='off'>
                        </div>
                        <div class="textfield-custom">
                            <label for="nome">Nome</label>
                            <input type="text" name="nome" placeholder="Oswaldo" id="nome-cadastro" required
                                autocomplete='off'>
                        </div>
                    </div>
                    <div class="cadastro-org">
                        <div class="textfield-custom">
                            <label for="sobrenome">Sobrenome</label>
                            <input type="text" name="sobrenome" placeholder="Neto" id='sobrenome-cadastro' required
                                autocomplete='off'>
                        </div>
                        <div class="textfield-custom">
                            <label for="email">Email</label>
                            <input type="email" name="email" placeholder="oswaldinho@gmail.com" id="email-cadastro"
                                autocomplete='off' required>
                        </div>
                    </div>
                    <div class="cadastro-org">
                        <div class="textfield-custom">
                            <label for="telefone">Telefone</label>
                            <input type="text" name="telefone" placeholder="(99)99999-9999" id="telefone-cadastro"
                                autocomplete='off' required pattern="^\(\d{2}\)\d{5}-\d{4}$">
                        </div>
                        <div class="textfield-custom">
                            <label for="senha">Senha</label>
                            <div class="password"><input type="password" name="senha" placeholder="oswaldo123"
                                    autocomplete='off' id="senha-cadastro" required pattern=".{8,}" class='senha'><span
                                    class="glyphicon glyphicon-eye-open icon versenha-c"
                                    id="showPassword-cadastro"></span>
                            </div>
                        </div>
                    </div>

                    <input type="submit" value="enviar" class="btn_login" id="btn-cadastrar"></input>
                </form>
                <p> Já tem uma conta?</p>
                <button id='login' class='btn_cadastro'>Faça login!</button>
            </div>
        </div>
</body>

</html>