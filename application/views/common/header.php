<div class="container">
    <div class="header-row">
        <div class="header-column justify-content-start"> 
            <!-- Logo
            ============================================= -->
            <div class="logo">
                <?php
                $banner = $this->db->where('banner_id', '1')->get('company')->row();
                $title = $this->db->where('banner_id', '1')->get('company')->row();
                ?>
<!--                <a href="--><?php //echo base_url() ?><!--home" title="Benchmark Construction">-->
<!--                    <img alt="--><?php //echo $banner->title ?><!--" style=" width: 127px;" src="--><?php //echo base_url() ?><!--assets/uploads/banner/--><?php //echo $banner->logo ?><!--">-->
<!--                </a>-->
            </div><!-- Logo end -->

        </div>

        <div class="header-column justify-content-end">

            <!-- Primary Navigation
            ============================================= -->
            <nav class="primary-menu navbar navbar-expand-lg">
                <div id="header-nav" class="collapse navbar-collapse">
                    <ul class="navbar-nav">
                        <li class="item"> <a class="dropdown-toggle" href="<?php echo base_url() ?>home">Home</a>

                        </li>
                        <li class="item"> <a class="dropdown-toggle" href="<?php echo base_url() ?>list-your-property">List Your Property</a> 

                        </li>
                        <li class="item"> <a class="dropdown-toggle" href="<?php echo base_url() ?>about-us">About Us</a> 

                        </li>



                        <li class="login-signup ml-lg-2">
                            <a class="pl-lg-4 pr-0" data-toggle="modal" data-target="#login-signup" href="#" title="Login / Sign up">Login / Sign up 
                                <span class="d-none d-lg-inline-block">
                                    <i class="fas fa-user"></i>
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav><!-- Primary Navigation end --> 

        </div>

        <!-- Collapse Button
        ============================================= -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#header-nav"> <span></span> <span></span> <span></span> </button>
    </div>
</div>