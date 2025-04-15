<?php

// 1ª Digitação (Aqui)

    // Como o encapsulamento está sendo aplicado?
    // 1. Métodos "getter" permitem acessar os valores sem expor diretamente os atributos.



    // 2ª Digitação (Aqui)



    // 2. Métodos "setter" controlam as modificações, garantindo regras de segurança.



    // 3ª Digitação (Aqui)



    // 3. Encapsulamento do comportamento: 
    // O método "comer" permite modificar o estado do objeto sem expor a lógica interna.



    // 4ª Digitação (Aqui)



// Exemplo de uso do encapsulamento


// 5ª Digitação (Aqui)


// O nome é acessado de forma controlada, sem expor diretamente o atributo.
echo $cachorro->getNome(). PHP_EOL;

// A comida é alterada através do setter, garantindo controle sobre a modificação.
$cachorro->setComida(5);

// O cachorro come, modificando seu estado interno sem acesso direto aos atributos.
echo $cachorro->comer() . PHP_EOL;

?>
