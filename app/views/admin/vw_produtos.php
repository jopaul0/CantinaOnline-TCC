<?php
require './app/scripts/DirUrl.php';
?>


<!-- Modal Adicionar -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content background">
            <div class="modal-header">
                <h5 class="modal-title text-custom" id="addProductModalLabel">Adicionar Produto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addProductForm" enctype="multipart/form-data" method="post">
                    <div class="row">
                        <div class="col-6">
                            <!-- Right side -->
                            <div class="mb-3">
                                <label for="nome" class="form-label text-custom">Nome</label>
                                <input type="text" class="form-control background text-custom" placeholder="Almoço"
                                    id="add-nome" name="nome">
                            </div>
                            <div class="mb-3">
                                <label for="descricao" class="form-label text-custom">Descrição</label>
                                <input type="text" class="form-control background text-custom" id="add-descricao"
                                    name="descricao" placeholder="Saudades eternas."></input>
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label text-custom">Status</label>
                                <select class="form-select background text-custom" id="add-status" name="status">
                                    <option value="Disponivel">Disponível</option>
                                    <option value="Indisponivel">Indisponível</option>
                                </select>
                            </div>

                        </div>
                        <div class="col-6">
                            <!-- Left side -->
                            <div class="mb-3">
                                <label for="preco" class="form-label text-custom">Preço</label>
                                <input type="text" class="form-control addpreco-input background text-custom"
                                    id="add-preco" name="preco" placeholder="16.00" required
                                    pattern="[0-9]{2}\.[0-9]{2}">
                            </div>
                            <div class="mb-3">
                                <label for="categoria" class="form-label text-custom">Categoria</label>
                                <select class="form-select background text-custom" id="add-categoria" name="categoria">
                                    <?php

                                    for ($ca = 0; $ca < count($produtos['categorias']); $ca++) {
                                        echo '<option value="' . $produtos['categorias'][$ca]['id'] . '">' . $produtos['categorias'][$ca]["nome"] . '</option>';
                                    }
                                    ?>
                                    <!-- Adicione mais opções aqui -->
                                </select>
                            </div>


                            <div class="mb-3">
                                <label for="foto" class="form-label text-custom">Foto</label>
                                <input type="file" class="form-control background text-custom" name="foto" id="add-foto"
                                    required accept="image/*">
                            </div>


                        </div>
                        <div class="preview">
                            <img id="preview"
                                src="<?php echo $diretorio . "/public/assets/style/basic/image/logos/logopng.png"; ?>"
                                class="rounded border-2 shadow">
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="submit" form="addProductForm" class="btn btn-custom-blue">Adicionar Produto</button>
            </div>
        </div>
    </div>
</div>

<!--Deletar Imgem-->
<div class="modal fade" id="modal-confirm-delete-img">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content background">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title text-custom">Deletar Imagem</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <div class="text-center">
                    <span class="text-custom">Deseja deletar a imagem selecionada?</span>
                </div>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" id="btn-confirm-delete-img" class="btn btn-danger">Confirmar</button>
            </div>
        </div>
    </div>
</div>

<!--Deletar Imgem-->
<div class="modal fade" id="modal-confirm-edit-product">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content background">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title text-custom">Editar Informações</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <div class="text-center">
                    <span class="text-custom">Deseja editar as informações desse produto?</span>
                </div>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <input type="submit" form="form-edit-product" class="btn btn-custom-blue" value="Confirmar"></input>
            </div>
        </div>
    </div>
</div>

<!--Adicionar Imagem-->
<div class="modal fade" id="modal-add-img">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content background">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title text-custom">Adicionar Imagem</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form method="POST" id="form-add-img" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="input-add-image" class="form-label text-custom">Escolha a foto do
                            produto</label>
                        <input type="file" class="form-control background text-custom" name="input-add-image"
                            id="input-add-image" accept="image/*" required>
                    </div>
                </form>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="submit" form="form-add-img" class="btn btn-custom-blue">Confirmar</button>
            </div>
        </div>
    </div>
</div>




<!--Adicionar Variedade-->
<div class="modal fade" id="modal-add-variety">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content background">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title text-custom">Adicionar Variedade</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form method="POST" id="form-add-variety">
                    <div class="mb-3">
                        <label for="input-add-variety" class="form-label text-custom">Digite o nome da nova
                            variedade</label>
                        <input type="text" class="form-control background text-custom" id="input-add-variety" required
                            placeholder="Prato Feito">
                    </div>
                </form>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="submit" form="form-add-variety" class="btn btn-custom-blue">Confirmar</button>
            </div>
        </div>
    </div>
</div>


<!--Deletar Variedade-->
<div class="modal fade" id="modal-confirm-delete-variety">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content background">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title text-custom">Deletar Variedade</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <div class="text-center">
                    <span class="text-custom">Deseja deletar a variedade selecionada?</span>
                </div>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="submit" form="form-delete-variety" class="btn btn-danger">Deletar</button>
            </div>
        </div>
    </div>
</div>

<!--Deletar Variedade-->
<div class="modal fade" id="modal-confirm-delete-price">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content background">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title text-custom">Deletar Preço</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <div class="text-center">
                    <span class="text-custom">Deseja deletar o preço selecionado?</span>
                </div>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="submit" form="form-delete-price" class="btn btn-danger">Deletar</button>
            </div>
        </div>
    </div>
</div>

<!--Deletar Variedade-->
<div class="modal fade" id="modal-confirm-delete-product">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content background">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title text-custom">Deletar Produto</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <div class="text-center">
                    <span class="text-custom">Você tem certeza que deseja deletar esse produto?</span>
                </div>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="submit" id='btn-confirm-delete-product' class="btn btn-danger">Deletar</button>
            </div>
        </div>
    </div>
</div>




<!--Barra lateral dos produtos-->
<div id="sidebar-products"
    class="shadow background overflow-y-auto d-flex flex-column justify-content-start gap-4 sidebar-control">
</div>



<div class="p-1 background border rounded m-3">
    <div class="d-flex flex-column m-2">
        <div class="mx-auto">
            <h1 class="text-custom">
                Produtos
            </h1>
        </div>
        <div class="d-flex justify-content-between">
            <div class="d-flex justify-content-start m-2">

                <form class="d-flex justify-content-evenly">

                    <select class="form-select background text-custom mx-2" id="select-filter-search">
                        <option value="nome">Nome</option>
                        <option value="id">ID</option>
                        <option value="categoria">Categoria</option>
                        <option value="status">Situação</option>
                    </select>


                    <div class='d-flex justify-content-between border border-2 rounded-pill background text-custom p-2'>
                        <input id='search-control' type="text" class="border-0 text-custom bg-transparent"
                            placeholder="Lanches">
                        <i class="text-custom fa fa-search p-1"></i>
                    </div>
                </form>
            </div>
            <div class="d-flex justify-content-end p-3">
                <button class="btn btn-custom-blue border rounded-circle" data-bs-toggle="modal"
                    data-bs-target="#addProductModal">
                    <i class="fa fa-plus"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table id="tabela-produtos" class="table border-none">
            <thead>
                <tr class='background text-custom'>
                    <th scope="col">Foto</th>
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Situação</th>
                </tr>
            </thead>
            <tbody id="adm-table-row">
                <?php
                for ($c = 0; $c < count($produtos['tabela1']); $c++) {
                    echo "
                    <tr data-id-produto='" . $produtos['tabela1'][$c]['id'] . "' class='border tr-produto cursor-pointer teste-hover'>
                    <td class='td-produto'>
                        <img src='$diretorio/media/products/" . $produtos['tabela1'][$c]['imagens'][0]['imagem'] . "'
                            class='rounded img-primary-gerenciamento'>
                    </td>
                    <td class='td-produto'>" . $produtos['tabela1'][$c]['id'] . "</td>
                    <td class='td-produto'>" . $produtos['tabela1'][$c]['nome'] . "</td>
                    <td class='td-produto'>" . $produtos['tabela1'][$c]['categoria_nome'] . "</td>
                    <td class='td-produto'>" . $produtos['tabela1'][$c]['status'] . "</td>
                    </tr>
                    ";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script src="<?php echo $diretorio . "/public/assets/scripts/admin/productcontrol.js" ?>"></script>