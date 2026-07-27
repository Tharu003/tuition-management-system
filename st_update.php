<?php
session_start();
include 'dbase.php';

$id = $_POST['id'];
$name = $_POST['name'];
$address = $_POST['address'];
$dob = $_POST['dob'];
$whatsapp_no = $_POST['whatsapp_no'];
$guardian_name = $_POST['guardian_name'];
$guardian_contact = $_POST['guardian_contact'];
$admission_date = $_POST['admission_date'];

$query = "UPDATE users SET name=?, address=?, dob=?, whatsapp_no=?, guardian_name=?, guardian_contact=?, admission_date=? WHERE id=?";
$stmt = $conn->prepare($query);
$stmt->bind_param("sssssssi", $name, $address, $dob, $whatsapp_no, $guardian_name, $guardian_contact, $admission_date, $id);
$stmt->execute();

header("Location: st_profile.php");
exit();
?>
