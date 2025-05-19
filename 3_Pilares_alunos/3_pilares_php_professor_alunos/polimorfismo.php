<?php
// Classe base Animal
abstract class Animal {
    protected string $nome;
    
    public function __construct(string $nome) {
        $this->nome = $nome;
    }

    public function getNome(): string {
        return $this->nome;
    }

    // Método abstrato a ser implementado pelas subclasses
    abstract public function fazerSom(): string;
}

// Subclasse Cachorro
class Cachorro extends Animal {
    public function fazerSom(): string {
        return "Au au!";
    }
}

// Subclasse Gato
class Gato extends Animal {
    public function fazerSom(): string {
        return "Miau!";
    }
}

// Função que aceita qualquer Animal e chama seu método fazerSom
function comunicarAnimal(Animal $animal): void {
    // O polimorfismo permite que a função tratar objetos de diferentes tipos
    // (Cachorro, Gato, ou qualquer outra subclasse de Animal) de forma uniforme.
    // Mesmo que os objetos sejam diferentes, o método 'fazerSom' será chamado corretamente
    // para o tipo específico do objeto passado, ou seja, cada tipo de animal tem seu próprio comportamento.
    echo "{$animal->getNome()} faz: {$animal->fazerSom()}<br>";
}

// Exemplo de uso
$cachorro = new Cachorro("Rex");
$gato = new Gato("Felix");

comunicarAnimal($cachorro); // "Rex faz: Au au!"
comunicarAnimal($gato); // "Felix faz: Miau!"
?>
