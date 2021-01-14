<?php

require_once ("conexao.php");
session_start();

$titulo = $_POST['titulo'];
$data_inicial = $_POST['data_inicial'];
$data_final = $_POST['data_final'];
$valor = str_replace('.',',', $_POST['valor']);
$investimento = $_POST['investimento'];
$descricao = $_POST['descricao'];
$cod_usuario = $_SESSION['cod'];
$categoria = $_POST['categoria'];

$sql = "INSERT INTO 
            tarefas (titulo, data_inicial, data_final, valor, investimento, descricao, usuario_cod, categoria_cod)
            VALUES
            ('$titulo', '$data_inicial', '$data_final', '$valor', '$investimento', '$descricao', $cod_usuario, $categoria)
        ";
echo $sql;
$resultado = mysqli_query($con, $sql);

if($resultado == true){
    header("Location:../home.php");
}



