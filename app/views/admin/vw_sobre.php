<!--Coisa que tem em todos os arquivos-->
<?php
require './app/scripts/DirUrl.php';
?>

<body id='body-sobre'>
    <div id="sidebar-elements"
        class="shadow background overflow-y-auto d-flex flex-column justify-content-start gap-4 sidebar-control">

    </div>

    <div id="content-sobre">
        <!--Fundo Sobre-->
        <img class="bg-image" src="<?php echo $diretorio . '/public/assets/style/sobre/img/fundoSobre.jpg'; ?>"
            alt="Background">

        <!--Texto Inicial-->
        <div id='alto-sobre' class='cursor-pointer edit-info' data-id-info='1'>
            <?php
            echo "
            <h1 class='p-3 text-center'>" . $sobre[0]['titulo'] . "</h1>
            <div class='pb-3'>
            <p>
            " . $sobre[0]['texto'] . "
            </p>
            </div>
        ";
            ?>

        </div>

        <!--Card Nosso Dever-->
        <div class="bg-light d-flex justify-content-between m-4 rounded cursor-pointer edit-info" data-id-info='2'
            style="max-height:300px" id="card-nosso-dever">

            <!--Imagem Do Vidro Da Cantina-->
            <div class="w-50 d-flex align-items-center img-sobre">
                <img class="w-100 h-100 object-fit-cover shadow rounded img-sobre"
                    src="<?php echo $diretorio . "/public/assets/style/sobre/img/vidropdt.jpg" ?>">
            </div>

            <div class="w-50 overflow-y-auto text-sobre">
                <div class="m-2">
                    <?php
                    echo "
                <h5 class='text-center p-2 text-custom'>" . $sobre[1]['titulo'] . "</h5>
                <p class='p-2 text-custom'>" . $sobre[1]['texto'] . "</p>
            ";
                    ?>
                </div>
            </div>
        </div>

        <!-- Card Nossa Origem -->
        <div class="bg-light d-flex justify-content-between m-4 rounded cursor-pointer edit-info" data-id-info='3'
            style="max-height:300px" id="card-nossa-origem">
            <!-- Texto Nossa Origem -->
            <div class="w-50 overflow-y-auto text-sobre">
                <div class="m-2">
                    <?php
                    echo "
                <h5 class='text-center p-2 text-custom'>" . $sobre[2]['titulo'] . "</h5>
                <p class='p-2 text-custom'>" . $sobre[2]['texto'] . "</p>
            ";
                    ?>
                </div>
            </div>

            <!--Imagem Opção Antigo-->
            <div class="w-50 d-flex align-items-center img-sobre">
                <img class="w-100 h-100 object-fit-cover shadow rounded"
                    src="<?php echo $diretorio . "/public/assets/style/sobre/img/origem.jpeg" ?>">
            </div>

        </div>
    </div>

    <script src="<?php echo $diretorio . "/public/assets/scripts/admin/about.js" ?>"></script>