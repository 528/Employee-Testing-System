<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<style type="text/css">
    .bs-example{
        margin: 18 px;
    }
</style>

<div class="bs-example">
    <form action='<?= site_url('skill_test') ?>' method='POST' autocomplete="off">
        <input type="text" name="fullname" class="form-control"><?= form_error('fullname', '<span class="help-block">', '</span>') ?>
        <span class="help-block">Type your Full name(First and last name) in the above box.</span>
</div>
<div class="form-group">
    <div class="col-xs-offset-0 col-xs-1">
        <button type="submit" name="skill_info" value="true" class="btn btn-primary">Submit</button>
    </div>
</form>

