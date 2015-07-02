<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Удаление тренинга</h4>
        </div>
        <div class="modal-body">
                    <h4>Вы действительно хотите удалить тренинг <?=$training['name']?></h4>
                    <input type="hidden" name="training_id" id="training_id" value="<?=$training['id']?>">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
            <button type="button" class="btn btn-primary" id="btn_delete_training">Удалить</button>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->