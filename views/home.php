<?php  

if(!isset($_SESSION)) { 
	session_start(); 
} 

if (!isset($_SESSION['id_usuario'])) header("location: ../index.php?erro_falha=1");

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Rede Alex</title>

	<link rel="stylesheet" type="text/css" href="css/index.css">

	<!--Import Google Icon Font-->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	
	<!--Import materialize.css-->
	<link type="text/css" rel="stylesheet" href="materialize/css/materialize.min.css"  media="screen,projection"/>

	

	<!--Let browser know website is optimized for mobile-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

	<!-- jquery - link cdn -->
	<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('.sidenav').sidenav();

			$('.dropdown-trigger').dropdown();

			$('input#input_text, textarea#textarea2').characterCounter();

			function atualizarAmigos(){
				//carregar os amigos
				$.ajax({
					url: '../model/recuperar_amigos.php',
					method: 'post',
					success: function(data){
						$("#todos_meus_amigos").html(data);
					}
				});
			}	

			atualizarAmigos();

			$("#btn_post").click( function(){	
				var valor_input = $("#txt_post").val();

				if (valor_input.length > 0) {

					
					$.ajax({
						url: '../model/inserir_post.php',
						method: "post",
						data: $("form").serialize(),

						success: function (data){
							$('#txt_post').val('');
							atualizarPosts(); 
							atualizarAmigos();
						}
				 	}); // Fechamento do Ajaax */ 
				}  
				
			});
			

			function atualizarPosts(){
				//carregar os posts
				$.ajax({
					url: '../model/recuperar_post.php',
					method: 'post',
					success: function(data){
						$("#posts").html(data);
					}
				});
			}

			function atualizarAmigos(){
				//carregar os amigos
				$.ajax({
					url: '../model/recuperar_amigos.php',
					method: 'post',
					success: function(data){
						$("#todos_meus_amigos").html(data);
					}
				});
			}	

			atualizarAmigos();
			atualizarPosts();

		});



	</script>

</head>
<body>
	<?php include('menu.php')?>


	<div class="conteiner">
		<div class="row">
			<!-- Conteiner do lado esquerdo -->
			<div class="col s2 "></div>
			
			<!-- Conteiner do meio -->
			<div class="col s6 ">
				<!-- Formulário de post -->
				<div class="card-panel">
					<div>
						<div class="row">
							<form class="col s12">
								<p style="font-size: 16px;" class="fontePadrao">Olá, <?php 
								$nome = $_SESSION['nome'];
								$sobrenome = $_SESSION['sobrenome'];
								echo "<b>$nome $sobrenome! </b> Em quê você está pensando? Conte para seus amigos"; 
								?></p>

								
								<div class="row center">
									<div class="input-field col s9">

										<!-- formulário -->
										<form id="form_post">
											<textarea id="txt_post" name="txt_post"  class="materialize-textarea" required="" maxlength="1000"></textarea>
											<label for="txt_post"><i class="left material-icons">mode_edit</i>Poste algo aqui</label>
										</div>
									</form>
									<div class="input-field col s3">
										<button type="button" id="btn_post" class="btn blue">Postar</button>
									</div>
									
								</div>
							</form>
						</div>
					</div>
				</div>
				<!-- Fim do Formulário de post -->

				<div class="card-panel">
					<h5 class="center-align"> Feed Notícia </h5>
					<!-- os posts vão ser impresso aqui -->
					<div id="posts"></div>
				</div>

			</div>


			<div class="col s1" ></div>
			<!-- Conteiner do lado direito -->
			<div class="col s3 ">
				<div class="card-panel">
					<h5><a href="procuraramigos.php"><i class="left material-icons">search</i> Procurar amigos </a></h5>
				</div>
				<div class="card-panel">
					<p style="font-size: 20px;" class="center">Todos meus amigos</p><br>
					<div id="todos_meus_amigos">
						
					</div>
				</div>
			</div>
		</div>


	</div>









	<?php include('rodape.php')?>

	<!--JavaScript at end of body for optimized loading-->
	<script type="text/javascript" src="materialize/js/materialize.min.js"></script>
</body>
</html>