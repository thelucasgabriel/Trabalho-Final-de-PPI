<?php

require "../includes/conexao.php";
$pdo = mysqlConnect();

class Medico{
    public $codigo;
    public $nome;

    function __construct($codigo, $nome){
        $this->codigo = $codigo;
        $this->nome = $nome;
    }
}

$especBuscada = $_GET["especialidade"] ?? "";

try{

    $sql = <<<SQL
    SELECT codigo,
           nome
    FROM medico 
    WHERE especialidade = ?
SQL;

$stmt = $pdo->prepare($sql);
$stmt->execute([$especBuscada]);

}

catch (Exception $e) {  
    exit('Falha inesperada: ' . $e->getMessage());
  }

 
  while ($row = $stmt->fetch()) {
    $medicos[] = new Medico(htmlspecialchars($row['codigo']), htmlspecialchars($row['nome']));
}

header('Content-type: application/json');
echo json_encode($medicos);

?>
