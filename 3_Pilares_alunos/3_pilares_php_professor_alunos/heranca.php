<?php

// Classe base Animal
class Animal {
    protected string $nome;

    // Construtor inicializa o nome
    public function __construct(string $nome) {
        $this->nome = $nome;
    }

    // Método que retorna o nome do animal
    public function getNome(): string {
        return $this->nome;
    }

    // Método que deve ser implementado pelas subclasses
    public function fazerSom(): string {
        return "Som genérico";
    }
}

// Classe Cachorro herda de Animal
// A classe Cachorro "herda" as propriedades e métodos da classe Animal.
class Cachorro extends Animal {
    
    // Construtor da classe Cachorro chama o construtor da classe Animal passando o nome
    public function __construct(string $nome) {
        parent::__construct($nome); // Chama o construtor da classe Animal
    }

    // Método que sobrescreve o método da classe base
    public function fazerSom(): string {
        return "Au au!";
    }
}

// Criando um objeto da classe Cachorro
$cachorro = new Cachorro("Rex"); // Passando o nome "Rex" para o construtor

// Acessando métodos herdados da classe Animal
echo $cachorro->getNome() . PHP_EOL;      // Exibe o nome herdado da classe Animal
echo $cachorro->fazerSom() . PHP_EOL;     // Exibe o som específico do cachorro, sobrescrito na classe Cachorro

?>
