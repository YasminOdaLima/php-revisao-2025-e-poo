# Guia de Variáveis e Funções em PHP

Este documento explica em detalhes algumas variáveis e funções do PHP utilizadas em um sistema simples.

## 1. `$_SERVER`

`$_SERVER` é uma variável superglobal do PHP que contém informações sobre cabeçalhos, caminhos e localizações de scripts.

### Exemplo usado no código:

```php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
```

### Explicação:
- `$_SERVER["REQUEST_METHOD"]` retorna o método HTTP utilizado na requisição.
- Verifica se a requisição foi feita via `GET`.

### Exemplo prático:

```php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Este formulário foi enviado via POST!";
}
```

---

## 2. `isset()`

A função `isset()` verifica se uma variável foi definida e não é `null`.

### Exemplo usado no código:

```php
if (isset($_GET["logout"])) {
    session_destroy();
    header("Location: " . $_SERVER["PHP_SELF"]);
    exit;
}
```

### Explicação:
- `isset($_GET["logout"])` verifica se o parâmetro `logout` está presente na URL.
- Se existir, destrói a sessão e redireciona a página.

### Exemplo prático:

```php
$nome = "João";
if (isset($nome)) {
    echo "Nome definido: $nome";
} else {
    echo "Nome não definido.";
}
```

---

## 3. `$_GET`

A variável `$_GET` captura dados enviados via URL.

### Exemplo usado no código:

```php
if (isset($_GET["editar"]) && is_numeric($_GET["editar"])) {
    $id_para_editar = (int)$_GET["editar"];
}
```

### Explicação:
- `$_GET["editar"]` recebe um valor passado na URL, como `?editar=5`.
- `is_numeric($_GET["editar"])` garante que o valor é um número.
- O `(int)` força a conversão para inteiro.

### Exemplo prático:

```php
// Suponha que a URL seja: pagina.php?id=10
$id = isset($_GET["id"]) ? (int)$_GET["id"] : 0;
echo "O ID recebido foi: " . $id;
```

---

## 4. `$_POST`

A variável `$_POST` captura dados enviados via formulário com método `POST`.

### Exemplo usado no código:

```php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];
    $senha = $_POST["senha"];
}
```

### Explicação:
- `$_POST["usuario"]` e `$_POST["senha"]` capturam os dados do formulário.

### Exemplo prático:

```php
<form method="post" action="">
    <input type="text" name="nome" placeholder="Digite seu nome">
    <input type="submit" value="Enviar">
</form>
```

```php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Nome enviado: " . $_POST["nome"];
}
```

---

## 5. `$_SESSION`

A variável `$_SESSION` armazena dados que persistem entre páginas.

### Exemplo usado no código:

```php
session_start();
$_SESSION["logado"] = true;
$_SESSION["usuario"] = "admin";
```

### Explicação:
- `session_start()` inicia a sessão.
- `$_SESSION["logado"] = true;` indica que o usuário está autenticado.
- `$_SESSION["usuario"] = "admin";` armazena o nome do usuário logado.

### Exemplo prático:

```php
session_start();
if (isset($_SESSION["usuario"])) {
    echo "Bem-vindo, " . $_SESSION["usuario"];
} else {
    echo "Faça login primeiro.";
}
```

---

## 6. `header("Location: ...")`

O `header("Location: ...")` redireciona para outra página.

### Exemplo usado no código:

```php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header("Location: sucesso.php");
    exit;
}
```

### Explicação:
- Após uma ação bem-sucedida, redireciona para `sucesso.php`.
- `exit;` garante que o código pare de ser executado.

### Exemplo prático:

```php
if (!isset($_SESSION["logado"])) {
    header("Location: login.php");
    exit;
}
```

Isso força usuários não autenticados a serem redirecionados para a página de login.

---

## Conclusão

Estas variáveis e funções são fundamentais para manipular dados de formulários, sessões e URLs no PHP. Combinando-as, é possível criar sistemas completos e dinâmicos.

