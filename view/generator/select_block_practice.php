<div class="col-xs-11">
    <h4>Упражнения в блоке:</h4>
    <select id="block_practice" name="block_practice" class="form-control" size="20">
        <?php foreach($block_practice as $unit): ?>
            <option value="<?=$unit['id']?>"><?=$unit['time']." ".$unit['name']?></option>
        <?php endforeach; ?>
    </select>
    <h5>Свободного времени в блоке: <?=$free_time?></h5>
</div>
<div class="col-xs-1 padding-top100">
    <button class="btn btn-default" id="btn_add_block_practice"><</button><br/><button class="btn btn-default" id="btn_delete_block_practice">></button>
</div>