<?php

$conn = new mysqli("localhost", "root", "", "dictionary_app");

if ($conn->connect_error) {
    die("DB connection failed");
}