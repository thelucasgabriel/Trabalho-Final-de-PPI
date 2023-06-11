<?php

function checkLogin($pdo, $email, $senha)
{
    $sql = <<<SQL
    SELECT senha_hash
    FROM funcionario
    WHERE email = ?
SQL;

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        $row = $stmt->fetch();
        if (!$row) {
            return false;
        }

        return password_verify($senha, $row["senha_hash"]);
    } catch (Exception $e) {
        exit("Falha inesperada: " . $e->getMessage());
    }
}

require "includes/conexao.php";
$pdo = mysqlConnect();

$email = $_POST["email"] ?? "";
$senha = $_POST["senha"] ?? "";


$errorMsg = []; // vetor para armazenar as mensagens de erro


// Validação dos campos
if (trim($email) == "") {
    $errorMsg[] = "Você deve digitar seu e-mail.";
} elseif (trim($senha) == "") {
    $errorMsg[] = "Você deve digitar sua senha.";
}

if (count($errorMsg) > 0) {
    //exibe as mensagens de erro
    foreach ($errorMsg as $error) {
        echo $error . "<br>";
    }

    echo "Você será redirecionado(a) para a página de Login em 5s.";
    
    header("Refresh: 5; URL=../front-end/area-publica/login.html"); 
    exit();
    
} else {
    if (checkLogin($pdo, $email, $senha)) {
        header("Location: ../front-end/area-restrita");
        exit();
    } else {
        header("Location: ../front-end/area-publica/login.html");
        exit();
    }

    
}
?>
