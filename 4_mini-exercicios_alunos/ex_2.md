# 🚗 Exercício: Sistema de Locadora de Veículos

## 📖 Enunciado

Crie um sistema de locadora de veículos utilizando **Programação Orientada a Objetos (POO)**. O sistema deve permitir o gerenciamento de veículos disponíveis para aluguel e calcular o valor da locação.

---

## 📌 Requisitos

### **1. Criar uma classe abstrata `Veiculo` com:**
- **Propriedades:**  
  - `modelo` (string) → Nome do modelo do veículo.  
  - `placa` (string) → Placa do veículo.  
  - `disponivel` (boolean) → Indica se o veículo está disponível para aluguel.  
- **Método abstrato:**  
  - `calcularAluguel(int $dias): float` → Calcula o valor total da locação com base na quantidade de dias.  
- **Métodos auxiliares:**  
  - `isDisponivel()` → Retorna se o veículo está disponível.  
  - `getModelo()` → Retorna o modelo do veículo.  
  - `alugar()` → Realiza o aluguel do veículo, se disponível.  
  - `devolver()` → Realiza a devolução do veículo, se alugado.

### **2. Criar duas classes concretas que herdam de `Veiculo`:**
- **`Carro`** → Tarifa de **R$100 por dia**.  
- **`Moto`** → Tarifa de **R$50 por dia**.  

Cada uma dessas classes deve implementar o método `calcularAluguel()`, garantindo que o valor seja calculado corretamente com base nos dias de locação.

### **3. Criar uma classe `Locadora` que será responsável por gerenciar os veículos:**
- Deve armazenar os veículos da locadora em um array.
- Deve possuir métodos para:
  - `adicionarVeiculo(Veiculo $veiculo)`: Adiciona um veículo ao sistema.  
  - `alugarVeiculo(string $modelo)`: Realiza o aluguel de um veículo pelo modelo.  
  - `devolverVeiculo(string $modelo)`: Realiza a devolução do veículo pelo modelo.  

---

## 🎯 Testes e Simulação

Crie um código que:
1. Instancia um objeto da classe `Locadora`.
2. Cria pelo menos um `Carro` e uma `Moto`.
3. Adiciona esses veículos à locadora.
4. Realiza o aluguel dos veículos.
5. Realiza a devolução de um dos veículos.
6. Calcula e exibe o valor do aluguel para **3 dias**.

---

### 🔍 Saída esperada
Implemente um código que produza exatamente as seguintes saídas no console:
```
Veículo 'HB20' adicionado ao acervo.
Veículo 'Yamaha XTZ' adicionado ao acervo.

Carro 'HB20' alugado com sucesso!
Moto 'Yamaha XTZ' alugada com sucesso!

Carro 'HB20' devolvido com sucesso!

Valor do aluguel do carro por 3 dias: R$300.00
Valor do aluguel da moto por 3 dias: R$150.00
```
