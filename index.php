<?php
include "Autoload.php";

session_start(); 
use App\Dwes\ProyectoVideoclub\Videoclub;


if (!isset($_SESSION['videoclub'])) {
    $_SESSION['videoclub'] = new Videoclub('Severo 8A');
} else { 
    $vc = $_SESSION['videoclub']; 
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="left">
            <h2>Descubre los mejores Videojuegos y Películas de la Historia</h2>
            <img src="img/fondo5.png" alt="img-fondo"> 
            <?php 
         
            ?>
        </div>
        <div class="right">
            <div class="login-form">
                <h1 class="h1-index">Login</h1>
                <h2>Bienvenido a VIDEOCLUB APP</h2>
                <form action="login.php" method="post">
                    <div>
                        <span class='error-message'><?php echo $_SESSION['error'] ?? ''; unset($_SESSION['error']); ?></span>
                    </div>
                        <input type='text' name='inputUsuario' id='usuario' maxlength="50" placeholder="Nombre de usuario o email" required/>
                        <br />
                        <input type='password' name='inputPassword' id='password' maxlength="50" placeholder="Contraseña" required/>
                        <br />
                    
                        <input type='submit' class="btn" name='enviar' value='Iniciar Sesion' />
                </form>
                <p><a href="#">¿No eres miembro? Regístrate</a></p>
            </div>
        </div>
        
    </div>
</body>
</html>