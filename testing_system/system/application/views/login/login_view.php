<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<div class="bs-example">

    <form action='<?= site_url('login') ?>' method='POST' class="form-horizontal" autocomplete="off">
        <div class="form-group">
            <label for="inputEmail" class="control-label col-xs-5"><span class="help-block"><?php echo $msg; ?></span></label>
        </div> 
        <div class="form-group">
            <label for="inputEmail" class="control-label col-xs-2">Email</label>
            <div class="col-xs-5">
                <input type="email" name="username" class="form-control" id="inputEmail" placeholder="Email"><?= form_error('username', '<span class="help-block">', '</span>') ?>
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword" class="control-label col-xs-2">Password</label>
            <div class="col-xs-5">
                <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password"><?= form_error('password', '<span class="help-block">', '</span>') ?>
            </div>
        </div>
        <input type="hidden" name="submit_login" value="true">
        <div class="form-group">
            <div class="col-xs-offset-2 col-xs-10">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>

        </div>
    </form>
</div>
</div>
</div>
</div>
</div>


