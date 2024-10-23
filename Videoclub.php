

<?php
include_once "./Cliente.php";
include_once "./CintaVideo.php";
include_once "./Dvd.php";
include_once "./Juego.php";


class Videoclub {
    private $nombre;
    private $productos = [];
    private $numProductos = 0;
    private $socios = [];
    private $numSocios = 0;


    public function __construct( $nombre ) {}

    private function incluirProducto(Soporte $producto) {
        $this->productos[] = $producto;
        $this->numProductos++;
        echo "Incluido soporte " . ($this->numProductos - 1) . "<br>";
    }

    // Métodos para incluir productos
    public function incluirJuego(string $titulo, float $precio, string $consola, int $minJugadores, int $maxJugadores): void {
        $juego = new Juego($titulo, $this->numProductos + 1, $precio, $consola, $minJugadores, $maxJugadores);
        $this->incluirProducto($juego);
    }

    public function incluirDvd(string $titulo, float $precio, string $idiomas, string $pantalla): void {
        $dvd = new Dvd($titulo, $this->numProductos + 1, $precio, $idiomas, $pantalla);
        $this->incluirProducto($dvd);
    }

    public function incluirCintaVideo(string $titulo, float $precio, int $duracion): void {
        $cintaVideo = new CintaVideo($titulo, $this->numProductos + 1, $precio, $duracion);
        $this->incluirProducto($cintaVideo);
    }

    public function listarProductos(): void {
        echo "<br>Listado de los " . count($this->productos) . " productos disponibles:<br>";
        foreach ($this->productos as $producto) {
            echo "{$producto->getNumero()} .- ";
            $producto->muestraResumen();
        }
    }

    public function incluirSocio(string $nombre, int $maxAlquileresConcurrentes = 3): void {
        $socio = new Cliente($nombre, $this->numSocios , $maxAlquileresConcurrentes);
        $this->socios[] = $socio;
        $this->numSocios++;
        echo "<br>Incluido socio " . ($this->numSocios) . "<br>";
    }

    public function alquilarSocioProducto(int $numeroCliente, int $numeroSoporte): void {
       $socioAlquilar = null;
        $productoAlquilar = null;

        foreach ($this->socios as $socio) {
            if ($socio->getNumero() == $numeroCliente) {
                $socioAlquilar = $socio;
                break;
            }
        }

        foreach ($this->productos as $producto) {
            if ($producto->getNumero() == $numeroSoporte +1) {
                $productoAlquilar = $producto;
                break;
            } 
        }

        if ($socioAlquilar && $productoAlquilar) {
            $socioAlquilar->alquilar($productoAlquilar);
        } else {
            echo "Cliente o soporte no existe";
        }
    }

    public function listarSocios(): void {
        echo "<br>Listado de " . count($this->socios) . " socios del videoclub:<br>";
        foreach ($this->socios as $index => $socio) {
            echo ($index + 1) . ".- Cliente " . ($socio->getNumero()) . ": " . $socio->nombre . "<br>";  
            echo "Alquileres actuales: ". $socio->getNumSoportesAlquilados() . '<br>';
        }
    }

}



?>