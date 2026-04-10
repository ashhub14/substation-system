<?php
include 'db.php';

$hour = intval($_POST['hour']);

// alisin hour sa data
$data = $_POST;
unset($data['hour']);

// check if exists
$check = $conn->query("SELECT id FROM readings WHERE hour=$hour");

$set = [];

foreach ($data as $key => $value) {
    $value = $conn->real_escape_string($value);
    $set[] = "$key='$value'";
}

$setString = implode(",", $set);

if ($check->num_rows > 0) {
    // UPDATE only this hour
    $sql = "UPDATE readings SET $setString WHERE hour=$hour";
} else {
    // INSERT new hour
    $cols = implode(",", array_keys($data));
    $vals = implode("','", array_map([$conn, 'real_escape_string'], array_values($data)));

    $sql = "INSERT INTO readings (hour,$cols) VALUES ($hour,'$vals')";
}

$conn->query($sql);

// stay on same page
header("Location: index.php");
exit;
?>