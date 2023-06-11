<?php
require "../../back-end/includes/conexao.php";
$pdo = mysqlConnect();

$codigo = $_GET["codigo"] ?? "";

try {

    $sql = <<<SQL
    DELETE FROM agendamento
    WHERE codigo = ?
    LIMIT 1
    SQL;
  

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$codigo]);
    
  
    header("location: ../../front-end/area-restrita/exibe-agendamentos.php");
    exit();
  } 
  catch (Exception $e) {  
    exit('Falha inesperada: ' . $e->getMessage());
  }
?>