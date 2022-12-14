<?php


namespace services;

use PDOException;


/**
 *
 */
class UsersService
{
  public function getContent($pdo)
    {
        $sql = "SELECT DISTINCT(Type)
            from medicaments 
            ORDER BY Type";

        $searchStmt[0] = $pdo->query($sql);


        $sql = "SELECT DISTINCT(Labo)
            from medicaments 
            ORDER BY Labo";

        $searchStmt[1] = $pdo->query($sql); 


        $searchStmt[2] = $pdo->query("SELECT * FROM ordonnance
                     JOIN medicaments
                     ON ordonnance.idMedicament = medicaments.id");
        
        return $searchStmt;
    }

  public function constructSQL($pdo,$lab,$typeMedic,$Designation) {

    $requete = "SELECT designation,type,labo,id FROM medicaments WHERE Designation LIKE :designation";
    $conditionLab = isset($lab) && $lab != "TOUS";
    $conditionMedic = isset($typeMedic) && $typeMedic != "TOUS";
    $conditionDesign = isset($Designation);
    $param = array();

    $param['designation'] = "%". "aaaa" ."%";
    if ($conditionDesign) {
      $param['designation'] = "%". $Designation ."%";
    }
    
    

    if ($conditionLab) {
      $requete = $requete . " AND Labo = :lab";
      $param['lab'] = $lab;

    } 
    if ($conditionMedic) {
      $requete = $requete . " AND Type = :typeMedic";
      $param['typeMedic'] = $typeMedic;
    }
    $result = $pdo->prepare($requete);

    $result->execute($param);

    $tab = $result->fetchAll();

    return $tab;
  }

  public function insertMedicament($pdo,$insertMedicament) {
    $insert = $pdo->prepare("INSERT INTO ordonnance (idMedicament) VALUES (:idMedic)");
    $insert->execute(array("idMedic" => $insertMedicament));
  }

  public function emptyOrdo($pdo)
  {
    $pdo->query("DELETE FROM ordonnance");
  }

  public function connexion($pdo,$login,$password)
    {
      $sql = "SELECT * 
              FROM connexion
              WHERE login = :login AND password = :password";

      $stmt = $pdo->prepare($sql);
      $stmt->execute(array('login' => $login,'password' => $password ));
      $nbRow = $stmt->rowcount();
      return $nbRow >= 1;
    }
  private static $defaultUsersService;

  public static function getDefaultUsersService()
  {
      if (UsersService::$defaultUsersService == null) {
          UsersService::$defaultUsersService = new UsersService();
      }
      return UsersService::$defaultUsersService;
  }
}
