<?php
use app\controllers\ReportController;
?>

<div class="row">
    <div class="col-lg-12">
        <table class="table table-hover">
            <thead>
                <th>Date/Time</th>
                <th><?= implode('</th><th>',($data['rows']['labels'])) ?></th>
            </thead>
            <tbody>
                <?php foreach ($data['labels'] as $index => $label) : ?>
                    <tr>
                        <td><?= $label ?></td>
                        <?php foreach ($data['rows']['data'][$index] as $item) : ?>
                            <td class="<?= ReportController::getHtmlClass($data['rows']['data'][$index], $item['value'], $data['min'], $data['max']) ?>">
                                <?= number_format($item['value'], 4) ?>
                                <?php switch (Yii::$app->request->get('data')) {
                                    case 'diff':
                                    case 'avg':
                                        echo 'KWh';
                                        break;
                                    case 'co2':
                                        echo 'KgCO<sub>2</sub>';
                                        break;
                                    default:
                                        echo Yii::$app->request->get('data') . 's';
                                        break;

                                }
                                echo 'no' == Yii::$app->request->get('shift') ? '<br />' . $item['label'] : null;
                                ?>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<form method="post" class="form-inline">
    <div class="row">
        <div class="col-lg-3 form-group">
            <select id="highlight-option" name="highlight_option" class="form-control" style="width: 200px;">
                <option value="row-min">Row Lows</option>
                <option value="row-max">Row Highs</option>
                <option value="min">Lowest Value</option>
                <option value="max">Highest Value</option>
            </select>
            <input id="highlight-color" name="highlight_color" type="color" class="form-control" value="#ffbfc1" style="width: 50px;" />
        </div>
        <div class="col-lg-4">
            <input id="highlight" type="button" class="btn btn-default" value="Highlight" />
            <input id="highlight-clear" type="button" class="btn btn-default" value="Clear" />
        </div>
    </div>
</form>
<script type="text/javascript">
    document.getElementById('highlight').onclick = function () {
        var option = document.getElementById('highlight-option').value;
        meters = null;
        if ('row-min' == option) {
            meters = document.getElementsByClassName('meter-data-row-min');
        }
        if ('row-max' == option) {
            meters = document.getElementsByClassName('meter-data-row-max');
        }
        if ('min' == option) {
            meters = document.getElementsByClassName('meter-data-min');
        }
        if ('max' == option) {
            meters = document.getElementsByClassName('meter-data-max');
        }
        for (var e in meters) {
            meters[e].style.backgroundColor = document.getElementById('highlight-color').value;
        }
        return false;
    };
    document.getElementById('highlight-clear').onclick = function () {
        var meters = document.getElementsByClassName('meter-data');
        for (var e in meters) {
            meters[e].style.backgroundColor = 'transparent';
        }
        return false;
    };
</script>