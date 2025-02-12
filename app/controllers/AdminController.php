<?php

namespace app\controllers;
use app\core\Controller;

class AdminController extends Controller
{



    //TELAS
    public function index()
    {
        require './app/scripts/ProtectOfficial.php';
        $elementos = new \app\models\Elementos;
        $carrossels = $elementos->getCarousel();
        $cards = $elementos->getCards();

        $this->loadingTemplateADM('vw_home', array('carrossel' => $carrossels, 'cards' => $cards));
    }

    public function Sobre()
    {
        require './app/scripts/ProtectOfficial.php';
        $elementos = new \app\models\Elementos;
        $sobre = $elementos->getSobre();

        $this->loadingTemplateADM('vw_sobre', array('sobre' => $sobre));
    }

    public function Produtos()
    {
        require './app/scripts/ProtectOfficial.php';
        $produto = new \app\models\Produtos;
        $produtos = $produto->readAll();


        $this->loadingTemplateADM('vw_produtos', array('produtos' => $produtos));
    }
    public function Usuarios()
    {
        require './app/scripts/ProtectAdm.php';
        $usuario = new \app\models\Usuarios;
        $usuarios = $usuario->readAll();


        $this->loadingTemplateADM('vw_usuarios', array('usuarios' => $usuarios));
    }

    public function Pedidos()
    {
        require './app/scripts/ProtectOfficial.php';
        $pedido = new \app\models\Pedidos;
        $pedidos = $pedido->readAll();

        $this->loadingTemplateADM('vw_pedidos', array('pedidos' => $pedidos));
    }


    public function Suporte()
    {
        require './app/scripts/ProtectOfficial.php';
        $elementos = new \app\models\Elementos;
        $faq = $elementos->getFAQ();

        $this->loadingTemplateADM('vw_suporte', array('faq' => $faq));
    }












    //COMANDOS

    //Gerenciamento Produtos
    public function atualizartabelaprodutos()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            require './app/scripts/DirUrl.php';

            $chave = $_POST['chave'];
            $parametro = $_POST['parametro'];

            $produto = new \app\models\Produtos;
            if ($parametro != null) {
                $produtos = $produto->readAllSearch($chave, $parametro);
            } else {
                $produtos = $produto->readAll();
            }

            $response = "";
            if (count($produtos['tabela1']) > 0) {


                for ($c = 0; $c < count($produtos['tabela1']); $c++) {
                    $response .= "
                <tr data-id-produto='" . $produtos['tabela1'][$c]['id'] . "' class='border tr-produto cursor-pointer'>
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
            } else {
                $response = "<tr class='border cursor-pointer'>
                <td colspan='5'><h1 class='text-custom text-center'>Não há produtos disponíveis</h1></td>
                </tr>";
            }



            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        } else {
            require './app/scripts/DirUrl.php';
            header("Location: $diretorio");
            exit;
        }
    }
    public function atualizarsidebarproduto()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            require './app/scripts/DirUrl.php';

            $id_produto = $_POST['id_produto'];
            $Produtos = new \app\models\Produtos;
            $produtos = $Produtos->getAllFromProduct($id_produto);

            $response = "
                  <div class='row flex-wrap justify-content-center m-3'>
                    <h4 class='text-center text-custom'> Imagens </h4>";

            for ($d = 0; $d < count($produtos['tabela1'][0]['imagens']); $d++) {
                if ($produtos['tabela1'][0]['imagens'][$d]['principal']) {
                    $response .= "
                            <div class='col-md-6 img-produto-" . $produtos['tabela1'][0]['id'] . "'>
                                        <img src='$diretorio/media/products/" . $produtos['tabela1'][0]['imagens'][$d]['imagem'] . "'
                                            class='m-1 img-sec-gerenciamento principal-image selecao-hover shadow img-fluid border rounded' data-imagem=" . $produtos['tabela1'][0]['imagens'][$d]['imagem'] . ">
                                    </div>
                        ";
                } else {
                    $response .= "
                            <div class='col-md-6 img-produto-" . $produtos['tabela1'][0]['id'] . "''>
                                        <img src='$diretorio/media/products/" . $produtos['tabela1'][0]['imagens'][$d]['imagem'] . "' class='m-1 img-sec-gerenciamento shadow selecao-hover img-fluid border rounded' data-imagem=" . $produtos['tabela1'][0]['imagens'][$d]['imagem'] . ">
                                    </div>
                        ";
                }
            }
            $response .= " </div>

                    <div class='d-flex justify-content-center'>
                    <button id='btn-promove-img' class='mx-2 btn btn-gerenciamento shadow btn-warning rounded-circle'  data-id-produto='" . $produtos['tabela1'][0]['id'] . "'><i
                     class='fa fa-trophy text-white'></i></button>

                        <button id='btn-delete-img' data-bs-toggle='modal' data-bs-target='#modal-confirm-delete-img' class='mx-2 btn btn-gerenciamento shadow btn-danger rounded-circle' data-id-produto='" . $produtos['tabela1'][0]['id'] . "' ><i
                                class='fa fa-trash-o text-light'></i></button>

                        <button id='btn-add-img' data-bs-toggle='modal' data-bs-target='#modal-add-img' class='mx-2 btn btn-gerenciamento shadow btn-primary rounded-circle' data-id-produto='" . $produtos['tabela1'][0]['id'] . "' ><i
                                class='fa fa-plus text-light'></i></button>
                    </div>



                    <div class='m-3'>
                    <h4 class='text-center text-custom'>Informações</h4>
                        <form method='POST' id='form-edit-product' class='d-flex flex-column' data-id-produto='" . $produtos['tabela1'][0]['id'] . "'>
                            <div class='mb-3'>
                                <label for='edit-nome' class='form-label text-custom'>Nome</label>
                                <input type='text' class='form-control background text-custom' placeholder='Almoço'
                                    id='edit-nome' value='" . $produtos['tabela1'][0]['nome'] . "'>
                            </div>
                            <div class='mb-3'>
                                <label for='edit-descricao' class='form-label text-custom'>Descrição</label>
                                <textarea class='form-control background text-custom' rows='5' placeholder='Saudades eternas.'
                                    id='edit-descricao'>" . $produtos['tabela1'][0]['descricao'] . "</textarea>
                            </div>
                            <div class='mb-3'>
                                <label for='edit-categoria' class='form-label text-custom'>Categoria</label>
                                <select class='form-select background text-custom' id='edit-categoria'>";

            for ($ca = 0; $ca < count($produtos['categorias']); $ca++) {
                if ($produtos['categorias'][$ca]['nome'] == $produtos['tabela1'][0]['categoria_nome']) {
                    $response .= '<option selected value="' . $produtos['categorias'][$ca]['id'] . '">' . $produtos['categorias'][$ca]["nome"] . '</option>';
                } else {
                    $response .= '<option value="' . $produtos['categorias'][$ca]['id'] . '">' . $produtos['categorias'][$ca]["nome"] . '</option>';
                }
            }
            $response .= "
                                </select>
                            </div>
                             <div class='mb-3'>
                                <label for='edit-status' class='form-label text-custom'>Status</label>
                                <select class='form-select background text-custom' id='edit-status'>";
            if ($produtos['tabela1'][0]['status'] == 'Disponível') {
                $response .= '<option selected value="Disponível">Disponível</option>
                                                <option value="Indisponível">Indisponível</option>';
            } else {
                $response .= '<option selected value="Indisponível">Indisponível</option>
                                    <option value="Disponível">Disponível</option>';
            }
            $response .= "
                                </select>
                            </div>
                        </form>
                        <div class='mb-3 d-flex justify-content-center'>
                                <input type='button' class='btn btn-custom-blue' value='Atualizar dados' data-bs-toggle='modal' data-bs-target='#modal-confirm-edit-product'>
                            </div>
                    </div>


                    <div class='m-3'>
                        <h4 class='text-center text-custom'>Variedades</h4>
                        <div class='overflow-y-auto'>
                        <table class='table small m-1'>
                                    <thead>
                                        <tr>
                                            <th scope='col'>Variação</th>
                                            <th scope='col'>Tamanho</th>
                                            <th scope='col'>Preço</th>
                                            <th scope='col'>Situação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        ";

            for ($d = 0; $d < count($produtos['tabela2']); $d++) {
                if ($produtos['tabela2'][$d]['id'] != $produtos['tabela1'][0]['id'])
                    continue;
                if (isset($produtos['tabela2'][$d]['variedade_nome'])) {
                    $response .= "
                                                                <tr>
                                                                    <td>" . $produtos['tabela2'][$d]['variedade_nome'] . "</td>
                                                                    <td>" . $produtos['tabela2'][$d]['tamanho_nome'] . "</td>
                                                                    <td>" . $produtos['tabela2'][$d]['preco'] . "</td>
                                                                    <td>" . $produtos['tabela2'][$d]['variedade_status'] . "</td>
                                                                </tr>
                                                                ";
                } else {
                    $response .= "<tr>
                                                                        <td colspan='4'>
                                                                        <h1>Não há variações</h1>
                                                                        </td>
                                                                        </tr>";
                }

            }
            $response .= "
                                    </tbody>
                            </table>
                        </div>
                        <div class='d-flex justify-content-center m-2'>
                                <button data-bs-toggle='modal' data-bs-target='#modal-add-variety' class='mx-2 btn btn-gerenciamento shadow btn-primary rounded-circle' data-id-produto='" . $produtos['tabela1'][0]['id'] . "' id='btn-add-variety'>
                                <i class='fa fa-plus text-light'></i>   
                                </button>
                        </div>
                    </div>

                    <div class='m-3'>
                        <h4 class='text-center text-custom'>Editar Variedade</h4>
                        <form method='POST' id='form-edit-variety' class='d-flex flex-column' data-id-produto='" . $produtos['tabela1'][0]['id'] . "'>
                            <div class='mb-3'>
                                <label for='input-edit-variety-id' class='form-label text-custom'>Selecione a Variedade</label>
                                <select class='form-select background text-custom' id='input-edit-variety-id'>";
            for ($ca = 0; $ca < count($produtos['tabela2']); $ca++) {
                if ($produtos['tabela2'][$ca]['id'] != $produtos['tabela1'][0]['id'])
                    continue;

                $response .= '<option value="' . $produtos['tabela2'][$ca]['variedade_id'] . '">' . $produtos['tabela2'][$ca]["variedade_nome"] . '</option>';
            }
            $response .= "
                                </select>
                            </div>
                            <div class='mb-3'>
                                 <label for='input-edit-variety-nome' class='form-label text-custom'>Nome</label>
                                <input type='text' class='form-control background text-custom' placeholder='Prato Feito'
                                    id='input-edit-variety-nome' required>
                            </div>
                            <div class='mb-3'>
                                <label for='input-edit-variety-status' class='form-label text-custom'>Selecione a Disponibilidade</label>
                                <select class='form-select background text-custom' id='input-edit-variety-status'>
                                <option value='Disponível'>Disponível</option>
                                <option value='Indisponível'>Indisponível</option>
                                </select>
                            </div>
                            <div class='mb-3 d-flex justify-content-center'>
                                <input type='submit' class='btn btn-custom-blue' value='Atualizar dados'>
                            </div>
                        </form>
                    </div>

                    <div class='m-3'>
                        <h4 class='text-center text-custom'>Deletar Variedade</h4>
                        <div class='d-flex'>
                            <form method='POST' class='w-75' id='form-delete-variety' data-id-produto='" . $produtos['tabela1'][0]['id'] . "'>
                            
                                <select class='form-select background text-custom' id='input-delete-variety-id'>";
            for ($ca = 0; $ca < count($produtos['tabela2']); $ca++) {
                if ($produtos['tabela2'][$ca]['id'] != $produtos['tabela1'][0]['id'])
                    continue;

                $response .= '<option value="' . $produtos['tabela2'][$ca]['variedade_id'] . '">' . $produtos['tabela2'][$ca]["variedade_nome"] . '</option>';
            }

            $response .= "
                                </select>
                            
                            </form>
                            <div class='w-25 d-flex flex-column justify-content-center align-items-center'>
                                <button id='btn-delete-variety' data-bs-toggle='modal' data-bs-target='#modal-confirm-delete-variety' class='mx-2 btn btn-gerenciamento shadow btn-danger rounded-circle' data-id-produto='" . $produtos['tabela1'][0]['id'] . "' ><i
                                class='fa fa-trash-o text-light'></i></button>
                            </div>
                        </div>
                    </div>


                    <div class='m-3'>
                        <h4 class='text-center text-custom'>Adicionar Preço</h4>
                        <form method='POST' id='form-add-price' class='d-flex flex-column' data-id-produto='" . $produtos['tabela1'][0]['id'] . "'>
                            <div class='mb-3'>
                                <label for='input-add-price-variety-id' class='form-label text-custom'>Selecione a Variedade</label>
                                <select class='form-select background text-custom' id='input-add-price-variety-id'>";
            for ($ca = 0; $ca < count($produtos['tabela2']); $ca++) {
                if ($produtos['tabela2'][$ca]['id'] != $produtos['tabela1'][0]['id'])
                    continue;

                $response .= '<option value="' . $produtos['tabela2'][$ca]['variedade_id'] . '">' . $produtos['tabela2'][$ca]["variedade_nome"] . '</option>';
            }
            $response .= "
                                </select>
                            </div>
                            <div class='mb-3'>
                                <label for='input-add-price-price' class='form-label text-custom'>Preço</label>
                                <input type='text' class='form-control addpreco-input background text-custom' id='input-add-price-price' required
                                    pattern='[0-9]{2}\.[0-9]{2}' placeholder='16.00'>
                            </div>
                            <div class='mb-3'>
                                <label for='tamanho' class='form-label text-custom'>Selecione o Tamanho</label>
                                <select class='form-select background text-custom' id='input-add-price-size'>
                            ";

            for ($ca = 0; $ca < count($produtos['tamanhos']); $ca++) {

                $response .= '<option value="' . $produtos['tamanhos'][$ca]['id'] . '">' . $produtos['tamanhos'][$ca]["nome"] . '</option>';
            }


            $response .= "
                            </select>
                            </div>
                            <div class='mb-3 d-flex justify-content-center'>
                                <input type='submit' class='btn btn-custom-blue' value='Adicionar preço'>
                            </div>
                        </form>
                    </div>

                    <div class='m-3'>
                        <h4 class='text-center text-custom'>Deletar Preço</h4>
                        <div class='d-flex'>
                            <form method='POST' class='w-75' id='form-delete-price' data-id-produto='" . $produtos['tabela1'][0]['id'] . "'>
                            
                                <select class='form-select background text-custom' id='input-delete-price-id'>";

            for ($ca = 0; $ca < count($produtos['tabela2']); $ca++) {
                if ($produtos['tabela2'][$ca]['id'] != $produtos['tabela1'][0]['id'])
                    continue;
                $response .= '<option value="' . $produtos['tabela2'][$ca]['preco_id'] . '">' . $produtos['tabela2'][$ca]["preco"] . ' - ' . $produtos['tabela2'][$ca]["variedade_nome"] . ' (' . $produtos['tabela2'][$ca]["tamanho_nome"] . ')</option>';
            }


            $response .= "
                                </select>
                            
                            </form>
                            <div class='w-25 d-flex flex-column justify-content-center align-items-center'>
                                <button id='btn-delete-price' data-bs-toggle='modal' data-bs-target='#modal-confirm-delete-price' class='mx-2 btn btn-gerenciamento shadow btn-danger rounded-circle' data-id-produto='" . $produtos['tabela1'][0]['id'] . "' ><i
                                class='fa fa-trash-o text-light'></i></button>
                            </div>
                        </div>

                    </div>

                    <div class='m-3'>
                        <h4 class='text-center text-custom'>Deletar Produto</h4>
                         <div class='d-flex justify-content-center align-items-center'>
                                <button id='btn-delete-product' data-bs-toggle='modal' data-bs-target='#modal-confirm-delete-product' class='mx-2 btn btn-gerenciamento shadow btn-danger rounded-circle' data-id-produto='" . $produtos['tabela1'][0]['id'] . "' ><i
                                class='fa fa-trash-o text-light'></i></button>
                            </div>
                    </div>
            ";

            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        } else {
            require './app/scripts/DirUrl.php';
            header("Location: $diretorio");
            exit;
        }
    }

    public function addproduto()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_FILES['imagem'])) {
                $imagem = $_FILES['imagem'];

                if ($imagem['error'] == 0) {
                    // Salvar a imagem em um diretório
                    $dir = './media/products/'; // diretório onde a imagem será salva
                    $foto = uniqid() . '.' . pathinfo($imagem['name'], PATHINFO_EXTENSION);
                    $filePath = $dir . $foto;

                    if (!file_exists($dir)) {
                        mkdir($dir, 0777, true);
                    }

                    move_uploaded_file($imagem['tmp_name'], $filePath);
                } else {
                    $foto = null;
                }
            } else {
                $foto = null;
            }

            $nome = $_POST['nome'];
            $preco = $_POST['preco'];
            $descricao = $_POST['descricao'];
            $status = $_POST['status'];
            $categoria = $_POST['categoria'];

            $produto = new \app\models\Produtos;
            $retorno = $produto->addProduct($foto, $nome, $categoria, $descricao, $status, $preco);
            echo json_encode($retorno);

            exit;


        } else {
            require './app/scripts/DirUrl.php';
            header("Location: $diretorio/admin/gerenciamento/controle/produtos");
            exit;
        }

    }

    public function deletarproduto()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_produto = $_POST['id_produto'];

            $Produtos = new \app\models\Produtos;
            $response = $Produtos->deleteProduct($id_produto);

            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        } else {
            require './app/scripts/DirUrl.php';
            header("Location: $diretorio");
            exit;
        }
    }

    public function deletarimagem()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_produto = $_POST['id_produto'];
            $imagem = $_POST['imagem'];

            $Produtos = new \app\models\Produtos;
            $response = $Produtos->deleteImage($id_produto, $imagem);

            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        } else {
            require './app/scripts/DirUrl.php';
            header("Location: $diretorio");
            exit;
        }
    }

    public function tornarimgprincipal()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_produto = $_POST['id_produto'];
            $imagem = $_POST['imagem'];

            $Produtos = new \app\models\Produtos;
            $response = $Produtos->toUpImage($id_produto, $imagem);

            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        } else {
            require './app/scripts/DirUrl.php';
            header("Location: $diretorio");
            exit;
        }
    }

    public function adicionarimagem()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_FILES['imagem'])) {
                $imagem = $_FILES['imagem'];

                if ($imagem['error'] == 0) {
                    // Salvar a imagem em um diretório
                    $dir = './media/products/'; // diretório onde a imagem será salva
                    $foto = uniqid() . '.' . pathinfo($imagem['name'], PATHINFO_EXTENSION);
                    $filePath = $dir . $foto;

                    if (!file_exists($dir)) {
                        mkdir($dir, 0777, true);
                    }

                    move_uploaded_file($imagem['tmp_name'], $filePath);
                } else {
                    $foto = null;
                }
            } else {
                $foto = null;
            }

            $id_produto = $_POST['id_produto'];

            $Produtos = new \app\models\Produtos;
            $response = $Produtos->addImage($id_produto, $foto);

            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        } else {
            require './app/scripts/DirUrl.php';
            header("Location: $diretorio");
            exit;
        }
    }

    public function atualizarproduto()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_produto = $_POST['id_produto'];
            $nome = $_POST['nome'];
            $descricao = $_POST['descricao'];
            $categoria = $_POST['categoria'];
            $status = $_POST['status'];

            $produto = new \app\models\Produtos;
            $retorno = $produto->updateProduct($id_produto, $nome, $descricao, $status, $categoria);
            echo json_encode($retorno);

        } else {
            require './app/scripts/DirUrl.php';
            header("Location: $diretorio");
            exit;
        }
    }

    public function adicionarvariedade()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_produto = $_POST['id_produto'];
            $nome = $_POST['nome'];

            $produto = new \app\models\Produtos;
            $retorno = $produto->addVariety($id_produto, $nome);
            echo json_encode($retorno);

            exit;
        } else {
            require './app/scripts/DirUrl.php';
            header("Location: $diretorio");
            exit;
        }
    }

    public function deletarvariedade()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_variedade = $_POST['id'];

            $produto = new \app\models\Produtos;
            $retorno = $produto->deleteVariety($id_variedade);
            echo json_encode($retorno);
        } else {
            require './app/scripts/DirUrl.php';
            header("Location: $diretorio");
            exit;
        }
    }

    public function atualizarvariedade()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $nome = $_POST['nome'];
            $status = $_POST['status'];

            $produto = new \app\models\Produtos;
            $retorno = $produto->editVariety($id, $nome, $status);
            echo json_encode($retorno);
        } else {
            require './app/scripts/DirUrl.php';
            header("Location: $diretorio");
            exit;
        }
    }

    public function adicionarpreco()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_variedade = $_POST['id_variedade'];
            $preco = $_POST['preco'];
            $id_tamanho = $_POST['id_tamanho'];

            $produto = new \app\models\Produtos;
            $retorno = $produto->addPrice($id_variedade, $preco, $id_tamanho);
            echo json_encode($retorno);
        } else {
            require './app/scripts/DirUrl.php';
            header("Location: $diretorio");
            exit;
        }
    }

    public function deletarpreco()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];

            $produto = new \app\models\Produtos;
            $retorno = $produto->deletePrice($id);
            echo json_encode($retorno);
        } else {
            require './app/scripts/DirUrl.php';
            header("Location: $diretorio");
            exit;
        }
    }










    //USUARIOS
    public function atualizarsidebarusuario()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            require './app/scripts/DirUrl.php';

            $id_usuario = $_POST['id_usuario'];
            $usuario = new \app\models\Usuarios;
            $usuarios = $usuario->getAllFromUser($id_usuario);

            $response = "
                <div class='m-3'>
                    <h4 class='text-center text-custom'> Informações </h4>

                    <form method='POST' id='form-edit-user' class='d-flex flex-column' data-id-usuario='" . $usuarios[0]['id'] . "'>
                        <div class='mb-3 d-flex flex-column'>
                            <span class='text-custom text-center'>Na plataforma desde</span>
                            <span class='text-custom text-center'> " . $usuarios[0]['data_formatada'] . "</span>  
                        </div>
                        <div class='mb-3'>
                            <div class='preview'>
                            <img id='preview'
                                src='$diretorio/media/profiles/" . $usuarios[0]['imagem'] . "'
                                class='rounded border-2 shadow'>
                            </div>
                        </div>
                        <div class='mb-3 d-flex justify-content-center'>
                            <span id='btn-delete-image' data-bs-toggle='modal' data-bs-target='#modal-confirm-delete-image' class='mx-2 btn btn-gerenciamento shadow btn-danger rounded-circle' data-id-usuario='" . $usuarios[0]['id'] . "' ><i
                                class='fa fa-trash-o text-light'></i></span>
                        </div>
                        <div class='mb-3'>
                            <label for='edit-image' class='form-label text-custom'>Imagem</label>
                                <input type='file' class='form-control background text-custom' id='edit-image'
                                     accept='image/*'>
                        </div>
                        <div class='mb-3'>
                            <label for='edit-name' class='form-label text-custom'>Nome</label>
                                <input type='text' class='form-control background text-custom' id='edit-name'
                                    required value='" . $usuarios[0]['nome'] . "' placeholder='Oswaldo'>
                        </div>
                        <div class='mb-3'>
                            <label for='edit-lastname' class='form-label text-custom'>Sobrenome</label>
                                <input type='text' class='form-control background text-custom' id='edit-lastname'
                                    required value='" . $usuarios[0]['sobrenome'] . "' placeholder='Neto'>
                        </div>
                        <div class='mb-3'>
                            <label for='edit-cpf' class='form-label text-custom'>CPF</label>
                                <input type='text' class='form-control background text-custom' id='edit-cpf'
                                    required value='" . $usuarios[0]['cpf'] . "' pattern='^\d{3}\.\d{3}\.\d{3}-\d{2}$' placeholder='111.111.111-11'>
                        </div>
                        <div class='mb-3'>
                            <label for='edit-phone' class='form-label text-custom'>Telefone</label>
                                <input type='text' class='form-control background text-custom' id='edit-phone'
                                    required value='" . $usuarios[0]['telefone'] . "' pattern='^\(\d{2}\)\d{5}-\d{4}$' placeholder='(11)11111-1111)'>
                        </div>
                        <div class='mb-3'>
                            <label for='edit-email' class='form-label text-custom'>Email</label>
                                <input type='email' class='form-control background text-custom' id='edit-email'
                                    required value='" . $usuarios[0]['email'] . "' placeholder='oswaldoneto@gmail.com'>
                        </div>
                        <div class='mb-3'>
                            <label for='edit-password' class='form-label text-custom'>Senha</label>
                                <input type='text' class='form-control background text-custom' id='edit-password'
                                    required value='" . $usuarios[0]['senha'] . "' pattern='.{8,}' max-length='12' placeholder='111111111111'>
                        </div>
                        <div class='mb-3'>
                            <label for='edit-status' class='form-label text-custom'>Status</label>
                            <select class='form-select background text-custom' id='edit-status'>";
            switch ($usuarios[0]['status_usuario']) {
                case 'Inativo':
                    $response .= "
                                            <option value='Inativo' selected>Inativo</option>
                                            <option value='Cliente'>Cliente</option>
                                            <option value='Vendedor'>Vendedor</option>
                                            <option value='Admin'>Admin</option>
                                            <option value='Suspenso'>Suspenso</option>
                                        ";
                    break;
                case 'Cliente':
                    $response .= "
                                            <option value='Inativo'>Inativo</option>
                                            <option value='Cliente' selected>Cliente</option>
                                            <option value='Vendedor'>Vendedor</option>
                                            <option value='Admin'>Admin</option>
                                            <option value='Suspenso'>Suspenso</option>";
                    break;
                case 'Vendedor':
                    $response .= "
                                                <option value='Inativo'>Inativo</option>
                                                <option value='Cliente'>Cliente</option>
                                                <option value='Vendedor' selected>Vendedor</option>
                                                <option value='Admin'>Admin</option>
                                                <option value='Suspenso'>Suspenso</option>";
                    break;
                case 'Admin':
                    $response .= "
                                                    <option value='Inativo'>Inativo</option>
                                                    <option value='Cliente'>Cliente</option>
                                                    <option value='Vendedor'>Vendedor</option>
                                                    <option value='Admin' selected>Admin</option>
                                                    <option value='Suspenso'>Suspenso</option>";
                    break;
                case 'Suspenso':
                    $response .= "
                                                    <option value='Inativo'>Inativo</option>
                                                    <option value='Cliente'>Cliente</option>
                                                    <option value='Vendedor'>Vendedor</option>
                                                    <option value='Admin'>Admin</option>
                                                    <option value='Suspenso' selected>Suspenso</option>";
                    break;
                default:
                    $response .= "
                                                    <option value='Inativo'>Inativo</option>
                                                    <option value='Cliente'>Cliente</option>
                                                    <option value='Vendedor'>Vendedor</option>
                                                    <option value='Admin'>Admin</option>
                                                    <option value='Suspenso'>Suspenso</option>
                                                    ";
                    break;


            }
            $response .= "
                            </select>
                        </div>

                        <div class='mb-3'>
                        <label for='edit-cash' class='form-label text-custom'>Saldo</label>
                        <input type='text' class='form-control background text-custom' id='edit-cash'
                                    step='0.01' pattern='[0-9]+([\.][0-9]{1,2})?' required value='" . $usuarios[0]['saldo'] . "' placeholder='1000.00'>
                        </div>

                        <div class='mb-3 d-flex justify-content-center'>
                            <input type='submit' class='btn btn-custom-blue' id='btn-edit'
                                     value='Atualizar Dados'>
                        </div>
                    </form>
                </div>
                 <div class='m-3'>
                    <h4 class='text-center text-custom'> Mensagens </h4>
                     <form method='POST' id='form-msg-user' class='d-flex flex-column' data-id-usuario='" . $usuarios[0]['id'] . "'>
                     <div class='mb-3'>
                                <label for='msg-title' class='form-label text-custom'>Título da Mensagem</label>
                                <input type='text' class='form-control background text-custom' id='msg-title'
                                    required placeholder='Aumento de Preço'>
                     </div>
                     <div class='mb-3'>
                     <label for='msg-text' class='form-label text-custom'>Conteúdo</label>
                            <textarea class='form-control background text-custom' id='msg-text'
                                rows='5' placeholder='Digite a mensagem aqui...' style='resize:none;'></textarea>
                     </div>
                     <div class='mb-3 d-flex justify-content-center'>
                            <input type='submit' class='btn btn-custom-blue' id='btn-msg'
                                     value='Enviar Mensagem'>
                        </div>
                        
                     </form>
                 </div>
            ";



            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        } else {
            require './app/scripts/DirUrl.php';
            header("Location: $diretorio");
            exit;
        }
    }

    public function atualizartabelausuario()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            require './app/scripts/DirUrl.php';

            $chave = $_POST['chave'];
            $parametro = $_POST['parametro'];

            $usuario = new \app\models\Usuarios;
            if ($parametro != null) {
                $usuarios = $usuario->readAllSearch($chave, $parametro);
            } else {
                $usuarios = $usuario->readAll();
            }

            $response = "";

            if (count($usuarios) > 0) {
                for ($c = 0; $c < count($usuarios); $c++) {
                    $response .= "
                    <tr data-id-usuario='" . $usuarios[$c]['id'] . "' class='border tr-usuario cursor-pointer'>
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
            } else {
                $response .= "<tr class='border cursor-pointer'>
                <td colspan='7'><h1 class='text-custom text-center'>Não há usuários disponíveis</h1></td>
                </tr>";
            }

            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        } else {
            require './app/scripts/DirUrl.php';
            header("Location: $diretorio");
            exit;
        }
    }

    public function enviarmensagem()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_usuario = $_POST['id_usuario'];
            $titulo = $_POST['titulo'];
            $mensagem = $_POST['conteudo'];

            $usuario = new \app\models\Usuarios;
            $response = $usuario->sendMessage($id_usuario, $titulo, $mensagem);


            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        } else {
            require './app/scripts/DirUrl.php';
            header("Location: $diretorio");
            exit;
        }
    }

    public function deletarimagemusuario()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_usuario = $_POST['id_usuario'];
            $usuario = new \app\models\Usuarios;
            $response = $usuario->deleteImage($id_usuario);


            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        } else {
            require './app/scripts/DirUrl.php';
            header("Location: $diretorio");
            exit;
        }
    }

    public function editarusuario()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if (isset($_FILES['imagem'])) {
                $imagem = $_FILES['imagem'];

                if ($imagem['error'] == 0) {
                    // Salvar a imagem em um diretório
                    $dir = './media/profiles/'; // diretório onde a imagem será salva
                    $foto = uniqid() . '.' . pathinfo($imagem['name'], PATHINFO_EXTENSION);
                    $filePath = $dir . $foto;

                    if (!file_exists($dir)) {
                        mkdir($dir, 0777, true);
                    }

                    move_uploaded_file($imagem['tmp_name'], $filePath);

                } else {
                    $foto = 'default.jpg';
                }
            } else {
                $foto = 'default.jpg';
            }

            $id_usuario = $_POST['id_usuario'];
            $nome = $_POST['nome'];
            $sobrenome = $_POST['sobrenome'];
            $cpf = $_POST['cpf'];
            $telefone = $_POST['telefone'];
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            $status = $_POST['status'];
            $saldo = $_POST['saldo'];

            $usuario = new \app\models\Usuarios;
            $response = $usuario->editUser($id_usuario, $nome, $sobrenome, $cpf, $telefone, $email, $senha, $status, $saldo, $foto);

            header('Content-Type: application/json');
            echo json_encode($response);
            exit;

        } else {
            require './app/scripts/DirUrl.php';
            header("Location: $diretorio");
            exit;
        }
    }














    //PEDIDOS
    public function atualizartabelapedidos()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            require './app/scripts/DirUrl.php';

            $chave = $_POST['chave'];
            $parametro = $_POST['parametro'];

            $pedido = new \app\models\Pedidos;
            if ($parametro != null) {
                $pedidos = $pedido->readAllSearch($chave, $parametro);
            } else {
                $pedidos = $pedido->readAll();
            }

            $response = "";
            if (count($pedidos['pedido']) > 0) {
                for ($c = 0; $c < count($pedidos['pedido']); $c++) {
                    $response .= "
                        <tr data-id-pedido='" . $pedidos['pedido'][$c]['id_pedido'] . "' class='border tr-pedido cursor-pointer'>
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
            } else {
                $response .= "<tr class='border cursor-pointer'>
                <td colspan='8'><h1 class='text-custom text-center'>Não há pedidos disponíveis</h1></td>
                </tr>";
            }

            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        } else {
            require './app/scripts/DirUrl.php';
            header("Location: $diretorio");
            exit;
        }
    }

    public function atualizarsidebarpedido()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            require './app/scripts/DirUrl.php';

            $id_pedido = $_POST['id_pedido'];
            $pedido = new \app\models\Pedidos;
            $pedidos = $pedido->readAllFromRequest($id_pedido);

            $response = "
            <div class='m-3'>
                    <h4 class='text-center text-custom'> Informações </h4>

                    <div class='mb-3 d-flex flex-column'>
                        <img src='$diretorio/media/profiles/" . $pedidos['pedido'][0]['imagem_usuario'] . "' class='border rounded shadow m-1'>
                        <span class='m-1 text-custom text-center'>" . $pedidos['pedido'][0]['nome_usuario'] . "</span>
                    </div>
                    <div class='mb-3 d-flex flex-column'>
                        <span class='text-custom text-center'>
                            O pedido foi feito
                        </span>
                        <span class='text-custom text-center'>
                            " . $pedidos['pedido'][0]['data_pedido'] . "
                        </span>
                    </div>
                    <div class='mb-3'>
                         <form method='POST' id='form-edit-status' class='d-flex flex-column' data-id-pedido='" . $pedidos['pedido'][0]['id_pedido'] . "'>
                            <label for='edit-status' class='form-label text-custom'>Status</label>
                                <select class='form-select background text-custom' id='edit-status'>";
            switch ($pedidos['pedido'][0]['status_pedido']) {
                case 'Pendente':
                    $response .= "<option value='Pendente' selected>Pendente</option>
                                        <option value='Pronto'>Pronto</option>
                                        <option value='Entregue'>Entregue</option>
                                        <option value='Cancelado'>Cancelado</option>";
                    break;
                case 'Pronto':
                    $response .= "<option value='Pendente'>Pendente</option>
                                            <option value='Pronto' selected>Pronto</option>
                                            <option value='Entregue'>Entregue</option>
                                            <option value='Cancelado'>Cancelado</option>";
                    break;
                case 'Entregue':
                    $response .= "<option value='Pendente'>Pendente</option>
                                                <option value='Pronto'>Pronto</option>
                                                <option value='Entregue' selected>Entregue</option>
                                                <option value='Cancelado'>Cancelado</option>";
                    break;
                case 'Cancelado':
                    $response .= "<option value='Pendente'>Pendente</option>
                                                    <option value='Pronto'>Pronto</option>
                                                    <option value='Entregue'>Entregue</option>
                                                    <option value='Cancelado' selected>Cancelado</option>";
                    break;
                default:
                    $response .= "<option value='Pendente'>Pendente</option>
                                                        <option value='Pronto'>Pronto</option>
                                                        <option value='Entregue'>Entregue</option>
                                                        <option value='Cancelado'>Cancelado</option>";
                    break;
            }
            $response .= " </select>
                            <div class='d-flex justify-content-center m-3   '>
                                <input type='submit' class='btn btn-custom-blue' value='Atualizar Situação'>
                            </div>
                         </form>
                    </div>
                    <div class='m-3 d-flex flex-column'>
                        <h5 class='text-center text-custom'> Observações </h5>

                        <span class='text-custom text-center'>";

            if ($pedidos['pedido'][0]['observacoes_pedido'] == null)
                $response .= "Não há observações";
            else
                $response .= $pedidos['pedido'][0]['observacoes_pedido'];
            $response .= " </span>
                    </div>
                    <div class='m-3 d-flex flex-column'>
                        <h5 class='text-custom text-center'>Valor total do pedido</h5>
                        <span class='text-custom text-center'>R$" . $pedidos['pedido'][0]['total_pedido'] . "</span>
                    </div>
                    <div class='m-3 d-flex flex-column'>
                        <h4 class='text-custom text-center'>Pagamento</h4>";
            if ($pedidos['pedido'][0]['status_pagamento'] == "Não Pago") {
                $response .= "
                <div class='mb-3 d-flex flex-column'>
                    <span class='m-2 text-custom text-center'>O pedido <strong>não</strong> foi pago</span>
                    <span class='m-2 text-custom text-center'>Via " . $pedidos['pedido'][0]['nome_formapagamento'] . "</span>
                    
                    <div class='m-2 d-flex flex-column justify-content-center'>
                        <button id='btn-add-payday' data-id-pedido='" . $pedidos['pedido'][0]['id_pedido'] . "' class='btn btn-custom-blue' data-bs-toggle='modal' data-bs-target='#modal-confirm-payday'>Confirmar Pagamento</button>
                    </div>
                </div>
             ";
            } else {
                $response .= "
                                <div class='mb-3 d-flex flex-column'>
                                    <span class='text-custom text-center'>O pedido foi pago</span>
                                    <span class='text-custom text-center'>" . $pedidos['pedido'][0]['data_pagamento'] . "</span>
                                    <span class='text-custom text-center'>Via " . $pedidos['pedido'][0]['nome_formapagamento'] . "</span>
                                </div>
                             ";
            }
            $response .= "
                    <div class='m-3'>
                        <h4 class='text-custom text-center'>Itens do pedido</h4>

                        <div class='overflow-y-auto'>";

            for ($c = 0; $c < count($pedidos['itens']); $c++) {
                $response .= "
                        <div class='product-item d-flex flex-column m-3 background'>
                          <div class='product-info'>
                          <div class='d-flex justify-content-center m-1'><img class='rounded img-primary-gerenciamento' src='$diretorio/media/products/" . $pedidos['itens'][$c]['imagem_produto'] . "'></div>
                             <h4 class='background text-custom text-center'>" . $pedidos['itens'][$c]['nome_produto'] . "</h4>
                            <p class='background text-custom text-center'>" . $pedidos['itens'][$c]['nome_variedade'] . " - Tamanho: " . $pedidos['itens'][$c]['tamanho_produto'] . "</p>
                            <div class='d-flex background justify-content-center'>
                              <span class='product-price my-auto p-2 text-custom'>R$" . $pedidos['itens'][$c]['preco_item'] . "</span></span>                          
                              <span class='product-price my-auto p-2 text-custom'>Qtd: " . $pedidos['itens'][$c]['quantidade_produto'] . "</span>                          
                          </div>
                          
                            </div>
                          
                        </div>";
            }
            $response .= "
                        </div>
                    </div>
                </div>
            </div>
            ";

            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        } else {
            require './app/scripts/DirUrl.php';
            header("Location: $diretorio");
            exit;
        }
    }

    public function editarstatuspedido()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_pedido = $_POST['id_pedido'];
            $status = $_POST['status'];

            $pedido = new \app\models\Pedidos;
            $response = $pedido->editStatusRequest($id_pedido, $status);

            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        } else {
            require './app/scripts/DirUrl.php';
            header("Location: $diretorio");
            exit;
        }
    }

    public function adicionarpagamento()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_pedido = $_POST['id_pedido'];

            $pedido = new \app\models\Pedidos;
            $response = $pedido->addPayday($id_pedido);

            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        } else {
            require './app/scripts/DirUrl.php';
            header("Location: $diretorio");
            exit;
        }
    }



    //ELEMENTOS
    public function atualizarsidebarcarousel()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            require './app/scripts/DirUrl.php';

            $elementos = new \app\models\Elementos;
            $carrossels = $elementos->getCarousel();

            $response = "";
            for ($c = 0; $c < count($carrossels); $c++) {
                $response .= "
               <div class='m-3'>

                    <h4 class='text-center text-custom'> Imagem " . ($c + 1) . " </h4>
                    <div class='mb-3'>
                            <div class='d-flex justify-content-center'>
                            <img
                                src='$diretorio/media/carousel/" . $carrossels[$c]['imagem'] . "'
                                class='rounded border-2 shadow preview-carousel' id='img-banner-" . $carrossels[$c]['id'] . "'>
                            </div>
                        </div>
                        <form class='mb-3 d-flex flex-column form-banner' data-id-banner='" . $carrossels[$c]['id'] . "'>
                          <label for='edit-banner-" . $carrossels[$c]['id'] . "' class='form-label text-center text-custom'>Escolha uma nova imagem</label>
                                <input type='file' required class='form-control background text-custom edit-banner' id='edit-banner-" . $carrossels[$c]['id'] . "' accept='image/*' data-id-banner='" . $carrossels[$c]['id'] . "'>
                                <span class='text-center text-secondary small'>O tamanho padrão da imagem do carrossel é 1965 x 885</span>
                                <input type='submit' class='btn btn-custom-blue m-4' value='Enviar nova imagem'>
                            </form>
                    </div>
            ";
            }



            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        } else {
            require './app/scripts/DirUrl.php';
            header("Location: $diretorio");
            exit;
        }
    }

    public function atualizarcarrossel()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            require './app/scripts/DirUrl.php';

            $elementos = new \app\models\Elementos;
            $carrossel = $elementos->getCarousel();

            $response = "<div id='carousel' class='rounded cursor-pointer edit-element'>
                        <div id='carousel-inside'>
                        ";

            for ($c = 0; $c < count($carrossel); $c++) {
                if ($carrossel[$c]['id'] == 1) {
                    $response .= "<img src='$diretorio/media/carousel/" . $carrossel[$c]['imagem'] . "' alt='Imagem " . $carrossel[$c]['id'] . "'
                            class='active'>";
                } else {
                    $response .= "<img src='$diretorio/media/carousel/" . $carrossel[$c]['imagem'] . "' alt='Imagem " . $carrossel[$c]['id'] . "'
                            >";
                }
            }

            $response .= "
            </div>

        <!--Setas-->
        <div id='carousel-arrow'>
            <span id='before'>&#9664;</span> <!-- Seta para a esquerda -->
            <span id='next'>&#9654;</span> <!-- Seta para a direita -->
        </div>

        <!--Radios-->
        <div id='carousel-indicators'>
            <div id='carousel-background-indicators'>";

            for ($c = 0; $c < count($carrossel); $c++) {
                if ($c == 0) {
                    $response .= "
                    <input type='radio' name='carousel-indicators' id='carousel-indicator-1' data-index='0' checked>
                    <label for='carousel-indicator-1'></label>
                    ";
                } else {
                    $response .= "
                <input type='radio' name='carousel-indicators' id='carousel-indicator-" . ($c + 1) . "' data-index='$c'>
                <label for='carousel-indicator-" . ($c + 1) . "'></label>
                ";
                }
            }

            $response .= "
         </div>
        </div>
        <div class='edit-hover text-custom'>
            <i class='fa fa-pencil'></i> Editar
        </div>
    </div>";

            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        } else {
            require './app/scripts/DirUrl.php';
            header("Location: $diretorio");
            exit;
        }
    }

    public function atualizarcards()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            require './app/scripts/DirUrl.php';

            $elementos = new \app\models\Elementos;
            $cards = $elementos->getCards();

            $response = "";
            for ($c = 0; $c < count($cards); $c++) {
                $response .= "
                <div class='card home-card edit-element cursor-pointer' data-card-id='" . $cards[$c]['id'] . "'>
        <img class='card-img-top card-cover-image' src='$diretorio/media/cards/" . $cards[$c]['imagem'] . "'>
        <div class='card-body'>
        <h5 class='card-title'>" . $cards[$c]['titulo'] . "</h5>
        <p class='card-text'>" . $cards[$c]['texto'] . "</p>
        </div>
        <div class='card-footer border-0'>
        <a href='$diretorio" . $cards[$c]['ancora'] . "' class='btn btn-custom-blue'>Ir até lá</a>
        </div> 
        <div class='edit-hover text-custom'>
            <i class='fa fa-pencil'></i> Editar
        </div>
        </div>";
            }
            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        } else {
            require './app/scripts/DirUrl.php';
            header("Location: $diretorio");
            exit;
        }
    }

    public function editarcard()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['card-id'];
            $titulo = $_POST['titulo'];
            $ancora = $_POST['ancora'];
            $texto = $_POST['texto'];

            $elementos = new \app\models\Elementos;
            $cards = $elementos->getCards();

            if (isset($_FILES['imagem'])) {


                $imagem = $_FILES['imagem'];

                if ($imagem['error'] == 0) {
                    // Salvar a imagem em um diretório
                    $dir = './media/cards/'; // diretório onde a imagem será salva
                    $foto = uniqid() . '.' . pathinfo($imagem['name'], PATHINFO_EXTENSION);
                    $filePath = $dir . $foto;

                    if (!file_exists($dir)) {
                        mkdir($dir, 0777, true);
                    }

                    unlink($dir . $cards[($id - 1)]['imagem']);
                    move_uploaded_file($imagem['tmp_name'], $filePath);
                } else {
                    $foto = $cards[($id - 1)]['imagem'];
                }
            } else {
                $foto = $cards[($id - 1)]['imagem'];
            }


            $response = $elementos->editCard($id, $foto, $titulo, $ancora, $texto);

            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        } else {
            require './app/scripts/DirUrl.php';
            header("Location: $diretorio");
            exit;
        }
    }

    public function editarbanner()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id_banner'];
            $elementos = new \app\models\Elementos;
            $carousel = $elementos->getCarousel();

            if (isset($_FILES['imagem'])) {


                $imagem = $_FILES['imagem'];

                if ($imagem['error'] == 0) {
                    // Salvar a imagem em um diretório
                    $dir = './media/carousel/'; // diretório onde a imagem será salva
                    $foto = uniqid() . '.' . pathinfo($imagem['name'], PATHINFO_EXTENSION);
                    $filePath = $dir . $foto;

                    if (!file_exists($dir)) {
                        mkdir($dir, 0777, true);
                    }

                    unlink($dir . $carousel[($id - 1)]['imagem']);
                    move_uploaded_file($imagem['tmp_name'], $filePath);
                } else {
                    $foto = null;
                }
            } else {
                $foto = null;
            }


            $response = $elementos->editCarousel($foto, $id);

            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        } else {
            require './app/scripts/DirUrl.php';
            header("Location: $diretorio");
            exit;
        }
    }

    public function atualizarsidebarcard()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            require './app/scripts/DirUrl.php';
            $id = $_POST['id_card'];
            $elementos = new \app\models\Elementos;
            $card = $elementos->getCards();
            $response = "
            <div class='m-3'>
            <h4 class='text-center text-custom'> Card " . $id . " </h4>
                 <div class='d-flex justify-content-center'>
                            <img
                                src='$diretorio/media/cards/" . $card[($id - 1)]['imagem'] . "'
                                class='rounded border-2 shadow preview-carousel' id='sidebar-img-card'>
                            </div>
                             <div class='m-3'>
                             <form class='d-flex flex-column' id='form-edit-card' data-card-id='" . $id . "'>
                                <div class='mb-3'>
                                    <label for='edit-card-img' class='form-label text-center text-custom'>Escolha uma nova imagem</label>
                                <input type='file' class='form-control background text-custom' id='edit-card-img' accept='image/*'>
                                </div>
                                <div class='mb-3'>
                                    <label for='edit-card-title' class='form-label text-custom'>Título</label>
                                <input type='text' class='form-control background text-custom' id='edit-card-title' value='" . $card[($id - 1)]['titulo'] . "' placeholder='Título'  maxlength='50'>
                                </div>
                                <div class='mb-3'>
                                    <label for='edit-card-ancora' class='form-label text-custom'>Âncora (URL)</label>
                                <input type='text' class='form-control background text-custom' id='edit-card-ancora' value='" . $card[($id - 1)]['ancora'] . "' placeholder='URL'  maxlength='100'>
                                </div>
                                <div class='mb-3'>
                                    <label for='edit-card-info' class='form-label text-custom'>Texto</label>
                                <textarea class='form-control background text-custom' id='edit-card-info'  maxlength='200' rows='4' cols='50'>" . $card[($id - 1)]['texto'] . "</textarea>
                                </div>
                                <div class='mb-3 text-center'>
                                    <input type='submit' class='btn btn-custom-blue' value='Enviar Dados'>
                                </div>
                            </form>
                            </div>
            </div>
            ";
            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        } else {
            require './app/scripts/DirUrl.php';
            header("Location: $diretorio");
            exit;
        }
    }

    //Sobre
    public function atualizarsidebarsobre()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $elementos = new \app\models\Elementos;
            $sobre = $elementos->getSobre();

            $response = "
                <div class='m-3'>
                <h4 class='text-center text-custom'> Texto " . $sobre[($id - 1)]['id'] . " </h4>
                <form class='d-flex flex-column justify-content-center m-3' id='form-edit-sobre' data-id-info='" . $sobre[($id - 1)]['id'] . "'>
                <div class='mb-3'>
                     <label for='edit-title-info' class='form-label text-center text-custom'>Título</label>
                                <input type='text' class='form-control background text-custom' id='edit-title-info' value='" . $sobre[($id - 1)]['titulo'] . "' placeholder='Título'>
                </div>
                <div class='mb-3'>
                            <label for='edit-texto-info' class='form-label text-custom'>Texto</label>
                                <textarea class='form-control background text-custom' rows='10' placeholder='Informação'
                                    id='edit-texto-info'>" . $sobre[($id - 1)]['texto'] . "</textarea>
                </div>
                <div class='mb-3 text-center'>
                <input type='submit' class='btn btn-custom-blue' value='Enviar Dados'>
                </div>
                </form>
                </div>
             ";
            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        } else {
            require './app/scripts/DirUrl.php';
            header("Location: $diretorio");
            exit;
        }
    }

    public function editarsobre()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $titulo = $_POST['titulo'];
            $texto = $_POST['texto'];
            $elementos = new \app\models\Elementos;
            $sobre = $elementos->editSobre($id, $titulo, $texto);
            header('Content-Type: application/json');
            echo json_encode($sobre);
            exit;
        } else {
            require './app/scripts/DirUrl.php';
            header("Location: $diretorio");
            exit;
        }
    }

    public function atualizarsobre()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            require './app/scripts/DirUrl.php';
            $elementos = new \app\models\Elementos;
            $sobre = $elementos->getSobre();
            $response = "
                <div id='sidebar-elements'
    class='shadow background overflow-y-auto d-flex flex-column justify-content-start gap-4 sidebar-control'>

</div>

    <!--Fundo Sobre-->
    <img class='bg-image' src='$diretorio/public/assets/style/sobre/img/fundoSobre.jpg'
        alt='Background'>

    <!--Texto Inicial-->
    <div id='alto-sobre' class='cursor-pointer edit-info' data-id-info='1'>
       
            <h1 class='p-3 text-center'>" . $sobre[0]['titulo'] . "</h1>
            <div class='pb-3'>
            <p>
            " . $sobre[0]['texto'] . "
            </p>
            </div>
        

    </div>

    <!--Card Nosso Dever-->
    <div class='bg-light d-flex justify-content-between m-4 rounded cursor-pointer edit-info' data-id-info='2' style='max-height:300px' id='card-nosso-dever'>

        <!--Imagem Do Vidro Da Cantina-->
        <div class='w-50 d-flex align-items-center img-sobre'>
            <img class='w-100 h-100 object-fit-cover shadow rounded img-sobre'
                src='$diretorio/public/assets/style/sobre/img/vidropdt.jpg'>
        </div>

        <div class='w-50 overflow-y-auto text-sobre'>
        <div class='m-2'>
           
                <h5 class='text-center p-2 text-custom'>" . $sobre[1]['titulo'] . "</h5>
                <p class='p-2 text-custom'>" . $sobre[1]['texto'] . "</p>
           
        </div>
    </div>
</div>

<!-- Card Nossa Origem -->
<div class='bg-light d-flex justify-content-between m-4 rounded cursor-pointer edit-info' data-id-info='3' style='max-height:300px' id='card-nossa-origem'>
    <!-- Texto Nossa Origem -->
    <div class='w-50 overflow-y-auto text-sobre'>
        <div class='m-2'>
            
                <h5 class='text-center p-2 text-custom'>" . $sobre[2]['titulo'] . "</h5>
                <p class='p-2 text-custom'>" . $sobre[2]['texto'] . "</p>
           
        </div>
    </div>

        <!--Imagem Opção Antigo-->
        <div class='w-50 d-flex align-items-center img-sobre'>
            <img class='w-100 h-100 object-fit-cover shadow rounded'
                src='$diretorio/public/assets/style/sobre/img/origem.jpeg'>
        </div>

    </div>
            ";
            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        } else {
            require './app/scripts/DirUrl.php';
            header("Location: $diretorio");
            exit;
        }
    }

    public function atualizarfaq()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $parametro = $_POST['parametro'];

            $elementos = new \app\models\Elementos;
            $faq = $elementos->searchFAQ($parametro);

            $response = '';
            if (count($faq) > 0) {
                for ($c = 0; $c < count($faq); $c++) {

                    $response .= "<div data-bs-toggle='collapse' data-bs-target='#" . $faq[$c]['id'] . "' aria-expanded='false' aria-controls='" . $faq[$c]['id'] . "' class= 'd-flex cursor-pointer justify-content-between align-items-center flex-row border-top border rounded p-4 w-100'><div class='pergunta'>" . $faq[$c]['pergunta'] . "</div>
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
            } else {
                $response = "
                        <div class='w-100 text-custom d-flex justify-content-center'>
                            <h3>Nenhuma pergunta encontrada.</h3>
                        </div>
                    ";
            }

            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        } else {
            require './app/scripts/DirUrl.php';
            header("Location: $diretorio/Perfil");
            exit;
        }
    }

    public function atualizarsidebarfaq()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $elementos = new \app\models\Elementos;
            $faq = $elementos->getFAQ();

            $response = "
                <div class='m-3'>
                <h4 class='text-center text-custom'> Pergunta " . $faq[($id - 1)]['id'] . " </h4>
                <form class='d-flex flex-column justify-content-center m-3' id='form-edit-faq' data-id-faq='" . $faq[($id - 1)]['id'] . "'>
                <div class='mb-3'>
                     <label for='edit-quest-info' class='form-label text-center text-custom'>Pergunta</label>
                                <input type='text' class='form-control background text-custom' id='edit-quest-info' value='" . $faq[($id - 1)]['pergunta'] . "' placeholder='Pergunta.'>
                </div>
                <div class='mb-3'>
                            <label for='edit-texto-info' class='form-label text-custom'>Resposta</label>
                                <textarea class='form-control background text-custom' rows='10' placeholder='Resposta.'
                                    id='edit-texto-info'>" . $faq[($id - 1)]['resposta'] . "</textarea>
                </div>
                <div class='mb-3 text-center'>
                <input type='submit' class='btn btn-custom-blue' value='Enviar Dados'>
                </div>
                </form>
                </div>
             ";
            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        } else {
            require './app/scripts/DirUrl.php';
            header("Location: $diretorio");
            exit;
        }
    }

    public function editarfaq()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $titulo = $_POST['titulo'];
            $texto = $_POST['texto'];
            $elementos = new \app\models\Elementos;
            $sobre = $elementos->editFAQ($id, $titulo, $texto);
            header('Content-Type: application/json');
            echo json_encode($sobre);
            exit;
        } else {
            require './app/scripts/DirUrl.php';
            header("Location: $diretorio");
            exit;
        }
    }

}