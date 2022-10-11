<div class="title">
    <h2>Latest Properties</h2>
</div><!-- /.title -->

<div class="content">
    <?php
    if ($latest_properties) {
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
    }
    ?>
</div><!-- /.content -->

<?php
//    wts($latest_properties);
?>