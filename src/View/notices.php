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

    <!-- 공지사항 리스트 -->
<div class="container py-5">
    <div class="d-between mb-4">
        <div class="title bar-left"> 알려드립니다 </div>
        <?php if(admin()): ?>
            <button class="btn-filled" data-toggle="modal" data-target="#insert-modal">공지 작성</button>
        <?php endif;?>
    </div>
    <div class="t-head">
            <div class="cell-10">글 번호</div>
            <div class="cell-10">제목</div>
            <div class="cell-50">내용</div>
            <div class="cell-20">작성일</div>
    </div>
    <?php foreach ($notices->data as $notice) {?>
    <div class="t-row" onclick="location.href='/notices/<?=$notice->id?>'">
            <div class="cell-10"><?=$notice->id?></div>
            <div class="cell-10"><?=enc($notice->title)?></div>
            <div class="cell-50"><?=$notice->content?></div>
            <div class="cell-20"><?=$notice->wdate?></div>
    </div>
    <?php }?>
    <div class="mt-4 d-center">
        <!-- 이전 -->
        <a href="/notices?page=<?=$notices->start - 1?>" class="bth-filled p-2" <?=!$notices->prev  ? "disabled" : "" ?>>
            <i class="fa fa-angle-left"></i>
        </a>

        <!-- 페이지 -->
        <?php for($i = $notices->start; $i <= $notices->end; $i++) :?>
            <a href="/notices?page=<?=$i;?>" class="btn-filed p-2">
                <?=$i?>
            </a>
        <?php endfor;?>

        <!-- 다음 -->
        <a href="/notices?page=<?=$notices->end +1?>" class="bth-filled p-2" <?=!$notices->next ? "disabled" : "" ?>>
            <i class="fa fa-angle-right"></i>
        </a>
    </div>
</div>

    <!-- /공지사항 리스트 -->
<form action="/insert/notices" method="post" id="insert-modal" class="modal fade" enctype="multipart/form-data">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="title">공지 작성</div>
            </div>
            <div class="modal-body">
                <div class="from-group">
                    <label for="">제목</label>
                    <input type="text" name="title" class="form-control">
                </div>
                <div class="from-group">
                    <label for="">내용</label>
                    <textarea name="content" id="content" col="30" rows="10" name="title" class="form-control"></textarea>
                </div>
                <div class="from-group">
                    <label for="">첨부파일</label>
                    <input type="file" name="files[]" multiple class="form-control" >
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-filled">작성 완료</button>
            </div>
        </div>
    </div>
</form>