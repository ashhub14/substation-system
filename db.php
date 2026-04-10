<?php
$conn = new mysqli("localhost", "root", "", "substation");

if ($conn->connect_error) {
    die("Connection failed");
}