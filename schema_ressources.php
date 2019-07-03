<html>
<!-- Permet d'appliquer le fichier schema.css à cette page web. -->
<head> <link rel="stylesheet" type="text/css" href="schema.css" /> </head>
<body>
	<!-- Dans cette balise script, on va définir deux fonctions en javascript : -->
	<script>
		//La fonction my_function permet de cliquer sur le nom d'une ressource et de récupérer ce même nom sous la forme d'une variable $_POST.
		function my_function(ele){
			var x = ele.innerHTML;
			var link =  "recherche.php";
	   		var post_var = {nom:x, event: "ok"};
			redirect_post(link,post_var);
		}

		//La fonction redirect_post permet de rediriger l'utilisateur vers une autre page lorsqu'il clique sur un élément.
		function redirect_post(link, post_var) {
		    var form = '';
		    $.each(post_var, function(key, value) {
		        form+='<input type="hidden" name="'+key+'" value="'+value+'">';
		    });
		    $('<form class="hidden" action="'+link+'" method="POST">'+form+'</form>').appendTo('body').submit();
		}
	</script>
		
	<div class="affichage">
		<?php
			//mysqli_connect permet de se connecter à la base de données en entrant respectivement et dans l'ordre : l'adresse du serveur, le nom d'utilisateur, le mot de passe, le nom de la base de données et le port. 
			$db = mysqli_connect('localhost', 'root','','Ressources','3306'); 
			// Définit le jeu de caractères utiliser entre le serveur et le client.
			$db->set_charset("utf8");
			
			if(mysqli_connect_errno()){
				echo "Ne peut pas se connecter à la bdd".mysqli_connect_errno();
			}
			
			echo "<br>";
			// Récupère la requête sous une forme de chaîne de caractères.
			$req = "select idService, nom from Services";
			// Récupère le nombre de ligne de la requête ce qui sera utile dans l'utilisation de boucles.
			$nb = mysqli_num_rows(mysqli_query($db,"select * from Services"));
			// Récupère le résultat de la requête.
			$resultat = $db->query($req);
			// Récupère la première ligne du résultat de la requête.
			$ligne = $resultat->fetch_assoc();
			?>
			<!-- Rappele le script précédemment crée avec cette fois-ci un lien sinon il ne fonctionne pas. -->
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"/>
			<script>
				function my_function(ele){
					var x = ele.innerHTML;
					var link =  "recherche.php";
		       		var post_var = {nom: x, event: "ok"};
					alert('ok');
					redirect_post(link,post_var);
				}
					function redirect_post(link, post_var) {
				    var form = '';
				    $.each(post_var, function(key, value) {
				        form+='<input type="hidden" name="'+key+'" value="'+value+'">';
				    });
				    $('<form class="hidden" action="'+link+'" method="POST">'+form+'</form>').appendTo('body').submit();
				}
			</script>
		
			<h1>Liste des ressources :</h1>
			<table>
				<tr>
					<th>Id</th>
					<th>Nom</th>
				</tr>
				<?php
					// Cette boucle permet l'affichage des résultats de la requête précédente.
					while($ligne){
						//La fonction tr va créer une ligne.
						?><tr>
						<!-- Affiche le numéro d'identifiant d'une ressource. -->
						<td class="contenu"><?php echo $ligne["idService"]; ?></td>
						<!-- Affiche le nom de la ressource correspondant à l'identifiant. -->
						<td onclick="my_function(this)" class="contenu2"><?php echo $ligne['nom']; ?></td>
						<!-- Termine la ligne. -->
						</tr>
						<!-- La variable $ligne récupère les informations de la ligne suivante. -->
						<?php $ligne = $resultat->fetch_assoc();
					}
					?>
				</tr>
			</table>

		<br/><form name="ressources" method="post" action="recherche.php">
			<!-- L'utilisateur ne peut entre qu'un numéro de ressource compris entre 1 et le nombre de ressources. -->
		        Entrer le numéro de la ressource : <input type="number" name="id" min="1" max="<?php echo $nb;?>"/>
				<br/> OU <br/>
			<!-- Permet à l'utilisateur d'entrer le nom d'une ressource. -->
		        Entrer le nom de la ressource : <input type="text" name="nom"/><br/>
			<!-- Crée un bouton de validation de la saisie. -->
		        <input type="submit" name="valider" value="OK"/>
		    </form>
		<?php
			// Met fin à la connexion à la base de données.
			mysqli_close($db);
		?>
	</div>
</body>
</html>