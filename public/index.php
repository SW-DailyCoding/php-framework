<?php

// 세션
session_start();


// 상수
// define("DS", DIRECTORY_SEPARATOR) // 운영체제마다 해주는 건데 하지말라함.

define("ROOT", dirname(__DIR__));
define("SRC", ROOT . "/src");
define("VIEW", SRC . "/view");

// 만약 파일 업로드가 있는 경우
define("UPLOAD", ROOT . "/public/uploads"); /* 
                                                                        유저의 프로필 사진을 업로드 , 게시판의 이미지 업로드
                                                                        uploads/image 폴더와
                                                                        uploads/users 폴더 구분하지마라.
                                                                        같은 시간대에 같은 분류의 이미지를 동시에 업로드하면 에러가 나지만, 
                                                                        어차피 채점하는 사람은 한 명이라 
                                                                        time() 함수로 현재시간 찍어서 저장하는게 시간 단축이 된다. 
                                                                        예 : time() . ".jpg"
                                                                        */
                    
// REQUIRE 
/* 
    autoload, helper, web
    autoload -> 클래스 로드 하는 파일(제일 먼저, 안 그러면 클래스 로드할 때 오류가 남.)
    helper -> web 쪽에서 helper의 있는 함수를 쓸 때 얘가 없으면 오류가 남.
*/
require SRC . "/autoload.php";
require SRC . "/helper.php";
require SRC . "/web.php";
