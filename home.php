    <?php  require_once("header.php");?>
    <main class="container">
        <form action="" class="row">
            <div class="input-field col s10">
                <input type="text" name="busca" id="busca">
                <label for="busca">Digite para buscar</label>
            </div>
            <div class="input-field col s2">
                <button class="btn"><i class="material-icons">search</i></button>
            </div>
            
        </form>
        <table class="striped ">
            <thead>
                <tr>
                <?php 
                    if($_SESSION['perfil'] == 1){
                ?>
                   <!-- <th>Criador</th>-->
                <?php } ?>
                    <th>Nome do projeto</th>
                    <th>Data início</th>
                    <th>Data término</th>
                    <th class="hide-on-small-only"> Valor do projeto</th>
					<th class="hide-on-small-only"> Risco</th>
					<th class="hide-on-small-only"> Participantes</th>
                    <th>Opções</th>
                </tr>
            </thead>
            <?php foreach ($result_tarefas as $tarefa){ ?>
            <tr>
            <?php 
                if($_SESSION['perfil'] == 1){
            ?>
               <!-- <td> <?= $tarefa['nome']?></td>-->
            <?php } ?>
                <td><a href="visualizar_tarefa.php?cod=<?= $tarefa['codt']?>"><?= $tarefa['titulo']?></a></td>
                <td><?= date("d/m/Y", strtotime($tarefa['data_inicial']));?></td>
                <td><?= date("d/m/Y", strtotime($tarefa['data_final']));?></td>
				<td><?= $tarefa['valor']?></td>
                <?php 
                    $cod_tarefa = $tarefa['categoria_cod'];
                    $sql = "SELECT * FROM categoria_tarefa WHERE cod = $cod_tarefa";
                    $result_cat = mysqli_query($con, $sql);
                    $cat_tarefa = mysqli_fetch_array($result_cat);
                ?>
                <td class="hide-on-small-only"><?= $cat_tarefa['nome']?></td>
				<td class="hide-on-small-only"><?= $tarefa['descricao']?></td>
                <td>
                    <a href="editar_tarefa.php?cod=<?= $tarefa['codt']?>"><i class="material-icons">edit</i></a>
                    <?php 
                        if($_SESSION['perfil'] == 1){
                    ?>
                    <a href=""data-toggle="modal" data-target="#confirm" ><i class="material-icons">delete</i></a>
                    <?php 
                        }
                    ?>
					<button type="button" class="btn btn-primary btn-lg" onclick="preencherDados('<?= $tarefa['titulo']?>', '<?= $tarefa['valor']?>', '<?= $cat_tarefa['nome']?>')" data-toggle="modal" data-target="#myModal">
					  Simular investimento
					</button> 
                </td>
            </tr>
            <?php } ?>
			
    <!--Modal excluir-->	
			<div class="modal fade" id="confirm" role="dialog">
			  <div class="modal-dialog modal-md">

				<div class="modal-content">
				  <div class="modal-body">
						<p> QUER REALMENTE FAZER ISSO??</p>
				  </div>
				  <div class="modal-footer">
					<a href="db/excluir_tarefa.php?cod=<?= $tarefa['codt']?>" type="button" class="btn btn-danger" id="delete">Apagar Registo</a>
						<button type="button" data-dismiss="modal" class="btn btn-default">Cancelar</button>
				  </div>
				</div>

			  </div>
			</div>

	<!-- Modal Simular -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel"></h4>
				
			  </div>
			  <div class="modal-body">
			    <label>Nome do Projeto</label>
				<input id="nomeProjeto" name="valor" type="text" class="input" readonly="true">
			  	<label>Valor do Projeto</label>
				<input id="valorProjeto" name="valor" type="text" class="input" readonly="true">
				<label>Risco do Projeto</label>
				<input id="riscoProjeto" name="nome" value="<?php $tarefa['valor']?>" type="text" class="input" readonly="true"><br>
				<label>Valor do Investimento</label>
				<input id="valorInvestimento" name="investimento" type="text" placeholder="Digite o valor do Investimento" onKeyPress="return(moeda(this,'.',',',event))" class="input">
				<label>Retorno</label>
				<input id="retorno"  type="text" class="input" readonly="true">
			    
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
				<button id="btAtualizarValor" onclick="calcularInvestimento()" type="button" class="btn btn-primary">Simular</button>
			  </div>
			</div>
		  </div>
		</div>
        </table>
		
       
    </main>
   <?php require_once "footer.php"; ?>
   
   <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
   <script src='//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script>
   
   <script>
   
   function preencherDados(titulo, valor, nome){
	   $('#valorProjeto').val(valor);
	   $('#nomeProjeto').val(titulo);
	   $('#riscoProjeto').val(nome);
   }
   function calcularInvestimento (){
	   let valorProjeto = parseFloat($('#valorProjeto').val());
	   let valorInvestimento = parseFloat($('#valorInvestimento').val());
	   let riscoProjeto = $('#riscoProjeto').val();
	   
	   if (valorInvestimento < valorProjeto){
	     alert('Valor do investimento menor que o valor do projeto!!');
		   $('#valorInvestimento').val('');
	   }else {
		   if(riscoProjeto == 'Baixo'){
			   let retorno = (valorInvestimento * 5) / 100;
			   retorno = retorno + valorInvestimento;
			   $('#retorno').val(retorno);
		   }  else if(riscoProjeto == 'Medio'){
			   let retorno = (valorInvestimento * 10) / 100;
			   retorno = retorno + valorInvestimento;
			   $('#retorno').val(retorno);
		   }  else if(riscoProjeto == 'Alto'){
			   let retorno = (valorInvestimento * 20) / 100;
			   retorno = retorno + valorInvestimento;
			   $('#retorno').val(retorno);
		   }
	   }
	  
   }
	   
   </script>