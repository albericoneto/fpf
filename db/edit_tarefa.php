<?php

require_once ("conexao.php");
session_start();

$titulo = $_POST['titulo'];
$data_inicial = $_POST['data_inicial'];
$data_final = $_POST['data_final'];
$valor = $_POST['valor'];
$investimento = $_POST['investimento'];
$descricao = $_POST['descricao'];
$cod_usuario = $_POST['cod'];
$categoria = $_POST['categoria'];

$sql = "UPDATE tarefas SET 
            titulo = '$titulo', 
            data_inicial = '$data_inicial', 
            data_final = '$data_final',
            valor = '$valor',
            investimento = '$investimento',			
            descricao = '$descricao',
            categoria_cod = $categoria
            WHERE
            cod = $cod_usuario
        ";
//echo $sql;
$resultado = mysqli_query($con, $sql);

if($resultado == true){
    header("Location:../home.php");
}



