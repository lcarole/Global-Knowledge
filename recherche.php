<html>
<!-- Applique le fichier schema.css à cette page -->
<head><link rel="stylesheet" type="text/css" href="schema.css" /></head>
<body>
	<!-- Réutilise les fonctions de la page précédente afin de pouvoir naviguer vers d'autres ressources sans avoir à repasser par la première page. -->
	<script>
		function my_function(ele){
			var x = ele.innerHTML;
			var link =  "recherche.php";
	   		var post_var = {nom:x, event: "ok"};
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

	<!-- Applique les règles de la div affichage qui permettra de centrer le contenu au centre de la page -->
	<div class="affichage">
	<?php
		// Vérifie si l'utilisateur a entré au moins une information requise.
		if(!empty($_POST["id"]) || !empty($_POST["nom"])){
			// Se connecte à la base de données Ressources.
			$db = mysqli_connect('localhost', 'root','','Ressources','3306');
			// Définit le jeu de caractères utiliser entre le serveur et le client.
			$db->set_charset("utf8");

			//Si un ID a été saisie, il vérifie que c'est bien un nombre.
			if(!empty($_POST["id"]) && is_numeric($_POST["id"])){
				//Convertit le contenu de la variable $_POST["id"] en chaîne de caractères.
				$string = strval($_POST["id"]);
				//Récupère le nom correspondant à $_POST["id"].
				$nom = $db->query("select nom from Services where idService = $string")->fetch_assoc();
				//Stocke le nom dans une variable sous forme de chaîne de caractères.
				$nom = $nom["nom"];
			}

			else if(!empty($_POST["nom"])){
				//Stocke le nom dans une variable sous forme de chaîne de caractères.
				$nom = $_POST["nom"];
			}

			//Cette première requête permet de récupérer les servcies dépendant de celui sélectionné.
			$req = "select distinct nom from Services inner join Dépendances on Services.idService = Dépendances.service where dépendance = (select idService from Services where nom = '$nom')";
			//Récupère les résultat de la requète.
			$resultat = $db->query($req);
			//Récupère la première ligne de la requète.
			$ligne = $resultat->fetch_assoc();
			//Cette seconde requête affichera les services dont dépend le service sélectionné.
			$req2 = "select distinct nom from Services inner join Dépendances on Services.idService = Dépendances.service where idService in (select dépendance from Dépendances inner join Services on Dépendances.service = Services.idService where nom = '$nom')";
			//Stocke le  résultat de la seconde requête
			$resultat2 = $db->query($req2);
			//Récupère la première ligne de la seconde requête.
			$ligne2 = $resultat2->fetch_assoc();
			$n=0;
			$trait=0;
			
			if($ligne || $ligne2){
				?>
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"/>
				<!-- Rappèle le script Javascript afin qu'il fonctionne -->
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

				<div class="ligne1"><?php
				//Boucle qui va permettre d'afficher les services dépendant dans des blocks.
				while($ligne){
					//Affiche un service de $ligne
					echo '<div onclick="my_function(this)" id="block' . $n. '"class="contenu">' .  $ligne["nom"] . ' </div>';
					//Récupère la ligne suivante.
					$ligne = $resultat->fetch_assoc();
					//Augment le nombre de lignes de 1.
					$n++;
				}?></div>
				<!-- Crée une div ligne dans la page -->
				<div class="ligne1"><?php
				//Boucle permettant de tracer un trait vertical en dessous de chaque block.
				while($n!=0){
					?><hr width="1.5px" size="70px"><?php
					$n=$n-1;
					$trait++;
				}?></div>
				<!-- Appelle une autre div ligne 1 qui va servir à afficher un trait horizontale cette fois-ci. -->
				<div class="ligne1"><?php
				//Si il y a plus d'un trait vertical, le programme va tracer un trait horizontale en fonction du nombre de blocks.
				if($trait>1){
					$n = $trait-2;
					$x = 50;
					for($i=0; $i<$n;$i++){
						$x=$x+8;
					}
					if($n==1){
						$x=$x+8;
					}
					if($x>88){
						$x = 88;
					}
					?><hr width="<?php echo $x; ?>%" size="3px"><?php
				}
				?></div>
				<div class="ligne1"><?php
				//Si il y a plus d'un trait vertical, trace un autre trait vertical qui va relier le trait horizontale au bloc contenant le nom du service sélectionné.
				if($trait>1){
					?><hr width="1.5px" size="70px">
					<?php
				}?></div>
				<!-- Crée un bloc qui va afficher le nom du service sélectionné. -->
				<div class="titre"><?php echo $nom; ?></div>
				<?php
				//Récupère le nombre de lignes de la seconde requête et le place dans la variable $trait.
				$trait=mysqli_num_rows(mysqli_query($db,"select distinct nom from Services inner join Dépendances on Services.idService = Dépendances.service where idService in (select dépendance from Dépendances inner join Services on Dépendances.service = Services.idService where nom = '$nom')"));
				
				//Si il y a plus d'une ligne, crée un trait verticale juste en dessous du bloc précédent.
				if($trait>1){
					?>
					<div class="ligne2">
					<hr width="1.5px" size="70px">
					</div><?php
				}?>

				<!-- Crée une div ligne2 -->
				<div class="ligne2"><?php
				//Crée un trait orizontale d'une longueur variable selon le nombre de trait verticaux à venir.
				if($trait>1){
					$n = $trait-2;
					$x = 50;
					for($i=0; $i<$n;$i++){
						$x=$x+8;
					}
					if($n==1){
						$x=$x+8;
					}
					if($x>100){
						$x = 100;
					}
					?><hr width="<?php echo $x; ?>%" size="3px"><?php
				}?></div>
				
				<!-- Crée une autre div afin d'afficher les traits verticuax qui vont relier les traits horizontaux aux blocs suivants. -->
				<div class="ligne2"><?php
				while($trait!=0){
					?><hr width="1.5px" size="70px"><?php
					$trait--;
				}?>
				</div>

				<!-- Dans cete div, nous allons afficher tous les services qui dépendent du service sélectionné. -->
				<div class="ligne2">
				<?php
				while($ligne2){
					echo '<div onclick="my_function(this)" id="block' . $n. '"class="contenu">' .  $ligne2["nom"] . ' </div>';
					$ligne2 = $resultat2->fetch_assoc();
				}?></div>
				<?php
			}
			//Si jamais le service sélectionné n'a ni besoin, ni dépendance, cela affichera un message à l'utilisateur.
			else{
				echo "Cette ressource n'a aucune dépendance et ne dépend de rien.";
			}
			//Met fin à la connection à la base de données.
			mysqli_close($db);
		}
		//Si jamais il n'y a ni ID, ni nom, alors le programme affichera un message à l'utilisateur.
		else{
			echo "Vous n'avez choisi aucune ressource.";
		}
	?>
	<!-- Formulaire qui va créer un bouton "Retour" afin de pouvoir revenir sur la page ou se trouve la liste complète des ressources du service informatique (schema_ressources.php). -->
	<br><form name="ressources" method="post" action="schema_ressources.php">
		<input type="submit" name="valider" value="Retour"/>
	</form>
</div>
</body>
</html>