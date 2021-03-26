<?php
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/patient.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare patient object
$patient = new Patient($db);
 
// set patient property values
$patient->id = $_POST['id'];
$patient->name = $_POST['name'];
$patient->phone = $_POST['phone'];
$patient->email = $_POST['email'];
$patient->gender = $_POST['gender'];
$patient->health_condition = $_POST['health_condition'];
$patient->doctor_id = $_POST['doctor_id'];
$patient->doctor_nurse = $_POST['doctor_nurse'];

if($patient->update()){
    $patient_arr=array(
        "status" => true,
        "message" => "Successfully Updated!"
    );
}
else{
    $patient_arr=array(
        "status" => false,
        "message" => "Email already exists!"
    );
}
print_r(json_encode($patient_arr));
?>