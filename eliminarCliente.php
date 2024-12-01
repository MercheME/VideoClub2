<?php
require_once './Autoload.php';
session_start();

use App\Dwes\ProyectoVideoclub\Videoclub;

if (!isset($_SESSION['videoclub'])) {
    $_SESSION['videoclub'] = new Videoclub('Severo 8A');
}

$vc = $_SESSION['videoclub'];
$id = $_GET['id'];
$clientes = $vc->getSocios(); 

foreach ($clientes as $index => $socio) { 
    if ($socio->getNumero() == $id) { 
        unset($clientes[$index]); 
        $vc->setSocios($clientes);
        break; 
    } 
}

header('Location: mainAdmin.php');
exit();
?>
