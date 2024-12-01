<?php
require_once './Autoload.php';
session_start();

use App\Dwes\ProyectoVideoclub\Videoclub;

if (!isset($_SESSION['videoclub'])) {
    $_SESSION['videoclub'] = new Videoclub('Severo 8A');
}

$vc = $_SESSION['videoclub'];

$vc->incluirSocio("Amancio Ortega", 3, 'amancio', '1234'); 
$vc->incluirSocio("Pablo Picasso", 2, 'picasso', '1234'); 

//voy a incluir unos cuantos soportes de prueba 
$vc->incluirJuego("God of War", 19.99, "PS4", 1, maxJugadores: 1); 
$vc->incluirJuego("The Last of Us Part II", 49.99, "PS4", 1, 1);
$vc->incluirDvd("Torrente", 4.5, "es","16:9"); 
$vc->incluirDvd("Origen", 4.5, "es,en,fr", "16:9"); 
$vc->incluirDvd("El Imperio Contraataca", 3, "es,en","16:9"); 
$vc->incluirCintaVideo("Los cazafantasmas", 3.5, 107); 
$vc->incluirCintaVideo("El nombre de la Rosa", 1.5, 140); 

$vc->alquilarSocioProducto(1,2)
    ->alquilarSocioProducto(1,3)
    ->alquilarSocioProducto(1, 6);

    
$vc->alquilarSocioProducto(1, 2)
       ->alquilarSocioProducto(1, 3)
       ->alquilarSocioProducto(1, 2)
       ->alquilarSocioProducto(1, 6);
    
$vc->alquilarSocioProductos(0, [1, 2, 3]);
    
// $vc->devolverSocioProducto(1, 1);
    
// $vc->devolverSocioProductos(1, [2, 3]);


if (isset($_POST["enviar"])) {

    $usuario = $_POST['inputUsuario'];
    $password = $_POST['inputPassword'];


    if (empty($usuario) || empty($password)) {
        $_SESSION['error'] = 'Debes introducir un usuario y contraseña';
        header('Location: index.php');    
        exit();
    }

    if ($usuario === 'admin' && $password === 'admin') {
        $_SESSION['usuario'] = $usuario;
        $_SESSION['videoclub'] = $vc;
        header('Location: mainAdmin.php');
        exit();
    }

    $socios = $vc->getSocios();
    $estaRegistrado = false;

    foreach ($socios as $socio) {
        if ($socio->getNombreUsuario() == $usuario && $socio->getContraseniaUsuario() == $password) {
            $_SESSION['cliente'] = $socio;
            $_SESSION['usuario'] = $usuario;
            $estaRegistrado = true;
            header('Location: mainCliente.php');
            exit();
        }
    }

    if ( !$estaRegistrado ) {
        $_SESSION['error'] = 'Usuario o contraseña incorrectos';
        header('Location: index.php');
        exit();
    }
}
?>
