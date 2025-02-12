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
  <link href="<?php echo $diretorio . "/public/assets/style/basic/header.css" ?>" rel="stylesheet">
  <link href="<?php echo $diretorio . "/public/assets/style/basic/footer.css" ?>" rel="stylesheet">
  <link href="<?php echo $diretorio . "/public/assets/style/basic/elements.css" ?>" rel="stylesheet">
  <link href="<?php echo $diretorio . "/public/assets/style/home/home.css" ?>" rel="stylesheet">
  <link href="<?php echo $diretorio . "/public/assets/style/perfil/perfil.css" ?>" rel="stylesheet">
  <link href="<?php echo $diretorio . "/public/assets/style/cardapio/cardapio.css" ?>" rel="stylesheet">
  <link href="<?php echo $diretorio . "/public/assets/style/sobre/sobre.css" ?>" rel="stylesheet">
  <link href="<?php echo $diretorio . "/public/assets/style/suporte/suporte.css" ?>" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo $diretorio . "/public/assets/style/basic/modal.css" ?>">
  <link rel="stylesheet" href="<?php echo $diretorio . "/public/assets/style/carrinho/carrinho.css" ?>">
  <link rel="stylesheet" href="
  <?php
  if ($session && $_SESSION['tema'] == 'Escuro')
    echo $diretorio . "/public/assets/style/tema/escuro.css";
  else
    echo $diretorio . "/public/assets/style/tema/claro.css";
  ?>">
  <link rel="stylesheet" href="<?php echo $diretorio . "/public/assets/style/pedido/pedir.css" ?>">

  <script src="<?php echo $diretorio . "/public/assets/scripts/basic/head.js" ?>"></script>
  <script src="<?php echo $diretorio . "/public/assets/scripts/basic/search.js" ?>"></script>

  <?php
  if ($session){
    echo "<script src='$diretorio/public/assets/scripts/basic/ajax.js'></script>";
    if($_SESSION['notificacoes']=='Sim'){
      echo "<script src='$diretorio/public/assets/scripts/basic/notification.js'></script>";
    }
  }


  
  ?>
</head>

<body>
  <!--Menu-->
  <header id="desktop-header">

    <!--Logo-->
    <div class="logo">
      <a href="<?php echo $diretorio . "/Home" ?>">
        <img src="<?php echo $diretorio . "/public/assets/style/basic/image/logos/logopng.png" ?>">
      </a>
    </div>

    <!--Links-->
    <nav>
      <ul class="nav justify-content-center">
        <li class="nav-item">
          <div class="position-relative">
            <a class="nav-link nav-link-custom" href="" id="desktop-nav-categories">CARDAPIO</a>
            <div class="menu-nav-categories" id="desktop-subnav-categories">
              <a class="menu-nav-links" href="<?php echo $diretorio . "/Categorias/listar/1" ?>">Salgados</a>
              <a class="menu-nav-links" href="<?php echo $diretorio . "/Categorias/listar/2" ?>">Sorvetes</a>
              <a class="menu-nav-links" href="<?php echo $diretorio . "/Categorias/listar/3" ?>">Bebidas</a>
              <a class="menu-nav-links" href="<?php echo $diretorio . "/Categorias/listar/4" ?>">Guloseimas</a>
              <a class="menu-nav-links" href="<?php echo $diretorio . "/Categorias/listar/5" ?>">Sobremesas</a>
            </div>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-link-custom" href="<?php echo $diretorio . "/Sobre" ?>">SOBRE</a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-link-custom" href="<?php echo $diretorio . "/Suporte" ?>">SUPORTE</a>
        </li>
      </ul>
    </nav>



    <ul class="nav justify-content-around">
      <!--Barra de pesquisa-->
      <li class="p-2">
        <div class="d-flex justify-content-around rounded-pill border border-3 border-white search-custom p-1">
          <form id="desktop-form-search" class="d-flex justify-content-between">
            <input type="text" id="desktop-input-search" class="mx-2 border-0 bg-transparent rounded-pill"
              placeholder="Lanches" autocomplete="off">
            <button type="submit" class="mx-2 border-0 bg-transparent">
              <i class="fa fa-search search-icon"></i>
            </button>
          </form>
        </div>
        <div id='search-suggestions' class="d-none overflow-y-auto border rounded background d-flex flex-column">
        </div>
      </li>

      <!--Carrinho de compras-->
      <li class="p-2 d-flex flex-column justify-content-center">
        <a class="border-0 bg-transparent" href="<?php echo $diretorio . "/Carrinho" ?>">
          <i class="fa fa-shopping-cart cart-icon"></i>
        </a>
      </li>


      <?php

      if ($session == true) {
        echo "<li class='p-2'>
    <div class='position-relative cursor-pointer'>
      
        <img src='$diretorio/media/profiles/" . $_SESSION['imagem'] . "' class='rounded-circle border border-3 border-white profile-icon' id='desktop-profile-icon'>
      <div class='profile-menu' id='desktop-profile-menu'>
        <a class='menu-text-links' href='$diretorio/Perfil'>Perfil</a>
        <a class='menu-text-links' href='$diretorio/Login/logout'>Sair</a>
      </div>
      <div>
  </li>
  <li class='p-2'>
  <div class='position-relative d-flex'>
            <span class='nav-link nav-link-custom'>R$ <span class='user-cash'>" . $_SESSION['saldo'] . "</span></span>
    </div>      
  </li>";
      } else {
        echo "<li class='p-2'>
    <div class='position-relative'>
      <a href='$diretorio/Login' class='border-0 bg-transparent'>
        <i class='fa fa-user-circle-o icon-user'></i>
      </a>
      <div>
  </li>
  ";
      }
      ?>

    </ul>

  </header>




  <!--Menu Responsivo para telas medianas-->
  <header id="mediumscreen-header">

    <!--Parte de cima-->
    <div id="mediumscreen-top-menu">

      <!--Logo-->
      <div class="logo">
        <a href="<?php echo $diretorio . "/Home" ?>">
          <img src="<?php echo $diretorio . "/public/assets/style/basic/image/logos/logopng.png" ?>">
        </a>
      </div>

      <!--Barra de pesquisa-->
      <li class="nav justify-content-around">
      <li class="p-2">
        <div class="d-flex justify-content-around rounded-pill border border-3 border-white search-custom p-1">
          <form id="mediumscreen-form-search" class="d-flex justify-content-between">
            <input type="text" id="mediumscreen-input-search" class="mx-2 border-0 bg-transparent rounded-pill"
              placeholder="Lanches">
            <button type="submit" class="mx-2 border-0 bg-transparent">
              <i class="fa fa-search search-icon"></i>
            </button>
          </form>
        </div>
        <div id='mediumscreen-search-suggestions'
          class="d-none overflow-y-auto border rounded background text-custom d-flex flex-column"></div>
      </li>

      <!--Carrinho de Compras-->
      <li class="p-2 d-flex">
        <div class="p-2 d-flex flex-column justify-content-center">
          <a class="border-0 bg-transparent" href="<?php echo $diretorio . "/Carrinho" ?>">
            <i class="fa fa-shopping-cart cart-icon"></i>
          </a>
        </div>

        <!--Perfil-->
        <?php
        if ($session == true) {
          echo "<div class='p-2'>
  <div class='position-relative'>
    
      <img src='$diretorio/media/profiles/" . $_SESSION['imagem'] . "' class='rounded-circle border border-3 border-white profile-icon' id='mediumscreen-profile-icon'>
    <div id='mediumscreen-profile-menu'>
      <a class='menu-text-links' href='$diretorio/Perfil'>Perfil</a>
      <a class='menu-text-links' href='$diretorio/Login/logout'>Sair</a>
    </div>
    </div>
</div>
<div class='p-2 d-flex flex-column justify-content-center'>
  <div class='position-relative'>
            <div class='d-flex h-100'>
              <span class='nav-link nav-link-custom'>R$ <span class='user-cash'>" . $_SESSION['saldo'] . "</span></span>
            </div>
    </div>
  </div>
";
        } else {
          echo "<div class='p-2'>
  <div class='position-relative'>
    <a href='$diretorio/Login' class='border-0 bg-transparent'>
      <i class='fa fa-user-circle-o icon-user'></i>
    </a>
    </div>
</div>";
        }
        ?>

      </li>
      </ul>
    </div>

    <!--Links do site-->
    <nav id="mediumscreen-nav-links">
      <ul class="nav justify-content-beetwen ">
        <li class="nav-item">
          <div class="position-relative">
            <a class="nav-link nav-link-custom" href="" id="mediumscreen-nav-categories">CARDAPIO</a>
            <div class="menu-nav-categories" id="mediumscreen-subnav-categories">
              <a class="menu-nav-links" href="<?php echo $diretorio . "/Categorias/listar/1" ?>">Salgados</a>
              <a class="menu-nav-links" href="<?php echo $diretorio . "/Categorias/listar/2" ?>">Sorvetes</a>
              <a class="menu-nav-links" href="<?php echo $diretorio . "/Categorias/listar/3" ?>">Bebidas</a>
              <a class="menu-nav-links" href="<?php echo $diretorio . "/Categorias/listar/4" ?>">Guloseimas</a>
              <a class="menu-nav-links" href="<?php echo $diretorio . "/Categorias/listar/5" ?>">Sobremesas</a>
            </div>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-link-custom" href="<?php echo $diretorio . "/Sobre" ?>">SOBRE</a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-link-custom" href="<?php echo $diretorio . "/Suporte" ?>">SUPORTE</a>
        </li>
      </ul>
    </nav>

  </header>





  <!--Menu Responsivo para celular-->
  <header id="cellphone-header">
    <div class="d-flex align-items-center justify-content-around">

      <!--Logo-->
      <div class="logo">
        <a href="<?php echo $diretorio . "/Home" ?>">
          <img src="<?php echo $diretorio . "/public/assets/style/basic/image/logos/logopng.png" ?>">
        </a>
      </div>

      <!--Setinha para baixo-->
      <div id="arrow-down-menu">
        <i class="fa fa-angle-down"></i>
      </div>

      <!--Links-->
      <div id="cellphone-nav-links">

        <!--Busca-->
        <div class="cellphone-nav-itens">
          <div class="nav justify-content-around">
            <div class="d-flex justify-content-around rounded-pill border border-3 border-white search-custom p-1">
              <form id="cellphone-form-search" class="d-flex justify-content-between">
                <input type="text" id="cellphone-input-search" class="mx-2 border-0 bg-transparent rounded-pill"
                  placeholder="Lanches" autocomplete="off">
                <button type="submit" class="mx-2 border-0 bg-transparent">
                  <i class="fa fa-search search-icon"></i>
                </button>
              </form>
            </div>
          </div>
          <div id='cellphone-search-suggestions'
            class="d-none overflow-y-auto border rounded background text-custom d-flex flex-column"></div>
        </div>

        <!--Categorias-->
        <div class="cellphone-nav-itens" id="cellphone-nav-categories">
          CARDAPIO <i class="fa fa-angle-down" id="arrow-down-categories"></i>
          <div id="cellphone-subnav-categories">
            <a class="cellphone-nav-itens" href="<?php echo $diretorio . "/Categorias/listar/1" ?>">SALGADOS</a>
            <a class="cellphone-nav-itens" href="<?php echo $diretorio . "/Categorias/listar/2" ?>">SORVETES</a>
            <a class="cellphone-nav-itens" href="<?php echo $diretorio . "/Categorias/listar/3" ?>">BEBIDAS</a>
            <a class="cellphone-nav-itens" href="<?php echo $diretorio . "/Categorias/listar/4" ?>">GULOSEIMAS</a>
            <a class="cellphone-nav-itens" href="<?php echo $diretorio . "/Categorias/listar/5" ?>">SOBREMESAS</a>
          </div>
        </div>
        <a class="cellphone-nav-itens" href="<?php echo $diretorio . "/Sobre" ?>">SOBRE</a>
        <a class="cellphone-nav-itens" href="<?php echo $diretorio . "/Suporte" ?>">SUPORTE</a>

      </div>
    </div>


    <!--Parte direita-->
    <!--Carrinho de compras-->
    <div id="cellphone-top-right-menu">
      <div class="p-2 d-flex flex-column justify-content-center">
        <a class="border-0 bg-transparent" href="<?php echo $diretorio . "/Carrinho" ?>">
          <i class="fa fa-shopping-cart cart-icon"></i>
        </a>
      </div>

      <!--Perfil-->
      <?php
      if ($session == true) {
        echo "<div class='p-2'>
                <div class='position-relative'>
                  <img src='$diretorio/media/profiles/" . $_SESSION['imagem'] . "' class='rounded-circle border border-3 border-white profile-icon' id='cellphone-profile-icon'>
                  <div class='profile-menu' id='cellphone-profile-menu'>
                    <a class='menu-text-links' href='$diretorio/Perfil'>Perfil</a>
                    <a class='menu-text-links' href='$diretorio/Login/logout'>Sair</a>
                  </div>
                </div>
              </div>

<div class='p-2 d-flex flex-column justify-content-center'>
  <div class='position-relative'>
            <div class='d-flex h-100'>
              <span class='nav-link nav-link-custom'>R$ <span class='user-cash'>" . $_SESSION['saldo'] . "</span></span>
            </div>
    </div>
  </div>
";
      } else {
        echo "<div class='p-2'>
  <div class='position-relative'>
    <a href='$diretorio/Login' class='border-0 bg-transparent'>
      <i class='fa fa-user-circle-o icon-user'></i>
    </a>
    <div>
</div>";
      }
      ?>
    </div>
  </header>

  <!--Notificações-->
  <div class="overflow-hidden">
    <div id="home-notificacao" class='d-none text-custom background'>
      <div id="qntd-notificacao">Você tem uma nova notificação!</div>

      <a id="notification" href='<?php echo $diretorio."/Perfil"?>' class="text-center border-top text-custom w-100 cont-notificacao">Seja bem vindo(a) ao Cantina Online+!</a>

    </div>
  </div>

  <?php
  require "./app/scripts/isSessionOfficial.php";
  if ($sessionofficial == true) {
    echo "
    <div class='botao-admin'>
    <a href='$diretorio/Admin' class='fa fa-user-plus botao-flutuante cursor-pointer'></a>
  </div>
    ";
  }
  ?>

  <!--Conteúdo-->
  <?php
  $dados = $this->getDados();
  $this->loadingView($nameView, $dados);
  ?>

  <!--Rodapé-->
  <footer id="rodapeUsuario" class="w-100 py-4 flex-shrink-0">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-4 col-md-6">

          <!--Logo Opção-->
          <a href="https://www.caccto.com.br/alunos/login.php">
            <img src='<?php echo $diretorio . "/public/assets/style/basic/image/logos/opcao.png" ?>' id='logoopcao'>
          </a>

          <!--Local Opção-->
          <p class="small"> São José Dos Campos <br> Avenida Anchieta, n° 908 Jardim Esplanada <br> 2024 <br> </p>

          <!--Criadores-->
          <p class="small mb-0"> &copy; Feito Por: João Scamilla / João Paulo / Caique Camargo </p>
        </div>

        <!--Acesso Rápido-->
        <div class="col-lg-2 col-md-6 quicklinks">
          <h5 class="mb-3">Links Rápidos</h5>
          <ul class="list-unstyled">
            <li><a href="<?php echo $diretorio ?>" class="nav-link-custom">Inicio</a></li>
            <li><a href="<?php echo $diretorio . "/Categorias" ?>" class="nav-link-custom">Cardápio</a></li>
            <li><a href="<?php echo $diretorio . "/Carrinho" ?>" class="nav-link-custom">Carrinho</a></li>
            <li><a href="<?php echo $diretorio . "/Perfil" ?>" class="nav-link-custom">Conta</a></li>
          </ul>
        </div>

        <!--Logo CantinaOnline-->
        <div class="col-lg-4 col-md-6">
          <img src="<?php echo $diretorio . "/public/assets/style/basic/image/logos/logobranco.png" ?>" id="logofooter">
        </div>
      </div>
    </div>
  </footer>
</body>

</html>