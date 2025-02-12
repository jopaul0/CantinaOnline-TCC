<?php
//Arquivos que detectam a sessão do usuário e a rota do diretório
require './app/scripts/DirUrl.php';
require './app/scripts/isSession.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="<?php echo $diretorio . "/public/assets/style/basic/image/logos/logopng.png" ?>">
    <title>Cantina Online</title>

    <!--Bibliotecas prontas-->
    <!--Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!--SweetAlert2-->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.2/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.2/dist/sweetalert2.all.min.js"></script>
    <!--JQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!--Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <!--Bibliotecas nossas-->
    <link href="<?php echo $diretorio . "/public/assets/style/basic/footer.css" ?>" rel="stylesheet">
    <link href="<?php echo $diretorio . "/public/assets/style/basic/elements.css" ?>" rel="stylesheet">
    <link href="<?php echo $diretorio . "/public/assets/style/admin/controller.css" ?>" rel="stylesheet">
    <link href="<?php echo $diretorio . "/public/assets/style/admin/gerenciamento.css" ?>" rel="stylesheet">
    <link href="<?php echo $diretorio . "/public/assets/style/sobre/sobre.css" ?>" rel="stylesheet">
    <link href="<?php echo $diretorio . "/public/assets/style/home/home.css" ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $diretorio . "/public/assets/style/carrinho/carrinho.css" ?>">
    <link rel="stylesheet" href="<?php echo $diretorio . "/public/assets/style/basic/modal.css" ?>">
    <link rel="stylesheet" href="
  <?php
  if ($session && $_SESSION['tema'] == 'Escuro')
      echo $diretorio . "/public/assets/style/tema/escuro.css";
  else
      echo $diretorio . "/public/assets/style/tema/claro.css";
  ?>">

    <script src="<?php echo $diretorio . "/public/assets/scripts/admin/controller.js" ?>"></script>
</head>

<body>
    <header>
        <!-- The button to toggle the sidebar -->
        <button id="toggle-sidebar" class="bg-transparent border-0"><i
                class="fa fa-angle-right icon-custom text-custom"></i></button>

        <!-- The sidebar container -->
        <div id="sidebar" class="overflow-y-auto">

            <ul class="d-flex flex-column list-unstyled ">

                <li class="controller-nav">
                    <a href="<?php echo $diretorio . "/Home" ?>"
                        class='  d-flex justify-content-center align-items-center w-100'>
                        <div class="logo">
                            <img src="<?php echo $diretorio . "/public/assets/style/basic/image/logos/logopng.png" ?>">
                        </div>
                    </a>
                </li>

                <li>
                    <ul class="d-flex flex-column list-unstyled gap-4 m-0" id="controller-nav">
                        <li class="controller-nav">
                            <a href="<?php echo $diretorio . "/Admin" ?>"
                                class='controller-nav-link nav-link d-flex justify-content-center align-items-center w-100 sidebar-text-custom'>
                                Home
                            </a>
                        </li>

                        <li class="controller-nav">
                            <a href="<?php echo $diretorio . "/Admin/Sobre" ?>"
                                class='controller-nav-link nav-link d-flex justify-content-center align-items-center w-100 sidebar-text-custom'>
                                Sobre
                            </a>
                        </li>

                        <?php
                            require"./app/scripts/isSessionAdm.php";
                            if($sessionadm) echo "<li class='controller-nav'>
                            <a href='$diretorio/Admin/Usuarios'
                                class='controller-nav-link nav-link d-flex justify-content-center align-items-center w-100 sidebar-text-custom'>
                                Usuários
                            </a>
                        </li>"
                        ?>
                        <li class="controller-nav">
                            <a href="<?php echo $diretorio . "/Admin/Pedidos" ?>"
                                class='controller-nav-link nav-link d-flex justify-content-center align-items-center w-100 sidebar-text-custom'>
                                Pedidos
                            </a>
                        </li>
                        <li class="controller-nav">
                            <a href="<?php echo $diretorio . "/Admin/Produtos" ?>"
                                class='controller-nav-link nav-link d-flex justify-content-center align-items-center w-100 sidebar-text-custom'>
                                Produtos
                            </a>
                        </li>
                        <li class="controller-nav">
                            <a href="<?php echo $diretorio . "/Admin/Suporte" ?>"
                                class='controller-nav-link nav-link d-flex justify-content-center align-items-center w-100 sidebar-text-custom'>
                                Suporte
                            </a>
                        </li>
                    </ul>

                    <div id='sidebar-footer' class="d-flex justify-content-end m-4">
                        <i id="close-sidebar" class="fa fa-angle-right sidebar-close-icon cursor-pointer"></i>
                    </div>
                </li>
            </ul>

        </div>
    </header>


    <!--Conteúdo-->
    <?php
    $dados = $this->getDados();
    $this->loadingViewADM($nameView, $dados);
    ?>

    <!--Rodapé-->
    <footer id="rodapeAdmin" class="w-100 py-4 flex-shrink-0 ">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-md-6">

                    <!--Logo Opção-->
                    <a href="https://www.caccto.com.br/alunos/login.php">
                        <img src='<?php echo $diretorio . "/public/assets/style/basic/image/logos/opcao.png" ?>'
                            id='logoopcao'>
                    </a>

                    <!--Local Opção-->
                    <p class="small"> São José Dos Campos <br> Avenida Anchieta, n° 908 Jardim Esplanada <br> 2024 <br>
                    </p>

                    <!--Criadores-->
                    <p class="small mb-0"> &copy; Feito Por: João Scamilla / João Paulo / Caique Camargo </p>
                </div>

                <!--Acesso Rápido-->
                <div class="col-lg-2 col-md-6 quicklinks">
                    <h5 class="mb-3">Links Rápidos</h5>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo $diretorio ?>" class="nav-link-custom">Inicio</a></li>
                        <li><a href="<?php echo $diretorio . "/Categorias" ?>" class="nav-link-custom">Cardápio</a></li>
                        <li><a href="<?php echo $diretorio . "/Carrinho" ?>" class="nav-link-custom">Carrinho</a>
                        </li>
                        <li><a href="<?php echo $diretorio . "/Perfil" ?>" class="nav-link-custom">Conta</a></li>
                    </ul>
                </div>

                <!--Logo CantinaOnline-->
                <div class="col-lg-4 col-md-6">
                    <img src="<?php echo $diretorio . "/public/assets/style/basic/image/logos/logobranco.png" ?>"
                        id="logofooter">
                </div>
            </div>
        </div>
    </footer>
</body>

</html>