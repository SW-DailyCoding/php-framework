<?php
namespace Controller;

use App\DB;

class AjaxController {
    function getUser($user_email) {
        json_response(DB::who($user_email));
    }

    function getPapers() {
        $data = DB::fetchAll("SELECT P.*, CONCAT('/upload/', P.image) image, user_name company_name
                                            FROM papers P
                                            LEFT JOIN users U ON U.id =P.uid");
        
        /*
        array(2) {
        [0]=>
        object(stdClass)#5 (9) {
            ["id"]=>
            string(1) "1"
            ["uid"]=>
            string(1) "4"
            ["paper_name"]=>
            string(1) "1"
            ["width_size"]=>
            string(3) "399"
            ["height_size"]=>
            string(3) "300"
            ["point"]=>
            string(2) "50"
            ["image"]=>
            string(36) "/uploads/1602916452-i15090370094.png"
            ["hash_tags"]=>
            string(7) "["333"]"
            ["user_name"]=>
            string(12) "기업영인"
        }
        [1]=>
        object(stdClass)#6 (9) {
            ["id"]=>
            string(1) "2"
            ["uid"]=>
            string(1) "4"
            ["paper_name"]=>
            string(2) "55"
            ["width_size"]=>
            string(3) "120"
            ["height_size"]=>
            string(3) "350"
            ["point"]=>
            string(2) "50"
            ["image"]=>
            string(37) "/uploads/1602916494-1602749456341.gif"
            ["hash_tags"]=>
            string(2) "[]"
            ["user_name"]=>
            string(12) "기업영인"
        }
        }
        */

        // 목적 :  배열 내의 값을 접근을 해야한다.
        // 해결 방법 : for 문으로 배열의 인덱스를 사용해서 접근한다.
        for($i = 0; $i < count($data); $i++) {
            $data[$i]->hash_tags =  json_decode($data[$i]->hash_tags);    

             // 일반 배열
            //  $a = [1,2,3,4,5];
            //  $a[2]; // 3

            // 키로 이뤄진 배열일 때
            //  $b = [
            //      "apple" => 1,
            //      "banana" => 2,
            //      "mango" => 3
            //  ];
            //  $b["banana"] // 2

                // 객체일 때
                // $c = (object)[
                //     "apple" => 1,
                //     "banana" => 2,
                //     "mango" => 3
                // ];
                
                // $c->apple  ==> 1
        }

        /**
         * foreach($data as $iem ) {
         * $$iem->hash_tags = json_decode($iem->hash_tags);
         * }
         */

        json_response($data)  ;
    }   

    // json 배열로 변환하는 코드 array_.., 머시기 
}