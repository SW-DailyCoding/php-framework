<?php

function view($viewName, $data = []) {
    extract($data);
    require VIEW . "/$viewName.php";
    exit;
}

function go($url, $message) {
    echo "<script>";
    if(!$message !== "") 
    echo "alert('$message');";
    echo "location.href='$url';";
    echo "</script>";
}

function back($message) {
    echo "<script>";
    if(!$message !== "") 
    echo "alert('$message');";
    echo "history.back()";
    echo "</script>";
}

function user() {
    return isset($_SESSION['user']) ? $_SESSION['user'] : false;
}