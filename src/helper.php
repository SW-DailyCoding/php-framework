<?php

function view($viewName, $data = []) {
    extract($data);
    require VIEW . "/$viewName.php";
}