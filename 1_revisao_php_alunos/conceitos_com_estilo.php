<!-- Será disponibilizado completo pelo Professor -->
 <!-- Será disponibilizado completo pelo Professor -->
<?php
// Inicia a sessão para gerenciar o login
session_start();

// Configurações de conexão com o banco de dados
$host = "localhost";
$usuario = "root";
$senha = "Senai@118";
$banco = "sistema_simples";

// Função para conectar ao banco de dados
function conectarBD() {
    global $host, $usuario, $senha, $banco;
    $conexao = new mysqli($host, $usuario, $senha, $banco);
    
    if ($conexao->connect_error) {
        die("Falha na conexão: " . $conexao->connect_error);
    }
    
    return $conexao;
}

// Função para validar campos do formulário
function validarCampo($campo) {
    $campo = trim($campo);
    return !empty($campo);
}

// Função para sanitizar entradas
function sanitizar($dado) {
    $dado = trim($dado);
    $dado = stripslashes($dado);
    $dado = htmlspecialchars($dado);
    return $dado;
}

// Inicializa variáveis
$mensagem = "";
$nome = "";
$id_para_editar = 0;
$operacao = "cadastrar"; // Padrão: cadastrar novo item

// Verifica ações baseadas em operações GET
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Operação para logout
    if (isset($_GET["logout"])) {
        session_destroy();
        header("Location: " . $_SERVER["PHP_SELF"]);
        exit;
    }
    
    // Operação para editar
    if (isset($_GET["editar"]) && is_numeric($_GET["editar"]) && isset($_SESSION["logado"])) {
        $id_para_editar = (int)$_GET["editar"];
        $operacao = "editar";
        
        $conexao = conectarBD();
        $stmt = $conexao->prepare("SELECT nome FROM itens WHERE id = ?");
        $stmt->bind_param("i", $id_para_editar);
        $stmt->execute();
        $resultado = $stmt->get_result();
        
        if ($registro = $resultado->fetch_assoc()) {
            $nome = $registro["nome"];
        }
        
        $stmt->close();
        $conexao->close();
    }
    
    // Operação para excluir
    if (isset($_GET["excluir"]) && is_numeric($_GET["excluir"]) && isset($_SESSION["logado"])) {
        $id_para_excluir = (int)$_GET["excluir"];
        
        $conexao = conectarBD();
        $stmt = $conexao->prepare("DELETE FROM itens WHERE id = ?");
        $stmt->bind_param("i", $id_para_excluir);
        
        if ($stmt->execute()) {
            $mensagem = "Item excluído com sucesso!";
        } else {
            $mensagem = "Erro ao excluir o item: " . $conexao->error;
        }
        
        $stmt->close();
        $conexao->close();
    }
}

// Processa formulários enviados por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Processamento de login
    if (isset($_POST["acao"]) && $_POST["acao"] == "login") {
        $usuario_login = sanitizar($_POST["usuario"] ?? "");
        $senha_login = sanitizar($_POST["senha"] ?? "");
        
        // Validação simples
        if (!validarCampo($usuario_login) || !validarCampo($senha_login)) {
            $mensagem = "Por favor, preencha todos os campos!";
        } else {
            // Em um sistema real, você faria uma verificação no banco de dados
            // Aqui simplificamos com um usuário e senha fixos (admin/admin)
            if ($usuario_login == "admin" && $senha_login == "admin") {
                $_SESSION["logado"] = true;
                $_SESSION["usuario"] = $usuario_login;
                $mensagem = "Login realizado com sucesso!";
            } else {
                $mensagem = "Usuário ou senha incorretos!";
            }
        }
    }
    
    // Processamento do cadastro/edição de item
    if (isset($_POST["acao"]) && ($_POST["acao"] == "cadastrar" || $_POST["acao"] == "atualizar") && isset($_SESSION["logado"])) {
        $nome = sanitizar($_POST["nome"] ?? "");
        
        // Validação dos campos
        if (!validarCampo($nome)) {
            $mensagem = "Por favor, preencha o campo nome!";
        } else {
            $conexao = conectarBD();
            
            // Cadastrar novo item
            if ($_POST["acao"] == "cadastrar") {
                $stmt = $conexao->prepare("INSERT INTO itens (nome) VALUES (?)");
                $stmt->bind_param("s", $nome);
                
                if ($stmt->execute()) {
                    $mensagem = "Item cadastrado com sucesso!";
                    // Limpa os campos após cadastro bem-sucedido
                    $nome = "";
                } else {
                    $mensagem = "Erro ao cadastrar item: " . $conexao->error;
                }
            } 
            // Atualizar item existente
            else if ($_POST["acao"] == "atualizar") {
                $id = (int)$_POST["id"];
                $stmt = $conexao->prepare("UPDATE itens SET nome = ? WHERE id = ?");
                $stmt->bind_param("si", $nome, $id);
                
                if ($stmt->execute()) {
                    $mensagem = "Item atualizado com sucesso!";
                    // Redireciona para limpar o formulário
                    header("Location: " . $_SERVER["PHP_SELF"]);
                    exit;
                } else {
                    $mensagem = "Erro ao atualizar item: " . $conexao->error;
                }
            }
            
            $stmt->close();
            $conexao->close();
        }
    }
}

// Consulta todos os itens
function listarItens() {
    $itens = array();
    
    $conexao = conectarBD();
    $resultado = $conexao->query("SELECT id, nome FROM itens ORDER BY id ASC");
    
    if ($resultado->num_rows > 0) {
        while ($registro = $resultado->fetch_assoc()) {
            $itens[] = $registro;
        }
    }
    
    $conexao->close();
    return $itens;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema PHP - Exercício Completo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1, h2, h3 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        form {
            margin-bottom: 20px;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .mensagem {
            padding: 10px;
            background-color: #f8f8f8;
            border-left: 4px solid #4CAF50;
            margin-bottom: 20px;
        }
        .acoes {
            display: flex;
            gap: 10px;
        }
        .acoes a {
            display: inline-block;
            padding: 5px 10px;
            text-decoration: none;
            background-color: #f4f4f4;
            color: #333;
            border-radius: 3px;
        }
        .acoes a.editar {
            background-color: #2196F3;
            color: white;
        }
        .acoes a.excluir {
            background-color: #f44336;
            color: white;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Cabeçalho com informações de login -->
        <div class="header">
            <h1>Sistema PHP - Exercício Completo</h1>
            <?php if (isset($_SESSION["logado"])): ?>
                <div>
                    Bem-vindo, <?php echo $_SESSION["usuario"]; ?>! 
                    <a href="?logout=1">Sair</a>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- Mensagens de sistema -->
        <?php if (!empty($mensagem)): ?>
            <div class="mensagem">
                <?php echo $mensagem; ?>
            </div>
        <?php endif; ?>
        
        <!-- Formulário de Login (exibido apenas quando não estiver logado) -->
        <?php if (!isset($_SESSION["logado"])): ?>
            <h2>Login</h2>
            <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                <input type="hidden" name="acao" value="login">
                
                <label for="usuario">Usuário:</label>
                <input type="text" id="usuario" name="usuario" required>
                
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required>
                
                <input type="submit" value="Entrar">
            </form>
            
            <p><strong>Dica:</strong> Use usuário "admin" e senha "admin" para entrar.</p>
        <?php else: ?>
            <!-- Formulário de Cadastro/Edição de Item -->
            <h2><?php echo ($operacao == "editar" ? "Editar" : "Cadastrar"); ?> Item</h2>
            <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                <input type="hidden" name="acao" value="<?php echo ($operacao == "editar" ? "atualizar" : "cadastrar"); ?>">
                <?php if ($operacao == "editar"): ?>
                    <input type="hidden" name="id" value="<?php echo $id_para_editar; ?>">
                <?php endif; ?>
                
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" value="<?php echo $nome; ?>" required>
                
                <input type="submit" value="<?php echo ($operacao == "editar" ? "Atualizar" : "Cadastrar"); ?>">
                <?php if ($operacao == "editar"): ?>
                    <a href="<?php echo $_SERVER["PHP_SELF"]; ?>" style="margin-left: 10px;">Cancelar</a>
                <?php endif; ?>
            </form>
            
            <!-- Listagem de Itens -->
            <h2>Itens Cadastrados</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $itens = listarItens();
                    if (count($itens) > 0):
                        foreach ($itens as $item):
                    ?>
                    <tr>
                        <td><?php echo $item["id"]; ?></td>
                        <td><?php echo $item["nome"]; ?></td>
                        <td class="acoes">
                            <a href="?editar=<?php echo $item["id"]; ?>" class="editar">Editar</a>
                            <a href="?excluir=<?php echo $item["id"]; ?>" class="excluir" onclick="return confirm('Tem certeza que deseja excluir este item?')">Excluir</a>
                        </td>
                    </tr>
                    <?php
                        endforeach;
                    else:
                    ?>
                    <tr>
                        <td colspan="3">Nenhum item cadastrado</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>