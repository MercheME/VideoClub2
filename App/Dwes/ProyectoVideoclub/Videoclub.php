<?php
namespace App\Dwes\ProyectoVideoclub;

use App\Dwes\ProyectoVideoclub\Juego;
use App\Dwes\ProyectoVideoclub\Cliente;
use App\Dwes\ProyectoVideoclub\Dvd;
use App\Dwes\ProyectoVideoclub\CintaVideo;

use App\Dwes\ProyectoVideoclub\Util\ClienteNoEncontradoException;
use App\Dwes\ProyectoVideoclub\Util\CupoSuperadoException;
use App\Dwes\ProyectoVideoclub\Util\SoporteYaAlquiladoException;
use App\Dwes\ProyectoVideoclub\Util\SoporteNoEncontradoException;


include_once __DIR__ . "/Cliente.php";
include_once __DIR__ . "/Dvd.php";
include_once __DIR__ . "/CintaVideo.php";
include_once __DIR__ . "/Juego.php";

class Videoclub {
    private $nombre;
    private $productos = [];
    private $numProductos = 0;
    private $socios = [];
    private $numSocios = 0;
    private $numProductosAlquilados = 0; 
    private $numTotalAlquileres = 0; 


    public function __construct( $nombre ) {}

    private function incluirProducto(Soporte $producto) {
        $this->productos[] = $producto;
        $this->numProductos++;
        echo "Incluido soporte " . ($this->numProductos - 1) . "<br>";
    }

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

    public function alquilarSocioProducto(int $numeroCliente, int $numeroSoporte): self {
        try {
            $socioAlquilar = null;
            foreach ($this->socios as $socio) {
                if ($socio->getNumero() == $numeroCliente) {
                    $socioAlquilar = $socio;
                    break;
                }
            }

            if ($socioAlquilar === null) {
                throw new ClienteNoEncontradoException("Cliente con número {$numeroCliente} no encontrado.");
            }

            $productoAlquilar = null;
            foreach ($this->productos as $producto) {
                if ($producto->getNumero() == $numeroSoporte) {
                    $productoAlquilar = $producto;
                    break;
                }
            }

            if ($productoAlquilar === null) {
                throw new SoporteNoEncontradoException("Soporte con número {$numeroSoporte} no encontrado.");
            }
    
            $socioAlquilar->alquilar($productoAlquilar);

            $this->numTotalAlquileres++;

            // Incrementamos productos alquilados si no estaba ya alquilado
            if (!$productoAlquilar->estaAlquilado()) {
                $this->numProductosAlquilados++;
            }

            } catch (ClienteNoEncontradoException $e) {
                echo "Error: " . $e->getMessage() . "<br>";
        
            } catch (SoporteNoEncontradoException $e) {
                echo "Error: " . $e->getMessage() . "<br>";
        
            } catch (SoporteYaAlquiladoException $e) {
                echo "Error: " . $e->getMessage() . "<br>";
        
            } catch (CupoSuperadoException $e) {
                echo "Error: " . $e->getMessage() . "<br>";
        
            } catch (\Exception $e) {
                echo "Error inesperado: " . $e->getMessage() . "<br>";
            }
        
            return $this;
    }


    public function alquilarSocioProductos(int $numeroCliente, array $numerosProductos): self {
        try {
            // Buscar el socio por su número
            $socioAlquilar = null;
            foreach ($this->socios as $socio) {
                if ($socio->getNumero() == $numeroCliente) {
                    $socioAlquilar = $socio;
                    break;
                }
            }

            if ($socioAlquilar === null) {
                throw new ClienteNoEncontradoException("Cliente con número {$numeroCliente} no encontrado.");
            }

            // Comprobar disponibilidad de todos los productos
            $productosAlquilar = [];
            foreach ($numerosProductos as $numeroSoporte) {
                $productoAlquilar = null;
                foreach ($this->productos as $producto) {
                    if ($producto->getNumero() == $numeroSoporte) {
                        $productoAlquilar = $producto;
                        break;
                    }
                }

                if ($productoAlquilar === null) {
                    throw new SoporteNoEncontradoException("Soporte con número {$numeroSoporte} no encontrado.");
                }

                // Verificar si el soporte ya está alquilado
                if ($productoAlquilar->estaAlquilado()) {
                    throw new SoporteYaAlquiladoException("El soporte con número {$numeroSoporte} ya está alquilado.");
                }

                $productosAlquilar[] = $productoAlquilar;
            }

            // Si todos los productos están disponibles, ppodemos alquilarlos
            foreach ($productosAlquilar as $producto) {
                $socioAlquilar->alquilar($producto);
                $this->numTotalAlquileres++;

                // Incrementamos productos alquilados si no estaba ya alquilado
                if (!$producto->estaAlquilado()) {
                    $this->numProductosAlquilados++;
                }
            }

        } catch (ClienteNoEncontradoException $e) {
            echo "Error: " . $e->getMessage() . "<br>";
        
        } catch (SoporteNoEncontradoException $e) {
            echo "Error: " . $e->getMessage() . "<br>";
        
        } catch (SoporteYaAlquiladoException $e) {
            echo "Error: " . $e->getMessage() . "<br>";
        
        } catch (CupoSuperadoException $e) {
            echo "Error: " . $e->getMessage() . "<br>";
        
        } catch (\Exception $e) {
            echo "Error inesperado: " . $e->getMessage() . "<br>";
        }

        return $this;
    }


    public function listarSocios(): void {
        echo "<br>Listado de " . count($this->socios) . " socios del videoclub:<br>";
        foreach ($this->socios as $index => $socio) {
            echo ($index + 1) . ".- Cliente " . ($socio->getNumero()) . ": " . $socio->nombre . "<br>";  
            echo "Alquileres actuales: ". $socio->getNumSoportesAlquilados() . '<br>';
        }
    }

    public function getNumProductosAlquilados(): int {
        return $this->numProductosAlquilados;
    }

    
    public function getNumTotalAlquileres(): int {
        return $this->numTotalAlquileres;
    }

    public function devolverSocioProducto(int $numSocio, int $numeroProducto): self {
        try {

            $socio = null;
            foreach ($this->socios as $s) {
                if ($s->getNumero() == $numSocio) {
                    $socio = $s;
                    break;
                }
            }

            if ($socio === null) {
                throw new ClienteNoEncontradoException("Cliente con número {$numSocio} no encontrado.");
            }

            $productoDevolver = null;
            foreach ($this->productos as $producto) {
                if ($producto->getNumero() == $numeroProducto) {
                    $productoDevolver = $producto;
                    break;
                }
            }

            if ($productoDevolver === null) {
                throw new SoporteNoEncontradoException("Producto con número {$numeroProducto} no encontrado.");
            }


            if (!$socio->tieneAlquilado($productoDevolver)) {
                throw new \Exception("El socio no tiene alquilado el producto con número {$numeroProducto}.");
            }

            $socio->devolver($productoDevolver->getNumero());
            $this->numProductosAlquilados--; 

        } catch (ClienteNoEncontradoException $e) {
            echo "Error: " . $e->getMessage() . "<br>";
        
        } catch (SoporteNoEncontradoException $e) {
            echo "Error: " . $e->getMessage() . "<br>";
        
        } catch (\Exception $e) {
            echo "Error inesperado: " . $e->getMessage() . "<br>";
        }

        return $this;  
    }

    public function devolverSocioProductos(int $numSocio, array $numerosProductos): self {
        try {
            
            $socio = null;
            foreach ($this->socios as $s) {
                if ($s->getNumero() == $numSocio) {
                    $socio = $s;
                    break;
                }
            }

            if ($socio === null) {
                throw new ClienteNoEncontradoException("Cliente con número {$numSocio} no encontrado.");
            }
            
            foreach ($numerosProductos as $numeroProducto) {
                $productoDevolver = null;
                foreach ($this->productos as $producto) {
                    if ($producto->getNumero() == $numeroProducto) {
                        $productoDevolver = $producto;
                        break;
                    }
                }

                if ($productoDevolver === null) {
                    echo "Producto con número {$numeroProducto} no encontrado.<br>";
                    continue;
                }
                
                if (!$socio->tieneAlquilado($productoDevolver)) {
                    echo "El socio no tiene alquilado el producto con número {$numeroProducto}.<br>";
                    continue;
                }
                
                $socio->devolver($productoDevolver->getNumero());
                $this->numProductosAlquilados--; 
            }

        } catch (ClienteNoEncontradoException $e) {
            echo "Error: " . $e->getMessage() . "<br>";
        
        } catch (\Exception $e) {
            echo "Error inesperado: " . $e->getMessage() . "<br>";
        }

        return $this; 
    }
}



