
<?php
 class Cliente {
    private $numSoportesAlquilados = 0; // Contador de alquileres
    private $soportesAlquilados = []; 
    public function __construct(
        public string $nombre,
        private int $numero,
        private int $maxAlquilerConcurrente = 3,
    ) {}

    public function getNumero() {
        return $this->numero;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }

    public function getNumSoportesAlquilados() {
        return $this->numSoportesAlquilados;
    }

    public function tieneAlquilado( Soporte $s) {
        foreach ($this->soportesAlquilados as $soporte) {
            if ($soporte->getNumero() === $s->getNumero()) return true; 
        }
        return false;
    }
        

    public function alquilarSoporte($soporte) {
        if ($this->numSoportesAlquilados < $this->maxAlquilerConcurrente) {
            $this->soportesAlquilados[] = $soporte;
            $this->numSoportesAlquilados++;
        } else {
            echo "No se puede alquilar más soportes. Limite alcanzado.";
        }
    }

    public function alquilar(Soporte $s): bool {
        if ($this->tieneAlquilado($s)) {
            echo "El cliente {$this->nombre} ya tiene alquilado el soporte '{$s->titulo}'.<br>";
            return false;
        }
        
        if ($this->numSoportesAlquilados < $this->maxAlquilerConcurrente) {
            $this->soportesAlquilados[] = $s;
            $this->numSoportesAlquilados++;
            echo "<br><strong>Alquilado soporte a</strong>: {$this->nombre}<br>";
            $s->muestraResumen();
            return true;
        } else {
            echo "Este cliente tiene {$this->numSoportesAlquilados} elementos alquilados. No puede alquilar más en este videoclub hasta que no devuelva algo.<br>";
            return false;
        }
    }

    public function devolver(int $numSoporte):bool {
        foreach($this->soportesAlquilados as $index => $soporte) {
            if ($soporte->getNumero() === $numSoporte) {
                //Si encuentra el soporte habría que eliminarlo
                unset($this->soportesAlquilados[$index]);
                $this->soportesAlquilados = array_values($this->soportesAlquilados); // Reindexar el array
                $this->numSoportesAlquilados--;
                echo "El cliente {$this->nombre} ha devuelto el soporte '{$soporte->titulo}' con éxito.<br>";
                return true;
            } 
        }

        echo  "Este cliente no tiene alquilado ningún elemento.<br>";
        return false; 
    }

    public function listaAlquileres(): void {
        "Este cliente tiene {$this->numSoportesAlquilados} elementos alquilados.<br>";
        if ($this->numSoportesAlquilados > 0) {
            echo "Soportes alquilados:<br>";
            foreach ($this->soportesAlquilados as $soporte) {
                echo "- {$soporte->titulo}<br>";
            }
        } else {
            echo "Este cliente no tiene alquilado ningún elemento.<br>";
        }
    }

    public function muestraResumen() {
        echo "<br>Nombre: {$this->nombre} <br>";
        echo "Total de alquileres: " . count($this->soportesAlquilados) . " <br>";

        if (count($this->soportesAlquilados) > 0) {
            echo "Soportes alquilados:<br>";
            foreach ($this->soportesAlquilados as $soporte) {
                $soporte->muestraResumen(); 
            }
        } else {
            echo "No hay soportes alquilados.<br>";
        }
    }

 }

?>