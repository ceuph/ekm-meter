<?php
use yii\helpers\Html;
/* @var $groups[] GroupsSearch */
?>
<form method="post" class="form">
    <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
    <table class="table">
        <thead>
            <tr>
                <th>Group</th><th>Start Date/Time</th><th>End Date/Time</th>
            </tr>
        </thead>
        <tbody id="fields">
            <?php for ($x = 0; $x < 2; $x++) : ?>
                <tr id="row-<?= $x ?>">
                    <td class="form-group col-lg-3">
                        <select id="id-<?= $x ?>" name="id[<?= $x ?>]" class="form-control">
                            <?php foreach ($groups as $group) : ?>
                                <option value="<?= $group->id ?>"><?= $group->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td class="form-group col-lg-3">
                        <input id="min_time-<?= $x ?>" name="min_time[<?= $x ?>]" type="datetime-local" class="form-control" />
                    </td>
                    <td class="form-group col-lg-3">
                        <input id="max_time-<?= $x ?>" name="max_time[<?= $x ?>]" type="datetime-local" class="form-control" />
                    </td>
                    <td class="form-group col-lg-1">
                        <input id="color-<?= $x ?>" name="color[<?= $x ?>]" type="color" class="form-control" />
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
        var fields = '' +
            '                    <td class="form-group col-lg-3">' +
            '                        <select id="id-' + x + '" name="id[' + x + ']" class="form-control">' +
            <?php foreach ($groups as $group) : ?>
            '                                <option value="<?= $group->id ?>"><?= $group->name ?></option>' +
            <?php endforeach; ?>
            '                        </select>' +
            '                    </td>' +
            '                    <td class="form-group col-lg-3">' +
            '                        <input id="min_time-' + x + '" name="min_time[' + x + ']" type="datetime-local" class="form-control" />' +
            '                    </td>' +
            '                    <td class="form-group col-lg-3">' +
            '                        <input id="max_time-' + x + '" name="max_time[' + x + ']" type="datetime-local" class="form-control" />\n' +
            '                    </td>' +
            '                    <td class="form-group col-lg-1">' +
            '                        <input id="color-' + x + '" name="color[' + x + ']" type="color" class="form-control" />' +
            '                    </td>' +
            '';
        var row = document.createElement('tr');
        row.id = 'row-' + x;
        row.innerHTML = fields;
        document.getElementById('fields').appendChild(row);
        x++;
        return false;
    }
    document.getElementById('add_row').onclick = add_row;

</script>
