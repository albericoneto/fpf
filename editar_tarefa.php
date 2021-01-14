<?php
    require_once("bloqueio.php");

    $sql = "SELECT * FROM categoria_tarefa";
    $result_cat = mysqli_query($con, $sql);
    $cod = $_GET['cod'];
    $sql2 = "SELECT * FROM tarefas where cod = $cod";
    $result_tarefas = mysqli_query($con, $sql2);
    $tarefa = mysqli_fetch_array($result_tarefas);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edição de tarefa - Tarefas Diárias</title>
</head>
<body>
<?php  require_once("header.php");?>

    <h3>Editar de Tarefa</h3>
    <form action="db/edit_tarefa.php" method="post">
        <input type="hidden" value="<?=$cod?>" name="cod">
        Título:   
        <input type="text" name="titulo" value="<?= $tarefa['titulo']?>"> <br>
        Data Inicial: 
        <input type="date" name="data_inicial" value="<?= $tarefa['data_inicial']?>"> <br>
        Data Final: 
        <input type="date" name="data_final" value="<?= $tarefa['data_final']?>"> <br>
        Valor do projeto:
		<input type="text" name="valor" value="<?= $tarefa['valor']?>" onKeyPress="return(moeda(this,'.',',',event))"> <br>
		Risco:
        <select name="categoria" id="" required>
        <?php 
        foreach($result_cat as $dados){ ?>   
            <option value="<?php echo $dados['cod']?>"><?php echo $dados['nome']?></option>
        <?php } ?>
        </select> <br>
        Participantes: 
        <textarea name="descricao" id="" cols="30" rows="10" value="<?= $tarefa['descricao']?>"></textarea> <br>
        <button>Salvar</button>
    </form>
    <?php require_once "footer.php"; ?>