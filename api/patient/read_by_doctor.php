<?php
// include database and object files
include_once '../config/database.php';
include_once '../objects/patient.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare patient object
$patient = new Patient($db);
 
$patient->doctor_id = isset($_GET['id']) ? $_GET['id'] : die();


// query patient
$stmt = $patient->read_by_doctor();
$num = $stmt->rowCount();
// check if more than 0 record found
if($num>0){
 
    // patients array
    $patients_arr=array();//fonction : tableau vide: []
    $patients_arr["patients"]=array(); // ["patients"=> [ ["id"=>1,"name"=>"doc", ],["id"=>2, ], ]]
    //PDO::QQCHOSE=>QQCHOSE est un attribut statique de la classe PDO
    //FETCH::ASSOC => [clé=>valeur, clé=>valeur]
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row); //$id=$row['id']; $name=$row['name'];$phone=$row['phone']
        $patient_item=array(
            "id" => $id,
            "name" => $name,
            "phone" => $phone,
            "gender" => $gender,
            "health_condition" => $health_condition,
            "doctor_id" => $doctor_id,
            "nurse_id" => $nurse_id,
            "created" => $created
        );
        array_push($patients_arr["patients"], $patient_item);//[ [id=>1,name="pierre",], [id=>2, na], [] ]
    }
    
    echo json_encode($patients_arr["patients"]);//JSON: JavaScript Object Notation  
    //JS: {clé1: valeur1,clé2:valeur2,}
    //JSON: {"clé":"valeur"}, exemple  { {"id":'1',"name":"pierre",}, {"id":2, name:"Marie"},{}}
}
else{
    echo json_encode(array());
}
?>
