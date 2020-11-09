<?php
namespace Controller;

use App\DB;

class ViewController {
    function index() {
        view("index");
    }

    // A과제
    /**
     * 메소드랑 파일명은 자신이 기억하기 쉽도록
     * 일정한 규칙을 만들어서 사용함. 
     * 
     * 민재 선배 같은 경우는 메소드랑 파일 이름 같게 함.
     */
    function overview() {
        view("overview");
    }

    function roadmap() {
        view("roadmap");
    }

    // 회원 관리
    function join() {
        view("join");
    }

    function login() {
        view("login");
    }


    // function logout() {
    //     view("logout");
    // }

    // 알려드립니다
    function notices() {
        $notices = DB::fetchAll("SELECT * FROM `notices` ORDER BY id DESC");
        $notices = pagination($notices);
        // 배열 index 지정 한글로 만들어진 것을 키값 

        // $user = DB::who("admin");
        // $arr = ["admin" => $user]; 
        // extract($arr);
        // $admin

        // $notices  = 
        // $data = ["notices" => $notices];
        // extract($data);
        // $notices

        // $data = ["notices" => 123, "key2" => 424, "3" => 532];
        // extract($data);
        // $notices

        // 이해하자 ^U^
        view("notices", compact("notices"));

        // view("notices", ["notices" => $notices ]);         
    }

    // 알려드립니다 상세보기
    function notice($id) {
        // $notice = DB::fetchAll("SELECT * FROM `notices` WHERE id = ?", [$id]);
        $notice  = DB::find("notices", $id);
        $notice->files = json_decode($notice->files);

        view("notice", compact("notice"));
    }

    // 1 : 1문의 
    function inquires() {
        if(admin()) {
            view("inquires--admin", [
                "inquires" => DB::fetchAll("SELECT I.*, user_name, user_email, A.content answer, A.wdate adate
                                                            FROM inquires I
                                                            LEFT JOIN users U ON U.id = I.uid
                                                            LEFT JOIN answers A ON A.id = I.aid
                                                            ORDER BY I.id DESC", [user()->id]),

            ]);
        } else {
            /**
             * select 
             * from
             * () join
             * where
             * ORDER BY  id DESC
             */

             // 유저에 u.id = > i.aid 

            view("inquires--user", [
                "inquires" => DB::fetchAll("SELECT I.*, user_name, user_email, A.content answer, A.wdate adate
                                                            FROM inquires I
                                                            LEFT JOIN users U ON U.id = I.uid
                                                            LEFT JOIN answers A ON A.id = I.aid
                                                            WHERE I.uid = ?
                                                            ORDER BY I.id DESC", [user()->id])
            ]);
        }
    }
    
    function companies() {
        view("companies");
    }

    function store() {
        view("store");        
    }
}