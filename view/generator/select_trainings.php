<h4>Мои тренинги:</h4>
<select id="training" name="training" class="form-control" size="5">
    <?php foreach($trainings as $training): ?>
        <option value="<?=$training['id']?>"><?=$training['name']?></option>
    <?php endforeach; ?>
</select>
<button class="btn btn-default" id="btn_window_add_training">Создать</button>
<button class="btn btn-default" id="btn_window_edit_training">Изменить</button>
<button class="btn btn-danger" id="btn_window_delete_training">Удалить</button>