<h4><?=$training['name']?> - Всего времени запланировано: <?=$training['total_time']?>; Не использовано времени: <?=$training['total_free_time']?></h4>
<table class="table table-bordered">
    <?php foreach($training['days'] as $day): ?>
        <tr>
            <td colspan="7"><b><?=$day['day']." день"?></b></td>
        </tr>
            <?php foreach($day['blocks'] as $block): ?>
                <?php if(!empty($block['id'])): ?>
                    <tr>
                        <td colspan="7"><b><?=$block['block_name'].". Продолжительность блока: ".$block['time'].". Свободно времени в блоке: ".$block['free_time']?></b></td>
                    </tr>
                    <?php foreach($block['block_practice'] as $block_practice): ?>
                        <?php if(!empty($block_practice['id'])): ?>
                            <tr>
                                <td><?=$block_practice['name']?></td>
                                <td><?=$block_practice['time']?></td>
                                <td><?=$block_practice['theme']?></td>
                                <td><?=$block_practice['purpose']?></td>
                                <td><?=$block_practice['content']?></td>
                                <td><?=$block_practice['inference']?></td>
                                <td><?=$block_practice['material']?></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            <?php endforeach; ?>
    <?php endforeach; ?>
</table>
