<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/ht/core/core.php';
ini_set('error_reporting', E_ALL & ~E_NOTICE);

// Inicia a sessão
session_start();

// Pega o ID do usuário logado
if (isset($_SESSION['casf_user'])) {
  $userID = $_SESSION['casf_user'];
}

if (!is_logged_in()) {
  login_error_check();
}

include 'includes/header.php';
include 'includes/navigation.php';

// EDITAR
if (@$_GET['edit'] && !empty(@$_GET['edit'])) {
  $id = $_GET['edit'];
  $get = $db->query("SELECT * FROM rooms WHERE id = '$id' ");
  $edit = mysqli_fetch_assoc($get);
}

// UPLOAD DE IMAGEM
if (!empty($_FILES)) {
  $fileName = @$_FILES['file']['name'];
  $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
  $fileName = md5(microtime()) . '.' . $ext;
  $tmp_name = @$_FILES['file']['tmp_name'];

  if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) {
    // 👇 NOVO CAMINHO
    $location = $_SERVER['DOCUMENT_ROOT'] . 'images/';
    move_uploaded_file($tmp_name, $location . $fileName);
  } else {
    echo '<div class="w3-center w3-red">O tipo de imagem deve ser jpg, jpeg, gif ou png.</div></br>';
  }
}

// INSERIR NOVO REGISTRO
if (isset($_POST['submit'])) {
  if (!empty($_POST['number']) && !empty($_POST['type']) && !empty($_POST['price']) && !empty($_POST['description'])) {

    $number = $_POST['number'];
    $type = $_POST['type'];
    $price = $_POST['price'];
    $details = $_POST['description'];
    $host = $_POST['host'];
    $endereco = $_POST['endereco'];

    // 👇 CAMINHO ATUALIZADO
    $image = !empty($fileName) ? 'images/' . $fileName : '';

    $sql = "INSERT INTO rooms (`room_number`,`type`,`price`,`details`,`photo`, `host`,`endereco`, `usuario_id`)
            VALUES ('$number','$type','$price','$details','$image', '$host', '$endereco','$userID')";

    $query_run = $db->query($sql);
    if ($query_run) {
      $_SESSION['added_event'] = '<div class="w3-center w3-green">Hospedagem adicionada com sucesso!</div></br>';
    }
    header("Location: rooms.php");
  } else {
    echo '<div class="w3-center w3-red">Por favor, preencha todos os campos.</div></br>';
  }
}

// ATUALIZAR EXISTENTE
else if (isset($_POST['update'])) {
  if ($_POST['number'] !== '' && $_POST['type'] !== '' && $_POST['price'] !== '' && $_POST['description'] !== '') {

    $number = $_POST['number'];
    $type = $_POST['type'];
    $price = $_POST['price'];
    $details = $_POST['description'];
    $host = $_POST['host'];
    $endereco = $_POST['endereco'];
    $toEditID = $_GET['edit'];

    $sqlSelect = $db->query("SELECT * FROM rooms WHERE id = '$toEditID'");
    $row = mysqli_fetch_assoc($sqlSelect);

    // SE NOVA IMAGEM FOI ENVIADA
    if (!empty($_FILES['file']['name'])) {
      $fileName = @$_FILES['file']['name'];
      $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
      $fileName = md5(microtime()) . '.' . $ext;
      $tmp_name = @$_FILES['file']['tmp_name'];

      if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) {
        $image = 'images/' . $fileName;
        $location = $_SERVER['DOCUMENT_ROOT'] . '/ht/images/';
        move_uploaded_file($tmp_name, $location . $fileName);
      } else {
        echo '<div class="w3-center w3-red">O tipo de imagem deve ser jpg, jpeg, gif ou png.</div></br>';
      }
    } else {
      $image = $row['photo'];
    }

    $query = "UPDATE rooms SET 
                `room_number`='$number',
                `photo`='$image',
                `type`='$type',
                `details`='$details',
                `price`='$price',
                `host`='$host',
                `endereco`='$endereco',
                `usuario_id`='$userID'
              WHERE id = '$toEditID'";

    $update = $db->query($query);
    if ($update) {
      $_SESSION['added_event'] = '<div class="w3-center w3-green">Hospedagem atualizada com sucesso!</div></br>';
    } else {
      echo '<div class="w3-center w3-red">Erro ao atualizar hospedagem.</div></br>';
    }

    header("Location: rooms.php");
  } else {
    echo '<div class="w3-center w3-red">Por favor, preencha todos os campos.</div></br>';
  }
}

// DELETAR IMAGEM
if (isset($_GET['delete_image'])) {
  $toEditID = $_GET['delete_image'];
  $sql1 = $db->query("SELECT * FROM rooms WHERE id = '$toEditID'");
  $fetch = mysqli_fetch_assoc($sql1);
  $imageURL = $_SERVER['DOCUMENT_ROOT'] . '/ht/' . $fetch['photo'];
  unlink($imageURL);
  $sql = "UPDATE rooms SET `photo` = '' WHERE id = '$toEditID'";
  $db->query($sql);
  header("Location: add_room.php?edit=$toEditID");
}
?>

<div class="w3-container w3-main" style="margin-left:200px">
  <header class="w3-container" style="background-color:#343a4a;">
    <span class="w3-opennav w3-xlarge w3-hide-large" onclick="w3_open()">☰</span>
    <h2 class="text-center" style="color:white">Adicionar uma hospedagem</h2>
  </header>
  <br />
  <form class="form" action="#" method="post" enctype="multipart/form-data">

    <div class="form-group col-md-4">
      <label>Título:</label>
      <input type="text" class="form-control" value="<?= (isset($_GET['edit'])) ? $edit['room_number'] : ''; ?>" name="number">
    </div>

    <div class="form-group col-md-4">
      <label for="type">Categoria:</label>
      <select class="form-control" name="type" id="type">
        <option value="selecao" disabled selected>Selecione</option>
        <option value="Apartamento Inteiro" <?= (isset($_GET['edit']) && $edit['type'] === 'Apartamento Inteiro') ? 'selected' : '' ?>>Apartamento Inteiro</option>
        <option value="Casa" <?= (isset($_GET['edit']) && $edit['type'] === 'Casa') ? 'selected' : '' ?>>Casa</option>
        <option value="Casa de Campo" <?= (isset($_GET['edit']) && $edit['type'] === 'Casa de Campo') ? 'selected' : '' ?>>Casa de Campo</option>
        <option value="Casa com Piscina" <?= (isset($_GET['edit']) && $edit['type'] === 'Casa com Piscina') ? 'selected' : '' ?>>Casa com Piscina</option>
        <option value="Chalé" <?= (isset($_GET['edit']) && $edit['type'] === 'Chalé') ? 'selected' : '' ?>>Chalé</option>
        <option value="Chácara" <?= (isset($_GET['edit']) && $edit['type'] === 'Chácara') ? 'selected' : '' ?>>Chácara</option>
        <option value="Fazenda" <?= (isset($_GET['edit']) && $edit['type'] === 'Fazenda') ? 'selected' : '' ?>>Fazenda</option>
        <option value="Hotel" <?= (isset($_GET['edit']) && $edit['type'] === 'Hotel') ? 'selected' : '' ?>>Hotel</option>
        <option value="Sítio" <?= (isset($_GET['edit']) && $edit['type'] === 'Sítio') ? 'selected' : '' ?>>Sítio</option>
      </select>
    </div>

    <div class="form-group col-md-2">
      <label>Preço da Diária:</label>
      <input type="number" class="form-control" value="<?= (isset($_GET['edit'])) ? $edit['price'] : ''; ?>" name="price">
    </div>

    <div class="form-group col-md-2">
      <label>Qtd máxima hóspedes:</label>
      <input type="number" class="form-control" value="<?= (isset($_GET['edit'])) ? $edit['host'] : ''; ?>" name="host">
    </div>

    <div class="form-group col-md-4">
      <?php if (isset($_GET['edit']) && !empty($edit['photo'])) : ?>
        <figure>
          <h3>Imagem</h3>
          <img src="<?= $edit['photo']; ?>" alt="Imagem da hospedagem" class="img-responsive">
          <figcaption>
            <a href="add_room.php?delete_image=<?= $id; ?>" class="w3-text-red">Deletar imagem</a>
          </figcaption>
        </figure>
      <?php else : ?>
        <label>Imagem:</label>
        <input type="file" class="form-control" name="file">
      <?php endif; ?>
    </div>

    <div class="form-group col-md-4">
      <label>Detalhes:</label>
      <textarea class="form-control" rows="6" name="description"><?= (isset($_GET['edit'])) ? $edit['details'] : ''; ?></textarea>
    </div>

    <div class="form-group col-md-4">
      <label>Endereço:</label>
      <input type="text" class="form-control" value="<?= (isset($_GET['edit'])) ? $edit['endereco'] : ''; ?>" name="endereco">
    </div>

    <div class="form-group col-md-4">
      <input type="submit" class="btn btn-block btn-lg btn-success"
        value="<?= (isset($_GET['edit'])) ? 'Atualizar hospedagem' : 'Adicionar Hospedagem'; ?>"
        name="<?= (isset($_GET['edit'])) ? 'update' : 'submit'; ?>">
    </div>

    <?php if (isset($_GET['edit']) && !empty($_GET['edit'])) : ?>
      <div class="form-group col-md-4">
        <a class="btn btn-block btn-danger btn-lg" href="rooms.php">Cancelar edição</a>
      </div>
    <?php endif; ?>

  </form>
</div>

<script>
  function w3_open() { document.getElementsByClassName("w3-sidenav")[0].style.display = "block"; }
  function w3_close() { document.getElementsByClassName("w3-sidenav")[0].style.display = "none"; }
</script>

<script src="js/jquery-1.11.2.min.js"></script>
<script src="js/bootstrap.js"></script>
</body>
</html>
