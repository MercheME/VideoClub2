

<?php

require_once "./Resumible.php"; 
 abstract class Soporte implements Resumible {
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

    public function muestraResumen(): void{
        echo "<br><em>{$this->titulo}</em>";
        echo "<br>" . number_format($this->getPrecio(), 2) . " € (IVA no incluido)<br>";
    }

 }

?>