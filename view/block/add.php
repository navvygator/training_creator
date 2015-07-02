<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Создание блока</h4>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="block_name">Название блока</label>
                <input type="text" name="block_name" id="block_name" class="form-control">
            </div>
            <div class="form-group">
                <label for="block_num">Порядковый номер блока</label>
                <input type="text" name="block_num" id="block_num" class="form-control">
            </div>
            <div class="form-group">
                <label for="block_num">Продолжительность блока</label>
                <input type="text" name="block_time" id="block_time" class="form-control" placeholder="чч:мм:сс">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
            <button type="button" class="btn btn-primary" id="btn_add_block">Создать</button>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->