<?php
require './app/scripts/DirUrl.php';
?>

<div id="container-profile" class="main-content overflow-hidden">
    <!--Nav da tela-->
    <div class="row d-flex justify-content-center">
        <div class="nav justify-content-center rounded nav-pills d-flex" id="v-pills-tab" role="tablist">
            <button class="nav-link shadow rounded active tab-custom-profile tab-text-profile-color background"
                id="v-pills-perfil-tab" data-bs-toggle="pill" data-bs-target="#v-pills-perfil" type="button" role="tab"
                aria-controls="v-pills-perfil" aria-selected="true">
                <div class="circle-icon"> <i class="tab-icon-profile fa fa-user"></i> </div>
                <h5 class="tab-text-profile">Perfil</h5>
            </button>

            <button class="nav-link shadow rounded tab-custom-profile tab-text-profile-color background"
                id="v-pills-historico-tab" data-bs-toggle="pill" data-bs-target="#v-pills-historico" type="button"
                role="tab" aria-controls="v-pills-historico" aria-selected="false">
                <div class="circle-icon"> <i class="fa fa-clock-o tab-icon-profile" aria-hidden="true"></i> </div>
                <h5 class="tab-text-profile">Pedidos</h5>
            </button>

            <button class="nav-link shadow rounded tab-custom-profile tab-text-profile-color background"
                id="v-pills-notificacao-tab" data-bs-toggle="pill" data-bs-target="#v-pills-notificacao" type="button"
                role="tab" aria-controls="v-pills-notificacao" aria-selected="false">
                <div class="circle-icon"> <i class="fa fa-commenting-o tab-icon-profile" aria-hidden="true"></i> </div>
                <h5 class="tab-text-profile">Notificações</h5>
            </button>

            <button class="nav-link shadow rounded tab-custom-profile tab-text-profile-color background" id="v-pills-settings-tab"
                data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab"
                aria-controls="v-pills-settings" aria-selected="false">
                <div class="circle-icon"> <i class="fa fa-cogs tab-icon-profile" aria-hidden="true"></i> </div>
                <h5 class="tab-text-profile">Preferências</h5>
            </button>
        </div>

        <!--Painel do Perfil-->
        <div class="tab-content d-flex justify-content-center" id="v-pills-tabContent">
            <div class="tab-pane fade show active" id="v-pills-perfil" role="tabpanel"
                aria-labelledby="v-pills-perfil-tab">






                <!--Modal de editar imagem-->
                <div class="modal fade" id="modal-edit-image">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content background">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title text-custom">Editar foto de perfil</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <!-- Modal Body -->
                            <div class="modal-body">
                                <form id="form-edit-image" enctype="multipart/form-data">
                                    <!-- Imagem -->
                                    <div class="mb-3">
                                        <label for="input-edit-image" class="form-label text-custom">Escolha sua foto de
                                            perfil</label>
                                        <input type="file" class="form-control background text-custom" name="input-edit-image"
                                            id="input-edit-image" accept="image/*" required>
                                    </div>
                                    <!--Preview-->
                                    <div class="preview">
                                        <img id="preview"
                                            src="<?php echo $diretorio . "/media/profiles/" . $_SESSION['imagem']; ?>"
                                            class="rounded-circle border-2 shadow">
                                    </div>
                                </form>
                            </div>

                            <!-- Modal Footer -->
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-custom-blue" form="form-edit-image">Aplicar
                                    Mudanças</button>
                            </div>
                        </div>
                    </div>
                </div>






                <!--Modal de editar o nome-->
                <div class="modal fade" id="modal-edit-name">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content background">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title text-custom">Editar nome</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <!-- Modal Body -->
                            <div class="modal-body">
                                <form id="form-edit-name">
                                    <!-- Imagem -->
                                    <div class="mb-3">
                                        <label for="input-edit-name" class="form-label text-custom">Nome</label>
                                        <input type="text" class="form-control background text-custom" name="input-edit-name"
                                            id="input-edit-name" value="<?php echo $_SESSION['nome']; ?>" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="input-edit-lastname" class="form-label text-custom">Sobrenome</label>
                                        <input type="text" class="form-control background text-custom" name="input-edit-lastname"
                                            id="input-edit-lastname" value="<?php echo $_SESSION['sobrenome']; ?>"
                                            required>
                                    </div>
                                </form>
                            </div>

                            <!-- Modal Footer -->
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-custom-blue" form="form-edit-name">Aplicar
                                    Mudanças</button>
                            </div>
                        </div>
                    </div>
                </div>








                <!--Modal de editar o telefone-->
                <div class="modal fade" id="modal-edit-cellphone">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content background">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title text-custom">Editar Telefone</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <!-- Modal Body -->
                            <div class="modal-body">
                                <form id="form-edit-cellphone">
                                    <!-- telefone -->
                                    <div class="mb-3">
                                        <label for="input-edit-cellphone" class="form-label text-custom">Telefone</label>
                                        <input type="text" class="form-control background text-custom" name="input-edit-cellphone"
                                            id="input-edit-cellphone" value="<?php echo $_SESSION['telefone']; ?>"
                                            required>
                                    </div>
                                </form>
                            </div>

                            <!-- Modal Footer -->
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-custom-blue" form="form-edit-cellphone">Aplicar
                                    Mudanças</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Modal de editar o email-->
                <div class="modal fade" id="modal-edit-email">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content background">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title text-custom">Editar Email</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <!-- Modal Body -->
                            <div class="modal-body">
                                <form id="form-edit-email">
                                    <!-- telefone -->
                                    <div class="mb-3">
                                        <label for="input-edit-email" class="form-label text-custom">Email</label>
                                        <input type="email" class="form-control background text-custom" name="input-edit-email"
                                            id="input-edit-email" value="<?php echo $_SESSION['email']; ?>" required>
                                    </div>
                                </form>
                            </div>

                            <!-- Modal Footer -->
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-custom-blue" form="form-edit-email">Aplicar
                                    Mudanças</button>
                            </div>
                        </div>
                    </div>
                </div>



                <!--Modal de editar a senha-->
                <div class="modal fade" id="modal-edit-password">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content background">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title text-custom">Editar Senha</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <!-- Modal Body -->
                            <div class="modal-body">
                                <form id="form-edit-password">
                                    <!-- telefone -->
                                    <div class="mb-3">
                                        <label for="input-edit-password" class="form-label text-custom">Senha</label>
                                        <input type="text" class="form-control background text-custom" name="input-edit-password"
                                            id="input-edit-password" value="<?php echo $_SESSION['senha']; ?>" required>
                                    </div>
                                </form>
                            </div>

                            <!-- Modal Footer -->
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-custom-blue" form="form-edit-password">Aplicar
                                    Mudanças</button>
                            </div>
                        </div>
                    </div>
                </div>










                <!--Perfil-->
                <div id="container-user" class="d-flex justify-content-around m-3 gap-3">
                    <!--Parte esquerda-->
                    <div id="container-user-left" class=" shadow rounded">
                        <div
                            class="d-flex justify-content-center align-items-center flex-column h-100 position-relative gap-3  rounded background">
                            <img src="<?php echo $diretorio . '/media/profiles/' . $_SESSION['imagem']; ?>"
                                class="rounded-circle shadow cursor-pointer" id="foto-perfil">
                            <div id="img-hover" class="rounded-circle shadow text-center d-none">
                                <div class="d-flex flex-column justify-content-center h-100">
                                    <div id="icon-plus">+</div>
                                </div>
                            </div>

                            <i id="nubank-eye" class="fa fa-eye-slash cursor-pointer text-secondary text-custom"></i>
                        </div>
                    </div>
                    <!--Parte direita-->
                    <div id="container-user-right" class="shadow rounded background overflow-x-auto">
                        <div class="border-0 d-flex flex-column justify-content-center"
                            style="height:50px">
                            <div class="d-flex justify-content-start m-2">
                                <div class="text-profile-info d-flex flex-column justify-content-center text-custom">Nome:</div>

                                <div id="row-name" class="row-custom d-flex gap-2">
                                    <div id="name-profile"
                                        class="text-secondary d-flex flex-column justify-content-center cursor-pointer">
                                        <?php echo $_SESSION['nome'] . " " . $_SESSION['sobrenome']; ?>
                                    </div>

                                    <i class="d-none text-secondary fa fa-pencil"></i>

                                </div>
                            </div>
                        </div>

                        <div class="border-0 d-flex flex-column justify-content-center"
                            style="height:50px">
                            <div class="d-flex justify-content-start m-2">
                                <div class="text-profile-info d-flex flex-column justify-content-center text-custom">CPF:</div>

                                <div id="row-cpf" class="row-custom d-flex gap-2">
                                    <div id="cpf-profile"
                                        class="text-secondary d-flex flex-column justify-content-center cursor-pointer d-none">
                                        <?php echo $_SESSION['cpf']; ?>
                                    </div>
                                    <div class="text-secondary d-flex flex-column justify-content-center info-ocult">
                                        **************
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="border-0 d-flex flex-column justify-content-center"
                            style="height:50px">
                            <div class="d-flex justify-content-start m-2">
                                <div class="text-profile-info d-flex flex-column justify-content-center text-custom">Telefone:</div>

                                <div id="row-cellphone" class="row-custom d-flex gap-2">
                                    <div id="cellphone-profile"
                                        class="text-secondary d-flex flex-column justify-content-center cursor-pointer">
                                        <?php echo $_SESSION['telefone']; ?>
                                    </div>

                                    <i class="d-none text-secondary fa fa-pencil"></i>

                                </div>
                            </div>
                        </div>

                        <div class="border-0 d-flex flex-column justify-content-center"
                            style="height:50px">
                            <div class="d-flex justify-content-start m-2">
                                <div class="text-profile-info d-flex flex-column justify-content-center text-custom">Email:</div>

                                <div id="row-email" class="row-custom d-flex gap-2">
                                    <div id="email-profile"
                                        class="text-secondary d-flex flex-column justify-content-center cursor-pointer">
                                        <?php echo $_SESSION['email']; ?>
                                    </div>

                                    <i class="d-none text-secondary fa fa-pencil"></i>

                                </div>
                            </div>
                        </div>


                        <div class="border-0 d-flex flex-column justify-content-center"
                            style="height:50px">
                            <div class="d-flex justify-content-start m-2">
                                <div class="text-profile-info d-flex flex-column justify-content-center text-custom">Senha:</div>


                                <div id="row-password" class="row-custom d-flex gap-2">
                                    <div id="password-profile"
                                        class="text-secondary d-flex flex-column justify-content-center cursor-pointer d-none">
                                        <?php echo $_SESSION['senha']; ?>
                                    </div>
                                    <div class="text-secondary d-flex flex-column justify-content-center info-ocult">
                                        ************
                                    </div>

                                    <i class="d-none text-secondary fa fa-pencil"></i>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>







            <div class="tab-pane fade" id="v-pills-historico" role="tabpanel" aria-labelledby="v-pills-historico-tab">
            <div class="modal fade" id="modal-confirm-cancel-request">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content background">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title text-custom">Cancelar Pedido</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <div class="text-center">
                    <span class="text-custom">Deseja cancelar esse pedido?</span>
                </div>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" id="btn-confirm-cancel-request" class="btn btn-danger text-light">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<input type="hidden" id="input-id-pedido">

                <div id="profile-container-request" class="shadow background m-2 rounded overflow-y-auto">



                        <?php
                            if(count($pedidos['pedido'])>0){
                                echo"<div class='d-flex justify-content-around'>
                                
                                <div class='d-flex flex-column justify-content-center'>
                                                <span class='text-custom'>ID:</span>
                                            </div>  
                                            <div class='d-flex flex-column justify-content-center'>
                                                <span class='text-custom'>Valor:</span>
                                            </div>  
                                            <div class='d-flex flex-column justify-content-center'>
                                                <span class='text-custom'>Status:</span>
                                            </div>  
                                            <div class='d-flex flex-column justify-content-center'>
                                                <span class='text-custom'>Pagamento:</span>
                                            </div>  
                                            <div class='d-flex flex-column justify-content-center'>
<span class='text-custom'>Feito:</span>
                                            </div>
                                            </div> ";
                            for($c=0;count($pedidos['pedido'])>$c;$c++){
                                echo"
                                    <div id='profile-request-info-".$pedidos['pedido'][$c]['id_pedido']."' data-bs-toggle='collapse' data-bs-target='#profile-request-items-".$pedidos['pedido'][$c]['id_pedido']."' aria-expanded='false' aria-controls='profile-request-items' class='w-100 profile-request-info d-flex justify-content-around cursor-pointer rounded border'>
                                            <div class='d-flex flex-column justify-content-center'>
                                                <span class='text-custom'>".$pedidos['pedido'][$c]['id_pedido']."</span>
                                            </div>  
                                            <div class='d-flex flex-column justify-content-center'>
                                                <span class='text-custom'>".$pedidos['pedido'][$c]['total_pedido']."</span>
                                            </div>  
                                            <div class='d-flex flex-column justify-content-center'>
                                                <span class='text-custom'>".$pedidos['pedido'][$c]['status_pedido']."</span>
                                            </div>  
                                            <div class='d-flex flex-column justify-content-center'>
                                                <span class='text-custom'>".$pedidos['pedido'][$c]['status_pagamento']."</span>
                                            </div>  
                                            <div class='d-flex flex-column justify-content-center'>
<span class='text-custom'>".$pedidos['pedido'][$c]['data_diapedido']."</span>
                                            </div>  
                                    </div>
                                    <div id='profile-request-items-".$pedidos['pedido'][$c]['id_pedido']."' class='collapse w-100 profile-request-items'>
                                            ";
                                            for ($d = 0; $d < count($pedidos['itens']); $d++) {
                                                if($pedidos['itens'][$d]['id_pedido']!=$pedidos['pedido'][$c]['id_pedido']) continue;
                                                else{
                                                    echo "
                                                        <div class='product-item m-3 background'>
                                                          <div class='product-info'>
                                                             <h2 class='background text-custom'>" . $pedidos['itens'][$d]['nome_produto'] . "</h2>
                                                            <p class='background text-custom'>" . $pedidos['itens'][$d]['nome_variedade'] . " - Tamanho: " . $pedidos['itens'][$d]['tamanho_produto'] . "</p>
                                                            <div class='d-flex background'>
                                                              <span class='product-price my-auto p-2 text-custom'>R$<span class='preco'>" . $pedidos['itens'][$d]['preco_produto'] . "</span></span>
                                                              <span class='text-custom p-2'>Qtd: " . $pedidos['itens'][$d]['quantidade_produto'] . "</span>
                                                            
                                                            
                                                          </div>
                                                          
                                                            </div>
                                                         <img class='rounded img-primary-gerenciamento' src='$diretorio/media/products/" . $pedidos['itens'][$d]['imagem_produto'] . "'>
                                                        </div>
                                                        ";
                                                }
                                                
                                              }
                                            if($pedidos['pedido'][$c]['status_pedido']=='Pendente'){
                                            echo"
                                            <div class='d-flex m-2 justify-content-center'>
                                              <button type='button' class='rounded-circle text-light btn btn-danger btn-toggle-modal-request' data-bs-toggle='modal' data-bs-target='#modal-confirm-cancel-request' data-id-pedido='".$pedidos['pedido'][$c]['id_pedido']."'><i class='fa fa-trash'></i></button>
                                                        
                                    </div>";}

                                              echo"
                                
                                    </div>
                                    
                                ";
                            }
                        }
                            
                            else echo "
                                <div class='d-flex flex-column justify-content-center h-100'>
                                    <h1 class='text-center text-custom'>Esse usuário não</h1>
                                    <h1 class='text-center text-custom'>possui pedidos!</h1>
                               </div>
                            ";
                        ?>
                
                </div>

            </div>

            <div class="tab-pane fade" id="v-pills-notificacao" role="tabpanel"
                aria-labelledby="v-pills-notificacao-tab">

                <!--Notificações-->
                        
                <div id="container-notifications" class='background rounded shadow m-2 overflow-y-auto'>
                        <?php
                            for($c=0;count($notificacoes)>$c;$c++){
                                echo "<div class='card-notificacao background rounded'>
                                        <div data-bs-toggle='collapse' data-bs-target='#notificacao-".$notificacoes[$c]['id']."' aria-expanded='false' aria-controls='notificacao' class='d-flex cursor-pointer justify-content-between align-items-center flex-row border-top border rounded p-4 hover-notificação text-custom-notificacao'>
                                         <div class='titulo-notificacao text-custom'>".$notificacoes[$c]['titulo']."</div>
                                            <p class='data text-custom'>".$notificacoes[$c]['data_notificacao']."</p>
                                        </div>
                                        <div class='collapse' id='notificacao-".$notificacoes[$c]['id']."'>
                                        <div class='card card-body collapse-custom text-custom w-100 border-0 text-custom'>
                                            ".$notificacoes[$c]['texto']."
                                        </div>
                                        </div>
                                </div>";
                            }
                        ?>
                </div>
            </div>

            <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">

                <!--Configurações-->
                <div id="container-config"class=" m-2 shadow d-flex justify-content-center flex-column rounded background">
                <form method="POST" id="form-preferences" class="d-flex flex-column d-flex justify-content-around gap-4 h-100">
                     <!--Modo Escuro-->
                     <div class="d-flex justify-content-around align-items-center">
                    <div class="d-flex justify-content-center align-items-center flex-row h-100 position-relative gap-4">
                        <label  class="text-profile-info text-custom" for="dark-mode">Modo Escuro</label>
                        <?php
                            if($_SESSION['tema']=='Escuro') echo "<input type='checkbox' value='Escuro' class='checkbox-custom' id='dark-mode' checked>";
                            else echo "<input type='checkbox' class='checkbox-custom' value='Escuro' id='dark-mode'>";
                        ?>
                    </div>
                   </div>

                    <!--Ativar Notificações-->
                    <div class="d-flex justify-content-around align-items-center">
                    <div class="d-flex justify-content-center align-items-center flex-row h-100 position-relative gap-4">
                        <label  class="text-profile-info text-custom" for="notification-mode">Notificações</label>
                        <?php
                            if($_SESSION['notificacoes']=='Sim') echo "<input type='checkbox' class='checkbox-custom' id='notification-mode' value='Sim' checked>";
                            else echo "<input type='checkbox' class='checkbox-custom' value='Sim' id='notification-mode'>";
                        ?>
                    </div>
                    </div>

                    <!--Forma de pagamento-->
                    <div class="d-flex justify-content-center">
                    <div class="w-75 align-items-center">
                     <label for="formpay-fav" class="form-label text-custom">Forma de Pagamento</label>
                            <select class="form-select background text-custom" id="formpay-fav">
                                <?php
                                    for($c=0;$c<count($formapagamento);$c++){
                                        if($formapagamento[$c]['id']==$_SESSION['formapagamento']) echo "<option selected value='".$formapagamento[$c]['id']."'>".$formapagamento[$c]['nome']."</option>";
                                        else echo "<option value='".$formapagamento[$c]['id']."'>".$formapagamento[$c]['nome']."</option>";
                                    }
                                ?>
                            </select>
                     </div>
                    </div>

                    <!--Botão-->
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-custom-blue">Aplicar Mudanças</button>
                    </div>
                   </form>
                </div>

            </div>
        </div>

    </div>
</div>

<script src="<?php echo $diretorio . "/public/assets/scripts/perfil/view.js" ?>"></script>
<script src="<?php echo $diretorio . "/public/assets/scripts/perfil/user.js" ?>"></script>
<script src="<?php echo $diretorio . "/public/assets/scripts/perfil/preferences.js" ?>"></script>
<script src="<?php echo $diretorio . "/public/assets/scripts/perfil/request.js" ?>"></script>