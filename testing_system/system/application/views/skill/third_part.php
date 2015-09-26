<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<style type="text/css">
    p{
        padding: 50px;
        font-size: 32px;
        font-weight: bold;
        text-align: center;
        background: #f2f2f2;
    }
</style>
<?php //require_once (dirname(dirname(__FILE__)) . '/shared/timer.php'); ?>



<div class="row">
    <form action='<?= site_url('skill_test/submit_third_part') ?>' method='POST'>

        <?php for ($j = 0; $j < count($qid); $j++) { ?>
            <div class="col-md-10"><h2><small><?php echo $text[$j]; ?></small><h2></div>
                        <input type="hidden" name="qid[]" value="<?php echo $qid[$j]; ?>">
                        <div class="col-md-10"><p>
                                <!--<input type="text" name="answer[]" class="form-control">-->
                                <textarea id="details" class="form-control" rows="10" spellcheck="false" name="answer[]"></textarea></p></div>

                    <?php } ?>
                    <div class="form-group">
                        <div class="col-xs-offset-5 col-xs-10">
                            <button type="submit" name="submit_math" value="true" class="btn btn-primary">Submit</button>
                        </div>
                    </div>

                    </form>

                    </div>

