<?php

class Cachorro {
    // Os atributos são privados, impedindo acesso direto de fora da classe.
    private string $nome;
    private int $comida;
    private bool $sono;
    
    // O construtor inicializa os atributos, mas mantém o controle sobre como são definidos.
    public function __construct(string $nome, int $comida, bool $sono) {
        $this->nome = $nome;
        $this->comida = $comida;
        $this->sono = $sono;
    }

    // Como o encapsulamento está sendo aplicado?
    // 1. Métodos "getter" permitem acessar os valores sem expor diretamente os atributos.
    public function getNome(): string {
        return $this->nome;
    }

    public function getComida(): int {
        return $this->comida;
    }

    public function getSono(): bool {
        return $this->sono;
    }

    // 2. Métodos "setter" controlam as modificações, garantindo regras de segurança.
    public function setComida(int $valor): void {
        if ($valor >= 0) {  // Validação encapsulada impede valores negativos.
            $this->comida = $valor;
        }
    }

    public function setSono(bool $valor): void {
        $this->sono = $valor;
    }

    // 3. Encapsulamento do comportamento: 
    // O método "comer" permite modificar o estado do objeto sem expor a lógica interna.
    public function comer(): string {
        if ($this->comida > 0) {
            $this->comida--; // A comida é reduzida de forma segura, sem acesso direto ao atributo.
            return "{$this->nome} comeu!";
        }
        return "{$this->nome} está sem comida!";
    }
}

// Exemplo de uso do encapsulamento
$cachorro = new Cachorro("Rex", 3, false);

// O nome é acessado de forma controlada, sem expor diretamente o atributo.
echo $cachorro->getNome(). PHP_EOL;

// A comida é alterada através do setter, garantindo controle sobre a modificação.
$cachorro->setComida(5);

// O cachorro come, modificando seu estado interno sem acesso direto aos atributos.
echo $cachorro->comer() . PHP_EOL;

?>