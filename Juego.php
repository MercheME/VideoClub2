


<?php
    require_once "Soporte.php";

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


        public function muestraJugadoresPosibles() {

            if ($this->minNumJugadores === $this->maxNumeroJugadores) {
                echo "Para {$this->minNumJugadores} jugador.<br>";
            } else {
                echo "De {$this->minNumJugadores} a {$this->maxNumeroJugadores} jugadores.<br>";
            }
        }

        public function muestraResumen() {
            echo "<br>Juego para: {$this->consola}";
            parent::muestraResumen();
            $this->muestraJugadoresPosibles();
        }

    }



?>