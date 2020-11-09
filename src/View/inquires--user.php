<!-- 비주얼 영역 -->
<div class="position-relative hx-350">
        <div class="background background--black">
            <img src="/images/visual/1.jpg" alt="비주얼 이미지" title="비주얼 이미지">
        </div>
        <div class="position-center text-center w-100">
            <div class="fx-8 text-white">알려드립비니다</div>
            <div class="fx-4 text-gray mt-3">축제공지사항 > 알려드립니다</div>
        </div>
    </div>
    <!-- /비주얼 영역 -->

    <!-- 내용 -->
    <div class="container py-5">
        <div class="d-between">
            <div class="title bar-left">1:1문의</div>
        </div>
        <div class="mt-4 t-head">
            <div class="cell-20">상태</div>
            <div class="cell-60">제목</div>
            <div class="cell-20">문의일자</div>
        </div>
        <?php foreach($inquires as $inquire) {?>
            <div class="t-row" data-toggle="modal" data-target="#view-modal-<?=$inquire->id?>">
                <!--aid -->
                <?php if($inquire->aid == 0) :?>
                    <div class="cell-20">진행중</div>
                <?php endif;?>
                <?php if($inquire->aid != 0 ) :?>
                    <div class="cell-20">진행완료</div>
                <?php endif;?>
            <!--  $inquire->aid ? "완료" : "진행중" -->
                <div class="cell-60"><?=enc($inquire->title)?></div>
                <div class="cell-20"><?=$inquire->wdate?></div>
            </div>
            <div id="view-modal-<?=$inquire->id?>" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="title">문의 내역</div>
                            </div>
                            <div class="modal-body">
                                <div class="fx-5"><?=enc($inquire->title)?></div>
                                <div class="mt-2">
                                    <span class="mr-2">작성자</span>
                                    <span><?=$inquire->user_name?>(<?=$inquire->user_email?>)</span>
                                </div>
                                <div class="mt-2">
                                    <span class="mr-2">문의일자</span>
                                    <span><?=$inquire->wdate?></span>
                                </div>
                                <div class="mt-2">
                                    <?=enc($inquire->content)?>
                                </div>
                                <div class="mt-3 pt-3 border-top">
                                    <?php if($inquire->aid) : ?>
                                        <div>
                                            <span class="mr-2">답변일자</span>
                                            <span><?=$inquire->adate?></span>
                                        </div>
                                        <div class="mt-2">
                                            <?=enc($inquire->answer)?>
                                        </div>
                                    <?php else: ?>
                                    </div>
                                        문의에 대한 답변이 아직 오지 않았습니다.
                                    </div>
                                    <?php endif ;?>
                        </div>
                    </div>
            </div>
        <?php }?>
    </div>
    <!-- /내용 -->
