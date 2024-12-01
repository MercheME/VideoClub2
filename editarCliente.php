<?php
require_once './Autoload.php';
session_start();

use App\Dwes\ProyectoVideoclub\Videoclub;

if (!isset($_SESSION['videoclub'])) {
    $_SESSION['videoclub'] = new Videoclub('Severo 8A');
}

$vc = $_SESSION['videoclub'];

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$usuario = $_POST['usuario'];
$password = $_POST['password'];

if (empty($nombre) || empty($usuario) || empty($password)) {
    $_SESSION['error'] = 'Todos los campos son obligatorios.';
    header('Location: formEditarCliente.php?id=' . $id . '&nombre=' . $nombre . '&usuario=' . $usuario);
    exit();
}

foreach ($vc->getSocios() as $socio) {
    if ($socio->getNumero() == $id) {
        $socio->nombre = $nombre;
        $socio->nombreUsuario = $usuario;
        $socio->contraseniaUsuario = $password;
        break;
    }
}

header('Location: mainAdmin.php');
exit();
?>
