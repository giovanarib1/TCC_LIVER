<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require '../conexao.php';
mysqli_query($con, "SET NAMES 'utf8'");
mysqli_query($con, 'SET character_set_connection=utf8');
mysqli_query($con, 'SET character_set_client=utf8');
mysqli_query($con, 'SET character_set_results=utf8');

session_start();
if (!isset($_SESSION['ID_USUARIO'])) {
    echo "Você precisa estar logado para adicionar à sua lista";
    header('Location: ../login/index.html');
    exit();
}

$idUsuario = $_SESSION['ID_USUARIO'];
$sqlperfil = "SELECT * FROM perfil WHERE usuario_ID_USUARIO = $idUsuario";
$resultado = mysqli_query($con, $sqlperfil);
$row = mysqli_fetch_assoc($resultado);
$id_obra = $_POST['obra'];
$_SESSION['ID_PERFIL'] = $row['ID_PERFIL'];
$idPerfilUsuario = $_SESSION['ID_PERFIL'];

    $sqlverif = "SELECT * FROM depois WHERE obra_ID_OBRA = $id_obra";
    $resultado2 = mysqli_query($con, $sqlverif);

    if (mysqli_num_rows($resultado2) > 0) {
    echo "<script>alert('Essa obra já está adicionada na sua lista de Ver Depois!');</script>";
    header('refresh:0.2;../timeline.php');

    } else {
    $sql = "INSERT INTO depois (obra_ID_OBRA, obra_perfil_ID_PERFIL, obra_perfil_usuario_ID_USUARIO, usuario_ID_USUARIO) VALUES ($id_obra, $idPerfilUsuario, $idUsuario, $idUsuario)";

    if (mysqli_query($con, $sql)) {
        header('refresh:0.2;../timeline.php');
    } else {
        echo "<script>alert('Erro ao adicionar a obra na lista.');</script>";
        header('refresh:0.2;../timeline.php');
    }
}

mysqli_close($con);

?>
