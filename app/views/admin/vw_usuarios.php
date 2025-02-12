<?php
require './app/scripts/DirUrl.php';
?>

<!--Deletar Imgem-->
<div class="modal fade" id="modal-confirm-delete-image">
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
                    <span class="text-custom">Deseja deletar a imagem desse usuário?</span>
                </div>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" id="btn-confirm-delete-image" class="btn btn-danger text-light">Deletar</button>
            </div>
        </div>
    </div>
</div>




<div id="sidebar-users"
    class="shadow background overflow-y-auto d-flex flex-column justify-content-start gap-4 sidebar-control">

</div>

<div class="p-1 background border rounded m-3">
    <div class="d-flex flex-column m-2">
        <div class="mx-auto">
            <h1 class="text-custom">
                Usuarios
            </h1>
        </div>
        <div class="d-flex justify-content-start m-2">

            <form class="d-flex justify-content-evenly">

                <select class="form-select background text-custom mx-2" id="select-filter-search">
                    <option value="nome">Nome</option>
                    <option value="id">ID</option>
                    <option value="cpf">CPF</option>
                    <option value="telefone">Telefone</option>
                    <option value="email">Email</option>
                    <option value="status">Status</option>
                </select>


                <div class='d-flex justify-content-between border border-2 rounded-pill background text-custom p-2'>
                    <input id='search-control' type="text" class="border-0 text-custom bg-transparent"
                        placeholder="Oswaldo">
                    <i class="text-custom fa fa-search p-1"></i>
                </div>
            </form>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table id="tabela-usuarios" class="table border-none">
            <thead>
                <tr class='background text-custom'>
                    <th scope="col">Foto</th>
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">CPF</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">Email</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody id="adm-table-row">
                <?php
                for ($c = 0; $c < count($usuarios); $c++) {
                    echo "
                    <tr data-id-usuario='" . $usuarios[$c]['id'] . "' class='border tr-usuario cursor-pointer teste-hover'>
                    <td class='td-usuario'>
                        <img src='$diretorio/media/profiles/" . $usuarios[$c]['imagem'] . "'
                            class='rounded img-primary-gerenciamento'>
                    </td>
                    <td class='td-usuario'>" . $usuarios[$c]['id'] . "</td>
                    <td class='td-usuario'>" . $usuarios[$c]['nome'] . " " . $usuarios[$c]['sobrenome'] . "</td>
                    <td class='td-usuario'>" . $usuarios[$c]['cpf'] . "</td>
                    <td class='td-usuario'>" . $usuarios[$c]['telefone'] . "</td>
                    <td class='td-usuario'>" . $usuarios[$c]['email'] . "</td>
                    <td class='td-usuario'>" . $usuarios[$c]['status_usuario'] . "</td>
                    </tr>
                    ";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script src="<?php echo $diretorio . "/public/assets/scripts/admin/usercontrol.js" ?>"></script>