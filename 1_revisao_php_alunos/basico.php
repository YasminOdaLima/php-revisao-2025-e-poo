<?php
// Exercício PHP em arquivo único abordando 5 conceitos:
// 1. Variáveis
// 2. Arrays
// 3. Condicionais
// 4. Loops
// 5. Funções

// ---- 1. VARIÁVEIS ----
echo "<h2>1. Variáveis</h2>";

$nome = "Maria";
$idade = 25;
$profissao = "Desenvolvedora";
$salario = 5000.50;
$ativo = true;

echo "Nome: $nome <br>";
echo "Idade: $idade anos <br>";
echo "Profissão: $profissao <br>";
echo "Salário: R$ " . number_format($salario, 2, ',', '.') . "<br>";
echo "Status: " . ($ativo ? "Ativo" : "Inativo") . "<br>";
echo "<br>";
echo "=============================================================================";

// ---- 2. ARRAYS ----
echo "<h2>2. Arrays</h2>";


// Array indexado
$frutas = ["Maçã", "Banana", "Laranja", "Uva", "Morango"];

// Array associativo
$funcionario = [
    "nome" => "João",
    "cargo" => "Analista",
    "departamento" => "TI",
    "salario" => 4500
];

// Array multidimensional
$alunos = [
    ["nome" => "Pedro", "nota" => 8.5],
    ["nome" => "Ana", "nota" => 9.0],
    ["nome" => "Carlos", "nota" => 7.5]
];

echo "<strong>Lista de Frutas:</strong> <br>";
foreach ($frutas as $fruta) {
    echo "- $fruta <br>";
}

echo "<br><strong>Dados do Funcionário:</strong> <br>";
// A função ucfirst() no PHP serve para converter a primeira letra de uma string para
// maiúscula e deixar o restante das letras em minúscula.

// No entanto, ucfirst() só altera a primeira letra da string. Se você precisar de uma 
//formatação mais complexa (por exemplo, deixar todas as palavras com a primeira letra
// maiúscula, como em títulos), você pode usar a função ucwords().

foreach ($funcionario as $chave => $valor) {
    echo ucfirst($chave) . ": $valor <br>";
}

echo "<br><strong>Alunos e Notas:</strong> <br>";
foreach ($alunos as $aluno) {
    echo "Aluno: {$aluno['nome']} - Nota: {$aluno['nota']} <br>";
}
echo "<br>";
echo "=============================================================================";

// ---- 3. CONDICIONAIS ----
echo "<h2>3. Condicionais</h2>";

$temperatura = 28;
echo "Temperatura atual: " . $temperatura . "ºC <br>";

// Normal
if ($temperatura < 15) {
    echo "Está frio! <br>";
} elseif ($temperatura >= 15 && $temperatura < 25) {
    echo "A temperatura está agradável. <br>";
} else {
    echo "Está calor! <br>";
}

// Com ternário
echo ($temperatura < 15) ? "Está frio! <br>" : (($temperatura >= 15 && $temperatura < 25) ? "A temperatura está agradável. <br>" : "Está calor! <br>");

// Switch case
$dia_semana = date("w");
echo "Hoje é: ";

switch ($dia_semana) {
    case 0:
        echo "Domingo";
        break;
    case 1:
        echo "Segunda-feira";
        break;
    case 2:
        echo "Terça-feira";
        break;
    case 3:
        echo "Quarta-feira";
        break;
    case 4:
        echo "Quinta-feira";
        break;
    case 5:
        echo "Sexta-feira";
        break;
    case 6:
        echo "Sábado";
        break;
}
echo "<br>";

// Operador ternário
$idade = 17;
echo "Com $idade anos: " . ($idade >= 18 ? "Maior de idade" : "Menor de idade") . "<br>";
echo "<br>";
echo "=============================================================================";

// ---- 4. LOOPS ----
echo "<h2>4. Loops</h2>";

// For
echo "<strong>Contagem com for:</strong> <br>";
for ($i = 1; $i <= 5; $i++) {
    echo "Número: $i <br>";
}

// While
echo "<br><strong>Contagem regressiva com while:</strong> <br>";
$contador = 5;
while ($contador > 0) {
    echo "Contagem: $contador <br>";
    $contador--;
}

// Foreach com arrays
echo "<br><strong>Percorrendo array com foreach:</strong> <br>";
$linguagens = ["PHP", "JavaScript", "Python", "Java", "C#"];
foreach ($linguagens as $indice => $linguagem) {
    echo "Linguagem $indice: $linguagem <br>";
}
echo "<br>";
echo "=============================================================================";

// ---- 5. FUNÇÕES ----
echo "<h2>5. Funções</h2>";

// Função simples
function saudacao($nome) {
    return "Olá, $nome!";
}

// Função com parâmetros default
function calcularMedia($nota1, $nota2, $nota3 = 0) {
    return ($nota1 + $nota2 + $nota3) / 3;
}

// Função anônima
// A função anônima é uma função sem nome que pode ser atribuída a uma variável.
$dobro = function($numero) {
    return $numero * 2;
};

echo saudacao("Carlos") . "<br>";
echo "Média das notas: " . number_format(calcularMedia(7.5, 8.5, 9.0), 1, ',', '.') . "<br>";
echo "O dobro de 15 é: " . $dobro(15) . "<br>";

// O fatorial de um número n é o produto de todos os inteiros de 1 até n. O fatorial de 5, por exemplo, 
//é 5 * 4 * 3 * 2 * 1 = 120.

// Função Recursiva:

// Recursão é um processo onde a função chama a si mesma. No caso da função fatorial(), ela chama a si mesma com o valor de $n - 1 até que $n seja menor ou igual a 1.
// A base da recursão (condição de parada) é quando $n <= 1, onde a função retorna 1. Isso é necessário para evitar que a função continue chamando a si mesma indefinidamente.

function fatorial($n) {
    if ($n <= 1) return 1;
    return $n * fatorial($n - 1);
}

echo "Fatorial de 5: " . fatorial(5) . "<br>";
echo "<br>";
echo "=============================================================================";

// EXERCÍCIO PRÁTICO: Combinando todos os conceitos
echo "<h2>Exercício Prático</h2>";

// Função para calcular média de notas
function Media($notas) {
    $soma = array_sum($notas);
    $media = $soma / count($notas);
    return $media;
}

function determinarStatus($media) {
    if ($media >= 9.0) {
        return "<span style='color: blue;'>Excelente</span>";
    } elseif ($media >= 7.0) {
        return "<span style='color: green;'>Aprovado</span>";
    } elseif ($media >= 6.0) {
        return "<span style='color: orange;'>Recuperação</span>";
    } else {
        return "<span style='color: red;'>Reprovado</span>";
    }
}

// Criando um array com alunos e notas
$turma = [
    ["nome" => "Ana Silva", "notas" => [8.5, 9.0, 7.5]],
    ["nome" => "Pedro Santos", "notas" => [6.0, 7.5, 8.0]],
    ["nome" => "Maria Oliveira", "notas" => [9.5, 9.0, 10.0]],
    ["nome" => "João Costa", "notas" => [5.0, 6.5, 7.0]],
    ["nome" => "Lucia Pereira", "notas" => [7.5, 8.0, 6.5]]
];

// Exibindo os resultados
echo "<strong>Boletim 2DA:</strong><br>";
foreach ($turma as $aluno) {
    $media = Media($aluno["notas"]); // Calcula a média
    $status = determinarStatus($media); // Determina o status
    $mediaFormatada = number_format($media, 1, ',', '.'); // Formata a média
    $notasFormatadas = implode(', ', $aluno["notas"]); // Formata as notas para exibição
    echo "Aluno(a): {$aluno['nome']} - Notas: {$notasFormatadas} - Média: {$mediaFormatada} - Status: {$status}<br>";
}


ini_set('display_errors', 1);
error_reporting(E_ALL);

?>