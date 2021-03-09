<?php

use App\Router;

Router::get("/", "ViewController@index");
Router::start();