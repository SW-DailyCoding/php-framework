<?php
use App\DB; 
/* 
    헬퍼에서 모든 변수를 다 생각하고 미리 함수를 만들어야 한다.
    이미지 업로드 대비해서 함수를 만들어야한다. 이미지에 대한 함수라든지, 확장자가 필요할테고 

*/ 

// 사이트 내에 유저 테이블이 변경될 수 있는 경우 
function user() {
    if(isset($_SESSION['user'])) {
        $user = DB::find("users", $_SESSION['user']->id);
        // DB에 정보가 없으면 로그아웃
        if(!$user) {
            go("/logout", "회원 정보를 찾을 수 없어 로그아웃이 되었습니다.");
        } else {
            // 있으면 세션 업데이트
            $_SESSION['user'] = $user;
            return $_SESSION['user'];
        } 
    } else return false;
}

/**
 * 변경이 없다면 이렇게 써
 * function user() {
 *      return isset($_SESSION['user]) ? $_SESSION['user] : false;
 * }
 */

 function company() {
     return user() && user()->type == 'company';
 }

 function admin() {
    return user() && user()->type == 'admin';
}

/**
 * 여기서 실수하기 쉬운 거
 * alert 다음에 location이 와야함.
 * 이동한 다음 alert가 떠버리면
 * 유저가 확인을 누르기 전에 이동해버림.
 */

function go($url, $message) {
    echo "<script>";
    echo "alert('$message');";
    echo "location.href='$url';";
    echo "</script>";
    exit; // 꼭 붙이기
}

function back($message) {
    echo "<script>";
    echo "alert('$message');";
    echo "history.back();";
    echo "</script>";
    exit; // 꼭 붙이기
}

function view($viewName, $data = []) {  
    extract($data);
    // $notices

    require VIEW . "/header.php";
    require VIEW . "/$viewName.php";
    require VIEW . "/footer.php";
    exit; // 이건 굳이 안해도 된다.
}

function checkEmpty() {
    foreach($_POST as $input) {
        if(!is_array($input) && trim($input) == "") 
            back("모든 정보를 입력해 주세요!");
    }
}

// strrpos :: 뒤에서부터 특정 문자열 검사하기
function extname($filename) { // 확장자를 가져올 수 있음. 
    return strtolower(substr($filename, strrpos($filename, ".")));
    //대문자 소문자 터지지않게 strtolower() 메소드 사용
}

// 이미지 검사 메소드 
function isImage($filename) {
    // .jpg > 0 : false 
    return in_array(extname($filename), [".jpg", ".png", ".gif"]);
}

// encoding 
function enc($output) {
    //new line to <br>
    return nl2br(str_replace(" ", "&nbsp;", htmlentities($output)));
}

function json_response($data) {
    echo json_encode($data, JSON_UNESCAPED_UNICODE); // 한글을 지원하기 위해서 이거 안쓰면은 반환 타입에 따라 다르며 한글이 깨질 수 있음 
}

function pagination($data) {
    // $_GET['page']
    // notices?page=4 

    define("LIST_LENGTH", 9);
    define("BLOCK_LENGTH", 10);

    // page는 $_GET으로 전달된 page가 있으면서, 숫자이면서 1보다 같거나 클 경우에만 page로 들어갈거야 
    $page = isset($_GET['page']) && is_numeric($_GET['page']) >= 1 ?  $_GET['page'] : 1 ;
    $totalPage =  ceil(count($data) / 10); //4.3 -> 5
    
    // 혹은 상수 define("LIST_LENGTH", 10) 하고 10 넣는 부분에 LIST_LENGTH 넣으면 됨.

    // count 배열의 개수 
    // totalPage 총 페이지의 수 

    /**
     * 게시글 43
     * 
     * 한 페이지 표시되는 게시글 : 10개
     * 총 페이지 : 5개
     * ceil :: 올림
     * count : 배열의 개수 
     */

    /**
     * 요약하자면 페이지네이션을 그릴려면 
     *시작점과 끝점을 알아야함.
    */

    // 시작점 포기 포기
    // 시작점 모르겠숴요 

    $blockNum = ceil($totalPage/BLOCK_LENGTH); //총 블럭 
    $nowBlock = ceil($page/BLOCK_LENGTH); //현재 블럭

    $end = $nowBlock * BLOCK_LENGTH;
    $start = $end - BLOCK_LENGTH +1;
    
    $next = true; // 다음
    $prev = true; //
    if($end > $totalPage) {
        $end = $totalPage;
        $next = false;
    }

    if($start <= 1) {
        $start = 1;
        $prev = false;
    }

    $data = array_splice($data, ($page-1) * LIST_LENGTH );
    return (object)compact("start", "end", "data", "next", "prev");
    //오브젝트를 사용하는 이유는 aa['sum']를 -> 로 쓰기위해 
    
    // $nextPage = $end + 1;
    // $prevPage = $start -1;

    // 1 -> 1 10
    // 2 -> 11 20
    // 3 -> 21 30
    //$nowBlock - 1 
    //$page 2 
    // 3 -> 블럭 1 -> 1
    // 14 -> 블럭 2  -> 11
    // $page > $

    // 현재페이지, 전체 페이지 수
    // $page, $totalPage
    // 현재페이지 = 5 라고 가정했을 때
}