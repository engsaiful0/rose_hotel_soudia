<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">
<?php
$banner = $this->db->where('banner_id', '1')->get('company')->row();
$title = $this->db->where('banner_id', '1')->get('company')->row();
?>
<title><?php echo $banner->title ?></title>
<link rel="icon"  type="image/x-icon" href="<?php echo base_url() ?>assets/uploads/banner/<?php echo $title->favicon ?>" />

<meta name="description" content="Aire Ticket,Bust Ticket, Launch Ticket">
<meta name="author" content="harnishdesign.net">

<!-- Web Fonts
============================================= -->
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900' type='text/css'>

<!-- Stylesheet
============================================= -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>vendor/bootstrap/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/all.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/fontawesome.min.css" />

<!--<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>vendor/font-awesome/css/all.min.css" />-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>vendor/owl.carousel/assets/owl.carousel.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>vendor/owl.carousel/assets/owl.theme.default.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>vendor/daterangepicker/daterangepicker.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/stylesheet.css" />

