# Exercício Prático de POO

## Mini Projeto: Sistema de Biblioteca

### 📚 Enunciado:

Crie um sistema simples de biblioteca usando Programação Orientada a Objetos (POO). O sistema deve permitir a gestão de itens de biblioteca e controlar empréstimos e devoluções. Para isso, siga os seguintes passos:

### 1. Criar uma classe abstrata `ItemBiblioteca` com:
- **Propriedades:** `titulo` (string), `codigo` (string) e `disponivel` (boolean).
- **Método abstrato:** `calcular_multa(dias_atraso: int) -> float` que deve calcular a multa com base nos dias de atraso na devolução.
- **Métodos auxiliares:**
  - `emprestar()`: Responsável por realizar o empréstimo de um item.
  - `devolver()`: Responsável por registrar a devolução do item.
  - `disponivel()`: Retorna se o item está disponível.
  - `titulo()`: Retorna o título do item.

### 2. Criar duas classes concretas que herdam de `ItemBiblioteca`:
- **`Livro`**: Possui multa de **R$0,50 por dia de atraso**.
- **`Revista`**: Possui multa de **R$0,25 por dia de atraso**.

Cada uma dessas classes deve implementar o método `calcular_multa(dias_atraso: int) -> float` e herdar os métodos `emprestar()` e `devolver()` de `ItemBiblioteca`.

### 3. Criar uma classe `Biblioteca` que será responsável por gerenciar os itens:
- Deve armazenar os itens da biblioteca em um dicionário.
- Deve possuir métodos para adicionar um item, emprestar um item e devolver um item com base no título.

### 4. Testes e Simulação
Crie um código que:
1. Instancia um objeto da classe `Biblioteca`.
2. Cria pelo menos um `Livro` e uma `Revista`.
3. Adiciona esses itens à biblioteca.
4. Realiza o empréstimo dos itens.
5. Realiza a devolução de um dos itens.
6. Calcula e exibe o valor da multa para 5 dias de atraso.

### 🔍 Saída esperada
Implemente um código que produza exatamente as seguintes saídas no console:
```
Item 'Python para Iniciantes' adicionado ao acervo.
Item 'TechNews' adicionado ao acervo.

Livro 'Python para Iniciantes' emprestado com sucesso!
Revista 'TechNews' emprestada com sucesso!

Livro 'Python para Iniciantes' devolvido com sucesso!

Multa do livro (5 dias): R$2.50
Multa da revista (5 dias): R$1.25
```

---
**Obs.:** Certifique-se de utilizar boas práticas de POO, como encapsulamento, herança e polimorfismo ao desenvolver sua solução.
