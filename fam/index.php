<!DOCTYPE html>
<html lang="pt-BR">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Index</title>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

	<h1>Bem-vindo ao sistema!</h1>



	<nav id="navLinks">
		<a id="linkLogin" href="logar.php" style="display:none;">Página de Login</a>
		<a id="linkCadastro" href="cadastro.php" style="display:none;">Página de Cadastro</a>
		<button id="logoutButton">Sair</button>
		<a id="linkRegistrosU" href="registros_usuarios.php" style="display:none;">Registros de usuarios</a>
		<a id="linkRegistrosP" href="cadastro_produtos.php" style="display:none;">Registros de produtos</a>
	</nav>

	<main id="main">
		<a id="box_luxo" href="box_luxo.php" >Box De Luxo</a>
		<a id="bubble_box" href="bubble_box.php" >Bubble na Box</a>
		<a id="bubble_acrilico" href="bubble_acrilico.php" >Bubble Acrilico</a>
		<a id="natal" href="natal.php" >Natal</a>
		<a id="dia_das_maes" href="dia_das_maes.php" >Dia das Mães</a>
		<a id="caneca" href="caneca.php">Caneca</a>
	</main>


	<script>
		$(document).ready(function() {
			// Simulação de chamada AJAX para verificar o estado do usuário
			$.ajax({
				url: 'verificar_usuario.php', // Script que verifica o estado do usuário
				method: 'GET',
				dataType: 'json',
				success: function(response) {
					console.log(response); // Adicione esta linha para depurar
					const usuarioLogado = response.logado;
					const tipoUsuario = response.tipo;

					if (!usuarioLogado) {
						$('#linkLogin').show();
						$('#linkCadastro').show();
						$('#logoutButton').hide();
						$('#linkRegistrosU').hide();
						$('#linkRegistrosP').hide();
					} else {
						$('#logoutButton').show();
						if (tipoUsuario === 'administrador') {
							$('#linkRegistrosU').show();
							$('#linkRegistrosP	').show();
						}
					}
				},
				error: function() {
					$('#navLinks').append('<span style="color:red;">Erro ao verificar estado do usuário.</span>');
				}
			});

			$('#logoutButton').on('click', function() {
                $.ajax({
                    url: 'logout.php', // URL do script de logout
                    type: 'POST',
                    success: function(response) {
                        $('#mensagem').html('<div style="color:green;">' + response.message + '</div>');
                        // Redireciona após 1 segundo
                        setTimeout(function() {
                            window.location.href = 'index.php'; // Redireciona para a página inicial
                        }, 1);
                    },
                    error: function() {
                        $('#mensagem').html('<div style="color:red;">Erro ao realizar logout.</div>');
                    }
                });
            });
		});
	</script>
</body>

</html>