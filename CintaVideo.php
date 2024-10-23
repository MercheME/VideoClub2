

<?php

require_once "Soporte.php";

class CintaVideo extends Soporte {

    public function __construct(
        public string $titulo,
        protected int $numero,
        private float $precio,
        private int $duracion,
    ) {
        parent::__construct($titulo, $numero, $precio);
    }

    public function muestraResumen(): void {
        echo "Película en VHS: ";
        parent::muestraResumen();
        echo "Duración: {$this->duracion} minutos<br>";
    }

}




?>