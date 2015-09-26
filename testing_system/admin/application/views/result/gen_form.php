<div class="form_content">
    <h3><?= $page_title ?></h3>
    <form id="evaluate_general" action='<?= site_url($action) ?>' method='post'>

        <?php for ($j = 0; $j < count($question); $j++) { ?>
            <div class="col-md-10"><h2><?php echo $question[$j]['texts']; ?><h2></div>
                        <input type="hidden" name="qid[]" value="<?php echo $question[$j]['id']; ?>">
                        <div><p><textarea id="details" class="form-control" rows="10" cols="80" spellcheck="true" name="answer[]"><?php echo $answer[$j]['answer']; ?></textarea></p></div>

                    <?php } ?>
						 <tr>
                <th>Marks<span class='req_mark'>*</span> :</th>
                <td><input type='text' name='general' value='<?= $general ?>'class="text ui-widget-content ui-corner-all width_200" /><?= form_error('general', '<span>', '</span>') ?></td></td>
            </tr>
			
 <tr><th>&nbsp;</th>
                <td>
                    <input type='submit' name='save' value='Save' class='button' />
                    <input type='button' name='cancel' value='Cancel' class='button cancel' onClick='history.go(-1);
                            return true;'/>
                </td></tr>
    </form>
</div>