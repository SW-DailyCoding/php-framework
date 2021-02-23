<?php

function view($viewName, $data = []) {
    extract($data);
    require VIEW . "/$viewName.php";
    exit;
}

function user() {
    return isset($_SESSION['user']) ? $_SESSION['user'] : false;
}

function go($url, $message) {
    echo "<script>";
    if(!$message !== "") 
        echo "alert('$message');";
    echo "location.href='$url';";
    echo "</script>";
    exit;
}

function back($message) {
    echo "<script>";
    if(!$message !== "") 
        echo "alert('$message');";
    echo "history.back()";
    echo "</script>";
    exit;
}