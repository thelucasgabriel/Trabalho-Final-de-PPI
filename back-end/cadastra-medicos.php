<?php

require "includes/conexao.php";
$pdo = mysqlConnect();

$nome = $_POST["nome"] ?? "";
$espec = $_POST["espec"] ?? "";
$crm = $_POST["crm"] ?? "";

$errorMsg = []; // vetor para armazenar as mensagens de erro

// Validação dos campos
if (trim($nome) == "") {
    $errorMsg[] = "O nome é obrigatório.";
}
if (trim($espec) == "") {
    $errorMsg[] = "A especialidade é obrigatória.";
}
if (trim($crm) == "") {
    $errorMsg[] = "O CRM é obrigatório.";
}

if (count($errorMsg) > 0) {
    //exibe as mensagens de erro
    foreach ($errorMsg as $error) {
        echo $error . "<br>";
    }

    echo "Você será redirecionado(a) para a página de Cadastro de Médicos em 5s.";

    header("Refresh: 5; URL=../front-end/area-restrita/cadastro-de-medicos.html");
    exit();
} else {
    $sql = <<<SQL
        INSERT INTO medico (nome, especialidade, crm)
        VALUES(?, ?, ?)
SQL;

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nome, $espec, $crm]);

        header("Location: ../front-end/area-restrita/exibe-medicos.php");
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