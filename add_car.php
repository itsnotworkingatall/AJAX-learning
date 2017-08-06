<?php

include("db.php");

if (isset($_POST['car_name'])) {
    $car_name = $_POST['car_name'];
    echo $car_name;
    echo "<br>";
}

$query = "INSERT INTO cars (car) VALUES ('{$car_name}') ";
$addCar = queryToDB($query);

if (!$addCar) {
    echo "<br>some error occurred!!!<br>";
}
