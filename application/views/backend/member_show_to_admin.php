<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--external css-->
    <link href="<?php echo base_url() ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/lineicons/style.css">

    <link href="<?php echo base_url() ?>assets/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/css/style-responsive.css" rel="stylesheet">

    <script src="<?php echo base_url() ?>assets/js/chart-master/Chart.js"></script>
    <?php foreach ($css_files as $file): ?>
        <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>"/>
    <?php endforeach; ?>
    <?php foreach ($js_files as $file): ?>
        <script src="<?php echo $file; ?>"></script>
    <?php endforeach; ?>
    <style type='text/css'>
        body {
            font-family: Arial;
            font-size: 14px;
        }

        a {
            color: blue;
            text-decoration: none;
            font-size: 14px;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>


<div style='height:20px;'></div>
<div class="card">
    <div class="card-header bg-primary">
    </div>
    <div class="card-body">
        <?php echo $output; ?>
    </div>
</body>
</html>
