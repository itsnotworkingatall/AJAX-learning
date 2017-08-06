<?php

function connectToDB()
{

    $dbase['db_host'] = "localhost";
    $dbase['db_user'] = "root";
    $dbase['db_pass'] = "";
    $dbase['db_name'] = "ajax";

    foreach ($dbase as $key => $value) {
        if (!defined(strtoupper($key))) {
            define(strtoupper($key), $value);
        }
    }

    $connectionToDB = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    $connectionToDB = mysqli_connect('localhost', 'root', '', 'ajax');

    if (!$connectionToDB) {
        echo "connection to db failed";
    }
    return $connectionToDB;
}

function queryToDB($query)
{

    $result = mysqli_query(connectToDB(), $query);

    if (!$result) {
        die("oi, there was an error: " . mysqli_error(connectToDB()));
    }

    return $result;

}
