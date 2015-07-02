<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Редактирование упражнения</h4>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="practice_name">Название упражнения</label>
                <input type="text" name="practice_name" id="practice_name" class="form-control" value="<?=$practice['name']?>">
            </div>
            <div class="form-group">
                <label for="practice_time">Продолжительность упражнения</label>
                <input type="text" name="practice_time" id="practice_time" class="form-control" placeholder="чч:мм:сс" value="<?=$practice['time']?>">
            </div>
            <div class="form-group">
                <label for="practice_theme">Тематика упражнения</label>
                <input type="text" name="practice_theme" id="practice_theme" class="form-control" value="<?=$practice['theme']?>">
            </div>
            <div class="form-group">
                <label for="practice_purpose">Цель упражнения</label>
                <textarea name="practice_purpose" id="practice_purpose" class="form-control" rows="3"><?=$practice['purpose']?></textarea>
            </div>
            <div class="form-group">
                <label for="practice_content">Описание упражнения</label>
                <textarea name="practice_content" id="practice_content" class="form-control" rows="10"><?=$practice['content']?></textarea>
            </div>
            <div class="form-group">
                <label for="practice_inference">Выводы из упражнения</label>
                <textarea name="practice_inference" id="practice_inference" class="form-control" rows="3"><?=$practice['inference']?></textarea>
            </div>
            <div class="form-group">
                <label for="practice_material">Материалы для упражнения</label>
                <textarea name="practice_material" id="practice_material" class="form-control" rows="3"><?=$practice['material']?></textarea>
            </div>
            <input type="hidden" id="practice_id" name="practice_id" value="<?=$practice['id']?>">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
            <button type="button" class="btn btn-primary" id="btn_edit_practice">Сохранить</button>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->