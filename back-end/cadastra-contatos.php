<?php

require "includes/conexao.php";
$pdo = mysqlConnect();

// alteração do fuso horário do servidor de America/New_York para America/Sao_Paulo, para conseguir exibir o horário.
date_default_timezone_set("America/Sao_Paulo");

$nome = $_POST["nome"] ?? "";
$email = $_POST["email"] ?? "";
$tel = $_POST["telefone"] ?? "";
$demaisInfos = $_POST["mais"] ?? "";

// captura automática da data e horário do contato que o visitante fez
$dataEnvio = new DateTime();
$dataHora = $dataEnvio->format("Y-m-d H:i:s");

$errorMsg = []; // vetor para armazenar as mensagens de erro

// Validação dos campos
if (trim($nome) == "") {
    $errorMsg[] = "O nome é obrigatório.";
}
if (trim($email) == "") {
    $errorMsg[] = "O e-mail é obrigatório.";
}
if (trim($tel) == "") {
    $errorMsg[] = "O telefone é obrigatório.";
}
if (trim($demaisInfos) == "") {
    $errorMsg[] = "A mensagem é obrigatória.";
}

if (count($errorMsg) > 0) {
    //exibe as mensagens de erro
    foreach ($errorMsg as $error) {
        echo $error . "<br>";
    }

    echo "Você será redirecionado(a) para a página de Contatos em 5s.";

    header("Refresh: 5; URL=../front-end/area-publica/contato.html");
    exit();
} else {
    $sql = <<<SQL
        INSERT INTO contato (nome, email, telefone,
                            mensagem, datahora)
        VALUES(?, ?, ?, ?, ?)
SQL;

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nome, $email, $tel, $demaisInfos, $dataHora]);

        header("Location: ../front-end/area-publica/contato.html");
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