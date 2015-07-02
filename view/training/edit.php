<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Редактирование тренинга</h4>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="block_name">Название тренинга</label>
                <input type="text" name="training_name" id="training_name" class="form-control" value="<?=$training['name']?>">
            </div>
            <input type="hidden" id="training_id" name="training_id" value="<?=$training['id']?>">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
            <button type="button" class="btn btn-primary" id="btn_edit_training">Сохранить</button>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->