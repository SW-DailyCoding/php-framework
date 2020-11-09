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
        <div class="text-title">[공지사항] <?=$notice->title?></div>
        <div class="d-between">
            <div>
                <div class="fx-2 mt-2">글 번호 <?=$notice->id?></div>
                <div class="fx-3 mt-2">작성일 <?=$notice->wdate?></div>
            </div>  
            <div>
                <button class="btn-filled" data-toggle="modal" data-target="#update-modal">수정하기</button>
                <a href="/delete/notices/<?=$notice->id?>" class="btn-bordered">삭제하기</a>
            </div>
        </div>
        <div class="fx-n1 mt-3">
            <?=$notice->content?>
        </div>
        <?php foreach($notice->files as $file) {?>
                <?php if(isImage($file)) :?>
                    <img src="/uploads/<?=$file?>" alt="이미지" class="mw-100">
                <?php endif;?>
        <?php }?>
        <!-- /내용 -->
        <!-- 첨부파일 -->
        <div class="py-4">
            <div class="fx-4">첨부 파일</div>
            <?php foreach($notice->files as $file) {?>
            <div class="py-2 d-between">
                <div>
                    <div class="fx-3"><?=$file?></div>
                    <div class="text-muted"><?= number_format(filesize(UPLOAD . "/$file") / 1024, 2) ?></div>
                </div>
                <a href="/uploads/<?=$file?>" download="<?=$file?>" class="btn-filled">다운로드</a>
            </div>
            <?php }?>
        </div>
    </div>
        <!-- /첨부파일 -->
        <form action="/update/notices/<?=$notice->id?>" method="post" id="update-modal" class="modal fade" enctype="multipart/form-data">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="title">공지 수정</div>
                    </div>
                    <div class="modal-body">
                        <div class="from-group">
                            <label for="">제목</label>
                            <input type="text" value="<?=$notice->title?>" name="title" class="form-control">
                        </div>
                        <div class="from-group">
                            <label for="">내용</label>
                            <textarea name="content" id="content" col="30" rows="10" name="title" class="form-control"><?=$notice->content?></textarea>
                        </div>
                        <div class="from-group">
                            <label for="">첨부파일</label>
                            <div class="custom-file">
                                <input type="file" id="files" name="files[]" class="custom-file-input" multiple>
                                <label for="files" class="custom-file-label">
                                    <?=count($notice->files)== 0 ? "파일을 선택해주세요" 
                                :  (count($notice->files) == 1 ? $notice->files[0]
                                :  $notice->files[0] .  "외" .(count($notice->files) - 1) . "개의 파일" )?>
                                </label>
                            </div>
                            <!-- <input type="file" name="files[]" multiple class="form-control" > -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn-filled">수정 완료</button>
                    </div>
                </div>
            </div>
        </form>



