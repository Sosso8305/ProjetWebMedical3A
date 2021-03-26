<?php
include_once '../config/database.php';
include_once '../objects/patient.php';

//On crée la variable $database de type Database 
//Connecte la base de données
$database = new Database();
$db = $database->getConnection();
 
// On crée la variable $patient qui permettra de manipuler la base de données
$patient = new Patient($db);
 
// On passe en argument à la variable $patient la valeur ‘id’ de la variable //$_POST afin de manipuler exclusivement le docteur sélectionné
$patient->id = $_POST['id'];
 
// Utilise la méthode delete sur le docteur sélectionné 
if($patient->delete()){
    $patient_arr=array(
        "status" => true,
        "message" => "Supprimé."
    );
}	
// Traite le cas où la suppression s’est mal effectué
else{
    $patient_arr=array(
        "status" => false,
        "message" => "Le docteur ne peut pas être supprimé."
    );
}
print_r(json_encode($patient_arr));
?>
