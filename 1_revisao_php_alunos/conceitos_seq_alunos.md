# Guia Passo a Passo: Sistema CRUD em PHP Simplificado (Testes)

Este guia apresenta uma sequência completa para desenvolver um sistema CRUD (Create, Read, Update, Delete) simples em PHP com autenticação de usuário. Cada etapa constrói progressivamente o sistema, permitindo testes incrementais.

## Etapa 1: Estrutura Básica e Início da Sessão

**Objetivo**: Configurar o início do arquivo PHP e a sessão.

```php
<?php

// Código

// Teste simples para verificar se a sessão está ativa
$_SESSION["teste"] = "Sessão funcionando!";
echo "Sessão iniciada. Valor de teste: " . $_SESSION["teste"];
?>
```

**Teste**: Ao acessar a página, você deve ver "Sessão iniciada. Valor de teste: Sessão funcionando!".

## Etapa 2: Conexão com o Banco de Dados

**Objetivo**: Configurar e testar a conexão com o banco de dados MySQL.

```php

// Código
    
    // Teste de conexão bem-sucedida
    echo "Conexão com o banco de dados realizada com sucesso!<br>";
    var_dump($conexao); // Mostra detalhes do objeto de conexão
    
// Código

```

**Teste**: Você verá "Conexão com o banco de dados realizada com sucesso!" e um var_dump do objeto de conexão se tudo estiver correto.

## Etapa 3: Funções de Validação e Sanitização

**Objetivo**: Implementar funções para validar e sanitizar os dados de entrada.

```php

// Código

// Teste das funções
$teste_vazio = "";
$teste_preenchido = "   Teste  ";
$teste_malicioso = "<script>alert('XSS');</script>";

echo "Campo vazio é válido? " . (validarCampo($teste_vazio) ? "Sim" : "Não") . "<br>";
echo "Campo preenchido é válido? " . (validarCampo($teste_preenchido) ? "Sim" : "Não") . "<br>";
echo "Sanitização: " . sanitizar($teste_malicioso) . "<br>";
```

**Teste**: Você deve ver "Campo vazio é válido? Não", "Campo preenchido é válido? Sim" e a versão sanitizada do código malicioso.

## Etapa 4: Inicialização de Variáveis

**Objetivo**: Inicializar as variáveis essenciais para o sistema.

```php

// Código

// Teste das variáveis inicializadas
echo "Variáveis inicializadas:<br>";
echo "Mensagem: '$mensagem'<br>";
echo "Nome: '$nome'<br>";
echo "ID para editar: $id_para_editar<br>";
echo "Operação: $operacao<br>";
```

**Teste**: Você verá as variáveis inicializadas com seus valores padrão.

## Etapa 5: Implementação do Logout

**Objetivo**: Implementar a funcionalidade de logout.

```php

// Código

// Para testar o logout, cria uma sessão de teste se não existir
if (!isset($_SESSION["logado"])) {
    $_SESSION["logado"] = true;
    $_SESSION["usuario"] = "teste";
    echo "Sessão de teste criada. <a href='?logout=1'>Testar Logout</a>";
}
```

**Teste**: Acesse a página e você verá um link "Testar Logout". Clique nele e você verá o estado da sessão antes do logout e a mensagem "Sessão destruída!".

## Etapa 6: Implementação da Edição de Item

**Objetivo**: Implementar a funcionalidade de edição de item.

```php
// Dentro do bloco if ($_SERVER["REQUEST_METHOD"] == "GET")
// Após o código de logout:

// Edição (Update)


// Código


```

**Teste**: Para testar, acesse a página com o parâmetro ?editar=1 (ou outro ID válido no seu banco). Você verá os detalhes da operação de edição.


## Etapa 7: Implementação da Exclusão de Item

**Objetivo**: Implementar a funcionalidade de exclusão de item.

```php
// Dentro do bloco if ($_SERVER["REQUEST_METHOD"] == "GET")
// Após o código de edição:

// Exclusão (Delete)


// Código


```

**Teste**: Para testar, acesse a página com o parâmetro ?excluir=1 (ou outro ID válido no seu banco). Você verá os detalhes da operação de exclusão e o resultado.


## Etapa 8: Implementação do Login

**Objetivo**: Implementar a funcionalidade de login.

```php
// Entrada no sistema (Login)


// Código


// Mostra formulário para teste de login
if (!isset($_SESSION["logado"])) {
    echo "<h3>Formulário de teste de login</h3>";
    echo "<form method='post' action='" . $_SERVER["PHP_SELF"] . "'>";
    echo "<input type='hidden' name='acao' value='login'>";
    echo "Usuário: <input type='text' name='usuario'><br>";
    echo "Senha: <input type='password' name='senha'><br>";
    echo "<input type='submit' value='Entrar'>";
    echo "</form>";
    echo "<p>Use usuário 'admin' e senha 'admin' para testar.</p>";
} else {
    echo "<h3>Usuário logado: " . $_SESSION["usuario"] . "</h3>";
    echo "<a href='?logout=1'>Sair</a>";
}
```

**Teste**: Acesse a página e você verá um formulário de login de teste. Tente entrar com credenciais incorretas e depois com "admin"/"admin" para ver os diferentes resultados.

## Etapa 9: Implementação do Cadastro e Atualização de Itens

**Objetivo**: Implementar as funcionalidades de cadastro e atualização de itens.

```php
// Dentro do bloco if ($_SERVER["REQUEST_METHOD"] == "POST")
// Após o código de login:

// Verifica se ação é de cadastro ou atualização (Insert/Update)


// Código


// Para testar o cadastro/atualização (se estiver logado)
if (isset($_SESSION["logado"])) {
    echo "<h3>Formulário de teste de " . ($operacao == "editar" ? "edição" : "cadastro") . "</h3>";
    echo "<form method='post' action='" . $_SERVER["PHP_SELF"] . "'>";
    echo "<input type='hidden' name='acao' value='" . ($operacao == "editar" ? "atualizar" : "cadastrar") . "'>";
    
    if ($operacao == "editar") {
        echo "<input type='hidden' name='id' value='$id_para_editar'>";
    }
    
    echo "Nome: <input type='text' name='nome' value='$nome'><br>";
    echo "<input type='submit' value='" . ($operacao == "editar" ? "Atualizar" : "Cadastrar") . "'>";
    
    if ($operacao == "editar") {
        echo " <a href='" . $_SERVER["PHP_SELF"] . "'>Cancelar</a>";
    }
    
    echo "</form>";
}
```

**Teste**: Se estiver logado, você verá um formulário para cadastrar ou editar um item. Preencha-o e envie para ver o resultado da operação.

## Etapa 10: Listagem de Itens

**Objetivo**: Implementar a funcionalidade de listar todos os itens cadastrados.

```php
// Função que consulta e retorna todos os itens cadastrados no banco de dados


// Código


// Teste da função de listagem
if (isset($_SESSION["logado"])) {
    echo "<h3>Itens cadastrados:</h3>";
    $itens = listarItens();
    
    if (count($itens) > 0) {
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Nome</th><th>Ações</th></tr>";
        
        foreach ($itens as $item) {
            echo "<tr>";
            echo "<td>" . $item["id"] . "</td>";
            echo "<td>" . $item["nome"] . "</td>";
            echo "<td>";
            echo "<a href='?editar=" . $item["id"] . "'>Editar</a> | ";
            echo "<a href='?excluir=" . $item["id"] . "' onclick=\"return confirm('Tem certeza que deseja excluir este item?')\">Excluir</a>";
            echo "</td>";
            echo "</tr>";
        }
        
        echo "</table>";
    } else {
        echo "Nenhum item cadastrado.";
    }
}
```

**Teste**: Se estiver logado, você verá uma tabela com todos os itens cadastrados, com opções para editar e excluir cada um.

## Versão Final: Sistema Completo

**Objetivo**: Sistema completo com todos os componentes, sem códigos de teste.

```php

// Pasta códigos figura (conceitos_sem_estilo_php)

```


