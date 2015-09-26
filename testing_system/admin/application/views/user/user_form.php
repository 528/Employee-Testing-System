<div class="form_content">
    <h3><?= $page_title ?></h3>
    <form id="valid_user" action='<?= site_url($action) ?>' method='post'>
        <table cellspacing='1' cellpadding='2' width='100%' class='pad_10'>
            <tr>
                <th>Email <span class='req_mark'>*</span></th>
                <td><input type='text' name='user_name' value='<?= $username ?>'class="text ui-widget-content ui-corner-all width_200" /><?= form_error('username', '<span>', '</span>') ?></td>
            </tr>
            <tr>
                <th>Password <span class='req_mark'>*</span></th>
                <td><input type='password' name='password' value='<?= $password ?>' id="password" class="text ui-widget-content ui-corner-all width_200" /></td>
            </tr>
            <tr>
                <th>Confirm Password <span class='req_mark'>*</span></th>
                <td><input type='password' name='confirm_password' value='<?= $password ?>'class="text ui-widget-content ui-corner-all width_200" /></td>
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