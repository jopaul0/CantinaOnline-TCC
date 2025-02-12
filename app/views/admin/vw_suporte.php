<?php
require './app/scripts/DirUrl.php';
?>
<div class="top"></div>
<img class="bg-image" src="<?php echo $diretorio . '/public/assets/style/sobre/img/fundoSobre.jpg'; ?>"
    alt="Background">

<div id="sidebar-elements"
    class="shadow background overflow-y-auto d-flex flex-column justify-content-start gap-4 sidebar-control">

</div>

<div class="card card-input bg-light d-flex align-items-center justify-content-center m-4 rounded"
    id="card-suporte-pergunta">
    <div class="w-75 overflow-y-auto">
        <div class="m-2 d-flex flex-column justify-content-center align-items-center gap-4">
            <h5 class="text-center p-2 text-custom">Alguma Dúvida?</h5>
            <input type="text" class="form-control form-control-lg mb-3 shadow-sm rounded" name="duvidas"
                placeholder="Tire suas dúvidas!" style="height: 100px;" id='input-search-suport'>
        </div>
    </div>
    <div id="faq" class="w-100">
        <?php

        for ($c = 0; $c < count($faq); $c++) {

            echo "<div data-bs-toggle='collapse' data-bs-target='#" . $faq[$c]['id'] . "' aria-expanded='false' aria-controls='" . $faq[$c]['id'] . "' class= 'd-flex cursor-pointer justify-content-between align-items-center flex-row border-top border rounded p-4 w-100'><div class='pergunta'>" . $faq[$c]['pergunta'] . "</div>
<i class='fa fa-angle-right mostrar-resposta' type='button'>
</i>
</div>
<div class='collapse' id='" . $faq[$c]['id'] . "'>
<div class='card card-body collapse-custom text-custom w-100 border-0 cursor-pointer edit-element' data-id-faq='" . $faq[$c]['id'] . "'>
" . $faq[$c]['resposta'] . "
</div>
</div>
";
            //echo "ID: " . $faq[$c]['id'] . "\n";
        }
        ?>
    </div>
</div>
</div>
</div>
</div>

<script src="<?php echo $diretorio . "/public/assets/scripts/admin/suport.js" ?>"></script>