<?php

// 가능하면 URL 정도는 다 외워서 치는 걸 목표로 !
use App\Router;

// B과제에서 만들었던 페이지를 우선적으로 만들어야 함.

Router::get("/", "ViewController@index");
Router::get("/init", "ActionController@init");

// A과제
Router::get("/overview", "ViewController@overview");
Router::get("/roadmap", "ViewController@roadmap");

// 회원관리
Router::get("/join", "ViewController@join", "guest");
Router::get("/login", "ViewController@login", "guest");

Router::post("/join", "ActionController@join", "guest");
Router::post("/login", "ActionController@login", "guest");
Router::get("/logout", "ActionController@logout", "user");

Router::get("/api/users/{user_email}", "AjaxController@getUser") ;

// 알려드립니다
Router::get("/notices", "ViewController@notices", "user");
Router::get("/notices/{id}", "ViewController@notice", "user");

Router::post("/insert/notices", "ActionController@insertnotices", "admin");
Router::post("/update/notices/{id}", "ActionController@updateNotice", "admin");
Router::get("/delete/notices/{id}", "ActionController@deleteNotice", "admin");

// 1 : 1 문의
Router::get("/inquires", "ViewController@inquires", "user");

Router::post("/insert/inquires", "ActionController@insertInquire", "user");
Router::post("/insert/answer/{id}", "ActionController@insertAnswer", "admin");

// 한지 업체
Router::get("/companies", "ViewController@companies");

// 온라인 스토어
Router::get("/store", "ViewController@store", "user");

Router::post("/insert/papers", "ActionController@insertPaper", "company");
Router::post("/insert/inventory", "ActionController@insertInventory", "user");

Router::get("/api/papers", "AjaxController@getPapers", "user");

// 출품하기
Router::get("/entry", "ViewController@entry");


// // 관리자 접근일 경우 
// Router::get("/", "ViewController@index", "admin");

Router::start();