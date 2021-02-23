<?php

function view($name, $data = []) {
    extract($data);

    require VIEW . "/$name.php";
    exit;
}

function go($url, $msg) {
    echo "<script>";
    if(!$msg !== "") 
    echo "alert('$msg');";
    echo "location.href='$url';";
    echo "</script>";
}

function back($msg) {
    echo "<script>";
    if(!$msg !== "") 
    echo "alert('$msg');";
    echo "history.back()";
    echo "</script>";
}

function user() {
    return isset($_SESSION['user']) ? $_SESSION['user'] : false;
}