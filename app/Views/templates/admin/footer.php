            </div>
            <!-- END CONTENT BODY -->
        </div>
        <!-- END CONTENT -->
    </div>
    <!-- END CONTAINER -->

    <!-- BEGIN FOOTER -->
    <div class="page-footer">
        <div class="page-footer-inner">
             <?= date("Y");?> &copy; Administration backend for 
            <a target="_blank" href="http://www.harmonieprop.co.za">Harmonie Property Rentals</a> | <?= phpversion(); ?>
            <div class="scroll-to-top">
                <i class="icon-arrow-up"></i>
            </div>
        </div>

        <!--[if lt IE 9]>
        <script src="<?= base_url('assets/plugins/respond.min.js');?>"></script>
        <script src="<?= base_url('assets/plugins/excanvas.min.js');?>"></script>
        <script src="<?= base_url('assets/plugins/ie8.fix.min.js');?>"></script>
        <![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="<?= base_url('assets/plugins/jquery.min.js');?>" type="text/javascript"></script>
        <script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.min.js');?>" type="text/javascript"></script>
        <script src="<?= base_url('assets/plugins/js.cookie.min.js');?>" type="text/javascript"></script>
        <script src="<?= base_url('assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js');?>" type="text/javascript"></script>
        <script src="<?= base_url('assets/plugins/jquery.blockui.min.js');?>" type="text/javascript"></script>
        <script src="<?= base_url('assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js');?>" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <?php
        // load extra JS files from controller
            if (isset($js_to_load)) :
                foreach ($js_to_load as $row):
                    $js_link=base_url($row);
                    echo "<script src='$js_link' type='text/javascript'></script> ";
                endforeach;
            endif;
        ?>
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?= base_url('assets/scripts/admin/app.min.js');?>" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        
        <?php
        // load script files from controller
            if (isset($scripts_to_load)) :
                foreach ($scripts_to_load as $row):
                    $js_link=base_url($row);
                    echo "<script src='$js_link'  ></script> ";
                endforeach;
            endif;
        ?>
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="<?= base_url('assets/scripts/admin/layout.min.js');?>" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
    </body>

</html>
