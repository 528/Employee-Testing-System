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
<!--
<link rel="stylesheet" href="<?//=site_url()?>bootstrap/jquery.mobile-1.0rc2/jquery.mobile-1.0rc2.css" type="text/css" media="screen" />

<script type="text/javascript" src="<?//=site_url()?>bootstrap/jquery.mobile-1.0rc2/jquery-1.6.4.js"></script>
<script type="text/javascript" src="<?//=site_url()?>bootstrap/jquery.mobile-1.0rc2/jquery.mobile-1.0rc2.js"></script>-->


<div class="row">
    <form action='<?= site_url('general/answer_submit') ?>' method='POST'>

        <?php for ($j = 0; $j < count($qid); $j++) { ?>
            <div class="col-md-10"><h2><small><?php echo $text[$j]; ?></small><h2></div>
                        <input type="hidden" name="qid[]" value="<?php echo $qid[$j]; ?>">
                        <div class="col-md-10"><p><textarea id="details" class="form-control" rows="10" spellcheck="false" name="answer[]"></textarea></p></div>

                    <?php } ?>
 <div class="form-group">
            <div class="col-xs-offset-5 col-xs-10">
                <button type="submit" name="submit_general" value="true" class="btn btn-primary">Submit</button>
            </div>
     </div>

</form>
        
    </div>

