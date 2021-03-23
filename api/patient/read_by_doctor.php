<?php
// include database and object files
include_once '../config/database.php';
include_once '../objects/patient.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare patient object
$patient = new Patient($db);
 
$patient->doctor_id = 1;//isset($_GET['doctor_id']) ? $_GET['doctor_id'] : die();


// query patient
$stmt = $patient->read_by_doctor();
$num = $stmt->rowCount();
// check if more than 0 record found
if($num>0){
 
  
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
    }
    
    echo json_encode($patient_item);//JSON: JavaScript Object Notation  
    //JS: {clé1: valeur1,clé2:valeur2,}
    //JSON: {"clé":"valeur"}, exemple  { {"id":'1',"name":"pierre",}, {"id":2, name:"Marie"},{}}
}
else{
    echo json_encode(array());
}
?>
