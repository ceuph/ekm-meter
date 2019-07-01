<?php
use yii\helpers\Html;
$post = Yii::$app->request->post();
$count = isset($post['id']) ? count($post['id']) : 2;
/* @var $groups[] GroupsSearch */
?>
<form method="post" class="form">
    <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
    <div class="row">
        <div class="form-group col-lg-3">
            <label for="type">Report Type</label>
            <select id="type" name="type" class="form-control">
                <option value="hr"<?= isset($post['type']) && $post['type'] == 'hr' ? ' selected="selected"' : null ?>>Hourly</option>
                <option value="dy"<?= isset($post['type']) && $post['type'] == 'dy' ? ' selected="selected"' : null ?>>Daily</option>
                <option value="wk"<?= isset($post['type']) && $post['type'] == 'wk' ? ' selected="selected"' : null ?>>Weekly</option>
                <option value="mo"<?= isset($post['type']) && $post['type'] == 'mo' ? ' selected="selected"' : null ?>>Monthly</option>
            </select>
        </div>
        <div class="form-group col-lg-3">
            <label for="data">Data Type</label>
            <select id="data" name="data" class="form-control">
                <option value="diff"<?= isset($post['data']) && $post['data'] == 'diff' ? ' selected="selected"' : null ?>>KW/H Difference</option>
                <option value="avg"<?= isset($post['data']) && $post['data'] == 'avg' ? ' selected="selected"' : null ?>>KW/H Average</option>
                <option value="volt"<?= isset($post['data']) && $post['data'] == 'volt' ? ' selected="selected"' : null ?>>Average Volts</option>
                <option value="amp"<?= isset($post['data']) && $post['data'] == 'amp' ? ' selected="selected"' : null ?>>Average Amp</option>
            </select>
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Group</th><th>Start Date/Time</th><th>End Date/Time</th>
            </tr>
        </thead>
        <tbody id="fields">
            <?php for ($x = 0; $x < $count; $x++) : ?>
                <tr id="row-<?= $x ?>">
                    <td class="form-group col-lg-3">
                        <select id="id-<?= $x ?>" name="id[<?= $x ?>]" class="form-control">
                            <?php foreach ($groups as $group) : ?>
                                <option value="<?= $group->id ?>"<?= isset($post['id'][$x]) && $post['id'][$x] == $group->id ? ' selected="selected"' : null ?>><?= $group->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td class="form-group col-lg-3">
                        <input id="min_time-<?= $x ?>" name="min_time[<?= $x ?>]" type="datetime-local" class="form-control" value="<?= isset($post['min_time'][$x]) ? $post['min_time'][$x] : null ?>" />
                    </td>
                    <td class="form-group col-lg-3">
                        <input id="max_time-<?= $x ?>" name="max_time[<?= $x ?>]" type="datetime-local" class="form-control" value="<?= isset($post['max_time'][$x]) ? $post['max_time'][$x] : null ?>" />
                    </td>
                    <td class="form-group col-lg-1">
                        <input id="color-<?= $x ?>" name="color[<?= $x ?>]" type="color" class="form-control" value="<?= isset($post['color'][$x]) ? $post['color'][$x] : null ?>" />
                    </td>
                </tr>
            <?php endfor; ?>
        </tbody>
        <tfoot>
            <tr>
                <td>
                    <a id="add_row" href="#" class="btn btn-default">Add Row</a>
                    <input type="submit" name="submit" value="Create Report" class="btn btn-primary" />
                </td>
            </tr>
        </tfoot>
    </table>
</form>
<?php var_dump(\Yii::$app->request->post()); ?>
<script type="text/javascript">
    var x = <?= $x ?>;
    function add_row() {
        var fields = '<td class="form-group col-lg-3">' +
            '    <select id="id-' + x + '" name="id[' + x + ']" class="form-control">' +
                     <?php foreach ($groups as $group) : ?>
            '            <option value="<?= $group->id ?>"><?= $group->name ?></option>' +
                     <?php endforeach; ?>
            '    </select>' +
            '</td>' +
            '<td class="form-group col-lg-3">' +
            '    <input id="min_time-' + x + '" name="min_time[' + x + ']" type="datetime-local" class="form-control" />' +
            '</td>' +
            '<td class="form-group col-lg-3">' +
            '    <input id="max_time-' + x + '" name="max_time[' + x + ']" type="datetime-local" class="form-control" />\n' +
            '</td>' +
            '<td class="form-group col-lg-1">' +
            '     <input id="color-' + x + '" name="color[' + x + ']" type="color" class="form-control" />' +
            '</td>';
        var row = document.createElement('tr');
        row.id = 'row-' + x;
        row.innerHTML = fields;
        document.getElementById('fields').appendChild(row);
        x++;
        return false;
    }
    document.getElementById('add_row').onclick = add_row;
</script>
