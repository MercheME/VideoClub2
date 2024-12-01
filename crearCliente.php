<?php
require_once './Autoload.php';
session_start();

use App\Dwes\ProyectoVideoclub\Videoclub;
use App\Dwes\ProyectoVideoclub\Cliente;

if (!isset($_SESSION['videoclub'])) {
    $_SESSION['videoclub'] = new Videoclub('Severo 8A');
}

$vc = $_SESSION['videoclub'];

$nombre = $_POST['nombre'];
$usuario = $_POST['usuario'];
$password = $_POST['password'];

if (empty($nombre) || empty($usuario) || empty($password)) {
    $_SESSION['error'] = 'Todos los campos son obligatorios.';
    header('Location: formCreateCliente.php');
    exit();
}


$vc->incluirSocio($nombre, 3, $usuario, $password);

header('Location: mainAdmin.php');
exit();
?>
