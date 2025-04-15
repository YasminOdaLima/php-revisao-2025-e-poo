# Explicação sobre o Pilar de Encapsulamento

Este exemplo em PHP demonstra como o pilar de **encapsulamento** da programação orientada a objetos (POO) é aplicado para proteger os dados e controlar o acesso aos atributos de um objeto.

## O que é Encapsulamento?

O **encapsulamento** é um dos pilares da programação orientada a objetos (POO) que visa esconder os **detalhes internos** de uma classe e expor apenas o que é necessário para o código externo interagir com o objeto. Isso garante que a **lógica interna** da classe seja protegida de mudanças externas e evita que os atributos sejam manipulados diretamente, proporcionando um controle mais seguro sobre os dados e comportamentos do objeto.

## Fluxo do Encapsulamento no Código

### 1. Criação do Objeto
```php
$cachorro = new Cachorro("Rex", 3, false);
```
- Ao criar o objeto `Cachorro`, os atributos como `nome`, `comida` e `sono` são **privados**. Isso significa que não podemos acessar diretamente `$cachorro->nome` ou `$cachorro->comida` de fora da classe. O acesso a esses atributos é feito através de **métodos públicos**.

### 2. Acessando o Nome
```php
echo $cachorro->getNome() . PHP_EOL;
```
- O método `getNome()` é um **método getter** que permite acessar o valor do nome de forma controlada, sem expor diretamente o atributo `$nome`.
- O encapsulamento impede que o nome seja modificado ou acessado de forma não controlada, garantindo que o código externo só tenha acesso ao nome através de métodos seguros.

### 3. Alterando a Quantidade de Comida (Com Validação)
```php
$cachorro->setComida(5);
```
- O método `setComida()` é um **método setter** que permite alterar o valor da comida, mas **apenas após validar** se o novo valor é válido (ou seja, se o valor não é negativo).
- Isso impede que a comida seja alterada para um valor inválido, garantindo a **integridade dos dados** do objeto.

### 4. Comportamento de Comer
```php
echo $cachorro->comer() . PHP_EOL;
```
- O método `comer()` define o comportamento de "comer" do cachorro. 
- O **encapsulamento** oculta a lógica de como o estado da comida é alterado (diminuindo o valor de `$comida`). O código externo apenas chama o método `comer()`, sem precisar se preocupar com como a comida é controlada internamente.
- Se o cachorro tem comida, o valor de `$comida` é reduzido e uma mensagem é retornada. Se não tiver comida, o método retorna uma mensagem informando que ele está sem comida.

## Como o Encapsulamento Protege o Objeto?

1. **Protege a integridade dos dados**:  
   O uso de **métodos setters** com validação (como `setComida()`) impede que os dados internos do objeto sejam alterados de maneira errada. Por exemplo, a comida não pode ser configurada com um valor negativo.

2. **Acesso controlado**:  
   O código externo não pode acessar diretamente os atributos privados. Em vez disso, ele deve usar os **métodos públicos** da classe para interagir com o objeto, garantindo que o acesso aos dados seja feito de maneira controlada.

3. **Facilidade de manutenção e segurança**:  
   O código externo não precisa saber como os atributos estão armazenados ou como o comportamento é implementado internamente. Se você precisar alterar a forma como a comida ou o sono são tratados, pode fazer isso dentro da classe sem afetar o código externo.

## Conclusão

O **encapsulamento** ajuda a proteger os dados de um objeto, controla como os dados são acessados e modificados, e encapsula a lógica de comportamento do objeto, tornando o código mais seguro e mais fácil de manter. Com o encapsulamento, você garante que o estado interno do objeto seja alterado apenas de formas seguras e predefinidas.
```
