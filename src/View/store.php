 <!-- 사이드바 -->
 <aside class="d-lg-none">
        <label for="open-aside" class="aside__background"></label>
        <div class="aside__content">
            <div class="auth auth--aside">
                <a href="#">로그인</a>
                <a href="#">회원가입</a>
            </div>
            <div class="nav nav--aside mt-3">
                <div class="nav__item">
                    <a href="#">전주한지문화축제</a>
                    <div class="nav__list">
                        <a href="#">개요/연혁</a>
                        <a href="#">찾아오시는길</a>
                    </div>
                </div>
                <div class="nav__item">
                    <a href="#">한지상품판매관</a>
                    <div class="nav__list">
                        <a href="#">한지업체</a>
                        <a href="#">온라인스토어</a>
                    </div>
                </div>
                <div class="nav__item">
                    <a href="#">한지공예대전</a>
                    <div class="nav__list">
                        <a href="#">출품신청</a>
                        <a href="#">참가작품</a>
                    </div>
                </div>
                <div class="nav__item">
                    <a href="#">축제공지사항</a>
                    <div class="nav__list">
                        <a href="#">알려드립니다</a>
                        <a href="#">1:1문의</a>
                    </div>
                </div>
            </div>
        </div>
    </aside>
    <!-- /사이드바 -->

    <!-- 비주얼 영역 -->
    <div class="position-relative hx-350">
        <div class="background background--black">
            <img src="./images/visual/1.jpg" alt="비주얼 이미지" title="비주얼 이미지">
        </div>
        <div class="position-center text-center w-100">
            <div class="fx-8 text-white">온라인스토어</div>
            <div class="fx-4 text-gray mt-3">전주한지문화축제 > 온라인스토어</div>
        </div>
    </div>
    <!-- /비주얼 영역 -->
  
    <div class="container py-5">
        <div class="bg-light border p-2 d-center">
            <div id="search_tags" data-name="hash_tags" class="w-100">
                
            </div>
            <button class="btn-search icon ml-3 text-red"><i class="fa fa-search"></i></button>
        </div>
    </div>

    <div class="container py-5">
        <div class="d-between pb-3 mb-3 border-bottom">
            <div class="title bar-left text-red border-red">상품 목록</div>
            <?php if(company()) :?>
                <button class="btn-custom" data-toggle="modal" data-target="#insert-form">상품 추가</button>
            <?php endif ;?>
        </div>
        <div id="store" class="row">
            
        </div>
    </div>

    <div class="container py-5">
        <div class="title bar-left text-yellow border-yellow">구매 목록</div>
        <div class="t-head mt-4">
            <div class="cell-50">상품 정보</div>
            <div class="cell-20">구매 수량</div>
            <div class="cell-20">합계 포인트</div>
            <div class="cell-10">-</div>
        </div>
        <div id="cart">
            
        </div>
        <div class="mt-4 d-between">
            <div>
                <span class="fx-n1">총 합계 포인트</span>
                <span id="total" class="fx-4 text-red ml-2">0</span>
                <span class="fx-n1 text-muted ml-1">p</span>
            </div>
            <form action="/insert/inventory" method="post" id="buy-form">
                <input type="hidden" id="cartList" name="cartList" value="[]">
                <input type="hidden" id="totalCount" name="totalCount" value="0">
                <input type="hidden" id="totalPoint" name="totalPoint" value="0">
                <button class="btn-custom">구매 완료</button>
            </form>
        </div>
    </div>


    <form action="/insert/papers" id="insert-form" class="modal fade" method="post" enctype="multipart/form-data">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="fx-4">상품 등록</div>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>이미지</label>
                        <input type="hidden" id="base64" >
                        <input type="file" class="form-control" name="image" id="image" accept="image/*" required>
                    </div>
                    <div class="form-group">
                        <label>상품명</label>
                        <input type="text" class="form-control" name="paper_name" required>
                    </div>
                    <div class="form-group">
                        <label>업체명</label>
                        <input type="text" class="form-control" name="company_name" value="<?=user()->user_name?>" readonly required>
                    </div>
                    <div class="form-group">
                        <label>가로 사이즈</label>
                        <input type="number" class="form-control" name="width_size" min="100" max="1000" required>
                    </div>
                    <div class="form-group">
                        <label>세로 사이즈</label>
                        <input type="number" class="form-control" name="height_size" min="100" max="1000" required>
                    </div>
                    <div class="form-group">
                        <label>포인트</label>
                        <input type="number" class="form-control" name="point" min="10" max="1000" step="10" required>
                    </div>
                    <div class="form-group">
                        <label>해시태그</label>
                        <div id="insert_tags" data-name="hash_tags"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn-filled">추가 완료</button>
                </div>
            </div>
        </div>
    </form>

    <script src="/js/store.js"></script>
    
    