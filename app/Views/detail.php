<div class="container">
    <div id="main">
        <div class="row">
            <div class="span9">
                <h1 class="page-header" style="margin-bottom: 8px;"><?= $prop_code; ?> - <?= $property_data['location_name']; ?></h1>
                <h4 class="page-header"><?= $property_data['property_summary']; ?></h1>

                    <div class="property-detail ">
                        <a data-fancybox="gallery" href="<?= base_url("photos/" . $prop_code . "/" . $property_data['property_img']); ?>">
                            <img src="<?= base_url("photos/" . $prop_code . "/" . $property_data['property_img']); ?>" alt="" style="width: 830px;">
                        </a>
                        <div id="propgallery">
                            <?php
                            if ($photos) {
                                foreach ($photos as $photo) {
                                    echo '<a data-fancybox="gallery" href="' . base_url("photos/" . $prop_code . "/" . $photo) . '">';
                                    echo '<img src="' . base_url("photos/" . $prop_code . "/" . $photo) . '" alt="" style="max-height: 150px;">';
                                    echo '</a>';
                                }
                            }
                            ?>
                        </div>

                        <h2 style="margin: 5px 0 6px;">Overview</h2>
                        <p style="margin: 0 0 16px;"><strong><?= $property_data['property_summary']; ?></strong></p>

                        <?= $property_data['property_overview']; ?>
                    </div>  
            </div>
            <div class="sidebar span3">
                <div class="widget prop-summary">
                    <div class="title">
                        <h2 class="block-title">Property Details</h2>
                    </div><!-- /.title -->
                    <div class="content">
                        <table class="table-bordered table-striped table-hover">                            
                            <tr>
                                <td>Sleeps</td>
                                <td><?= $property_data['property_sleeps']; ?></td>
                            </tr>
                            <tr>
                                <td>Low Season</td>
                                <td><?= fdisplayCurrency($property_data['property_rate_low']); ?></td>
                            </tr>
                            <?php
                            if ($property_data['property_rate_med'] > 0) {
                                ?>
                                <tr>
                                    <td>Mid Season</td>
                                    <td><?= fdisplayCurrency($property_data['property_rate_med']); ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                            <tr>
                                <td>High Season</td>
                                <td><?= fdisplayCurrency($property_data['property_rate_high']); ?></td>
                            </tr>
                            <tr>
                                <td>Bedrooms</td>
                                <td><?= $property_data['property_bedrooms']; ?></td>
                            </tr>
                            <tr>
                                <td>Bathrooms</td>
                                <td><?= $property_data['property_bathrooms']; ?></td>
                            </tr>
                            <tr>
                                <td>Location</td>
                                <td><?= $property_data['location_name']; ?></td>
                            </tr>
                            <tr>
                                <td>Property Type</td>
                                <td><?= $property_data['type_name']; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="widget contact last">
                    <div class="title">
                        <h2 class="block-title">Enquiry</h2>
                    </div><!-- /.title -->
                    <div class="content">
                        <?php
                        echo form_open(base_url("contact"));
                        //  Name
                        echo "<div class='control-group'>";
                        echo form_label('Name <span class="form-required" title="This field is required.">*</span>', 'inputContactName');
                        echo form_input([
                            'name' => 'inputContactName',
                            'id' => 'inputContactName',
                            'required' => '',
                        ]);
                        echo "</div>";

                        //  Email
                        echo "<div class='control-group'>";
                        echo form_label('Email <span class="form-required" title="This field is required.">*</span>', 'inputContactEmail');
                        echo form_input([
                            'name' => 'inputContactEmail',
                            'id' => 'inputContactEmail',
                            'type' => "email",
                            'required' => '',
                        ]);
                        echo "</div>";

                        // Message
                        echo "<div class='control-group'>";
                        echo form_label('Message <span class="form-required" title="This field is required.">*</span>', 'inputContactMessage');
                        echo form_textarea([
                            'name' => 'inputContactMessage',
                            'id' => 'inputContactMessage',
                            'required' => '',
                            'style' => 'height: 222px;',
                        ]);
                        echo "</div>";

                        //  Sleeps
                        echo form_input([
                            'name' => 'inputSleeps',
                            'value' => $property_data['property_sleeps'],
                            'type' => 'hidden',
                            'required' => '',
                        ]);
                        //  ProprCode
                        echo form_input([
                            'name' => 'inputPropCode',
                            'value' => $prop_code,
                            'type' => 'hidden',
                            'required' => '',
                        ]);

                        echo '<div class="form-actions">';
                        echo '<input type="submit" class="btn btn-primary arrow-right" value="Send">';
                        echo '</div>';

                        echo form_close();
                        ?>
                    </div>
                </div><!-- /.widget -->
            </div>
        </div>

        <div class="row">  
            <div class="span12">  
                <h2>Location Map</h2>
                <div class="property-detail">
                    <!-- /.row -->           
                    <div id="property-map"></div><!-- /#property-map -->
                </div>
            </div>

        </div>
        <!-- /.overview -->
    </div>
    <!-- /.property detail -->
</div> <!-- /#main -->
<?php
//    wts($property_data);
//    wts($photos);
?>
</div> <!-- /#container -->