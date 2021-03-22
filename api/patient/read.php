<?php
// include database and object files
include_once '../config/database.php';
include_once '../objects/patient.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare doctor object
$patient = new Patient($db);
 
// query doctor
$stmt = $patient->read();
$num = $stmt->rowCount();
// check if more than 0 record found
if($num>0){
 
    // doctors array
    $patient_arr=array();//fonction : tableau vide: []
    $patient_arr["patients"]=array(); // ["doctors"=> [ ["id"=>1,"name"=>"doc", ],["id"=>2, ], ]]
    //PDO::QQCHOSE=>QQCHOSE est un attribut statique de la classe PDO
    //FETCH::ASSOC => [clé=>valeur, clé=>valeur]
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row); //$id=$row['id']; $name=$row['name'];$phone=$row['phone']
        $patient_item=array(
            "id" => $id,
            "name" => $name,
            "phone" => $phone,
            "gender" => $gender,
            "health_contition" => $health_condition,
            "created" => $created
        );
        array_push($patient_arr["patients"], $patient_item);//[ [id=>1,name="sanae",], [id=>2, na], [] ]
    }
    
    echo json_encode($patient_arr["patients"]);//JSON: JavaScript Object Notation  
    //JS: {clé1: valeur1,clé2:valeur2,}
    //JSON: {"clé":"valeur"}, exemple  { {"id":'1',"name":"sanae",}, {"id":2, name:"luna"},{}}
}
else{
    echo json_encode(array());
}
?>