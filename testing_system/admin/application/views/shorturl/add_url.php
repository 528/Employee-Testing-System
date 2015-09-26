<div class="form_content">
    <h3><?= $page_title ?></h3>
    <form id="add_question" action='<?= site_url($action) ?>' method='post'>
        <table cellspacing='1' cellpadding='2' width='100%' class='pad_10'>
            <tr>
                <th>Section<span class='req_mark'>*</span>:</th>
                <td> <select name="type">
                        <option value="">Select</option>
                        <option value="0" <?php if ($_POST['type'] == "0" || $type == "0") echo 'selected' ?>> General</option>
                        <option value="1" <?php if ($_POST['type'] == "1" || $type == "1") echo 'selected' ?>>First Part</option>
                        <option value="2" <?php if ($_POST['type'] == "2" || $type == "2") echo 'selected' ?>>Second Part</option>
                        <option value="3" <?php if ($_POST['type'] == "3" || $type == "3") echo 'selected' ?>>Third Part</option>
                    </select><?= form_error('type', '<span>', '</span>') ?>
                </td>

            </tr>
            <tr>
                <td>

                </td>
            </tr>

            <tr><th>Question<span class='req_mark'>*</span>:</th></br>
                <td><textarea name="texts" style='width:97%;height:250px;'><?= $texts ?></textarea><?= form_error('texts', '<span>', '</span>') ?></td>

            </tr>
            <tr>
                <th>Answer:</th>
                <td><input type='text' name='answer' value='<?= $answer['answer'] ?>'class="text ui-widget-content ui-corner-all width_200" /></td>
            </tr>
            <tr>

                <td><hr /></td>
            </tr>
            <tr>
                <th>Multiple Option A:</th>
                <td><input type='text' name='first' value='<?= $multi_answer['first'] ?>'class="text ui-widget-content ui-corner-all width_200" /></td>
            </tr>
            <tr>
                <th>Multiple Option B:</th>
                <td><input type='text' name='second' value='<?= $multi_answer['second'] ?>'class="text ui-widget-content ui-corner-all width_200" /></td>
            </tr>
            <tr>
                <th>Multiple Option C:</th>
                <td><input type='text' name='third' value='<?= $multi_answer['third'] ?>'class="text ui-widget-content ui-corner-all width_200" /></td>
            </tr>
            <tr>
                <th>Multiple Option B:</th>
                <td><input type='text' name='fourth' value='<?= $multi_answer['fourth'] ?>'class="text ui-widget-content ui-corner-all width_200" /></td>
            </tr>


            <tr><th>&nbsp;</th>
                <td>
                    <input type='submit' name='save' value='Save' class='button' />
                    <input type='button' name='cancel' value='Cancel' class='button cancel' onClick='history.go(-1);
                            return true;'/>
                </td></tr>
        </table>
    </form>
</div>