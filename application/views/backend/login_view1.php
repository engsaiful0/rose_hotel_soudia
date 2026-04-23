<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <?php
        $banner = $this->db->where('banner_id', '1')->get('company')->row();
        $title = $this->db->where('banner_id', '1')->get('company')->row();
        ?>
        <title><?php echo $banner->title ?></title>
        <link rel="icon"  type="image/x-icon" href="<?php echo base_url() ?>assets/uploads/banner/<?php echo $title->favicon ?>" />
        <link href="<?php echo base_url(); ?>backend/css/bootstrap-theme.css" rel='stylesheet' type='text/css' />
        <link href="<?php echo base_url(); ?>backend/css/bootstrap-theme.min.css" rel='stylesheet' type='text/css' />
        <link href="<?php echo base_url(); ?>backend/css/bootstrap.css" rel='stylesheet' type='text/css' />
        <link href="<?php echo base_url(); ?>backend/css/bootstrap.min.css" rel='stylesheet' type='text/css' />
        <script src="<?php echo base_url(); ?>backend/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>backend/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>backend/js/npm.min.js"></script>

        <link rel="icon"  type="image/x-icon" href="<?php echo base_url() ?>assets/uploads/banner/<?php echo $title->favicon ?>" />


        <script type="text/javascript" src="<?php echo base_url(); ?>backend/js/jquery_menue.js"></script>

        <script type="text/javascript" src="<?php echo base_url(); ?>backend/js/jquery.smartmenus.js"></script>
        <link href="<?php echo base_url(); ?>backend/css/custom_css.css" rel="stylesheet" type="text/css" />

        <script type="text/javascript">
            $(function () {
                $('#main-menu').smartmenus({
                    subMenusSubOffsetX: 1,
                    subMenusSubOffsetY: -8
                });
            });
        </script>

    </head>
    <body style="background-color: sandybrown ">
        <div class="row">
                <div class="col-md-12">
                    <div id="p0" data-pjax-container="" data-pjax-push-state data-pjax-timeout="10000">
                        <?php
                        if ($this->session->userdata('message') != '') {
                            ?>                   
                            <p class="alert alert-success alert-auto-hide dism " style="text-align: center">  <a href="#" class="close" style="text-decoration:none" data-dismiss="alert" aria-label="close">&times;</a> <strong>Failed!</strong>User name or password is incorrect.Please try again.</p>                      
                            <?php
                            $sdata['message'] = '';
                            $this->session->set_userdata($sdata);
                        }
                        ?>
                    </div>
                </div>
            </div>
        <div class="row" style="margin-top:200px; ">
                <div class="col-md-4">
                    
                </div>
                <div class="col-md-4">
                     <div style="margin-bottom:10px;  " class="sign-in">
            <p>Sign In</p>
            <form method="post" action="<?php echo base_url() ?>login-function" >
                <div class="form-group">
                    <input class="form-control" value="admin@admin.com" placeholder="User Name" name="user_name">

                </div>
                <div class="form-group">
                    <input class="form-control" value="admin" placeholder="Password" type="password" name="password">

                </div>
                <div class="form-group">
                    <input class="btn btn-primary"  type="submit" name="submit" value="Submit">

                </div>

            </form>
        </div>
                </div>
                <div class="col-md-4">
                    
                </div>
                
            </div>
            
        
       
    </body>
</html>
