<h4>Упражнения в базе:</h4>
<select id="all_practice" name="all_practice" class="form-control" size="20">
    <?php foreach($practice as $unit): ?>
        <option value="<?=$unit['id']?>"><?=$unit['time']." ".$unit['name']?></option>
    <?php endforeach; ?>
</select>
<button class="btn btn-default" id="btn_window_add_practice">Создать</button>
<button class="btn btn-default" id="btn_window_view_practice">Просмотр</button>
<button class="btn btn-default" id="btn_window_edit_practice">Изменить</button>
<button class="btn btn-danger" id="btn_window_delete_practice">Удалить</button>