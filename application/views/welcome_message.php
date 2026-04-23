<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
        include 'common/top_css_js.php';
        ?>

    </head>
    <body>
        <!-- Preloader -->

        <!-- Document Wrapper   
        ============================================= -->
        <div id="main-wrapper">

            <!-- Header
            ============================================= -->
            <header id="header">

                <?php
                include 'frontend/header.php';
                ?>
            </header><!-- Header end -->

            <!-- Secondary Navigation
        ============================================= -->
            <div class="bg-secondary">
                <div class="container">

                    <?php
                    include 'common/bottom_menu.php';
                    ?>
                </div>
            </div><!-- Secondary Navigation end -->

            <!-- Content
            ============================================= -->
            <div id="content">
                <section class="container">
                    <div class="bg-light shadow-md rounded p-4">
                        <div class="row">
                            <div class="col-lg-5 mb-4 mb-lg-0">
                                <h2 class="text-4 mb-3">Book Domestic and International Hotels</h2>
                                <form id="bookingHotels" method="post">
                                    <div class="form-row">
                                        <div class="col-lg-12 form-group">
                                            <input type="text" class="form-control" id="hotelsFrom" required placeholder="Enter Locality, Landmark, City or Hotel">
                                            <span class="icon-inside"><i class="fas fa-map-marker-alt"></i></span> </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-lg-6 form-group">
                                            <input id="hotelsCheckIn" type="text" class="form-control" required placeholder="Check In">
                                            <span class="icon-inside"><i class="far fa-calendar-alt"></i></span> </div>
                                        <div class="col-lg-6 form-group">
                                            <input id="hotelsCheckOut" type="text" class="form-control" required placeholder="Check Out">
                                            <span class="icon-inside"><i class="far fa-calendar-alt"></i></span> </div>
                                    </div>
                                    <div class="travellers-class form-group">
                                        <input type="text" id="hotelsTravellersClass"  class="travellers-class-input form-control" name="hotels-travellers-class" placeholder="Rooms / People" required onKeyPress="return false;">
                                        <span class="icon-inside"><i class="fas fa-caret-down"></i></span>
                                        <div class="travellers-dropdown">
                                            <div class="row align-items-center">
                                                <div class="col-sm-7">
                                                    <p class="mb-sm-0">Rooms</p>
                                                </div>
                                                <div class="col-sm-5">
                                                    <div class="qty input-group">
                                                        <div class="input-group-prepend">
                                                            <button type="button" class="btn bg-light-4" data-value="decrease" data-target="#hotels-rooms" data-toggle="spinner">-</button>
                                                        </div>
                                                        <input type="text" data-ride="spinner" id="hotels-rooms" class="qty-spinner form-control" value="1" readonly >
                                                        <div class="input-group-append">
                                                            <button type="button" class="btn bg-light-4" data-value="increase" data-target="#hotels-rooms" data-toggle="spinner">+</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr class="mt-2 mb-4">
                                            <div class="row align-items-center">
                                                <div class="col-sm-7">
                                                    <p class="mb-sm-0">Adults <small class="text-muted">(12+ yrs)</small></p>
                                                </div>
                                                <div class="col-sm-5">
                                                    <div class="qty input-group">
                                                        <div class="input-group-prepend">
                                                            <button type="button" class="btn bg-light-4" data-value="decrease" data-target="#adult-travellers" data-toggle="spinner">-</button>
                                                        </div>
                                                        <input type="text" data-ride="spinner" id="adult-travellers" class="qty-spinner form-control" value="1" readonly>
                                                        <div class="input-group-append">
                                                            <button type="button" class="btn bg-light-4" data-value="increase" data-target="#adult-travellers" data-toggle="spinner">+</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr class="my-2">
                                            <div class="row align-items-center">
                                                <div class="col-sm-7">
                                                    <p class="mb-sm-0">Children <small class="text-muted">(1-12 yrs)</small></p>
                                                </div>
                                                <div class="col-sm-5">
                                                    <div class="qty input-group">
                                                        <div class="input-group-prepend">
                                                            <button type="button" class="btn bg-light-4" data-value="decrease" data-target="#children-travellers" data-toggle="spinner">-</button>
                                                        </div>
                                                        <input type="text" data-ride="spinner" id="children-travellers" class="qty-spinner form-control" value="0" readonly>
                                                        <div class="input-group-append">
                                                            <button type="button" class="btn bg-light-4" data-value="increase" data-target="#children-travellers" data-toggle="spinner">+</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn btn-primary btn-block submit-done mt-3" type="button">Done</button>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-block" type="submit">Search Hotels</button>
                                </form>
                            </div>
                            <!-- Slideshow
                          ============================================= -->
                            <div class="col-lg-7">
                                <div class="owl-carousel owl-theme slideshow single-slider">



                                    <?php
                                    $slide_show = '';

                                    $slide_show = $this->db->select('*')
                                                    ->get('slide_show')->result();

                                    foreach ($slide_show as $slide_show_value) {
                                        ?>
                                        <div class="item">
                                            <a href="#">
                                                <img style="height: 300px; " class="img-fluid" src="<?php echo base_url() ?>images/slides/<?php echo $slide_show_value->picture; ?>" />
                                            </a>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div><!-- Slideshow end -->
                        </div>
                    </div>
                </section>

                <!-- Banner
                ============================================= -->
                <section class="section">
                    <div class="container">
                        <h2 class="text-9 font-weight-500 text-center">Popular Blogs</h2>
                        <p class="lead text-center mb-4">World's leading Hotel Booking website, Over 40,000 Hotel rooms worldwide.</p>
                        <div class="row banner">
                            <?php
                            $blog = $this->db->select('*')->get('blog')->result();

                            foreach ($blog as $blog_value) {
                                ?>
                                <div class="col-md-4" style=" margin-bottom: 20px; ">
                                    <div class="single-blog-info">
                                        <div class="blog_header">
                                            <h2><?php echo $blog_value->title ?></h2>
                                        </div>
                                        <div class="blog_date">
                                            <span class="date-info"><i class="fa fa-calendar"></i> <?php
                                                echo date("jS  F Y", strtotime($blog_value->date));
                                                ?></span>
                                        </div>

                                        <div class="short_description" style="height: 200px; ">
                                            <?php echo $blog_value->short_description ?>
                                        </div>
                                        <div class="blog_details">
                                            <a style="padding: 8px;" class="blog-readmore-btn btn-primary" href="">Read more <i class="fa fa-long-arrow-right"></i></a>
                                        </div>



                                    </div>
                                </div>
                                <?php
                            }
                            ?>


                            </section><!-- Banner end --> 

                            <!-- Why Choose Us
                            ============================================= -->
                            <div class="container">
                                <section class="section bg-light shadow-md rounded px-5">
                                    <h2 class="text-9 font-weight-600 text-center">Why Choose Us</h2>
                                    <p class="lead mb-5 text-center">Book Hotels Online. Save Time and Money!</p>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="featured-box style-4">
                                                <div class="featured-box-icon bg-light-3 text-primary rounded-circle"> <i class="fas fa-users"></i> </div>
                                                <h3>Over 10M+ Happy Customers</h3>
                                                <p>Book with one of most trusted travel portals in the world</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="featured-box style-4">
                                                <div class="featured-box-icon bg-light-3 text-primary rounded-circle"> <i class="fas fa-dollar-sign"></i> </div>
                                                <h3>Lowest Price Guarnteee</h3>
                                                <p>Always get lowest price with the best in the industry.</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="featured-box style-4">
                                                <div class="featured-box-icon bg-light-3 text-primary rounded-circle"> <i class="far fa-life-ring"></i> </div>
                                                <h3>24X7 Customer Support</h3>
                                                <p>We're here to help. Round the clock support for all your hotel needs</p>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div><!-- Why Choose Us end --> 

                            <!-- Mobile App
                            ============================================= -->
                            <section class="section pb-0">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-5 col-lg-6 text-center"> <img class="img-fluid" alt="" src="images/app-mobile.png"> </div>
                                        <div class="col-md-7 col-lg-6">
                                            <h2 class="text-9 font-weight-600 my-4">Download Our Quickai<br class="d-none d-lg-inline-block">
                                                Mobile App Now</h2>
                                            <p class="lead">Download our app for the fastest, most convenient way to send Recharge.</p>
                                            <p>Ridens mediocritatem ius an, eu nec magna imperdiet. Mediocrem qualisque in has. Enim utroque perfecto id mei, ad eam tritani labores facilisis, ullum sensibus no cum. Eius eleifend in quo.</p>
                                            <ul>
                                                <li>Recharge</li>
                                                <li>Bill Payment</li>
                                                <li>Booking Online</li>
                                                <li>and much more.....</li>
                                            </ul>
                                            <div class="d-flex flex-wrap pt-2"> <a class="mr-4" href=""><img alt="" src="images/app-store.png"></a><a href=""><img alt="" src="images/google-play-store.png"></a> </div>
                                        </div>
                                    </div>
                                </div>
                            </section><!-- Mobile App end --> 
                        </div><!-- Content end -->

                        <!-- Footer
                        ============================================= -->
                        <footer id="footer">
                            <?php
                            include 'frontend/footer.php';
                            ?>
                        </footer><!-- Footer end -->

                    </div><!-- Document Wrapper end -->

                    <!-- Back to Top
                    ============================================= -->
                    <a id="back-to-top" data-toggle="tooltip" title="Back to Top" href="javascript:void(0)"><i class="fa fa-chevron-up"></i></a>

                    <!-- Modal Dialog - Login/Signup
                    ============================================= -->
                    <div id="login-signup" class="modal fade" role="dialog" aria-hidden="true">
                        <?php
                        include 'frontend/sign_in_sign_up.php';
                        ?>
                    </div><!-- Modal Dialog - Login/Signup end -->

                    <?php
                    include 'common/bottom_css_js.php';
                    ?>


                    </body>
                    </html>