<?php session_start() ;?>
<!DOCTYPE html>
<html lang="fr">
  <head>
		<meta charset="utf-8">
		<title>MEDILOG - Accueil</title>
		<!-- Lien vers mon CSS -->
		<link href="css/monStyle.css" rel="stylesheet">
   </head>

  <body>
	<table class="entete largeur100">
		<tr>
			<!--- Ligne d'Entete -->
			<td class="largeurColonne20 sansCadre texteCentre">
				<!--- Colonne Logo -->
					<a href="index.php" ><img src="images/medicaments2.jpg" id="imageHaut"/></a>
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
						-- Présentation de l'application --
					</h2>
					<div class="texte">	
						Cette application permet aux médecins de générer une ordonnance avec une aide à la recherche de médicaments.<br/><br/>
					</div>
			</td>
		</tr>
	</table>
	<table class="largeur100"> <!--- Table contenant le mode d'emploi et les images-->
		<tr>
			<!--- Contenu -->
			<td class="largeurColonne25 texteCentre" id="cadreModeEmploi">
				<!--- Colonne Mode d'emploi -->
					<div class="texte">	
						Mode d'emploi : <br/><br/>
						Utiliser le menu en bas de la page<br/>pour naviguer dans les différentes rubriques.
					</div>
			</td>
			<td class="texteCentre" id="cadreIcones">
				<!--- Colonne images -->
				<table class="largeur100 sansCadre">
					<tr class="sansCadre">
						<td class="sansCadre largeurColonne33"><img src="images/CabinetMedical.png" alt="image cabinet médical" class="imagesCentre"/></td>
						<td class="sansCadre largeurColonne33"><img src="images/caducee.png" alt="image caducée" class="imagesCentre"/></td>
						<td class="sansCadre"><img src="images/croix.png" alt="image croix médicale" class="imagesCentre"/></td>
					</tr>
					<tr>
						<td class="sansCadre largeurColonne33"><img src="images/steto.png" alt="image stethoscope" class="imagesCentre"/></td>
						<td class="sansCadre largeurColonne33"><img src="images/valise.png" alt="image Valide médicale" class="imagesCentre"/></td>
						<td class="sansCadre"><img src="images/medecin.png" alt="image médecin" class="imagesCentre"/></td>
					</tr>					
				</table>

			</td>			
		</tr>
	</table>
	
	<table class="largeur100 basDePage">   <!--- Table contenant le menu et le logo de l'iut-->
		<tr>
			<!--- Ligne Menu Bas -->
			<td class="largeurColonne80">
				<!--- Menu Bas -->
					<div class="texte">
						Menu : 
						<a href="index.php" >Accueil</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<a href="index.php?action=searchPage">Recherche d'un médicament</a>   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<a href="index.php?action=ordoPage">Création ordonnance</a>   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					</div>
			</td>
			<td>
				<!--- Logo et lien IUT -->
				<div class="texte">
					<br/>Réalisé par <br/><a href="http://www.iut-rodez.fr" target="_blank"><img src="images/LogoIut.png" alt="Logo IUT Rodez" ID="logoIUT"/></a><br/><br/>
				</div>
			</td>				
		</tr>
	</table>

  </body>
</html>