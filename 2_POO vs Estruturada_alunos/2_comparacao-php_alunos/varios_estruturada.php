<?php
// ========================================== 
// PARTE 1: PROGRAMAÇÃO ESTRUTURADA
// ==========================================

// Funções para manipular os dados


// 1ª Digitação (Aqui)


// Criando vários cachorros
$cachorros = [
    ["nome" => "Nelson", "comida" => 3, "sono" => false],
    ["nome" => "Jeremias", "comida" => 1, "sono" => true],
    ["nome" => "Cléo", "comida" => 247, "sono" => true],
    ["nome" => "Francisco", "comida" => 5, "sono" => true],
    ["nome" => "Conan", "comida" => 19, "sono" => false],
    ["nome" => "Leleco", "comida" => 3, "sono" => false],
    ["nome" => "Babi", "comida" => 13, "sono" => true]
];

// Manipulando os cachorros


// 2ª Digitação (Aqui)


// Exibindo os resultados no navegador
echo "<!DOCTYPE html>";
echo "<html lang='pt-BR'>";
echo "<head>";
echo "    <meta charset='UTF-8'>";
echo "    <meta name='viewport' content='width=device-width, initial-scale=1.0'>";
echo "    <title>Resultados dos Cachorros</title>";
echo "</head>";
echo "<body>";
echo "    <h1>Resultados dos Cachorros</h1>";
echo "    <ul>";

foreach ($cachorros as $cachorro) {
    echo "        <li><strong>" . $cachorro["nome"] . "</strong> agora tem <strong>" . $cachorro["comida"] . "</strong> unidades de comida e está com sono? <strong>" . ($cachorro["sono"] ? 'Sim' : 'Não') . "</strong></li>";
}

echo "    </ul>";
echo "</body>";
echo "</html>";
