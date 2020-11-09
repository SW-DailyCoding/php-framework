 <!-- 비주얼 영역 -->
 <div class="position-relative hx-350">
        <div class="background background--black">
            <img src="./images/visual/1.jpg" alt="비주얼 이미지" title="비주얼 이미지">
        </div>
        <div class="position-center text-center w-100">
            <div class="fx-8 text-white">로그인</div>
            <!-- <div class="fx-4 text-gray mt-3">사용자 인증 > 회원가입</div> -->
        </div>
    </div>
    <!-- /비주얼 영역 -->
  
    <div class="container py-5">
        <form id="sign-up" action="/login" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>이메일</label>
                <input type="text" class="form-control" name="user_email" id="user_email">
                <div class="error mt-2 text-red fx-n2"></div>
            </div>
            <div class="form-group">
                <label>비밀번호</label>
                <input type="password" class="form-control" name="password" id="password">
                <div class="error mt-2 text-red fx-n2"></div>
            </div>
            <div class="form-group mt-3 text-right">
                <button class="btn-custom">로그안</button>
            </div>
        </form>
    </div>
    