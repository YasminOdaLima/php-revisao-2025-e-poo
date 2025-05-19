<?php

// Classe abstrata base
abstract class ItemBiblioteca {
    protected string $titulo;
    protected string $codigo;
    protected bool $disponivel;

    // Inicialização com método Construtor 
    public function __construct(string $titulo, string $codigo) {
        $this->titulo = $titulo;
        $this->codigo = $codigo;
        $this->disponivel = true;
    }

    // Método abstrato (Não implementado agora) 
    abstract public function calcularMulta(int $diasAtraso): float;

    public function emprestar(): void {
        if ($this->disponivel) {
            $this->disponivel = false;
            echo get_class($this) . " '{$this->titulo}' emprestado com sucesso!<br>";
        } else {
            echo get_class($this) . " '{$this->titulo}' não está disponível para empréstimo.<br>";
        }
    }

    public function devolver(): void {
        if (!$this->disponivel) {
            $this->disponivel = true;
            echo get_class($this) . " '{$this->titulo}' devolvido com sucesso!<br>";
        } else {
            echo get_class($this) . " '{$this->titulo}' já está disponível.<br>";
        }
    }

    public function estaDisponivel(): bool {
        return $this->disponivel;
    }

    public function getTitulo(): string {
        return $this->titulo;
    }
}

class Livro extends ItemBiblioteca {
    public function calcularMulta(int $diasAtraso): float {
        return $diasAtraso * 0.50;
    }
}

class Revista extends ItemBiblioteca {
    public function calcularMulta(int $diasAtraso): float {
        return $diasAtraso * 0.25;
    }
}

class Biblioteca {
    private array $itens = [];

    public function adicionarItem(ItemBiblioteca $item): void {
        $this->itens[$item->getTitulo()] = $item;
        echo "Item '{$item->getTitulo()}' adicionado ao acervo.<br>";
    }

    public function emprestarItem(string $titulo): void {
        if (isset($this->itens[$titulo])) {
            $this->itens[$titulo]->emprestar();
        } else {
            echo "Item '{$titulo}' não encontrado na biblioteca.<br>";
        }
    }

    public function devolverItem(string $titulo): void {
        if (isset($this->itens[$titulo])) {
            $this->itens[$titulo]->devolver();
        } else {
            echo "Item '{$titulo}' não encontrado na biblioteca.<br>";
        }
    }

    public function calcularMulta(string $titulo, int $diasAtraso): float {
        if (isset($this->itens[$titulo])) {
            return $this->itens[$titulo]->calcularMulta($diasAtraso);
        } else {
            echo "Item '{$titulo}' não encontrado para cálculo de multa.<br>";
            return 0.0;
        }
    }
}

// =========
// Testes 
// =========

$biblioteca = new Biblioteca();

$livro = new Livro("Python para Iniciantes", "L001");
$revista = new Revista("TechNews", "R001");

$biblioteca->adicionarItem($livro);
$biblioteca->adicionarItem($revista);

echo "<br>";

$biblioteca->emprestarItem("Python para Iniciantes");
$biblioteca->emprestarItem("TechNews");

echo "<br>";

$biblioteca->devolverItem("Python para Iniciantes");

echo "<br>";

$multaLivro = $biblioteca->calcularMulta("Python para Iniciantes", 5);
$multaRevista = $biblioteca->calcularMulta("TechNews", 5);

echo "Multa do livro (5 dias): R$" . number_format($multaLivro, 2, ',', '.') . "<br>";
echo "Multa da revista (5 dias): R$" . number_format($multaRevista, 2, ',', '.') . "<br>";

?>
