<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Просмотр упражнения</h4>
        </div>
        <div class="modal-body">
            <h5>Название упражнения:</h5>
            <?=$practice['name']?>
            <h5>Продолжительность упражнения:</h5>
            <?=$practice['time']?>
            <h5>Тематика упражнения:</h5>
            <?=$practice['theme']?>
            <h5>Цель упражнения:</h5>
            <?=$practice['purpose']?>
            <h5>Описание упражнения</h5>
            <?=$practice['content']?>
            <h5>Выводы из упражнения:</h5>
            <?=$practice['inference']?>
            <h5>Материалы необходимые для упражнения:</h5>
            <?=$practice['material']?>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->