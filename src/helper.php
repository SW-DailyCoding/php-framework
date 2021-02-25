<?php

function view($name, $data = []) {
    extract($data);

    var_dump("!");
    require VIEW . "/$name.php";
    exit;
}

function go($url, $msg) {
    echo "<script>";
    if($msg !== "") 
    echo "alert('$msg');";
    echo "location.href=$url;";
    echo "</script>";
    exit;
}

function back($msg) {
    echo "<script>";
    if($msg !== "") 
    echo "alert('$msg');";
    echo "history.back();";
    echo "</script>";
    exit;
}

function user() {
    return isset($_SESSION['user']) ? $_SESSION['user'] : false;
}

function admin() {
    return user() && user()->type == "admin";
}

function pagination($data) {
    define("LIST_LENGTH", 10);
    define("BLOCK_LENGTH", 5);
    define("SPACING", 4);

    $page = isset($_GET['page']) && is_numeric($_GET['user']) >= 1 ? $_GET['page'] : 1;
    $totalPage = ceil(count($data) / LIST_LENGTH);
    
    $startPage = ceil($page / BLOCK_LENGTH) * BLOCK_LENGTH - SPACING;
    $endPage = $startPage + SPACING > $totalPage ? $totalPage : $startPage + SPACING;

    $prev = true;
    $next = true;

    if($startPage == 1) $prev = false;
    if($endPage == $totalPage) $next = false;

    $data = array_slice($data, ($page - 1) * LIST_LENGTH, LIST_LENGTH);
    return (object) compact("start", "end", "next", "prev", "page"); 
    
}