<?php
require './app/scripts/DirUrl.php';
?>

<!--Adicionar Pagamento-->
<div class="modal fade" id="modal-confirm-payday">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content background">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title text-custom">Confirmar Pagamento</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <div class="text-center">
                    <span class="text-custom">Deseja confirmar que o usuário realizou o pagamento?</span>
                </div>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" id="btn-confirm-payday" class="btn btn-custom-blue">Confirmar</button>
            </div>
        </div>
    </div>
</div>

<div id="sidebar-request"
    class="shadow background overflow-y-auto d-flex flex-column justify-content-start gap-4 sidebar-control">
</div>

<div class="p-1 background border rounded m-3">
    <div class="d-flex flex-column m-2">
        <div class="mx-auto">
            <h1 class="text-custom">
                Pedidos
            </h1>
        </div>
        <div class="d-flex justify-content-between">
            <div class="d-flex justify-content-start m-2">

                <form class="d-flex justify-content-evenly">

                    <select class="form-select background text-custom mx-2" id="select-filter-search">
                        <option value='nome'>Nome</option>
                        <option value='status'>Situação</option>
                        <option value='pagamento'>Pagamento</option>
                    </select>


                    <div class='d-flex justify-content-between border border-2 rounded-pill background text-custom p-2'>
                        <input id='search-control' type="text" class="border-0 text-custom bg-transparent"
                            placeholder="Lanches">
                        <i class="text-custom fa fa-search p-1"></i>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table id="tabela-pedidos" class="table border-none">
            <thead>
                <tr class='background text-custom'>
                    <th scope="col">Foto</th>
                    <th scope="col">ID do Usuário</th>
                    <th scope="col">Nome</th>
                    <th scope="col">ID do Pedido</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Situação</th>
                    <th scope="col">Pagamento</th>
                    <th scope="col">Data do Pedido</th>
                </tr>
            </thead>
            <tbody id="adm-table-row">
                <?php
                for ($c = 0; $c < count($pedidos['pedido']); $c++) {
                    echo "
                        <tr data-id-pedido='" . $pedidos['pedido'][$c]['id_pedido'] . "' class='border tr-pedido cursor-pointer teste-hover'>
                        <td class='td-pedido'>
                            <img src='$diretorio/media/profiles/" . $pedidos['pedido'][$c]['imagem_usuario'] . "'
                                class='rounded img-primary-gerenciamento'>
                        </td>
                        <td class='td-pedido'>" . $pedidos['pedido'][$c]['id_usuario'] . "</td>
                        <td class='td-pedido'>" . $pedidos['pedido'][$c]['nome_usuario'] . "</td>
                        <td class='td-pedido'>" . $pedidos['pedido'][$c]['id_pedido'] . "</td>
                        <td class='td-pedido'>" . $pedidos['pedido'][$c]['total_pedido'] . "</td>
                        <td class='td-pedido'>" . $pedidos['pedido'][$c]['status_pedido'] . "</td>
                        <td class='td-pedido'>" . $pedidos['pedido'][$c]['status_pagamento'] . "</td>
                        <td class='td-pedido'>" . $pedidos['pedido'][$c]['data_diapedido'] . "</td>
                        </tr>
                        ";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script src="<?php echo $diretorio . "/public/assets/scripts/admin/requestcontrol.js" ?>"></script>