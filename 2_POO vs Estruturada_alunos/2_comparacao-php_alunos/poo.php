<?php
// ==========================================
// PARTE 2: PROGRAMAÇÃO ORIENTADA A OBJETOS
// ==========================================


// 1ª Digitação (Aqui)


// Exibindo os resultados no navegador
echo "<!DOCTYPE html>
<html lang='pt-BR'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Resultados dos Cachorros (POO)</title>
</head>
<body>
    <h1>Resultados dos Cachorros (POO)</h1>
    <p><strong>{$cachorro_1->getNome()}</strong> agora tem <strong>{$cachorro_1->getComida()}</strong> unidades de comida.</p>
    <p><strong>{$cachorro_2->getNome()}</strong> está com sono? <strong>" . ($cachorro_2->getSono() ? 'Sim' : 'Não') . "</strong></p>
</body>
</html>";
?>