<?php
namespace Controller;

use App\DB;

class ActionController {
    //초기 설정
    function init() {
        DB::query("INSERT INTO users(user_email, password, user_name, type)
                                                     VALUES('admin', '1234', '관리자', 'admin')");
    }


    // 회원 관리
    function join() {
        checkEmpty();
        extract($_POST);

        $file = $_FILES['image']; //html 에서 image라는 name을 가지고 있어야 한다.
        $filename = time() . extname($file['name']); // 빠르게 파일명을 중복되지 않게 만듦
        move_uploaded_file($file['tmp_name'], UPLOAD ."/$filename");

        DB::query("INSERT INTO users(user_email, user_name, password, image, type)
                                                    VALUES (?, ?, ?, ?, ?)",
                                                    [$user_email, $user_name, $password, $filename, $type]);
        go("/", "회원가입 되었습니다.");
    }

    function login() {
        checkEmpty();
        extract($_POST);
        
        $user = DB::who($user_email);
        if(!$user) back("아이디와 일치하는 회원이 존재하지 않습니다.");
        if($user->password !== $password) back("비밀번호가 일치하지 않습니다.");
        
        $_SESSION['user'] = $user;
        go("/", "로그인이 되었습니다.");

        // $user = DB::fetch("SELECT * FROM`users` WHERE user_email =? AND password = ?", [$user_email, $password]);
        // // 값 저장
        // if(!$user) {
        //     back("아이디와 일치하는 회원이 존재하지 않습니다.");
        // } else {
        //     //다왔는데... 그 값 영구저장..
        //     $_SESSION['user'] = $user; 
        
        //     go("/", "로그인이 되었습니다.");
        // }
        
    }

    function logout() {
        unset($_SESSION['user']);
        go("/", "로그아웃 되었습니다.");
    }
    // go 하는 이유는 back은 뒤로가기 버튼처럼 캐시가 남아있기 때문에 함. unset => 사라지게 함.

    // 알려드립니다
    function insertnotices() {
        checkEmpty();
        extract($_POST);

        if(mb_strlen($title)  > 50) back("제목은 50자 이하여야합니다.");
        // 한글 문자열 길이 보는 방법 

        $files = $_FILES['files'];
        $fileLength = $files['name'][0] === "" ? 0 : count($files['name']);
        $filenames = [];

        for($i = 0; $i < $fileLength; $i++) {
            $name = $files['name'][$i];
            $tmp_name = $files['tmp_name'][$i];
            $size  = $files['size'][$i];
            $filename = $i .  time() . extname($name);
            // time() . extname($name); 파일 이름이 중복되어서 업로드 시 덮어씌움. 업로드할 때
            // 이름이 중복되지 않게 앞에 $i 넣어주기

            if($i > 3) back("파일은 4개까지만 업로드 할 수 있습니다.");
            /**
             * 1KB = 1024byte
             * 1MB = 1024KB
             */
            if($size > 1024 * 1024 * 10) back("10MB 이상인 파일은 업로드할 수 없습니다.");

            move_uploaded_file($tmp_name, UPLOAD . "/$filename");
            //업로드파일에 다 때려박기
            $filenames[] = $filename;
        }

        // $files['name'][4];
        DB::query("INSERT INTO notices(title, content, files) VALUES (?, ?, ?)",
                            [$title, $content, json_encode($filenames)]);
        go("/notices", "새로운 공지사항을 작성했습니다.");
        /**
         * PHP 파일 구조
         * 
         * [
         *      "name" => [
         *          "file_1",
         *          "file_2"
         *      ],
         *      "tmp_name",
         *      "size",
         *      "type"
         * 
         * ]
         */
    }

    function deleteNotice($id) {
        // 나가죽기 
        
        DB::query("DELETE FROM `notices` WHERE id = ?", [$id]); 
        go("/notices", "삭제가 되었습니다.");

        // 프로젝트 제대로 할려면 사진도 제대로 삭제해야함.
    }

    function updateNotice($id) {
        // 글쓰기 조건과 제한 조건은 동일하고 
        // 파일의 경우 업로드 한게 없으면 기존걸 유지하면 됨

        $notice = DB::find("notices", $id);
        if(!$notice) back("찾을 수 없습니다");

        checkEmpty();
        extract($_POST);

        $files = $_FILES['files'];
        $fileLength = $files['name'][0] === "" ? 0 : count($files['name']);
        $filenames = json_decode($notice->files); // "["01602897675.png"]"
        // 파일이 있을 때 파일을 누르면 -> 이전 데이터를 삭제
        
        if($fileLength > 0) {
            $filenames = [];
            for($i = 0; $i < $fileLength; $i++) {
        
                $name = $files['name'][$i];
                $tmp_name = $files['tmp_name'][$i];
                $size  = $files['size'][$i];
                $filename = $i .  time() . extname($name);
                // time() . extname($name); 파일 이름이 중복되어서 업로드 시 덮어씌움. 업로드할 때
                // 이름이 중복되지 않게 앞에 $i 넣어주기

                if($i > 3) back("파일은 4개까지만 업로드 할 수 있습니다.");
                /**
                 * 1KB = 1024byte
                 * 1MB = 1024KB
                 */
                if($size > 1024 * 1024 * 10) back("10MB 이상인 파일은 업로드할 수 없습니다.");

                $filenames[] = $filename;
                move_uploaded_file($tmp_name, UPLOAD . "/$filename");
                //업로드파일에 다 때려박기
            }
        }
        
        // 그대로 이름 나오기 
        DB::query("UPDATE `notices` SET title = ?, content = ?, files = ? WHERE id = ?", [$title, $content, json_encode($filenames), $id]);
        go("/notices/$id", "수정했습니다");
    }

    // 1:1 문의
    function insertInquire() {
        checkEmpty();
        extract($_POST);

        // 사용자가 title, content을 입력해서 문의 내용을 작성함
        // -> DB에 넣어야함.

        /**
         * table inquires
         * id x
         * wdate x
         * aid x
         * uid
         * title
         * content
         * 
         */

         DB::query("INSERT INTO `inquires`(uid, title, content) VALUES (?, ?, ?)", [user()->id, $title, $content] );
         go("/inquires", "문의 등록이 완료 되었습니다.");
    }
    
    function insertAnswer($id) {
        checkEmpty();
        extract($_POST);        
        DB::query("INSERT INTO `answers` (content) VALUES (?)", [$content]);
        DB::query("UPDATE `inquires` SET aid = ?  WHERE id = ?", [DB::lastInsertId() , $id ]);
        
        // a.id == i.aid <- 가장 최근에 
        // 
        // 최근에 있는 insert 마지막 꺼 오토 인클리먼트가 된 id 값을 가져오는 거 
        //return <- 
        
        
        // 답변하기 등록 할려면 인콰이어 aid 가 등록이 되어야하고, 업데이트문으로 그걸 aid  
        // id 가 필요하잖아 글의 답변
        go("/inquires", "답변 등록이 완료 되었습니다.");
    }

    function insertPaper(){
        checkEmpty();
        extract($_POST);

        $image = $_FILES['image'];
        $filename = time(). "-" . $image['name'];
        move_uploaded_file($image['tmp_name'], UPLOAD."/$filename");

        DB::query("INSERT INTO papers(uid, paper_name, width_size, height_size, point, hash_tags, image) VALUES (?, ?, ?, ?, ?, ?, ?)", [
            user()->id, $paper_name, $width_size, $height_size, $point, $hash_tags, "/uploads/" . $filename
        ]);

        go("/store", "추가되었습니다.");
    }
}