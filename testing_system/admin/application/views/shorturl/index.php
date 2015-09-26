<?php
/*
  $sql=$this->session->userdata('query');
  echo "<script type='text/javascript'>alert('".$_POST['searchField']."');</script>";
  echo "<script type='text/javascript'>alert('".$sql."');</script>";
 */
?>

<div class="form_content">

    <form name="search_purchase" action="<?= site_url('question') ?>" method="POST">
        <table>
            <tr>
                <th>Search Field</th><td>
                    <select name="searchField"> 
                        <option value="0" <?php if ($_POST['searchField'] == 0) echo 'selected' ?>>None</option>			
                        <option value="1" <?php if ($_POST['searchField'] == 1) echo 'selected' ?>>General</option>
                        <option value="2" <?php if ($_POST['searchField'] == 2) echo 'selected' ?>>First Part</option>
                        <option value="3" <?php if ($_POST['searchField'] == 3) echo 'selected' ?>>Second Part</option>
                        <option value="4" <?php if ($_POST['searchField'] == 4) echo 'selected' ?>>Third Part</option>
                    </select>
                </td>
               <!-- <th>Search Keyword</th><td><input type="text" name="searchValue" class="text ui-widget-content ui-corner-all width_160" value=<//=$_POST['searchValue'] ?> ></td>-->
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
            <button id="add" title="question/new_question"  class="jadd_button">Add</button>
        <?php endif; ?>
        <?php if (common::update_permit()): ?>
            <button title="question/edit_question" class="jedit_button">Edit</button>
            <button title="question/delete_question" class="jdelete_button">Delete</button>
            <button title="question/question_status/active" class="jstatus_button">Activate</button>
            <button title="question/question_status/inactive" class="jstatus_button">Inactive</button>
            <!--<button title="question/edit_answer" class="jedit_button">Edit Answer</button>-->
        <?php endif; ?>
    </div>
    <hr />
    <?php echo $grid_data ?>
</div>