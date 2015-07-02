<h5>Добро пожаловать в систему, <?=$user['name']?> <a href="login/logout" class="btn btn-danger">Выйти</a></h5>
<input type="hidden" value="<?=$user['id']?>" id="user_id">
<div id="show_error"></div>
<div class="row">
    <div class="col-xs-4">
        <div id="show_trainings">

        </div>
        <div id="show_days">

        </div>
        <div id="show_blocks">

        </div>
    </div>
    <div class="col-xs-4">
        <div id="show_block_practice">

        </div>
    </div>
    <div class="col-xs-4">
        <div id="show_all_practice">

        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div id="training_builder">

        </div>
    </div>
</div>

<!--Добавление тренинга-->
<div id="window_add_training" class="modal fade">

</div>
<!--Удаление тренинга-->
<div id="window_delete_training" class="modal fade">

</div>
<!--Редактирование тренинга-->
<div id="window_edit_training" class="modal fade">

</div>
<!--Добавление блока-->
<div id="window_add_block" class="modal fade">

</div>
<!--Удаление блока-->
<div id="window_delete_block" class="modal fade">

</div>
<!--Редактирование блока-->
<div id="window_edit_block" class="modal fade">

</div>
<!--Добавление упражнения-->
<div id="window_add_practice" class="modal fade">

</div>
<!--Удаление упражнения-->
<div id="window_delete_practice" class="modal fade">

</div>
<!--Редактирование упражнения-->
<div id="window_edit_practice" class="modal fade">

</div>
<!--Просмотр упражнения-->
<div id="window_view_practice" class="modal fade">

</div>

