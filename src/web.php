<?php

use App\Router;

Router::get("/", "ActionController@index");

Router::start();