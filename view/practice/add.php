<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Создание упражнения</h4>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="practice_name">Название упражнения</label>
                <input type="text" name="practice_name" id="practice_name" class="form-control">
            </div>
            <div class="form-group">
                <label for="practice_time">Продолжительность упражнения</label>
                <input type="text" name="practice_time" id="practice_time" class="form-control" placeholder="чч:мм:сс">
            </div>
            <div class="form-group">
                <label for="practice_theme">Тематика упражнения</label>
                <input type="text" name="practice_theme" id="practice_theme" class="form-control">
            </div>
            <div class="form-group">
                <label for="practice_purpose">Цель упражнения</label>
                <textarea name="practice_purpose" id="practice_purpose" class="form-control" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="practice_content">Описание упражнения</label>
                <textarea name="practice_content" id="practice_content" class="form-control" rows="10"></textarea>
            </div>
            <div class="form-group">
                <label for="practice_inference">Выводы из упражнения</label>
                <textarea name="practice_inference" id="practice_inference" class="form-control" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="practice_material">Материалы для упражнения</label>
                <textarea name="practice_material" id="practice_material" class="form-control" rows="3"></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
            <button type="button" class="btn btn-primary" id="btn_add_practice">Создать</button>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->