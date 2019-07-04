<?php
/* @var $dropDownItems[] GroupsSearch */
use yii\helpers\Url;
use yii\helpers\Html;
$get = Yii::$app->request->get();
$count = isset($get['id']) ? count($get['id']) : 2;
$x = 0;
?>
<?= Html::beginForm('', 'get') ?>
    <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
    <div class="row">
        <div class="form-group col-lg-3">
            <label for="type">Report Type</label>
            <select id="type" name="type" class="form-control">
                <option value="hr"<?= isset($get['type']) && $get['type'] == 'hr' ? ' selected="selected"' : null ?>>Hourly</option>
                <option value="dy"<?= isset($get['type']) && $get['type'] == 'dy' ? ' selected="selected"' : null ?>>Daily</option>
                <option value="wk"<?= isset($get['type']) && $get['type'] == 'wk' ? ' selected="selected"' : null ?>>Weekly</option>
                <option value="mo"<?= isset($get['type']) && $get['type'] == 'mo' ? ' selected="selected"' : null ?>>Monthly</option>
            </select>
        </div>
        <div class="form-group col-lg-3">
            <label for="data">Data Type</label>
            <select id="data" name="data" class="form-control">
                <option value="diff"<?= isset($get['data']) && $get['data'] == 'diff' ? ' selected="selected"' : null ?>>Total KWh Difference</option>
                <option value="co2"<?= isset($get['data']) && $get['data'] == 'co2' ? ' selected="selected"' : null ?>>Total KgCO<sub>2</sub></option>
                <option value="avg"<?= isset($get['data']) && $get['data'] == 'avg' ? ' selected="selected"' : null ?>>Average Watts</option>
                <option value="volt"<?= isset($get['data']) && $get['data'] == 'volt' ? ' selected="selected"' : null ?>>Average Volts</option>
                <option value="amp"<?= isset($get['data']) && $get['data'] == 'amp' ? ' selected="selected"' : null ?>>Average Amperes</option>
            </select>
        </div>
        <div class="form-group col-lg-2">
            <label for="shift">Shift Dates</label>
            <select id="shift" name="shift" class="form-control">
                <option value="yes"<?= isset($get['shift']) && $get['shift'] == 'yes' ? ' selected="selected"' : null ?>>Yes</option>
                <option value="no"<?= isset($get['shift']) && $get['shift'] == 'no' ? ' selected="selected"' : null ?>>No</option>
            </select>
        </div>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th><?= ucfirst($granularity) ?></th><th>Start Date/Time</th><th>End Date/Time</th><th>Color</th><th></th>
        </tr>
        </thead>
        <tbody id="fields">
        <?php for ($i = 0; $i < $count; $i++) : ?>
            <?php
            if (isset($get['id'])) {
                $x = key($get['id']);
                next($get['id']);
            } else {
                $x = $i;
            }
            ?>
            <tr id="row-<?= $x ?>">
                <td class="form-group col-lg-3">
                    <select id="id-<?= $x ?>" name="id[<?= $x ?>]" class="form-control">
                        <?php foreach ($dropDownItems as $dropdownItem) : ?>
                            <option value="<?= $dropdownItem->id ?>"<?= isset($get['id'][$x]) && $get['id'][$x] == $dropdownItem->id ? ' selected="selected"' : null ?>><?= $dropdownItem->name ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td class="form-group col-lg-3">
                    <input id="min_time-<?= $x ?>" name="min_time[<?= $x ?>]" type="datetime-local" class="form-control" value="<?= isset($get['min_time'][$x]) ? $get['min_time'][$x] : null ?>" />
                </td>
                <td class="form-group col-lg-3">
                    <input id="max_time-<?= $x ?>" name="max_time[<?= $x ?>]" type="datetime-local" class="form-control" value="<?= isset($get['max_time'][$x]) ? $get['max_time'][$x] : null ?>" />
                </td>
                <td class="form-group col-lg-1">
                    <input id="color-<?= $x ?>" name="color[<?= $x ?>]" type="color" class="form-control" value="<?= isset($get['color'][$x]) ? $get['color'][$x] : null ?>" />
                </td>
                <td class="form-group col-lg-1">
                    <a href="#" onclick="delete_row(<?=$x?>)" class="btn btn-default"><i class="glyphicon glyphicon-trash"></i></a>
                </td>
            </tr>
        <?php endfor; ?>
        </tbody>
        <tfoot>
        </tfoot>
    </table>
    <div class="row">
        <div class="col-lg-12">
            <a id="add_row" href="#" class="btn btn-default">Add Row</a>
            <input type="submit" name="submit" value="Create Report" class="btn btn-primary" />
            <input type="submit" name="submit" value="Download Data" class="btn btn-primary" />
        </div>
    </div>
<?= Html::endForm() ?>
<script type="text/javascript">
    var x = <?= $x + 1 ?>;
    function add_row()
    {
        var fields = '<td class="form-group col-lg-3">' +
            '    <select id="id-' + x + '" name="id[' + x + ']" class="form-control">' +
            <?php foreach ($dropDownItems as $dropdownItem) : ?>
            '            <option value="<?= $dropdownItem->id ?>"><?= $dropdownItem->name ?></option>' +
            <?php endforeach; ?>
            '    </select>' +
            '</td>' +
            '<td class="form-group col-lg-3">' +
            '    <input id="min_time-' + x + '" name="min_time[' + x + ']" type="datetime-local" class="form-control" />' +
            '</td>' +
            '<td class="form-group col-lg-3">' +
            '    <input id="max_time-' + x + '" name="max_time[' + x + ']" type="datetime-local" class="form-control" />' +
            '</td>' +
            '<td class="form-group col-lg-1">' +
            '     <input id="color-' + x + '" name="color[' + x + ']" type="color" class="form-control" />' +
            '</td>' +
            '<td class="form-group col-lg-1">' +
            '    <a href="#" onclick="delete_row(' + x + ')" class="btn btn-default"><i class="glyphicon glyphicon-trash"></i></a>' +
            '</td>';
        var row = document.createElement('tr');
        row.id = 'row-' + x;
        row.innerHTML = fields;
        document.getElementById('fields').appendChild(row);
        x++;
        return false;
    }

    function delete_row(x)
    {
        document.getElementById('row-' + x).remove();
        return false;
    }
    document.getElementById('add_row').onclick = add_row;
</script>