### Descritivo do Exercício Prático: Combinando Conceitos

**Objetivo:**
Neste exercício, você irá aplicar e combinar os conceitos de **funções**, **arrays associativos**, **loops**, **condicionais** e **formatação de números** para calcular a média de notas de uma turma e exibir o status de cada aluno de forma dinâmica.

**Instruções:**

1. **Função para Calcular a Média de Notas**:
    - Crie uma função chamada `calcularMediaNotas()` que recebe um array de notas e calcula a média dessas notas.
    - A função deve retornar a média de todas as notas fornecidas. Para isso, você deverá somar todas as notas e depois dividir pelo número total de notas.

2. **Array de Alunos**:
    - Crie um array associativo chamado `$turma` que contém informações de vários alunos.
    - Cada aluno deve ser representado por um array que inclui:
      - O nome do aluno (uma string).
      - Um array de notas (com 3 notas para cada aluno).

3. **Exibindo o Boletim da Turma**:
    - Para cada aluno na turma, calcule a média das notas usando a função `calcularMediaNotas()`.
    - Exiba o nome do aluno, a média calculada e o status do aluno de acordo com a média:
      - **Excelente**: Se a média for igual ou superior a 9.0.
      - **Aprovado**: Se a média for igual ou superior a 7.0, mas menor que 9.0.
      - **Recuperação**: Se a média for igual ou superior a 6.0, mas menor que 7.0.
      - **Reprovado**: Se a média for inferior a 6.0.

4. **Formatação**:
    - Ao exibir a média do aluno, utilize a função `number_format()` para exibir a média com uma casa decimal e usando vírgula como separador decimal.

5. **Cores para Status**:
    - Use cores diferentes para mostrar o status do aluno:
      - Azul para "Excelente".
      - Verde para "Aprovado".
      - Laranja para "Recuperação".
      - Vermelho para "Reprovado".

**Dicas**:
- Lembre-se de que você deve usar **laços de repetição (foreach)** para iterar sobre os alunos e calcular a média de notas.
- Para verificar o status do aluno, você pode usar estruturas **if-else**.
- Certifique-se de que a formatação de números seja feita corretamente usando `number_format()`.

**Exemplo de saída esperada:**

```
Boletim da Turma
Aluno(a): Ana Silva - Média: 8,3 - Aprovado
Aluno(a): Pedro Santos - Média: 7,3 - Aprovado
Aluno(a): Maria Oliveira - Média: 9,5 - Excelente
Aluno(a): João Costa - Média: 6,5 - Recuperação
Aluno(a): Lucia Pereira - Média: 7,3 - Aprovado
```

**Entrega**:
- Implemente o código conforme as instruções e garanta que os resultados sejam exibidos conforme o formato descrito.
- Realize os testes para garantir que todas as médias e os status estão sendo calculados e exibidos corretamente.