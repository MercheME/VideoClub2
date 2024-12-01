<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cliente</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container-form">

        <div class="login-form">

            <h2>Crear Cliente</h2> 
            <form action="crearCliente.php" method="POST"> 
                <label for="nombre">Nombre:</label> 
                <input type="text" id="nombre" name="nombre" required> <br> 
                <label for="usuario">Usuario:</label> 
                <input type="text" id="usuario" name="usuario" required> <br> 
                <label for="password">Contraseña:</label> 
                <input type="password" id="password" name="password" required> <br> 
                <button class="btn" type="submit">Crear Cliente</button> 
            </form>  

        </div>

    </div>
    
</body>
</html>
