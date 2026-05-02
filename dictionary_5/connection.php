<?php

$conn = new mysqli("localhost", "root", "", "dictionary_app");
// $conn = new mysqli("sql102.ezyro.com", "ezyro_41808259", "b659b808462", "ezyro_41808259_dictionary_app");

if ($conn->connect_error) {
    die("DB connection failed");
}