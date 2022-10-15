<?php
echo form_open($form_url);
?>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-edit font-dark"></i>
                    <span class="caption-subject font-dark bold uppercase"><?= ucfirst($action); ?> entry</span>
                </div>
            </div>
            <div class="portlet-body">
                <?php
                echo '<div class="alert alert-danger" role="alert">';
                echo $validation->listErrors();
                echo '</div>';


                // BEGIN LINKS
                echo '<div class="row"><div class="col-md-6">';

                echo "<div class='row'>";
                echo "<div class='col-md-6'>";
                // Property Code
                echo "<div class='form-group'>";
                echo form_label('Property Code  <span class="compulsary">*</span>', 'property_code');
                echo form_input([
                    'name'          => 'property_code',
                    'id'            => 'property_code',
                    'value'         => set_value('property_code', @$property_detail['property_code']),
                    'class'         => 'form-control input-small',
                    'required'      => '',
                ]);

                echo '</div>';

                //  Sleeps Dropdown
                echo "<div class='form-group'>";
                echo form_label('Sleeps <span class="compulsary">*</span>', 'property_sleeps');
                echo form_dropdown('property_sleeps', $sleeps_dropdown, @$property_detail['property_sleeps'], ["id" => "property_sleeps", "class" => "form-control input-small"]);
                echo "</div>";

                // Bedrooms
                echo "<div class='form-group'>";
                echo form_label('Bedrooms  <span class="compulsary">*</span>', 'property_bedrooms');
                echo form_input([
                    'name'          => 'property_bedrooms',
                    'id'            => 'property_bedrooms',
                    'type'          => 'number',
                    'value'         => set_value('property_bedrooms', @$property_detail['property_bedrooms']),
                    'class'         => 'form-control input-small',
                    'required'      => '',
                ]);

                echo '</div>';

                // Bathrooms
                echo "<div class='form-group'>";
                echo form_label('Bathrooms  <span class="compulsary">*</span>', 'property_bathrooms');
                echo form_input([
                    'name'          => 'property_bathrooms',
                    'id'            => 'property_bathrooms',
                    'type'          => 'number',
                    'value'         => set_value('property_bathrooms', @$property_detail['property_bathrooms']),
                    'class'         => 'form-control input-small',
                    'required'      => '',
                ]);

                echo '</div>';

                echo '</div>';

                echo "<div class='col-md-6'>";

                // Rate low
                echo "<div class='form-group'>";
                echo form_label('Rate Low  <span class="compulsary">*</span>', 'property_rate_low');
                echo form_input([
                    'name'          => 'property_rate_low',
                    'id'            => 'property_rate_low',
                    'type'          => 'number',
                    'value'         => set_value('property_rate_low', @$property_detail['property_rate_low']),
                    'class'         => 'form-control input-medium',
                    'required'      => '',
                ]);

                echo '</div>';

                // Rate Med
                echo "<div class='form-group'>";
                echo form_label('Rate Medium  <span class="compulsary">*</span>', 'property_rate_med');
                echo form_input([
                    'name'          => 'property_rate_med',
                    'id'            => 'property_rate_med',
                    'type'          => 'number',
                    'value'         => set_value('property_rate_med', @$property_detail['property_rate_med']),
                    'class'         => 'form-control input-medium',
                    'required'      => '',
                ]);

                echo '</div>';

                // Rate low
                echo "<div class='form-group'>";
                echo form_label('Rate High  <span class="compulsary">*</span>', 'property_rate_high');
                echo form_input([
                    'name'          => 'property_rate_high',
                    'id'            => 'property_rate_high',
                    'type'          => 'number',
                    'value'         => set_value('property_rate_high', @$property_detail['property_rate_high']),
                    'class'         => 'form-control input-medium',
                    'required'      => '',
                ]);

                echo '</div>';

                echo '</div>';
                echo '</div>';


                // GPS
                echo "<div class='form-group'>";
                echo form_label('GPS', 'property_gps');
                echo form_input([
                    'name'          => 'property_gps',
                    'id'            => 'property_gps',
                    'value'         => set_value('property_gps', @$property_detail['property_gps']),
                    'class'         => 'form-control input-large',
                ]);

                echo '</div>';

                // Main Image
                echo "<div class='form-group'>";
                echo form_label('Main Image Name', 'property_img');
                echo form_input([
                    'name'          => 'property_img',
                    'id'            => 'property_img',
                    'value'         => set_value('property_img', @$property_detail['property_img']),
                    'class'         => 'form-control input-large',
                ]);

                echo '</div>';

                //  Location
                echo "<div class='form-group'>";
                echo form_label('Location <span class="compulsary">*</span>', 'location_id');
                echo form_dropdown('location_id', $location_dropdown, @$property_detail['location_id'], ["id" => "location_id", "class" => "form-control input-xlarge"]);
                echo "</div>";

                //  Property Type
                echo "<div class='form-group'>";
                echo form_label('Property Type <span class="compulsary">*</span>', 'type_id');
                echo form_dropdown('type_id', $type_dropdown, @$property_detail['type_id'], ["id" => "type_id", "class" => "form-control input-xlarge"]);
                echo "</div>";

                //  Is Published
                echo "<div class='form-group'>";
                $checkbox=[
                    'name'          => 'property_ispublished',
                    'id'            => 'property_ispublished',
                    'value'         => 1,
                ];
                if ($property_detail['property_ispublished']) {
                    $checkbox['checked']=true;
                }
                echo form_checkbox($checkbox);
                echo form_label(' Is Published', 'property_ispublished');
                echo "</div>";

                //  Is Featured
                echo "<div class='form-group'>";
                
                $checkbox=[
                    'name'          => 'property_isfeatured',
                    'id'            => 'property_isfeatured',
                    'value'         => 1,
                ];
                if ($property_detail['property_isfeatured']) {
                    $checkbox['checked']=true;
                }
                echo form_checkbox($checkbox);
                echo form_label(' Is Featured', 'property_isfeatured');
                echo "</div>";

                // get image
                if ($action == "edit") {
                    $img_uri = "photos/" . @$property_detail['property_code'] . "/" . @$property_detail['property_img'];
                    if (is_file($img_uri)) {
                        echo "<p><img src='" . base_url($img_uri) . "' style='width: 270px;'></p>";
                    }
                }

                // END LINKS
                echo "</div>";



                // BEGIN REGS
                echo '<div class="col-md-6">';

                // Summary
                echo "<div class='form-group'>";
                echo form_label('Short Description  <span class="compulsary">*</span>', 'property_summary');
                echo form_input([
                    'name'          => 'property_summary',
                    'id'            => 'property_summary',
                    'value'         => set_value('property_img', @$property_detail['property_summary']),
                    'class'         => 'form-control',
                    'required'      => '',
                ]);

                echo '</div>';

                // Property Overview
                echo "<div class='form-group'>";
                echo form_label('Overview', 'property_overview');
                echo form_textarea([
                    'name'          => 'property_overview',
                    'id'            => 'property_overview',
                    'value'         => @$property_detail['property_overview'],
                ]);

                echo "</div>";

                // Property Address
                echo "<div class='form-group'>";
                echo form_label('Address', 'property_address');
                echo form_textarea([
                    'name'          => 'property_address',
                    'id'            => 'property_address',
                    'value'         => @$property_detail['property_address'],
                ]);

                echo "</div>";



                // END REGS
                echo "</div></div>";

                ?>
            </div>

            <div class="portlet-footer">
                <?php
                echo "<div class='btn-group'>";
                if ($action == "edit") {
                    echo fbutton($text = "Save", $type = "submit", $status = "primary", NULL, "save_only");
                }
                echo fbutton($text = "Save & Close", $type = "submit", $status = "success");
                echo fbuttonLink($return_url, "Cancel", $status = "danger");
                echo "</div>";

                // d($property_detail);
                ?>
            </div>
        </div>
    </div>
</div>
<?php
echo form_close();
?>