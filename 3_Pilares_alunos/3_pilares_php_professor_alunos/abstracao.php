<?php

// A classe abstrata Cachorro define a estrutura base de um cachorro.
// Ela garante que todas as subclasses tenham os mesmos métodos essenciais, 
// mas sem especificar a implementação detalhada de treinamento e execução de comandos.


// 1ª Digitação (Aqui)


    // Método concreto que permite alimentar o cachorro sem expor como a comida é armazenada

    // Em PHP, void é um tipo de retorno que indica que a função não retorna nenhum valor.
    // public function alimentar(int $quantidade): Define um método público chamado alimentar que recebe um parâmetro do tipo inteiro (int $quantidade).
    // : void: Indica que essa função não retorna nada. Ela apenas executa uma ação (aumenta a comida do cachorro) e encerra.


    // 2ª Digitação (Aqui)


    // Método concreto que verifica se o cachorro está com fome
    // O código externo não precisa saber como essa verificação é feita internamente


    // 3ª Digitação (Aqui)


    // Métodos abstratos: obrigam qualquer subclasse a definir sua própria lógica de treinamento e execução de comandos


    // 4ª Digitação (Aqui)


// Classe CachorroTreinavel que herda de Cachorro e implementa os métodos abstratos


// 5ª Digitação (Aqui)


    // Implementação do método de treinamento
    // O código externo apenas chama esse método sem saber como o nível de treinamento é armazenado


    // 6ª Digitação (Aqui)


    // Implementação do método de execução de comandos
    // O código externo só pede para executar um comando, sem precisar saber se o cachorro está treinado ou não


    // 7ª Digitação (Aqui)


// Criando um cachorro treinável chamado Rex
// O código externo apenas interage com os métodos públicos, sem conhecer a implementação interna


// 8ª Digitação (Aqui)


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
