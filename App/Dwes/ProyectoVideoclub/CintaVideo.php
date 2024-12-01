<?php
namespace App\Dwes\ProyectoVideoclub;

use App\Dwes\ProyectoVideoclub\Soporte;
include_once __DIR__ . "/Soporte.php";

class CintaVideo extends Soporte {

    public function __construct(
        public string $titulo,
        protected int $numero,
        private float $precio,
        private int $duracion,
    ) {
        parent::__construct($titulo, $numero, $precio);
    }


    public function getDuracion(): int {
        return $this->duracion;
    }

    public function muestraResumen(): void {
        echo "<br>";
        echo "📼 Película en VHS: ";
        parent::muestraResumen();
        echo "Duración: {$this->duracion} minutos<br>";
    }
}

?>