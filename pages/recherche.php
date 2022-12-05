<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/monStyle.css">
    <title>Recherche</title>
</head>
<body class="container largeur100">
    <div class="text-center entete border-1 largeur100">


        <a href="../index.html"><img src="../images/medicaments2.jpg" alt="Médicament" class="logo"></a>

        <h1>APPLICATION<br/>MEDILOG</h1>

        <h2>-- Recherche d'un médicament --</h2>
    </div>
    <?php

    try{
        $hostname =  '127.0.0.1';
        $dbname = 'medilog';
        $user = 'admin';
        $password = 'admin';

        $pdo = new PDO('mysql:host='.$hostname.';dbname='.$dbname.';charset=utf8',$user,$password);

        $tabTypes = $pdo->query("SELECT DISTINCT(type) FROM medicaments ORDER BY type");
        $tabLab = $pdo->query("SELECT DISTINCT(labo) FROM medicaments ORDER BY labo");

        $requete = "SELECT designation,type,labo FROM medicaments WHERE";

        $param = array();

        $conditionLab = isset($_POST['lab']) && $_POST['lab'] != "TOUS";
        $conditionMedic = isset($_POST['designation']) && $_POST['typeMedic'] != "TOUS";
        $conditionDesign = isset($_POST['typeMedic']);

        

        if ($conditionDesign) {
            $requete = $requete . "  Designation LIKE :designation";
            $param['designation'] = "%". $_POST['designation'] ."%";
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

    } catch ( Exception $e ) {
        echo $e->getMessage();
        
    }
    ?>

    
    <div class="largeur100 text-center col">
        <h1>Recherche</h1><br><br>
        <form  method="post" action="recherche.php" >
            <span>Désignation a rechercher :</span>

            <input type="text" class="form-control" name="designation" value="<?php if (isset($_POST['designation'])) { echo $_POST['designation']; } ?>" placeholder="Taper un mot a rechercher">

            <br/>
            <span>Type de médicament :</span>
            <select name='typeMedic' class="form-control">
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
            </select>
            <br/>
            <span>Laboratoire :</span>
            <select name='lab' class="form-control">
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
            </select>
            <br/>
            <button type="submit">Envoyer</button>
        </form>
    </div>
    
    <table class="table table-striped contenu">

        <?php

        foreach($tab as $i) {

            echo "<tr>" 
            . "<td>" . $i['designation'] . "</td>"
            . "<td>" . $i['type'] . "</td>"
            . "<td>" . $i['labo'] . "</td>"
            ."</tr>";
        } 
        ?>
    </table>

    <table class="bottom largeur100">
        <td class="menu" colspan="2">
            <span>Menu :</span>
            <a href="../index.php">Acceuil</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="../pages/recherche.php">Recherche d'un médicament</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="../pages/ordonnance.php">Création d'ordonnance</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </td>
        <td class="iut">
            <span>Réaliser par</span><br>
            <a href="https://www.iut-rodez.fr/fr" target="_blank"><img src="../images/LogoIut.png" alt="LogoIut" class="logoIut"></a>
        </td>
    </table>          
</table>
</table>
</body>
</html>