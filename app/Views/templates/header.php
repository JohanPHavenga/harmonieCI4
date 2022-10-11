<?php
if (isset($title)) {
    $page_title = $title;
} else {
    $page_title = "Personal Service Holiday Rentals in Hermanus, South Africa";
}
if (isset($meta_description)) {
    $descrip = $meta_description;
} else {
    $descrip = "Holiday accommodation in Hermanus offering self catering apartments, self catering holiday homes in Hermanus by Harmonie Property Rentals.";
}
?>
<!DOCTYPE html>
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />    
        <title>Harmonie Rental Properties | <?= $page_title; ?></title>    
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="<?= $descrip; ?>" name="description" />
        <meta content="Johan Havenga" name="author" />

        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,700,300" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700" rel="stylesheet">
        
        <link href="<?= base_url('assets/css/open-sans.css'); ?>" rel="stylesheet" type="text/css" />

        <link rel="apple-touch-icon" sizes="152x152" href="<?=base_url('assets/favicons/apple-touch-icon.png');?>">
        <link rel="icon" type="image/png" sizes="32x32" href="<?=base_url('assets/favicons/favicon-32x32.png')?>">
        <link rel="icon" type="image/png" sizes="16x16" href="<?=base_url('assets/favicons/favicon-16x16.png');?>">
        <link rel="manifest" href="<?=base_url('assets/favicons/manifest.json');?>">
        <link rel="mask-icon" href="<?=base_url('assets/favicons/safari-pinned-tab.svg');?>" color="#5bbad5">
        <meta name="apple-mobile-web-app-title" content="Harmonie Properties">
        <meta name="application-name" content="Harmonie Properties">
        <meta name="theme-color" content="#ffffff">

        <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.css'); ?>" type="text/css">
        <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap-responsive.css'); ?>" type="text/css">
        <link rel="stylesheet" href="<?= base_url('assets/libraries/chosen/chosen.css'); ?>" type="text/css">
        <link rel="stylesheet" href="<?= base_url('assets/libraries/bootstrap-fileupload/bootstrap-fileupload.css'); ?>" type="text/css">
        <link rel="stylesheet" href="<?= base_url('assets/libraries/jquery-ui-1.10.2.custom/css/ui-lightness/jquery-ui-1.10.2.custom.min.css'); ?>" type="text/css">
        <link rel="stylesheet" href="<?= base_url('assets/css/theme.css'); ?>" type="text/css" id="color-variant-default">        
        <link rel="stylesheet" href="<?= base_url('assets/css/jquery.fancybox.min.css'); ?>" type="text/css" >  
        <link rel="stylesheet" href="<?= base_url('assets/css/justifiedGallery.min.css'); ?>" type="text/css" >  
        <link rel="stylesheet" href="<?= base_url('assets/css/custom.css'); ?>" type="text/css" >        
        <link rel="stylesheet" href="#" type="text/css" id="color-variant">

        <?php
        // load extra CSS files from controller
        if (isset($css_to_load)) :
            foreach ($css_to_load as $row):
                $css_link = base_url($row);
                echo "<link href='$css_link' rel='stylesheet'>";
            endforeach;
        endif;
        ?>
        
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-85900175-3"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'UA-85900175-3');
        </script>

    </head>
    <body>
        
        <div id="wrapper-outer">
            <div id="wrapper">
                
                <div id="wrapper-inner">                    
                    
                    <!-- BREADCRUMB -->
                    <div class="breadcrumb-wrapper">
                        <div class="container">
                            <div class="row">
                                <div class="span12">
                                    <ul class="breadcrumb pull-left">
                                        <li><a href="/">Home</a></li>
                                    </ul><!-- /.breadcrumb -->

                                    <div class="account pull-right">
                                        <!--<ul class="nav nav-pills">
                                            <li><a href="login.html">Login</a></li>
                                            <li><a href="registration.html">Registration</a></li>
                                        </ul>-->
                                    </div>
                                </div><!-- /.span12 -->
                            </div><!-- /.row -->
                        </div><!-- /.container -->
                    </div><!-- /.breadcrumb-wrapper -->

                    <!-- HEADER -->
                    <div id="header-wrapper">
                        <div id="header">
                            <div id="header-inner">
                                <div class="container">
                                    <div class="navbar">
                                        <div class="navbar-inner">
                                            <div class="row">
                                                <div class="logo-wrapper span4">
                                                    <a href="#nav" class="hidden-desktop" id="btn-nav">Toggle navigation</a>

                                                    <div class="logo">
                                                        <a href="<?=base_url();?>" title="Home">
                                                            <img src="<?=base_url("assets/img/harmonie_logo_44.png");?>" alt="Home">
                                                        </a>
                                                    </div><!-- /.logo -->

                                                    <div class="site-name">
                                                        <a href="<?=base_url();?>" title="Home" class="brand">Harmonie</a>
                                                    </div><!-- /.site-name -->

                                                    <div class="site-slogan">
                                                        <span>Rental<br>Properties</span>
                                                    </div> <!--  /.site-slogan -->
                                                </div><!-- /.logo-wrapper -->

                                                <div class="info">
                                                    <div class="site-email">
                                                        <a href="mailto:info@harmonieprop.co.za?subject=Website%20Enquiry">info@harmonieprop.co.za</a>
                                                    </div><!-- /.site-email -->

                                                    <div class="site-phone">
                                                        <span>+27 (0)71 505 9201</span>
                                                    </div><!-- /.site-phone -->
                                                </div><!-- /.info -->

                                                <a class="btn btn-primary btn-large list-your-property arrow-right" href="<?=base_url();?>property/all">View all properties</a>
                                            </div><!-- /.row -->
                                        </div><!-- /.navbar-inner -->
                                    </div><!-- /.navbar -->
                                </div><!-- /.container -->
                            </div><!-- /#header-inner -->
                        </div><!-- /#header -->
                    </div><!-- /#header-wrapper -->

                    <!-- NAVIGATION -->
                    <div id="navigation">
                        <div class="container">
                            <div class="navigation-wrapper">
                                <div class="navigation clearfix-normal">

                                    <ul class="nav">
                                        <li><a href="<?=base_url();?>" <?php if ($active_menu=="home") { echo "class='active'"; }?>>Home</a></li>
<!--                                        <li class="menuparent">
                                            <span class="menuparent nolink">Home Alternatives</span>
                                            <ul>
                                                <li><a href="index_1.html">Home with image</a></li>
                                                <li><a href="index_2.html">Home with image 2</a></li>
                                            </ul>
                                        </li>-->
                                        <!--<li><a href="<?=base_url('listing');?>" <?php if ($active_menu=="listing") { echo "class='active'"; }?>><b>Holiday Rental Listings</b></a></li>-->

                                         <li class="menuparent">
                                             <span class="menuparent nolink <?php if ($active_menu=="property") { echo "active"; }?>"><b>Holiday Rental Listings</b></span>
                                            <ul>
                                                <li><a href="<?=base_url('property/all');?>">View all properties</a></li>
                                                <li><a href="<?=base_url('property/houses');?>">Houses to let</a></li>
                                                <li><a href="<?=base_url('property/apartments');?>">Apartments to let</a></li>
                                                <!--<li><a href="<?=base_url('property/list-my-property');?>">List your property</a></li>-->
                                            </ul>
                                        </li>
                                        </li>
                                        <li><a href="<?=base_url('about');?>" <?php if ($active_menu=="about") { echo "class='active'"; }?>>About Us</a></li>
                                        <!--<li><a href="<?=base_url('faq');?>" <?php if ($active_menu=="faq") { echo "class='active'"; }?>>FAQ</a></li>-->
                                        <li><a href="<?=base_url('contact');?>" <?php if ($active_menu=="contact") { echo "class='active'"; }?>>Contact Us</a></li>

                                    </ul><!-- /.nav -->


                                    <?php 
                                        echo form_open(base_url('property/search'), array(
                                            'class' => 'site-search'
                                            ));?>
                                    <!--<form method="post" class="site-search" action="<?= base_url('property/search'); ?>">-->
                                        <div class="input-append">
                                            <input title="Enter the terms you wish to search for." class="search-query span2 form-text" placeholder="Search" type="text" name="ss">
                                            <button type="submit" class="btn"><i class="icon-search"></i></button>
                                        </div><!-- /.input-append -->
                                    <?php echo form_close();?>
                                </div><!-- /.navigation -->
                            </div><!-- /.navigation-wrapper -->
                        </div><!-- /.container -->
                    </div><!-- /.navigation -->

                    <!-- CONTENT -->
                    <div id="content">
                        


