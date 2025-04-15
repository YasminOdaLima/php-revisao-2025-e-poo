# Explicação sobre Herança em PHP

## Como a Herança Está Sendo Aplicada

### 1. **Classe Base - `Animal`**
A classe `Animal` é a **classe base**. Ela define:
- Uma propriedade protegida `nome`, que será compartilhada pelas classes filhas.
- O **construtor** `__construct`, que inicializa o nome.
- O método `getNome()`, que retorna o nome do animal.
- O método `fazerSom()`, que tem uma implementação genérica (retorna "Som genérico"), mas pode ser sobrescrito nas classes filhas.

### 2. **Classe `Cachorro` - Herança de `Animal`**
A classe `Cachorro` **herda** de `Animal`, o que significa que ela possui todas as propriedades e métodos da classe `Animal`, como `getNome()` e `fazerSom()`. Contudo:
- **Sobrescreve** o método `fazerSom()`, fornecendo uma implementação específica para cachorros (retornando "Au au!").
- No construtor da classe `Cachorro`, usa `parent::__construct($nome)` para chamar o construtor da classe base `Animal` e inicializar o nome do cachorro.

### 3. **Fluxo do Código**
1. **Instanciação de `Cachorro`**: Ao criar um novo objeto `Cachorro` com `$cachorro = new Cachorro("Rex");`, o construtor da classe `Cachorro` é chamado. Ele, por sua vez, chama o construtor da classe base `Animal` através de `parent::__construct($nome);`. Isso garante que a propriedade `nome` seja inicializada corretamente.

2. **Acesso aos Métodos Herdados**:
   - O método `getNome()` é chamado em `$cachorro->getNome()`, que retorna o nome do cachorro. Como o método `getNome()` é herdado diretamente de `Animal`, ele funciona sem modificações.
   - O método `fazerSom()` é chamado em `$cachorro->fazerSom()`. A diferença é que, apesar de a classe `Cachorro` herdar esse método, ela **sobrescreve** o comportamento. Em vez de retornar o som genérico definido na classe `Animal`, a classe `Cachorro` retorna "Au au!", específico para cachorros.

### 4. **Benefícios da Herança**
A herança permite que a classe `Cachorro` reutilize o código da classe base `Animal`, evitando a duplicação de propriedades e métodos. Ela também permite que a classe `Cachorro` personalize certos comportamentos (como o som que faz) enquanto herda funcionalidades gerais (como o nome e o método `getNome()`).

### Fluxo Exemplo
1. **Instanciação**: 
   - O objeto `$cachorro` é instanciado com o nome "Rex", passando o parâmetro para o construtor da classe `Cachorro`.
   
2. **Chamada ao `getNome()`**: 
   - O método `getNome()` é chamado para acessar o nome "Rex". Esse método é herdado diretamente de `Animal`.
   
3. **Chamada ao `fazerSom()`**: 
   - O método `fazerSom()` é chamado, mas como ele foi sobrescrito na classe `Cachorro`, retorna "Au au!", e não "Som genérico".

## Conclusão
A **herança** permite que a classe `Cachorro` utilize métodos e propriedades da classe base `Animal`, mas também forneça implementações específicas para comportamentos como o som. A herança ajuda a organizar e reutilizar código de forma eficiente, permitindo que novas funcionalidades sejam adicionadas sem a necessidade de reescrever o código existente.
```

