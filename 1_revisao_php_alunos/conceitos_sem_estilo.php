<?php
// Inicia a sessão PHP para permitir o armazenamento de dados entre páginas através de cookies
session_start();


// 1º Digitação da lógica em PHP (Aqui)


?>

<!-- __________________________________________________________________________________
HTML + PHP Para exibição do sistema -->

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
            <!-- 🛠 O que significa ?logout=1?
                ? Inicia a query string na URL
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
        <h2><?php echo ($operacao == "editar" ? "Editar" : "Cadastrar"); ?> Item</h2>
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <input type="hidden" name="acao" value="<?php echo ($operacao == "editar" ? "atualizar" : "cadastrar"); ?>">
            
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
                <input type="submit" value="<?php echo ($operacao == "editar" ? "Atualizar" : "Cadastrar"); ?>">
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
