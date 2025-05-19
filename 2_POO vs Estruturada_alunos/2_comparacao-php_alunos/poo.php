<?php
// ==========================================
// PARTE 2: PROGRAMAÇÃO ORIENTADA A OBJETOS
// ==========================================


// 1ª Digitação (Aqui)
class Cachorro {
    private $nome;
    private $comida;
    private $sono;

    public function __construct ($nome, $comida, $sono) {
        $this-> nome = $nome;
        $this-> comida = $comida;
        $this-> sono = $sono;
    }

    public function comer () {
        $this->comida -= 1;
    }

    public function dormir () {
        $this-> sono = false;
    }

    // Getters e Setters (comuns no PHP)
    public function getNome() {
        return $this->nome;
    }

    public function getComida() {
        return $this->comida;
    }

    public function getSono() {
        return $this->sono;
    }
}

$cachorro_1 = new cachorro("Nelson", 3, false);
$cachorro_2 = new cachorro("Jeremias", 1, true);

// Usar metodos
$cachorro_1 -> comer();
$cachorro_2 -> dormir();


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
