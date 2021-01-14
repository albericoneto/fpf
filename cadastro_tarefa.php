<?php
    require_once("bloqueio.php");

    $sql = "SELECT * FROM categoria_tarefa";
    $result_cat = mysqli_query($con, $sql);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel='stylesheet prefetch' href='//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'>
    <title>Cadastrar Projeto</title>
</head>
<body>
<?php  require_once("header.php");?>

    <h3>Cadastro de Projeto</h3>
    <form action="db/cad_tarefa.php" method="post">
        Nome do projeto:   
        <input type="text" name="titulo" required> <br>
        Data de início: 
        <input type="date" name="data_inicial" required> <br>
		Data de Termino: 
        <input type="date" name="data_final" required> <br>
		Valor do projeto:
		<input type="text" id="demo" name="valor" onKeyPress="return(moeda(this,'.',',',event))" required> <br>
		Risco:
        <select name="categoria" id="" required>
        <?php 
        foreach($result_cat as $dados){ ?>   
            <option value="<?php echo $dados['cod']?>"><?php echo $dados['nome']?></option>
        <?php } ?>
        </select> <br>
        Participantes: 
        <textarea name="descricao" id="" cols="30" rows="10"></textarea> <br>
		
        <button>Cadastrar</button>
    </form>
    <?php require_once "footer.php"; ?>


	<script>
		function moeda(a, e, r, t) {
			let n = ""
			  , h = j = 0
			  , u = tamanho2 = 0
			  , l = ajd2 = ""
			  , o = window.Event ? t.which : t.keyCode;
			if (13 == o || 8 == o)
				return !0;
			if (n = String.fromCharCode(o),
			-1 == "0123456789".indexOf(n))
				return !1;
			for (u = a.value.length,
			h = 0; h < u && ("0" == a.value.charAt(h) || a.value.charAt(h) == r); h++)
				;
			for (l = ""; h < u; h++)
				-1 != "0123456789".indexOf(a.value.charAt(h)) && (l += a.value.charAt(h));
			if (l += n,
			0 == (u = l.length) && (a.value = ""),
			1 == u && (a.value = "0" + r + "0" + l),
			2 == u && (a.value = "0" + r + l),
			u > 2) {
				for (ajd2 = "",
				j = 0,
				h = u - 3; h >= 0; h--)
					3 == j && (ajd2 += e,
					j = 0),
					ajd2 += l.charAt(h),
					j++;
				for (a.value = "",
				tamanho2 = ajd2.length,
				h = tamanho2 - 1; h >= 0; h--)
					a.value += ajd2.charAt(h);
				a.value += r + l.substr(u - 2, u)
			}
			return !1
		}
		
		

	</script>