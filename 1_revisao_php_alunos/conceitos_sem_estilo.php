<?php
// Inicia a sessão PHP para permitir o armazenamento de dados entre páginas através de cookies
session_start();

//
// Conexão com o Banco de Dados MySQL (Nome do BD: sistema_simples)
//

// Define as variáveis de configuração para conexão com o banco de dados MySQL
$host = "localhost";       // Endereço do servidor de banco de dados (local)
$usuario = "root";         // Nome de usuário do banco de dados MySQL
$senha = "Senai@118";        // Senha do usuário MySQL
$banco = "sistema_simples";// Nome do banco de dados a ser utilizado

// Função que estabelece conexão com o banco de dados e retorna o objeto de conexão
function conectarBD() {
    // Indica que serão usadas as variáveis globais definidas anteriormente
    global $host, $usuario, $senha, $banco;

    // Cria um novo objeto de conexão MySQL com os parâmetros fornecidos
    $conexao = new mysqli($host, $usuario, $senha, $banco);

    // Verifica se houve erro na conexão
    if ($conexao->connect_error) {
        // Se houver erro, interrompe a execução e exibe a mensagem de erro
        die("Falha na conexão: " . $conexao->connect_error);
    }

    // Retorna o objeto de conexão para ser utilizado nas operações de banco de dados
    return $conexao;
}

//
// Validações e inicializações de variáveis
//

// Função que valida se um campo de formulário não está vazio
function validarCampo($campo) {
    // Remove espaços em branco no início e fim do texto
    $campo = trim($campo);
    // Retorna verdadeiro se o campo não estiver vazio, falso caso contrário
    return !empty($campo);
}

// Função que limpa dados de entrada para prevenir injeção de código malicioso
function sanitizar($dado) {
    // Remove espaços em branco no início e fim do texto
    $dado = trim($dado);
    // Remove barras invertidas adicionadas por escape automático
    $dado = stripslashes($dado);
    // Converte caracteres especiais em entidades HTML para evitar ataques XSS
    $dado = htmlspecialchars($dado);
    // Retorna o dado limpo e seguro
    return $dado;
}

// Inicializa variáveis que serão utilizadas no sistema
$mensagem = "";            // Armazena mensagens de feedback para o usuário
$nome = "";                // Armazena o nome do item a ser cadastrado/editado
$id_para_editar = 0;       // Armazena o ID do item a ser editado
$operacao = "cadastrar";   // Define a operação padrão como cadastro de novo item

// Verifica se a requisição atual é do tipo GET (via URL)
// Obs: Explicação detalhada no arquivo (guia_variaveis_explicacao.md)
if ($_SERVER["REQUEST_METHOD"] == "GET") {

    // Saída do sistema (Logout)

    // Verifica se foi solicitado logout (presença do parâmetro logout na URL)
    if (isset($_GET["logout"])) {
        // Destroi a sessão atual, removendo todas as variáveis de sessão
        session_destroy();
        // Redireciona para a própria página, agora sem sessão ativa
        header("Location: " . $_SERVER["PHP_SELF"]);
        // Encerra a execução do script para garantir o redirecionamento
        exit();
    }

    // Edição (Update)

    // Verifica se foi solicitada a edição de um item e se o usuário está logado
    if (isset($_GET["editar"]) && is_numeric($_GET["editar"]) && isset($_SESSION["logado"])) {
        // Converte o ID recebido para inteiro e armazena
        $id_para_editar = (int)$_GET["editar"];
        // Muda a operação para modo de edição
        $operacao = "editar";

        // Conecta ao banco de dados
        $conexao = conectarBD();
        // Prepara uma consulta SQL para selecionar o nome do item pelo ID
        // 'stmt' é uma abreviação comum para 'statement' (declaração), usada para
        // armazenar uma consulta SQL preparada.
        $stmt = $conexao->prepare("SELECT nome FROM itens WHERE id = ?");
        // Vincula o parâmetro ID consulta (i: integer)
        $stmt->bind_param("i", $id_para_editar);
        // Executa a consulta preparada
        $stmt->execute();
        // Obtém os dados da consulta
        $resultado = $stmt->get_result();

        // Verifica se encontrou algum registro
        // 'fetch_assoc' é o método do mysqli_result no PHP. Ele é usado para
        // buscar uma linha do resultado da consulta SQL e retorná-la como um array associativo
        if ($registro = $resultado->fetch_assoc()) {
            // Atribui o nome do item à variável $nome para preencher o formulário
            $nome = $registro["nome"];
        }

        // Fecha a declaração preparada para liberar recursos
        $stmt->close();
        // Fecha a conexão com o banco de dados
        $conexao->close();
    }


    


    // -------------------------------------------------------------------------
    // Exclusão (Delete)
    // -------------------------------------------------------------------------

    // Verifica se foi solicitada a exclusão de um item e se o usuário está logado
    if (isset($_GET["excluir"]) && is_numeric($_GET["excluir"]) && isset($_SESSION["logado"])) {
        // Converte o ID recebido para inteiro e armazena
        $id_para_excluir = (int)$_GET["excluir"];

        // Conecta ao banco de dados
        $conexao = conectarBD();
        // Prepara uma consulta SQL para excluir o item pelo ID
        $stmt = $conexao->prepare("DELETE FROM itens WHERE id = ?");
        // Vincula o parâmetro ID à consulta (i = integer)
        $stmt->bind_param("i", $id_para_excluir);

        // Executa a consulta e verifica se foi bem-sucedida
        if ($stmt->execute()) {
            // Define mensagem de sucesso
            $mensagem = "Item excluído com sucesso!";
        } else {
            // Define mensagem de erro com detalhes
            $mensagem = "Erro ao excluir o item: " . $conexao->error;
        }

        // Fecha a declaração preparada
        $stmt->close();
        // Fecha a conexão com o banco de dados
        $conexao->close();
    }
}

// -------------------------------------------------------------------------
// Entrada no sistema (Login)
// -------------------------------------------------------------------------

// Verifica se a requisição atual é do tipo POST (envio de formulário)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se a ação é de login
    if (isset($_POST["acao"]) && $_POST["acao"] == "login") {
        // Obtém e sanitiza os dados do usuário e senha
        $usuario_login = sanitizar($_POST["usuario"] ?? "");
        $senha_login = sanitizar($_POST["senha"] ?? "");

        // Valida se ambos os campos foram preenchidos
        if (!validarCampo($usuario_login) || !validarCampo($senha_login)) {
            // Define mensagem de erro se algum campo estiver vazio
            $mensagem = "Por favor, preencha todos os campos!";
        } else {
            // Verifica se as credenciais correspondem ao par fixo admin/admin
            if ($usuario_login == "admin" && $senha_login == "admin") {
                // Se as credenciais estiverem corretas, marca o usuário como logado na sessão
                $_SESSION["logado"] = true;
                // Armazena o nome do usuário na sessão
                $_SESSION["usuario"] = $usuario_login;
                // Define mensagem de sucesso
                $mensagem = "Login realizado com sucesso!";
            } else {
                // Define mensagem de erro para credenciais inválidas
                $mensagem = "Usuário ou senha incorretos!";
            }
        }
    }

// -------------------------------------------------------------------------
// Verifica se ação é de cadastro ou atualização (Insert/Update)
// -------------------------------------------------------------------------

// Verifica se a ação é de cadastro ou atualização de item e se o usuário está logado
if (isset($_POST["acao"]) && ($_POST["acao"] == "cadastrar" || $_POST["acao"] == "atualizar") && isset($_SESSION["logado"])) {
    // Obtém e sanitiza o nome do item
    $nome = sanitizar($_POST["nome"] ?? "");

    // Valida se o campo nome foi preenchido
    if (!validarCampo($nome)) {
        // Define mensagem de erro se o campo estiver vazio
        $mensagem = "Por favor, preencha o campo nome!";
    } else {
        // Conecta ao banco de dados
        $conexao = conectarBD();

        // -----------------------------------------------------------------
        // Cadastro (Insert)
        // -----------------------------------------------------------------

            // Verifica se a ação é cadastrar novo item
            if ($_POST["acao"] == "cadastrar") {
                // Prepara uma consulta SQL para inserir o novo item
                $stmt = $conexao->prepare("INSERT INTO itens (nome) VALUES (?)");
                // Vincula o parâmetro nome à consulta (s = string)
                $stmt->bind_param("s", $nome);

                // Executa a consulta e verifica se foi bem-sucedida
                if ($stmt->execute()) {
                    // Define mensagem de sucesso
                    $mensagem = "Item cadastrado com sucesso!";
                    // Limpa o campo nome para permitir novo cadastro
                    $nome = "";
                } else {
                    // Define mensagem de erro com detalhes
                    $mensagem = "Erro ao cadastrar item: " . $conexao->error;
                }
            }
            // Verifica se a ação é atualizar item existente
            else if ($_POST["acao"] == "atualizar") {
                // Obtém o ID do item a ser atualizado
                $id = (int)$_POST["id"];
                // Prepara uma consulta SQL para atualizar o item
                $stmt = $conexao->prepare("UPDATE itens SET nome = ? WHERE id = ?");
                // Vincula os parâmetros à consulta (s = string, i = integer)
                $stmt->bind_param("si", $nome, $id);

                // Executa a consulta e verifica se foi bem-sucedida
                if ($stmt->execute()) {
                    // Define mensagem de sucesso
                    $mensagem = "Item atualizado com sucesso!";
                    // Redireciona para a própria página para resetar o formulário
                    header("Location: " . $_SERVER["PHP_SELF"]);
                    // Encerra a execução do script para garantir o redirecionamento
                    exit;
                } else {
                    // Define mensagem de erro com detalhes
                    $mensagem = "Erro ao atualizar item: " . $conexao->error;
                }
            }

            // Fecha a declaração preparada
            $stmt->close();
            // Fecha a conexão com o banco de dados
            $conexao->close();
        }
    }
}
// Retorna todos os itens cadastrados no banco de dados (Read)

// Função que consulta e retorna todos os itens cadastrados no banco de dados
function listarItens() {
    // Inicializa um array vazio para armazenar os itens
    $itens = array();

    // Conecta ao banco de dados
    $conexao = conectarBD();
    // Executa uma consulta SQL para selecionar todos os itens ordenados por ID
    $resultado = $conexao->query("SELECT id, nome FROM itens ORDER BY id ASC");

    // Verifica se a consulta retornou algum resultado
    if ($resultado->num_rows > 0) {
        // Loop para percorrer cada linha do resultado
        while ($registro = $resultado->fetch_assoc()) {
            // Adiciona cada registro ao array de itens
            $itens[] = $registro;
        }
    }

    // Fecha a conexão com o banco de dados
    $conexao->close();
    // Retorna o array de itens
    return $itens;
}
?>
<!-- HTML + PHP Para exibição do sistema -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema PHP Simplificado</title>
</head>
<body>
    <!-- Cabeçalho com informações de login -->
    <h1>Sistema PHP Simplificado</h1>
    <?php if (isset($_SESSION["logado"])): ?>
        <!-- Exibe mensagem de boas-vindas e link para logout caso o usuário esteja logado -->
        <div>
            Bem-vindo, <?php echo $_SESSION["usuario"]; ?>!
            <!-- % o que significa ?logout=1
                Inicia a query string na URL
                logout=1 Define um parâmetro chamado logout com o valor 1
                Isso é uma forma de passar um comando via URL para o PHP detectar que o usuário quer sair do sistema. -->
            <a href="?logout=1">Sair</a>
        </div>
    <?php endif; ?>

    <!-- Mensagens de sistema -->
    <?php if (!empty($mensagem)): ?>
        <!-- Exibe mensagens de erro ou sucesso -->
        <div>
            <?php echo $mensagem; ?>
        </div>
    <?php endif; ?>

    <!-- Formulário de Login (exibido apenas quando não estiver logado) -->
    <?php if (!isset($_SESSION["logado"])): ?>
        <h2>Login</h2>
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <input type="hidden" name="acao" value="login">

            <!-- Campo de entrada para o nome de usuário -->
            <div>
                <label for="usuario">Usuário:</label>
                <input type="text" id="usuario" name="usuario" required>
            </div>

            <!-- Campo de entrada para a senha -->
            <div>
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required>
            </div>

            <!-- Botão de envio do formulário de login -->
            <div>
                <input type="submit" value="Entrar">
            </div>
        </form>

        <p>Dica: Use usuário "admin" e senha "admin" para entrar.</p>
    <?php else: ?>
        <!-- Formulário de Cadastro/Edição de Item -->
        <h2><?php echo ($operacao == "editar") ? "Editar" : "Cadastrar"; ?> Item</h2>
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <input type="hidden" name="acao" value="<?php echo ($operacao == "editar") ? "atualizar" : "cadastrar"; ?>">

            <!-- Campo oculto para armazenar o ID do item ao editar -->
            <?php if ($operacao == "editar"): ?>
                <input type="hidden" name="id" value="<?php echo $id_para_editar; ?>">
            <?php endif; ?>

            <!-- Campo de entrada para o nome do item -->
            <div>
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" value="<?php echo $nome; ?>" required>
            </div>

            <!-- Botão de envio do formulário -->
            <div>
                <input type="submit" value="<?php echo ($operacao == "editar") ? "Atualizar" : "Cadastrar"; ?>">
                <?php if ($operacao == "editar"): ?>
                    <!-- Link para cancelar a edição e voltar ao modo de cadastro -->
                    <a href="<?php echo $_SERVER["PHP_SELF"]; ?>">Cancelar</a>
                <?php endif; ?>
            </div>
        </form>

        <!-- Listagem de Itens -->
        <h2>Itens Cadastrados</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
            <?php
                // Obtém a lista de itens cadastrados
                $itens = listarItens();
                if (count($itens) > 0):
                    foreach ($itens as $item):
            ?>
                <tr>
                    <!-- Exibe o ID do item -->
                    <td><?php echo $item["id"]; ?></td>
                    <!-- Exibe o nome do item -->
                    <td><?php echo $item["nome"]; ?></td>
                    <td>
                        <!-- Links para edição e exclusão do item -->
                        <a href="?editar=<?php echo $item["id"]; ?>">Editar</a>
                        <a href="?excluir=<?php echo $item["id"]; ?>" onclick="return confirm('Tem certeza que deseja excluir este item?')">Excluir</a>
                    </td>
                </tr>
            <?php
                    endforeach;
                else:
            ?>
                <!-- Exibe mensagem caso não existam itens cadastrados -->
                <tr>
                    <td colspan="3">Nenhum item cadastrado</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>
