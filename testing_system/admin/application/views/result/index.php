<div class="form_content">
    <form action="<?= site_url('result') ?>" method="post">
        <table>
            <tr>
                <th>Search Field</th><td><select name="searchField"><?= $this->mod_result->get_search_options($_REQUEST['searchField']) ?></select></td>
                <th>Search Keyword</th><td><input type="text" name="searchValue" class="text ui-widget-content ui-corner-all width_160" value="<?= $_REQUEST['searchValue'] ?>" class="" /></td>
            </tr>
            <tr><th colspan="4"><input type="submit" name="apply_filter" value="Apply Filter" class="button" /></th></tr>
        </table>
    </form>
</div>
<div class='grid_area'>
    <?php
    if ($msg != "") {
        echo "<div class='success'>$msg</div>";
    }
    ?>
    <div class="tooolbars">
        <?php if (common::add_permit()): ?>
            <button id="add" title="user/new_user"  class="jadd_button" style="display:none;">Add</button>
        <?php endif; ?>
        <?php if (common::update_permit()): ?>
            <button title="result/evaluate_general" class="jedit_button">General</button>
            <button title="result/evaluate_third" class="jedit_button">Third Part</button>
            <button title="result/delete_result" class="jdelete_button">Delete</button>


        <?php endif; ?>
    </div>
    <hr />
    <?php echo $grid_data ?>
</div>