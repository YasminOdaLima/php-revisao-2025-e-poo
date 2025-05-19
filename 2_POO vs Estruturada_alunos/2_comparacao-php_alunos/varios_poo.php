<?php
// ==========================================
// PARTE 2: PROGRAMAÇÃO ORIENTADA A OBJETOS
// ==========================================


// 1ª Digitação (Aqui)
class Cachorro {
    private $nome;
    private $comida;
    private $sono;

    public function __construct($nome, $comida, $sono)
    {
        $this -> nome = $nome;
        $this -> comida = $comida;
        $this -> sono = $sono;
    }

    public function comer() {
        if ($this->comida > 0) {
            $this->comida -= 1;
        }
    }

    public function dormir() {
        $this->sono = false; 
    }

    // Getters

    public function getNome() {
        return $this -> nome;
    }
    
    public function getComida() {
        return $this -> comida;
    }
    
    public function getSono() {
        return $this -> sono;
    }
}


// Criando vários cachorros
$cachorros = [
    new Cachorro("Cléo", 247, true),
    new Cachorro("Francisco", 5, true),
    new Cachorro("Conan", 19, false),
    new Cachorro("Leleco", 3, false),
    new Cachorro("Babi", 13, true)
];

// Usando métodos para manipular os objetos
foreach ($cachorros as $cachorro) {
    if ($cachorro -> getComida() > 0) {
        $cachorro->comer();
    }

    if ($cachorro->getSono()) {
        $cachorro->dormir();
    }
}


// Exibindo os resultados no navegador
echo "<!DOCTYPE html>
<html lang='pt-BR'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Resultados dos Cachorros (POO)</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            color: #333;
        }
        p {
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <h1>Resultados dos Cachorros (POO)</h1>";

foreach ($cachorros as $cachorro) {
    echo "<p><strong>{$cachorro->getNome()}</strong>:</p>";
    echo "<ul>";
    echo "<li>Comida restante: <strong>{$cachorro->getComida()}</strong></li>";
    echo "<li>Está com sono? <strong>" . ($cachorro->getSono() ? 'Sim' : 'Não') . "</strong></li>";
    echo "</ul>";
}

echo "</body>
</html>";
?>