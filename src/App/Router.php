<?php
namespace App;

class Router {
    static $pages = [];
    static function __callStatic($name, $args)
    {
        if(strtolower($_SERVER['REQUEST_METHOD']) == $name) {
            self::$pages[] = $args;
        }
    }
    
    static function start() {
        $currentURL = explode("?", $_SERVER['REQUEST_URI'])[0];
        foreach(self::$pages as $page) {
            $url = $page[0];
            $action = explode("@", $page[1]);
            $permission = isset($page[2]) ? $page[2] : null;

            // [^/] -> ^ = not, / 는 이미 구분지어져있기 때문에 /가 아닌 모든 요소들을 가져옴. 
            // {id} 상태로는 가져올 수 없으니까 [id]인데, /가 아닌 요소들만 가져온다면 
            // /13123123 에서 13123123만 가져올 수 있는거임.

            $regex = preg_replace("/({[^\/]+})/", "([^/]+)", $url); // Escape 뒤쪽에 처리 안하게 조심

            /**
             * /users/{id}
             * /users/4
             * 와 같은 URL 매칭시킬 수 있도록 정규식화 해주는 작업 
             */

            $regex = preg_replace("/\//", "\\/", $regex);
            /**
             * Escape 처리 시키는 코드가 위 코드
             * 이스케이프화를 앞에서 하지 않는 이유는 번거로움을 없애기 위해서
             */

             // 현재 URL과 매칭을 시켜서 원하는 값을 가져온다. 
            if(preg_match("/^{$regex}$/", $currentURL, $matches)) {
                unset($matches[0]); 
                /**
                 * unset()을 쓰는 이유는 첫 번째 값이 매칭된 전체 값이기 때문이다.
                 * $matches[0] == /users/25
                 * $matches[1] == /25
                 * 하지만 쓰게 된다면 저렇게 번거로움을 한 번더 안 거침.
                 */
                if($permission) {
                    if($permission == "guest" && user()) go("/", "로그인한 회원은 접근할 수 없습니다.");
                    if($permission == "user" && !user()) go("/login", "로그인 후 이용하실 수 있습니다.");
                    if($permission == "company" && !company()) go("/", "기업 회원만 접근할 수 있습니다.");
                    if($permission == "admin" && !admin()) go("/", "관리자만 접근할 수 있습니다..");
                    /**
                     * 한줄로 go 할 수 있는 이유는 각 함수마다 exit를 썼기 때문이다.
                     */
                }
                $conName = "Controller\\$action[0]";
                $con = new $conName();
                $con->{$action[1]}(...$matches);
                return;
            }
        }
        http_response_code(404);
    }
}