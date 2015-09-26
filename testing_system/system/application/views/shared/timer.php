<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$start_time = $this->session->userdata('start');
//$start_time = \strtotime('+ 30 minute',$start_time);
$start_time=date_create($start_time);
$start_time = date_format($start_time, 'm/d/Y g:i A');
//exit;

?>
<script language="JavaScript">
TargetDate = "<?php echo $start_time; ?>";
BackColor = "palegreen";
ForeColor = "navy";
CountActive = true;
CountStepper = -1;
LeadingZero = true;
DisplayFormat = "Time Left: %%H%% Hours, %%M%% Minutes, %%S%% Seconds.";
FinishMessage = "It is finally here!";
Address = "<?=site_url('logout')?>";
</script>
<script language="JavaScript" src="<?=site_url()?>bootstrap/js/countdown.js"></script>

