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

<script type="text/javascript">
/*
function evalGroup()
{
<?php
$js_array = json_encode($qid);
echo "var myArr = ". $js_array . ";\n";
?>
  
for (var k=0; k<myArr.length ; k++){
<?php
    if(isset($_GET['k'])) { 

    $ind = $_GET['k'];
    }
?> 
var group = document.radioForm.<?=$qid[$ind]?>;
for (var i=0; i<group.length; i++) {
if (group[i].checked)
break;
}
if (i==group.length)
return alert("You must have to answer all the questions");
//alert("Radio Button " + (i+1) + " is checked.");
}
}
*/
</script>


<?php //require_once (dirname(dirname(__FILE__)) . '/shared/timer.php'); ?>
<div class="row">
    <form action='<?= site_url('skill_test/submit_first_part') ?>' method='POST' name="radioForm">

        <?php for ($j = 0; $j < count($qid); $j++) { ?>
            <div class="col-md-10"><h2><small><?php echo $text[$j]; ?></small><h2></div>
                        <input type="hidden" name="qid[]" value="<?php echo $qid[$j]; ?>">

                        <div class="col-xs-6">

                            <div class="input-group">
                                <span class="input-group-addon">
                                    <input type="radio" name="<?php echo $qid[$j]; ?>" value="a">
                                </span>
                                <input type="text" placeholder="<?php echo $first[$j]; ?>" disabled="disabled" class="form-control">
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <input type="radio" name="<?php echo $qid[$j]; ?>" value="b">
                                </span>
                                <input type="text" placeholder="<?php echo $second[$j]; ?>" disabled="disabled" class="form-control">
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <input type="radio" name="<?php echo $qid[$j]; ?>" value="c">
                                </span>
                                <input type="text" placeholder="<?php echo $third[$j]; ?>" disabled="disabled" class="form-control">
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <input type="radio" name="<?php echo $qid[$j]; ?>" value="d">
                                </span>
                                <input type="text" placeholder="<?php echo $fourth[$j]; ?>" disabled="disabled" class="form-control">
                            </div>

                        </div>    



                    <?php } ?>
                    <div class="form-group">
                        <div class="col-xs-offset-2 col-xs-5" style="margin-top:10px;">
                            <button type="submit" name="submit_first" value="true" class="btn btn-primary" onclick="evalGroup()">Submit</button>
                        </div>
                    </div>

                    </form>

                    </div>

