<?php

require "includes/conexao.php";
$pdo = mysqlConnect();

$nome = $_POST["nome"] ?? "";
$email = $_POST["mail"] ?? "";
$senha = $_POST["senha"] ?? "";
$estadoCivil = $_POST["estadocivil"] ?? "";
$dataNasc = $_POST["datanascimento"] ?? "";
$funcao = $_POST["funcao"] ?? "";

$errorMsg = []; // vetor para armazenar as mensagens de erro

// Validação dos campos
if (trim($nome) == "") {
    $errorMsg[] = "O nome é obrigatório.";
}
if (trim($email) == "") {
    $errorMsg[] = "O e-mail é obrigatório.";
}
if (trim($senha) == "") {
    $errorMsg[] = "A senha é obrigatória.";
}
if (trim($estadoCivil) == "") {
    $errorMsg[] = "O estado civil é obrigatório.";
}
if (trim($dataNasc) == "") {
    $errorMsg[] = "A data de nascimento é obrigatória.";
}
if (trim($funcao) == "") {
    $errorMsg[] = "A função é obrigatória.";
}

if (count($errorMsg) > 0) {
    //exibe as mensagens de erro
    foreach ($errorMsg as $error) {
        echo $error . "<br>";
    }

    echo "Você será redirecionado(a) para a página de Cadastro de Funcionários em 5s.";
    header("Refresh: 5; URL= ../front-end/area-restrita/cadastro-de-funcionarios.html"); 
    exit();
} else {
    // calcula um hash de senha seguro para armazenar no BD
    $hashsenha = password_hash($senha, PASSWORD_DEFAULT);

    $sql = <<<SQL
        INSERT INTO funcionario (nome, email, senha_hash,
                                estado_civil, data_nascimento, funcao)
        VALUES(?, ?, ?, ?, ?, ?)
SQL;

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $nome,
            $email,
            $hashsenha,
            $estadoCivil,
            $dataNasc,
            $funcao,
        ]);

        header("Location: ../front-end/area-restrita/exibe-funcionarios.php");
        exit();
    } catch (PDOException $e) {
        if ($e->errorInfo[1] === 1062) {
            exit("Dados duplicados: " . $e->getMessage());
        } else {
            exit("Falha ao cadastrar os dados: " . $e->getMessage());
        }
    }
}

?>
