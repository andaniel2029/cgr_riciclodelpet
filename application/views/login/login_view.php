<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="robots" content="noindex, nofollow"/>
        <title>CGR - Area riservata</title>
        <link rel="stylesheet" media="screen" type="text/css" href="<?php echo base_url(); ?>css/cupertino/jquery-ui-1.10.1.custom.css"/>
        <link rel="stylesheet" media="screen" type="text/css" href="<?php echo base_url(); ?>css/login.css"/>

        <script type="text/javascript" src="<?= base_url() ?>js/modernizr.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>js/jquery-1.9.1.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>js/jquery-ui-1.10.1.custom.min.js"></script>   
        <script type="text/javascript" src="<?= base_url() ?>js/login.js"></script>        
    </head>
    <body>

        <br>
        <br>
        
        <div id="login_cont" class="centrato bordato">

            <div id="login_testo" class="centrato">
                Area riservata
            </div>
            
            <div id="login_form" class="centrato">
                <?php
                
             echo form_fieldset();
                
                 echo form_open('admin/login/auth');

                 echo form_label('Password:').br();
                 echo form_input('pswd').br(2);
                 echo form_submit('','Accedi');
                 echo form_fieldset_close();
                
                ?>
            </div>
            <br class="login_clear">
        </div>
        <?php
        // put your code here
        ?>
    </body>
</html>
