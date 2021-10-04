<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="<?=base_url('assets/css/bootstrap.css') ?>" type="text/css">
    </head>
    <body>

        <div class="form-box" id="login-box">
            <div class="header bg-navy">Register</div>
                <div class="body bg-gray">
                    <form action="<?= base_url('auth/add_user'); ?>" method="post">
                    <?= csrf_field(); ?>
                        <?php if(!empty(session()->getFlashdata('fail'))):?>
                            <div class="alert alert-danger"><?= session()->getFlashdata('fail') ?></div>
                        <?php endif;?>
                        <?php if(!empty(session()->getFlashdata('sucess'))):?>
                            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                        <?php endif;?>
                        
                        <div class="form-group">  
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-send-o"></i> </div>
                            <input type="email" name="email" class="form-control" placeholder="Email" value="<?= set_value('email'); ?>"/></div>
                            <span class="text-danger"><?= isset($validation) ? display_error($validation,'email') : '' ?></span>
                        
                        </div>

                        <div class="form-group">  
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-send-o"></i> </div>
                            <input type="text" name="username" class="form-control" placeholder="Username"  value="<?= set_value('username'); ?>"/></div>
                            <span class="text-danger"><?= isset($validation) ? display_error($validation,'username') : '' ?></span>
                      
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-lock"></i> </div>
                                <input type="password" name="password" class="form-control" placeholder="Password"  value="<?= set_value('password'); ?>"/></div>
                                <span class="text-danger"><?= isset($validation) ? display_error($validation,'password') : '' ?></span>
                            
                        </div>
                         
                        <div class="form-group">  
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-send-o"></i> </div>
                            <input type="password" name="confirm_pass" class="form-control" placeholder="Confirm Password"  value="<?= set_value('confirm_pass'); ?>"/></div>
                            <span class="text-danger"><?= isset($validation) ? display_error($validation,'confirm_pass') : '' ?></span>
                       
                        </div>
                </div>
                    
                <div class="footer">
                    <button type="submit" class="btn bg-navy btn-block">Sign Up</button>

                   
                    <a href="<?php echo base_url('auth/') ?>" class="text-center">Already have an account? Sign-In</a>
            </div>
            </form>
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js" type="text/javascript"></script>

    </body>
</html>
