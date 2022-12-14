<?php session_start() ;?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>MEDILOG - Ordonnance</title>

	<!-- Lien vers mon CSS -->
	<link href="css/monStyle.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />

</head>

<body>
	<?php
	spl_autoload_extensions(".php");
	spl_autoload_register();
	use yasmf\HttpHelper;
	$conditionLab = isset($_POST['lab']) && $_POST['lab'] != "TOUS";
	$conditionMedic = isset($_POST['typeMedic']) && $_POST['typeMedic'] != "TOUS";
	$conditionDesign = isset($_POST['Designation']);
	?>
	<div class="container-fluid ">
		<div class="row justify-content-center">
			
			<div class="col-md-10 align-items-center border-1 ">
				<!--- Ligne d'Entete -->
			<!--- Colonne Logo -->
				<div class="border-1 p-4">
					<div class="d-flex flex-row text-center align-items-center">

						<a href="index.php" class="col-md-2" ><img src="images/medicaments2.jpg" id="imageHaut"/></a>
						<!--- Colonne Titre -->
						<h1 class="col-md-12">APPLICATION<br/>MEDILOG</h1>
					</div>
					<!--- Ligne Présentation -->
					<!--- Colonne Présentation -->
					<h2 class="text-center">	-- Création d'une ordonnance -- </h2>	
				</div>
				<div class="d-flex flex-row">
					<div class="col-md-4 text-center border-1 p-4" > <!--- Table contenant le mode d'emploi et les images-->
						<!--- Ligne Formulaire de recherche -->
						<div class="justify-content-center d-flex flex-row ">
							<h1>Recherche</h1>
							<form method="post">

								<input type="hidden" name="lab" value="TOUS">
								<input type="hidden" name="typeMedic" value="TOUS">
								<input type="hidden" name="Designation" value="">
								
								<input type="submit" class="material-symbols-outlined form-control btn btn-danger" value="delete">


							</form>
						</div>
						Désignation à rechercher :
						<form method="post" action="#" ID="formRecherche">
							
							<input class="form-control" name="Designation" id="Designation" value="<?php if (isset($_POST['Designation'])) { echo $_POST['Designation']; } ?>" placeholder="Tapez un mot à rechercher">

							Type de médicament : 

							<select ID="typeMedic" name="typeMedic" class="form-select">
								<option>TOUS</option>
								<?php


								while($row = $tabTypes->fetch()) {

									if (isset($_POST['typeMedic']) && $_POST['typeMedic'] == $row['Type']) {
										echo "<option selected='selected'>" . $row['Type'] . "</option>";
									} else {
										echo "<option>" . $row['Type'] . "</option>";
									}

								}
								?>
							</select>
							Laboratoire : 
							<select ID="labo" name="lab" class="form-select">
								<option>TOUS</option>
								<?php

								while($row = $tabLab->fetch()) {
									if (isset($_POST['lab']) && $_POST['lab'] == $row['Labo']) {
										echo "<option selected='selected'>" . $row['Labo'] . "</option>";
									} else {
										echo "<option>" . $row['Labo'] . "</option>";
									}
								}
								?>
							</select><br/>
							<input type="submit" class="form-control" value="Envoyer">

						</form>
					</div>
					<div class="col-md-8 border-1 p-4">
						<div class="justify-content-center d-flex flex-row">
							<h1>Ordonnance</h1> <!-- Ligne contenu de l'ordonnance -->
							<form method="post">
								<input type="hidden" name='typeMedic' value="<?php if($conditionMedic) { echo $_POST['typeMedic']; } else { echo "TOUS";}?>">
								<input name='lab' type='hidden' value="<?php if($conditionLab) { echo $_POST['lab']; } else { echo "TOUS";}?>">
								<input type="hidden" name="supprimer" value="test">
								<input type="hidden" name="Designation"  value="<?php if (isset($_POST['Designation'])) { echo $_POST['Designation']; } ?>">
								<input type="submit" class="material-symbols-outlined form-control btn btn-danger" value="delete">
							</form>
						</div>
						<table class="w-100 table table-striped table-borderless">
							<tr>
								<th>Désignation</th>
								<th>Présentation</th>
								<th>Laboratoire</th>
							</tr>
							<?php 
							while ($ligne = $ordo->fetch()) {

								echo "<tr>"
								."<td>" .$ligne['Designation'] . "</td>"
								."<td>" .$ligne['Type'] . "</td>"
								."<td>" .$ligne['Labo'] . "</td>"
								."</tr>";
							}
							?>
						</table>
					</div>
				</div>

				<div class="border-1 p-4">
					<h2 class="text-center"> Resultat de la recherche </h2>
					<table class="table table-striped border-1 p-4">
						<?php

						foreach($tab as $i) {

							echo "<tr>"
							. "<td>" . $i['designation'] . "</td>"
							. "<td>" . $i['type'] . "</td>"
							. "<td>" . $i['labo'] . "</td>";
							?>
							<td> <form method='POST' action='#'>
								<input name='insertMedicament' type='hidden' value="<?php  echo $i['id']; ?>">
								<input name='lab' type='hidden' value="<?php if($conditionLab) { echo $i['labo']; } else { echo "TOUS";}?>">
								<input type="hidden" name='typeMedic' value="<?php if($conditionMedic) { echo $i['type']; } else { echo "TOUS";}?>">
								<input type='hidden' name='Designation' value="<?php if (isset($_POST['Designation'])) { echo $_POST['Designation']; } ?>">
								<input type="submit" class="material-symbols-outlined form-control btn btn-info" value="shopping_cart">


							</form>

							<?php
						} 
						?>
					</table>
				</div>
				<!--- Table contenant le menu et le logo de l'iut-->
				<table class="w-100 basDePage">   
					<tr>
						<!--- Ligne Menu Bas -->
						<td class="largeurColonne80 text-center">
							<!--- Menu Bas -->
							<div class="texte">
								Menu : 
								<a href="index.php" >Accueil</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<a href="index.php?action=searchPage">Recherche d'un médicament</a>   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<a href="index.php?action=ordoPage">Création ordonnance</a>   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							</div>
						</td>
						<td class="text-center">
							<!--- Logo et lien IUT -->
							<div class="texte">
								<br/>Réalisé par <br/><a href="http://www.iut-rodez.fr" target="_blank"><img src="images/LogoIut.png" alt="Logo IUT Rodez" ID="logoIUT"/></a><br/><br/>
							</div>
						</td>				
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>

</body>
</html>