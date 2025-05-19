<?php

// A classe abstrata Cachorro define a estrutura base de um cachorro.
// Ela garante que todas as subclasses tenham os mesmos métodos essenciais, 
// mas sem especificar a implementação detalhada de treinamento e execução de comandos.
abstract class Cachorro {
    protected string $nome; // Nome do cachorro
    protected int $comida; // Quantidade de comida disponível

    // O construtor inicializa o nome e a quantidade de comida do cachorro
    public function __construct(string $nome, int $comida) {
        $this->nome = $nome;
        $this->comida = $comida;
    }

    // Método concreto que permite alimentar o cachorro sem expor como a comida é armazenada

    // Em PHP, void é um tipo de retorno que indica que a função não retorna nenhum valor.
    // public function alimentar(int $quantidade): Define um método público chamado alimentar que recebe um parâmetro do tipo inteiro (int $quantidade).
    // : void: Indica que essa função não retorna nada. Ela apenas executa uma ação (aumenta a comida do cachorro) e encerra.

    public function alimentar(int $quantidade): void {
        $this->comida += $quantidade;
    }

    // Método concreto que verifica se o cachorro está com fome
    // O código externo não precisa saber como essa verificação é feita internamente
    public function estaComFome(): bool {
        return $this->comida <= 0;
    }

    // Métodos abstratos: obrigam qualquer subclasse a definir sua própria lógica de treinamento e execução de comandos
    abstract public function treinar(): void;
    abstract public function executarComando(string $comando): string;
}

// Classe CachorroTreinavel que herda de Cachorro e implementa os métodos abstratos
class CachorroTreinavel extends Cachorro {
    private int $nivelTreinamento = 0; // Indica o nível de treinamento do cachorro

    // Implementação do método de treinamento
    // O código externo apenas chama esse método sem saber como o nível de treinamento é armazenado
    public function treinar(): void {
        if (!$this->estaComFome()) { // O cachorro só treina se não estiver com fome
            $this->nivelTreinamento++; // Aumenta o nível de treinamento
            $this->comida--; // Treinar consome comida (energia)
        }
    }

    // Implementação do método de execução de comandos
    // O código externo só pede para executar um comando, sem precisar saber se o cachorro está treinado ou não
    public function executarComando(string $comando): string {
        return $this->estaComFome() ? "{$this->nome} está com fome!" :
            ($this->nivelTreinamento > 0 ? "{$this->nome} executou: {$comando}" : "{$this->nome} não foi treinado!");
    }
}

// Criando um cachorro treinável chamado Rex
// O código externo apenas interage com os métodos públicos, sem conhecer a implementação interna
$rex = new CachorroTreinavel("Rex", 2);

// Treina o cachorro sem saber como o nível de treinamento é armazenado internamente
$rex->treinar();

// Pede para executar um comando sem precisar saber os detalhes da lógica interna

// PHP_EOL é uma constante predefinida do PHP que representa a quebra de linha do sistema operacional em que o código está sendo executado

// Por que usar PHP_EOL?
// Diferentes sistemas operacionais usam diferentes caracteres para representar a quebra de linha:
// Windows: \r\n
// Linux/macOS: \n
// Usar PHP_EOL torna o código mais portável, garantindo que a saída tenha a quebra de linha correta em qualquer sistema operacional.

echo $rex->executarComando("Sentar") . PHP_EOL;

?>