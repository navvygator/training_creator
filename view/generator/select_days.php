<h4>Дни тренинга</h4>
<div class="col-xs-9 padding0">
<select id="days" name="days" class="form-control">
    <option>Выберите день</option>
    <?php foreach($training_days as $day): ?>
        <option value="<?=$day['id']?>"><?=$day['day']." день"?></option>
    <?php endforeach; ?>
</select>
</div>
<div class="col-xs-3 padding0">
<button class="btn btn-default" id="btn_add_day">+</button><button class="btn btn-danger" id="btn_delete_day">–</button>
</div><br /><br />