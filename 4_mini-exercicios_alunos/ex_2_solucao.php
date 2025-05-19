<?php

// Classe abstrata Veiculo
abstract class Veiculo {
    protected string $modelo;
    protected string $placa;
    protected bool $disponivel;

    public function __construct(string $modelo, string $placa) {
        $this->modelo = $modelo;
        $this->placa = $placa;
        $this->disponivel = true;
    }

    abstract public function calcularAluguel(int $dias): float;

    public function isDisponivel(): bool {
        return $this->disponivel;
    }

    public function getModelo(): string {
        return $this->modelo;
    }

    public function alugar(): void {
        if ($this->disponivel) {
            $this->disponivel = false;
            echo get_class($this) . " '{$this->modelo}' alugado com sucesso!<br>";
        } else {
            echo get_class($this) . " '{$this->modelo}' não está disponível para aluguel.<br>";
        }
    }

    public function devolver(): void {
        if (!$this->disponivel) {
            $this->disponivel = true;
            echo get_class($this) . " '{$this->modelo}' devolvido com sucesso!<br>";
        } else {
            echo get_class($this) . " '{$this->modelo}' já está disponível.<br>";
        }
    }
}

// Classe concreta Carro
class Carro extends Veiculo {
    public function calcularAluguel(int $dias): float {
        return $dias * 100.00;
    }
}

// Classe concreta Moto
class Moto extends Veiculo {
    public function calcularAluguel(int $dias): float {
        return $dias * 50.00;
    }
}

// Classe Locadora
class Locadora {
    private array $veiculos = [];

    public function adicionarVeiculo(Veiculo $veiculo): void {
        $this->veiculos[$veiculo->getModelo()] = $veiculo;
        echo "Veículo '{$veiculo->getModelo()}' adicionado ao acervo.<br>";
    }

    public function alugarVeiculo(string $modelo): void {
        if (isset($this->veiculos[$modelo])) {
            $this->veiculos[$modelo]->alugar();
        } else {
            echo "Veículo '{$modelo}' não encontrado na locadora.<br>";
        }
    }

    public function devolverVeiculo(string $modelo): void {
        if (isset($this->veiculos[$modelo])) {
            $this->veiculos[$modelo]->devolver();
        } else {
            echo "Veículo '{$modelo}' não encontrado na locadora.<br>";
        }
    }

    public function calcularValorAluguel(string $modelo, int $dias): float {
        if (isset($this->veiculos[$modelo])) {
            return $this->veiculos[$modelo]->calcularAluguel($dias);
        } else {
            echo "Veículo '{$modelo}' não encontrado para cálculo de aluguel.<br>";
            return 0.0;
        }
    }
}

// =========
// Testes 
// =========

$locadora = new Locadora();

$carro = new Carro("HB20", "ABC1234");
$moto = new Moto("Yamaha XTZ", "XYZ5678");

$locadora->adicionarVeiculo($carro);
$locadora->adicionarVeiculo($moto);

echo "<br>";

$locadora->alugarVeiculo("HB20");
$locadora->alugarVeiculo("Yamaha XTZ");

echo "<br>";

$locadora->devolverVeiculo("HB20");

echo "<br>";

$valorCarro = $locadora->calcularValorAluguel("HB20", 3);
$valorMoto = $locadora->calcularValorAluguel("Yamaha XTZ", 3);

echo "Valor do aluguel do carro por 3 dias: R$" . number_format($valorCarro, 2, '.', '') . "<br>";
echo "Valor do aluguel da moto por 3 dias: R$" . number_format($valorMoto, 2, '.', '') . "<br>";

?>
