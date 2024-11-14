<?php

$sever = "localhost";
$username = "root";
$password = "";
$dbname = "cost";


$con = mysqli_connect($sever, $username, $password, $dbname);

if(!$con)
{
    echo "not connected";

}

$gender = $_POST["gender"];
$dob = $_POST["dob"];
$marital_status = $_POST["marital_status"];

$sql = "INSERT INTO `text`(`gender`, `dob`, `marital status`) VALUES ('$gender','$dob','$marital_status')";

$result = mysqli_query($con, $sql);

if ($result) {
    // Prepare data for CSV
    $filename = "response_data.csv";
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '"');

    $output = fopen('php://output', 'w');
    fputcsv($output, ['Gender', 'Date of Birth', 'Marital Status']); // Header row
    fputcsv($output, [$gender, $dob, $marital_status]); // Data row

    fclose($output);
    exit;
} else {
    echo "Query failed: " . mysqli_error($con);
}

?>