# Explicação sobre o Pilar de Abstração

Este exemplo em PHP demonstra como o pilar de **abstração** da programação orientada a objetos (POO) é aplicado, permitindo que a implementação interna de uma classe seja escondida do código externo, e o acesso seja feito apenas através de métodos e comportamentos definidos.

## O que é Abstração?

A **abstração** é um dos pilares da POO que consiste em esconder os detalhes de implementação e expor apenas o essencial. Em outras palavras, ela permite que o usuário de uma classe interaja com ela sem precisar saber como suas funcionalidades são implementadas internamente.

## Fluxo de Abstração no Código

### 1. Definição de Classe Abstrata
A classe `Cachorro` é uma **classe abstrata**, o que significa que não podemos criar instâncias diretamente dela. Ela define a **estrutura** e os **métodos essenciais** que todas as subclasses, como `CachorroTreinavel`, devem implementar. No entanto, a implementação de **treinamento** e **execução de comandos** é deixada para as subclasses. A classe abstrata expõe apenas os **métodos públicos** como `alimentar()` e `estaComFome()` para que o código externo possa interagir com o objeto sem precisar saber os detalhes da implementação.

### 2. Interação com os Métodos Públicos
Ao criar um objeto da classe `CachorroTreinavel`, o código externo interage com o objeto sem precisar saber como o treinamento é armazenado ou como a execução de comandos funciona internamente.

```php
$rex = new CachorroTreinavel("Rex", 2);
$rex->treinar(); // O código externo apenas chama o método sem saber como o treinamento é feito
echo $rex->executarComando("Sentar") . PHP_EOL; // O código externo não precisa saber o nível de treinamento do cachorro
```

O código externo apenas chama o método `treinar()` para treinar o cachorro e o método `executarComando()` para pedir a execução de um comando, mas não tem acesso ao código que realmente implementa o **nível de treinamento** ou como o comando é processado internamente.

### 3. Abstração de Implementação Detalhada
- **Treinamento**: O método `treinar()` aumenta o nível de treinamento e diminui a comida do cachorro. O código externo não precisa saber como o nível de treinamento é armazenado ou como a comida é alterada.
- **Execução de Comando**: O método `executarComando()` executa um comando, mas a lógica de como ele verifica se o cachorro foi treinado e se tem comida é escondida dentro da classe.

### 4. Como a Abstração Protege o Código?
A abstração permite que o código externo interaja com o objeto sem se preocupar com os **detalhes de implementação**. Isso torna o código mais limpo, modular e mais fácil de entender, pois o foco está apenas no comportamento do objeto e nas ações que ele pode executar, sem se preocupar com como essas ações são implementadas internamente.

## Conclusão

A **abstração** é um mecanismo poderoso que permite ocultar os detalhes internos de uma classe e expor apenas os comportamentos essenciais. No exemplo acima, a classe abstrata `Cachorro` define um contrato para as subclasses, enquanto a implementação específica de treinamento e execução de comandos fica dentro da classe `CachorroTreinavel`. O código externo interage com o objeto através de métodos públicos, sem se preocupar com os detalhes de como essas operações são realizadas internamente.
```
