<?php
namespace App\Dwes\ProyectoVideoclub;

use App\Dwes\ProyectoVideoclub\Util\SoporteYaAlquiladoException;

include_once __DIR__ . "/Resumible.php";

 abstract class Soporte implements Resumible {

    public $alquilado = false;

    private const IVA = 0.21;
    public function __construct(
        public string $titulo,
        protected int $numero,
        private float $precio,
    ) {}

    public function getPrecio(): float {
        return $this->precio;
    }

    public function getPrecioConIva(): string {
        return number_format($this->precio * (1 + self::IVA), 2);
        
    }


    public function getNumero(): int {
        return $this->numero;
    }

     
    public function alquilar(): void {
        if ($this->alquilado) {
            throw new SoporteYaAlquiladoException("El soporte ya está alquilado.");
        }
        $this->alquilado = true;
    }

    
    public function devolver(): void {
        if (!$this->alquilado) {
            throw new \Exception("El soporte no está alquilado.");
        }
        $this->alquilado = false;
    }

    public function estaAlquilado(): bool {
        return $this->alquilado;
    }

    public function muestraResumen(): void{
        echo "<br><em>{$this->titulo}</em>";
        echo "<br>" . number_format($this->getPrecio(), 2) . " € (IVA no incluido)<br>";
    }

 }

