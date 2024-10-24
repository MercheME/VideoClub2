<?php

spl_autoload_register(function ($class) {
    // Cambia las barras invertidas por barras normales para obtener la ruta del archivo
    $classPath = str_replace('\\', DIRECTORY_SEPARATOR, $class);

    // Agrega la extensión .php al final y busca la clase en el directorio raíz
    $filePath = __DIR__ . DIRECTORY_SEPARATOR . $classPath . '.php';

    // Verifica si el archivo existe antes de incluirlo
    if (file_exists($filePath)) {
        include_once $filePath;
    } else {
        echo (string)"No se pudo cargar la clase: " . $class;
    }
});
