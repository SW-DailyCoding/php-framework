<?php

function view($viewName, $data = []) {
    extract($data);

    require VIEW . "/$viewName.php";
    exit;
}

// function pagenation($data) {
//     define("LIST_LENGTH", 10);
//     define("BLOCK_LENGTH", 5);
//     define("SPACING", 4);
    
//     $page = isset($_GET['page'] ) && is_numeric($_GET['page']) && $_GET['page'] >= 1 ? $_GET['page'] : 1;
//     $total_page = ceil(count())
// }