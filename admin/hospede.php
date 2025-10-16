    <?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    $no_login_required = true;

    require_once $_SERVER['DOCUMENT_ROOT'] . '/ht/core/core.php';

    include 'includes/header.php';
    //include 'includes/navigation.php';

    // Detalhes dos campos
    $name = '';
    $email = '';
    $documento = '';
    $endereco = '';
    $observacao = '';
    $telefone = '';
    $role = '';
    $password = '';
    $password2 = '';
    $joinDate = date("Y-m-d H:i:s");

    // Código para registrar um novo administrador
    if (isset($_POST['add'])) {
        // Verificar se todos os campos obrigatórios foram preenchidos
        if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['role']) && !empty($_POST['password'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $documento = $_POST['documento'];
            $endereco = $_POST['endereco'];
            $observacao = $_POST['observacao'];
            $telefone = $_POST['telefone'];
            $role = $_POST['role'];

            if ($_POST['password'] == $_POST['password2']) {
                // Hashing da senha para segurança
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                // Inserir novo administrador no banco de dados
                $sql = "INSERT INTO users (full_name, email, telefone, password, join_date, permissions, documento, endereco, observacao) VALUES ('$name', '$email', '$telefone','$password', '$joinDate', '$role', '$documento', '$endereco', '$observacao')";

                $insert = $db->query($sql);
                if ($insert) {
                    $_SESSION['add_admin'] = 'Novo usuário adicionado com sucesso!';
                    header("Location: login.php");
                    exit;
                } else {
                    echo '<div class="w3-red w3-center">Erro ao adicionar novo usuário</div>';
                }
            } else {
                echo '<div class="w3-red w3-center">As senhas não coincidem!</div>';
            }
        } else {
            echo '<div class="w3-red w3-center">Todos os campos com asterisco são obrigatórios!</div>';
        }
    }
    ?>

    <style>
  body {
    background-color: #343a4a;
  }

    .container {
            background-color: white;
            padding: 30px;
            margin: 80px auto;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 60%;
        }
    </style>
        <div class="container">
            <div class="row">
                <div class="col-md-6" style="text-align: center; margin-left:25%">
                    <h2>Cadastro de Hóspede</h2>
                    <hr>
                    <form action="hospede.php" method="POST" class="form" id="add_user">

                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="text" value="<?= $name; ?>" name="name" class="form-control" placeholder="Nome completo*">
                            </div>
                        </div>


                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="text" value="<?= $endereco; ?>" name="endereco" class="form-control" placeholder="Endereço*">
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="email" value="<?= $email; ?>" name="email" class="form-control" placeholder="E-mail do usuário*">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="text" value="<?= $documento; ?>" name="documento" id="documento" class="form-control" placeholder="Documento (CPF)*">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="text" value="<?= $telefone; ?>" name="telefone" id="telefone" class="form-control" placeholder="Telefone*">
                            </div>
                        </div>

                        <div class="col-sm-12" style="display:none;">
                            <div class="form-group">
                                <label for="role">Tipo de usuário:</label>
                                <select id="permission" name="role" class="form-control">
                                    <option value="editor" selected>Hospede</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 form-group">
                            <input type="password" name="password" class="form-control" placeholder="Senha*">
                        </div>
                        <div class="col-sm-6 form-group">
                            <input type="password" name="password2" class="form-control" placeholder="Confirmar senha*">
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <textarea value="<?= $observacao; ?>" name="observacao" class="form-control" placeholder="Observação"></textarea>
                            </div>
                        </div>

                        <div class="col-sm-12">
                        <br>
                            <input style="background-color:#df8352; border: white; padding: 10px 20px;" type="submit" class="btn btn-info" name="<?= (isset($_GET['edit'])) ? 'edit' : 'add'; ?>" value="<?= (isset($_GET['edit'])) ? 'Editar usuário' : 'Cadastrar'; ?>">
                            <a href="./login.php" class="btn btn-info" style="background-color:#df8352; border: white; padding: 10px 20px;">⠀Voltar⠀</a>
                    </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            function w3_open() {
                document.getElementsByClassName("w3-sidenav")[0].style.display = "block";
            }

            function w3_close() {
                document.getElementsByClassName("w3-sidenav")[0].style.display = "none";
            }
        </script>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
        
        <script src="js/bootstrap.js"></script>

        <script>
            $(document).ready(function(){
                $('#documento').mask('000.000.000-00', {reverse: true});
                $('#telefone').mask('(00) 00000-0000');
            });
        </script>
        
        </body>
        </html>