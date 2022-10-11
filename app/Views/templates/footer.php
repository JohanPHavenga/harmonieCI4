                
        </div><!-- /#content -->
    </div><!-- /#wrapper-inner -->

<!-- FOOTER -->
<div id="footer-wrapper">
    <div id="footer-top">
        <div id="footer-top-inner" class="container">
            <div class="row">
                <div class="widget properties span3">
                    <div class="title">
                    <h2>Latest Properties</h2>
                </div><!-- /.title -->

                <div class="content">
                    <?php
                        array_pop($latest_properties);
                        foreach ($latest_properties as $property_id=>$property) 
                        {
                            ?>
                            <div class="property">
                                <div class="image">
                                    <a href="<?=base_url("property/detail/".$property['property_code']."");?>"></a>
                                    <img src="<?=base_url("photos/".$property['property_code']."/".$property['property_img']);?>" alt="" style="width: 100px; height: 74px;">
                                </div><!-- /.image -->

                                <div class="wrapper">
                                    <div class="title">
                                        <h3>
                                            <a href="<?=base_url("property/detail/".$property['property_code']."");?>"><?=$property['property_code'];?></a>
                                        </h3>
                                    </div><!-- /.title -->
                                    <div class="location"><?=$property['location_name'];?></div><!-- /.location -->
                                    <div class="price">from <?= fdisplayCurrency($property['property_rate_low']); ?></div><!-- /.price -->
                                </div><!-- /.wrapper -->
                            </div><!-- /.property -->
                            <?php
                        }
                    ?>
                </div><!-- /.content -->

                </div><!-- /.properties-small -->

                <div class="widget span3">
                    <div class="title">
                        <h2>Contact us</h2>
                    </div><!-- /.title -->

                    <div class="content">
                        <table class="contact">
                            <tbody>
                                <tr>
                                    <th class="address">Address:</th>
                                    <td>19 Bird Lane<br>Northcliff<br> Hermanus 7200<br>South Africa<br></td>
                                </tr>
                                <tr>
                                    <th class="phone">Phone:</th>
                                    <td>+27 (0)71 505 9201</td>
                                </tr>
                                <tr>
                                    <th class="email">E-mail:</th>
                                    <td><a href="mailto:info@harmonieprop.co.zas">info@harmonieprop.co.za</a></td>
                                </tr>
                                <tr>
                                    <th class="gps">GPS:</th>
                                    <td><a href="https://www.google.co.za/maps/search/-34.418073,+19.235384?sa=X&ved=0ahUKEwje49-8uq_WAhUoI8AKHVRGDUgQ8gEIIzAA" target="_blank">-34.418073, 19.235384</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div><!-- /.content -->
                </div><!-- /.widget -->

                <div class="widget span3">
                    <div class="title">
                        <h2 class="block-title">Useful links</h2>
                    </div><!-- /.title -->

                    <div class="content">
                        <ul class="menu nav">
                            <li class="first leaf"><a href="<?=base_url();?>">Home</a></li>
                            <li class="leaf"><a href="<?=base_url('about');?>">About us</a></li>
                            <li class="leaf"><a href="<?=base_url('contact');?>">Contact us</a></li>
                            <!--<li class="last leaf"><a href="<?=base_url('faq');?>">FAQ</a></li>-->
                        </ul>
                    </div><!-- /.content -->
                </div><!-- /.widget -->

                <div class="widget span3">
                    <div class="title">
                        <h2 class="block-title">Enquiry</h2>
                    </div><!-- /.title -->
                    <div class="content">
                        <?php
                            echo form_open("/contact/mailer/footer");
                            //  Name
                            echo "<div class='control-group'>";
                            echo form_label('Name <span class="form-required" title="This field is required.">*</span>', 'inputContactName');
                            echo form_input([
                                'name'      => 'inputContactName',
                                'id'        => 'inputContactName',
                                'required'  => '',
                            ]);
                            echo "</div>";

                            //  Email
                            echo "<div class='control-group'>";
                            echo form_label('Email <span class="form-required" title="This field is required.">*</span>', 'inputContactEmail');
                            echo form_input([
                                'name'      => 'inputContactEmail',
                                'id'        => 'inputContactEmail',
                                'type'      => "email",
                                'required'  => '',
                            ]);
                            echo "</div>";  
                            
                            // Message
                            echo "<div class='control-group'>";
                            echo form_label('Message <span class="form-required" title="This field is required.">*</span>', 'inputContactMessage');
                            echo '<div class="controls">';
                            echo form_textarea([
                                    'name'          => 'inputContactMessage',
                                    'id'            => 'inputContactMessage',
                                    'required'  => '',
                                ]);
                            echo "</div></div>";
                            
                            echo '<div class="form-actions">';
                            echo '<input type="submit" class="btn btn-primary arrow-right" value="Send">';
                            echo '</div>';

                        echo form_close();
                        ?>
                    </div>
                   
                </div><!-- /.widget -->
            </div><!-- /.row -->
        </div><!-- /#footer-top-inner -->
    </div><!-- /#footer-top -->

    <div id="footer" class="footer container">
        <div id="footer-inner">
            <div class="row">
                <div class="span6 copyright">
                    <p>© Copyright <?= date("Y");?> by <a href="<?=base_url();?>">Harmonie Property Services</a>. All rights reserved. <br>
                    <!-- <a href="<?=base_url("login/admin");?>">Admin Login</a></p> -->
                </div><!-- /.copyright -->

                <div class="span6 share">
                    <div class="content">
                        <ul class="menu nav">
                            <li class="first leaf"><a href="http://www.facebook.com/harmoniepropertieshermanus/" class="facebook">Facebook</a></li>
                        </ul>
                    </div><!-- /.content -->
                </div><!-- /.span6 -->
            </div><!-- /.row -->
        </div><!-- /#footer-inner -->
    </div><!-- /#footer -->
</div><!-- /#footer-wrapper -->

</div><!-- /#wrapper -->
</div><!-- /#wrapper-outer -->



<script type="text/javascript" src="<?= base_url('assets/js/jquery.js');?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/jquery.ezmark.js');?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/jquery.currency.js');?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/jquery.cookie.js');?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/retina.js');?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/bootstrap.min.js');?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/carousel.js');?>"></script>

<script type="text/javascript" src="<?= base_url('assets/libraries/jquery-ui-1.10.2.custom/js/jquery-ui-1.10.2.custom.min.js');?>"></script>
<script type="text/javascript" src="<?= base_url('assets/libraries/chosen/chosen.jquery.min.js');?>"></script>
<script type="text/javascript" src="<?= base_url('assets/libraries/iosslider/_src/jquery.iosslider.min.js');?>"></script>
<script type="text/javascript" src="<?= base_url('assets/libraries/bootstrap-fileupload/bootstrap-fileupload.js');?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/realia.js');?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/jquery.fancybox.min.js');?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/jquery.justifiedGallery.min.js');?>"></script>
<?php
// load extra JS files from controller
    if (isset($js_to_load)) :
        foreach ($js_to_load as $row):
            $js_link=base_url($row);
            echo "<script src='$js_link' type='text/javascript'></script> ";
        endforeach;
    endif;
    
    
    // load script files from controller
        if (isset($scripts_to_load)) :
            foreach ($scripts_to_load as $row):
                if (substr($row, 0,4)=="http") {
                    $js_link=$row;
                } else {
                    $js_link=base_url($row);
                }
                echo "<script src='$js_link' type='text/javascript'></script>";
            endforeach;
        endif;
        
        if (isset($scripts_to_display)) {
            echo "<script>";
                foreach ($scripts_to_display as $script) {
                    echo $script;
                }
            echo "</script>";
        }
    ?>
    <script>
    $("#propgallery").justifiedGallery({                
                margins: 8,
                rowHeight: 130,
                randomize: true
            });
    </script>
</body>
</html>
