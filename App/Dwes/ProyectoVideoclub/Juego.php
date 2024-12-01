<?php
namespace App\Dwes\ProyectoVideoclub;

    use App\Dwes\ProyectoVideoclub\Soporte;

    include_once __DIR__ . "/Soporte.php";

    class Juego extends Soporte {

        public function __construct(
            public string $titulo,
            protected int $numero,
            private float $precio,
            public string $consola,
            private int $minNumJugadores,
            private int $maxNumeroJugadores
        ) {
            parent::__construct($titulo, $numero, $precio);
        }

        public function getConsola(): string {
            return $this->consola;
        }

        public function getMinNumJugadores(): int {
            return $this->minNumJugadores;
        }

        public function getMaxNumJugadores(): int {
            return $this->minNumJugadores;
        }


        public function muestraJugadoresPosibles() {

            if ($this->minNumJugadores === $this->maxNumeroJugadores) {
                echo "Para {$this->minNumJugadores} jugador.<br>";
            } else {
                echo "De {$this->minNumJugadores} a {$this->maxNumeroJugadores} jugadores.<br>";
            }
        }

        public function muestraResumen(): void {
            echo "<br>";
            echo "🎮 Juego para: {$this->consola}";
            parent::muestraResumen();
            $this->muestraJugadoresPosibles();
        }

    }



?>