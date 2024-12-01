<?php
require_once './Autoload.php';
session_start();

use App\Dwes\ProyectoVideoclub\Videoclub;

if (!isset($_SESSION['videoclub'])) {
    $_SESSION['error'] = 'El videoclub no está inicializado';
}

$vc = $_SESSION['videoclub'];
$usuario = $_SESSION['usuario'];

$socios = $vc->getSocios();

if (empty($socios)) { 
    echo 'La lista de socios está vacía'; 
    exit();
}

$soportes = $vc->getSoportes();
$numSoportesAlquilados = $vc->getNumProductosAlquilados();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Videoclub - Admin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container-app">

        <div class="left">
        <h2>Bienvenido, <?= htmlspecialchars($usuario); ?> </h2>
            <a class="btn-close-session" href="logout.php">Cerrar sesión</a>
        
        </div>
        <div class="right-no-flex">
            <h2>Listado de Clientes</h2>
            <ul>
                <?php foreach ($socios as $socio) : ?>
                    <li>
                        <?= htmlspecialchars($socio->getNombre());?>
                        <br>
                        <p>Nombre usuario: <?= htmlspecialchars($socio->getNombreUsuario());?></p>
                        
                        <a class="btn-admin" href="formEditarCliente.php?id=<?php echo $socio->getNumero(); ?>&nombre=<?php echo $socio->getNombre(); ?>&usuario=<?php echo $socio->getNombreUsuario(); ?>">
                        ⚙️ Editar
                        </a> 
                        <a class="btn-admin-remove" href="eliminarCliente.php?id=<?php echo $socio->getNumero(); ?>" 
                            onclick="return confirm('¿Estás seguro de que deseas eliminar este cliente?');">
                        ❌ Eliminar
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
            <a class="btn-admin" href="formCrearCliente.php">✅ Crear Cliente</a>

            
            <h2>Listado de Soportes</h2>
            
            <ul>
                <?php foreach ($soportes as $soporte) : ?>
                    <li><?= htmlspecialchars($soporte->getTitutlo());?></li>
                <?php endforeach; ?>
            </ul>

            <h3>Número de soportes alquilados <?= $numSoportesAlquilados ?></h3>
        </div>






        
        
    </div>
   
</body>
</html>
