<div class="container">
    <?php
    echo form_open(base_url('property/all'));
    ?>
    <div id="main">
        <div class="row">
            <div class="span9">
                <h1 class="page-header">Holiday Rental Listings</h1>

                <div class="properties-grid">
                    <div class="row">

                        <?php
                        if (empty($prop_list)) {
                            echo "<div class='span9'><p>There is <b>no properties</b> matching this filter criteria.<br>Please alter the parameters and try again.</p></div>";
                        } else {
                            foreach ($prop_list as $property_id => $property) {
                                ?>
                                <div class="property span3">
                                    <div class="image">
                                        <div class="content">
                                            <a href="<?= base_url("property/detail/" . $property['property_code'] . ""); ?>"></a>
                                            <img src="<?= base_url("photos/" . $property['property_code'] . "/" . $property['property_img']); ?>" alt="" style="width: 270px; height: 200px">
                                        </div><!-- /.content -->

                                        <div class="reduced">from <?= fdisplayCurrency($property['property_rate_low']); ?></div><!-- /.reduced -->
                                    </div><!-- /.image -->

                                    <div class="title">
                                        <h2><a href="<?= base_url("property/detail/" . $property['property_code'] . ""); ?>"><?= $property['property_code']; ?></a></h2>
                                    </div><!-- /.title -->

                                    <div class="location"><?= $property['location_name']; ?>, Hermanus</div><!-- /.location -->
                                    <div class="property-footer">
                                        <div class="area">
                                            <span class="key">Sleeps:</span><!-- /.key -->
                                            <span class="value"><?= $property['property_sleeps']; ?></span><!-- /.value -->
                                        </div><!-- /.area -->
                                        <div class="bedrooms"><div class="content"><?= $property['property_bedrooms']; ?></div></div><!-- /.bedrooms -->
                                        <div class="bathrooms"><div class="content"><?= $property['property_bathrooms']; ?></div></div><!-- /.bathrooms -->
                                    </div>
                                </div><!-- /.property -->
                                <?php
                            }
                        }
                        ?>

                    </div><!-- /.row -->
                </div><!-- /.properties-grid -->
                <p>&nbsp;</p>
                
            </div>
            <div class="sidebar span3">
                <h2>Property filter</h2>
                <div class="property-filter widget">
                    <div class="content">

                    <?php
                        //  Location
                        echo "<div class='location control-group'>";
                        echo form_label('Location', 'inputLocation');
                        echo form_dropdown('location_id', $location_dropdown, @$filter['location_id'], ["id" => "inputLocation"]);
                        echo "</div>";

                        //  Type
                        echo "<div class='type control-group'>";
                        echo form_label('Property Type', 'inputType');
                        echo form_dropdown('type_id', $type_dropdown, @$filter['type_id'], ["id" => "inputType"]);
                        echo "</div>";

                        //  Beds
                        echo "<div class='beds control-group'>";
                        echo form_label('Beds', 'inputBeds');
                        echo form_dropdown('property_bedrooms', $beds_dropdown, @$filter['property_bedrooms'], ["id" => "inputBeds"]);
                        echo "</div>";

                        //  Sleeps
                        echo "<div class='baths control-group'>";
                        echo form_label('Sleeps', 'inputSleeps');
                        echo form_dropdown('property_sleeps', $sleeps_dropdown, @$filter['property_sleeps'], ["id" => "inputSleeps"]);
                        echo "</div>";

                        //  Sort by
                        echo "<div class='beds control-group'>";
                        echo form_label('Sort by', 'inputSortBy');
                        echo form_dropdown('sort', $sort_dropdown, @$filter['sort'], ["id" => "inputSortBy"]);
                        echo "</div>";

                        //  Order by
                        echo "<div class='baths control-group'>";
                        echo form_label('Order', 'inputOrder');
                        echo form_dropdown('order', $order_dropdown, @$filter['order'], ["id" => "inputOrder"]);
                        echo "</div>";

                        // Price From
                        echo "<div class='price-from control-group'>";
                        echo form_label('Price from', 'inputPriceFrom');
                        echo form_input([
                            'name' => 'inputPriceFrom',
                            'id' => 'inputPriceFrom',
//                            'value' => set_value('inputPriceFrom', @$filter['inputPriceFrom']),
                            'value' => set_value('inputPriceFrom', 0),
                        ]);
                        echo '</div>';

                        // Price To
                        echo "<div class='price-to control-group'>";
                        echo form_label('Price to', 'inputPriceTo');
                        echo form_input([
                            'name' => 'inputPriceTo',
                            'id' => 'inputPriceTo',
//                            'value' => set_value('inputPriceTo', @$filter['inputPriceTo']),
                            'value' => set_value('inputPriceTo', 10000),
                        ]);
                        echo '</div>';

                        echo '<div class="price-value"><span class="from"></span> - <span class="to"></span></div>';
                        echo '<div class="price-slider"></div>';
                    ?>



                        <div class="form-actions">
                            <input type="submit" value="Filter now!" class="btn btn-primary btn-large">
                        </div><!-- /.form-actions -->
                    </div><!-- /.content -->
                </div><!-- /.property-filter -->

            </div>
        </div>
    </div>
<?php
echo form_close();
?>
</div>
    <?php
//    wts($filter);
//    wts($this->input->post(NULL, TRUE));
//    wts($location_data);
//    wts($prop_list);
    ?>
