<h4>Блоки:</h4>
<select id="block" name="block" class="form-control" size="5">
    <?php foreach($day_blocks as $block): ?>
        <option value="<?=$block['id']?>"><?=$block['block_name']?></option>
    <?php endforeach; ?>
</select>
<button class="btn btn-default" id="btn_window_add_block">Создать</button>
<button class="btn btn-default" id="btn_window_edit_block">Изменить</button>
<button class="btn btn-danger" id="btn_window_delete_block">Удалить</button>