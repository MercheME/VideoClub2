<?php
namespace App\Dwes\ProyectoVideoclub;

    use App\Dwes\ProyectoVideoclub\Soporte;
    include_once __DIR__ . "/Soporte.php";

    class Dvd extends Soporte {

        public function __construct(
            public string $titulo,
            protected int $numero,
            private float $precio,
            public string $idiomas,
            private string $formatPantalla
        ) {
            parent::__construct($titulo, $numero, $precio);
        }

        public function getIdiomas(): string { return $this->idiomas; }
        public function getFormatPantalla(): string { return $this->formatPantalla; }
    
        public function muestraResumen(): void {
            echo "<br>";
            echo "📀 Pelílula en DVD: ";
            parent::muestraResumen();
            echo "Idiomas: {$this->idiomas}<br>";
            echo "Formato Pantalla: {$this->formatPantalla}<br>";
        }
    
    }
    

?>