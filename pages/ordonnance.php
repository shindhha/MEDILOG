<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>MEDILOG - Ordonnance</title>

	<!-- Lien vers mon CSS -->
	<link href="../css/monStyle.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="../css/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />

</head>

<body>
	<?php
	try{
		$hostname =  '127.0.0.1';
		$dbname = 'medilog';
		$user = 'admin';
		$password = 'admin';

		$pdo = new PDO('mysql:host='.$hostname.';dbname='.$dbname.';charset=utf8',$user,$password);

		$tabTypes = $pdo->query("SELECT DISTINCT(type) FROM medicaments ORDER BY type");
		$tabLab = $pdo->query("SELECT DISTINCT(labo) FROM medicaments ORDER BY labo");

		$requete = "SELECT designation,type,labo,id FROM medicaments WHERE";

		$param = array();

		$conditionLab = isset($_POST['lab']) && $_POST['lab'] != "TOUS";
		$conditionMedic = isset($_POST['typeMedic']) && $_POST['typeMedic'] != "TOUS";
		$conditionDesign = isset($_POST['Designation']) && $_POST['Designation'] != "";



		
		
		
		if ($conditionDesign) {
			$requete = $requete . " Designation LIKE :designation";
			$param['designation'] = "%". $_POST['Designation'] ."%";
		}
		
		

		if ($conditionLab) {
			$requete = $requete . " AND Labo = :lab";
			$param['lab'] = $_POST['lab'];

		} 
		if ($conditionMedic) {
			$requete = $requete . " AND Type = :typeMedic";
			$param['typeMedic'] = $_POST['typeMedic'];
		}
		$result = $pdo->prepare($requete);

		$result->execute($param);

		$tab = $result->fetchAll();

		var_dump($requete);

		if (isset($_POST['insertMedicament'])) {
			echo $_POST['insertMedicament'];
			$insert = $pdo->prepare("INSERT INTO ordonnance (idMedicament) VALUES (:idMedic)");
			$insert->execute(array("idMedic" => $_POST['insertMedicament']));
		}
		if (isset($_POST['supprimer'])) {
			echo $_POST['supprimer'];
			$pdo->query("DELETE FROM ordonnance");
		}


	} catch ( Exception $e ) {
		echo $e->getMessage();

	}
	?>
	<table class="entete largeur100">
		<tr>
			<!--- Ligne d'Entete -->
			<td class="largeurColonne20 sansCadre texteCentre">
				<!--- Colonne Logo -->
				<a href="../index.html" ><img src="../images/medicaments2.jpg" id="imageHaut"/></a>
			</td>
			<td class="sansCadre texteCentre">
				<!--- Colonne Titre -->
				<h1>APPLICATION<br/>MEDILOG</h1>
			</td>
		</tr>

		<tr>
			<!--- Ligne Présentation -->
			<td colspan=2 class="largeur100 texteCentre" >
				<!--- Colonne Présentation -->
				<h2>
					-- Création d'une ordonnance -- 
					<form method="post">
						<input type="hidden" name="supprimer" value="test">
						<button type="submit">
							<span class="material-symbols-outlined">
								delete
							</span>
						</button>
					</form>
					
				</h2>
			</td>
		</tr>
	</table>
	<table class="largeur100 contenu"> <!--- Table contenant le mode d'emploi et les images-->
		<tr>
			<!--- Ligne Formulaire de recherche -->
			<td class="largeurColonne40">
				<h1>Recherche</h1>
				<form method="post">
					Désignation à rechercher :
					<input type="hidden" name="lab" value="TOUS">
					<input type="hidden" name="typeMedic" value="TOUS">
					<input type="hidden" name="Designation" value="">
					<button type="submit">
						<span class="material-symbols-outlined">
							delete
						</span>
					</button>
				</form>
				<form method="post" action="#" ID="formRecherche">
					<h2>
						

						<input class="form-control" name="Designation" id="Designation" value="<?php if (isset($_POST['Designation'])) { echo $_POST['Designation']; } ?>" placeholder="Tapez un mot à rechercher">

						Type de médicament : 
						<select ID="typeMedic" name="typeMedic" class="form-control">
							<option>TOUS</option>
							<?php
							foreach($tabTypes as $i) {
								if (isset($_POST['typeMedic']) && $_POST['typeMedic'] == $i['type']) {
									echo "<option selected='selected'>" . $i['type'] . "</option>";
								} else {
									echo "<option>" . $i['type'] . "</option>";
								}

							}
							?>
						</select><br/>
						Laboratoire : 
						<select ID="labo" name="lab" class="form-control">
							<option>TOUS</option>
							<?php

							foreach($tabLab as $i) {
								if (isset($_POST['lab']) && $_POST['lab'] == $i['labo']) {
									echo "<option selected='selected'>" . $i['labo'] . "</option>";
								} else {
									echo "<option>" . $i['labo'] . "</option>";
								}
							}
							?>
						</select><br/>
						<input type="submit" class="form-control btn btn-info"></input>
					</h2>												
				</form>
			</td>	
			<td>
				<h1>Ordonnance</h1> <!-- Ligne contenu de l'ordonnance -->
				<table class="largeur100 table-striped">
					<tr>
						<th>Désignation</th>
						<th>Présentation</th>
						<th>Laboratoire</th>
					</tr>
					<?php 
					$ordo = $pdo->query("SELECT * FROM ordonnance
						JOIN medicaments
						ON ordonnance.idMedicament = medicaments.id");
					while ($ligne = $ordo->fetch()) {

						echo "<tr>"
						."<td>" .$ligne['Designation'] . "</td>"
						."<td>" .$ligne['Type'] . "</td>"
						."<td>" .$ligne['Labo'] . "</td>"
						."</tr>";
					}
					?>
				</table>
			</td>			
		</tr>
	</table>
	<table class="largeur100 contenu">
		<tr>
			<!--- Ligne Résultat de la recherche -->
			<td>
				<table class="table table-striped contenu">
					<?php

					foreach($tab as $i) {

						echo "<tr>" 
						. "<td>" . $i['designation'] . "</td>"
						. "<td>" . $i['type'] . "</td>"
						. "<td>" . $i['labo'] . "</td>"
						."<td> <form method='POST' action='#'>
						<input name='insertMedicament' type='hidden' value=". $i['id'].">
						<input name='Labo' type='hidden' value=". $i['labo'] .">
						<button type='submit' class='form-control btn btn-info' name='AddMedoc' value='AddMedoc' /><span class='material-symbols-outlined'>
						shopping_cart
						</span></button>
						</form></td>"
						."</tr>";
					} 
					?>
				</table>
			</td>			
		</tr>		
	</table>

	<table class="largeur100 basDePage">   <!--- Table contenant le menu et le logo de l'iut-->
		<tr>
			<!--- Ligne Menu Bas -->
			<td class="largeurColonne80 texteCentre">
				<!--- Menu Bas -->
				<div class="texte">
					Menu : 
					<a href="../index.html" >Accueil</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<a href="recherche.php">Recherche d'un médicament</a>   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<a href="ordonnance.php">Création ordonnance</a>   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</div>
			</td>
			<td class="texteCentre">
				<!--- Logo et lien IUT -->
				<div class="texte">
					<br/>Réalisé par <br/><a href="http://www.iut-rodez.fr" target="_blank"><img src="../images/LogoIut.png" alt="Logo IUT Rodez" ID="logoIUT"/></a><br/><br/>
				</div>
			</td>				
		</tr>
	</table>

</body>
</html>