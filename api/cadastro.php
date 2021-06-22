<?php

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    echo "OK";
    exit();
}

require_once 'utils/funcoes.php';
require_once 'utils/manipula_post.php';

$objPost = new ManipulaPost();
$dados=$objPost->getJsonPost();

// Validação dos campos
if (NuloOuVazio($dados['apelido'])) {
    RetornaErro(400,"Por Favor, Informe seu apelido.");
}

if (NuloOuVazio($dados['email'])) {
    RetornaErro(400,"Por Favor, Informe seu email.");
}

if (NuloOuVazio($dados['telefone'])) {
    RetornaErro(400,"Por Favor, Informe seu telefone.");
}

if (NuloOuVazio($dados['senha'])) {
    RetornaErro(400,"Por Favor, Informe sua senha.");
}

require_once 'utils/mysql.php';

$parametros = array("sssis",$dados['apelido'], $dados['email'], $dados['telefone'], $dados['temWhats'], $dados['senha']);
execSQL("insert into usuarios (apelido, email, telefone, possui_whatsapp, senha, data_cadastro) values (?, LOWER(?), ?, ?, SHA(?), NOW())", $parametros);
$conn_cli->query('COMMIT');

echo "## More a test elephant. ##\n";
echo "Apelido: " . $dados["apelido"]. "\n";
echo "Email: " . $dados["email"]. "\n";
echo "Telefone: " . $dados["telefone"]. "\n";
echo "temWhats: " . $dados["temWhats"]. "\n";
echo "Senha: " . $dados["senha"]. "\n";
?>