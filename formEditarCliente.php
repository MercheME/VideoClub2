<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Cliente</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container-form">

        <div class="login-form">

            <h2>Editar Cliente</h2>
            <form action="editarCliente.php"  method="POST">
                <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo $_GET['nombre']; ?>" required>
                <br>
                <label for="usuario">Usuario:</label>
                <input type="text" id="usuario" name="usuario" value="<?php echo $_GET['usuario']; ?>" required>
                <br>
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
                <br>
                <button class="btn" type="submit">Actualizar Cliente</button>
            </form>
        </div>

    </div>
    
</body>
</html>
