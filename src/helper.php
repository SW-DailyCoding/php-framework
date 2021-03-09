<?php

function view($name, $data = []) {
    extract($data);

    require VIEW . "/$name.php";
    exit;
}

function go($url, $msg) {
    echo "<script>";
    echo "alert('$msg');";
    echo "location.href='$url';";
    echo "</script>";
}

function back($msg) {
    echo "<script>";
    echo "alert('$msg');";
    echo "history.back();";
    echo "</script>";
}

function user() {
    return isset($_SESSION['user']) ? $_SESSION['user'] : false;
}

function admin() {
    return user() && user()->type == 'admin';
}

function pagination($data) {
    define("LIST_LENGTH", 10);
    define("BLOCK_LENGTH", 5);
    define("SPACING", 4);

    $page = isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] >= 1 ? $_GET['page'] : 1;
    $totalPage = ceil(count($data) / LIST_LENGTH);

    $startPage = ceil($page / BLOCK_LENGTH) * BLOCK_LENGTH;
    $endPage = $startPage + SPACING > $totalPage ? $totalPage : $startPage - SPACING;

    $prev = true;
    $next = true;

    if($startPage == 1) $next = false;
    if($endPage == $totalPage) $prev = false;

    $data = array_slice($data, ($page - 1) * LIST_LENGTH, LIST_LENGTH);
    return (object)compact("data", "next", "prev", "startPage", "endPage", "page");
}