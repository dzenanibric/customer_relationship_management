<?php

$con = mysqli_connect('localhost', 'root', 'root', 'crm_db');

function escape($string){
    global $con;
    return mysqli_real_escape_string($con, $string);
}

function query($query){
    global $con;
    return mysqli_query($con, $query);
}

function confirm($query_result){
    global $con;
    if(!$query_result){
        die("QUERY FAILED" . mysqli_error($con));
    }
}