
<?php
// include database and object files
include_once '../config/database.php';
include_once '../objects/patient.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare patient object
$patient = new Patient($db);

//Ce script doit avoir le moyen de récupérer ce identifiant

$patient->id = isset($_GET['id']) ? $_GET['id'] : die(); //http://monsite/patient/single.php?



$stmt = $patient->read_single();
if ($stmt->rowCount() == 1) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $patient_arr=array(
            "id" => $row['id'],
            "name" => $row['name'],
            "phone" => $row['phone'],
            "gender" => $row['gender'],
            "health_condition" => $row['health_condition'],
            "doctor_id" => $row['doctor_id'],
            "nurse_id" => $row['nurse_id'],
            "created" => $row['created']

    );
}

echo json_encode($patient_arr);