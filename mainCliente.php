<?php 
require_once './Autoload.php';
session_start();

if (!isset($_SESSION['cliente'])) {
    $_SESSION['error'] = 'No hay datos del cliente disponibles';
    header('Location: index.php'); 
    exit(); 
}

$cliente = $_SESSION['cliente'];
$alquileres = $cliente->getAlquileres();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Videoclub - Admin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="container-app">
    <div class="left">
        <h2>Bienvenido, <?php echo $cliente->getNombre(); ?></h2>
        <a class="btn-close-session" href="logout.php">Cerrar sesión</a>
       
    </div>
    <div class="right-no-flex">
        <h2>Tus alquileres</h2>
        <?php $cliente->listaAlquileres();?>
    </div>
</body>
</html>