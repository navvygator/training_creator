<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Редактирование блока</h4>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="block_name">Название блока</label>
                <input type="text" name="block_name" id="block_name" class="form-control" value="<?=$block['block_name']?>">
            </div>
            <input type="hidden" id="block_id" name="block_id" value="<?=$block['id']?>">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
            <button type="button" class="btn btn-primary" id="btn_edit_block">Сохранить</button>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->