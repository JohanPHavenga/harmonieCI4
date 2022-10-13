<div class="container">

    <div id="main">
        <div class="row">
            <div class="span12">
                <h1 class="page-header">Search for <span style="background-color: yellow"><?= $_POST['ss']; ?></span></h1>

                
                <div class="properties-grid">
                    <div class="row">
                        
                        <?php
                        if (empty($prop_list)) {
                            echo "<div class='span9'><p>There is <b>no properties</b> matching your search criteria. Please try again.</p></div>";
                        } else {
                            foreach ($prop_list as $property_id=>$property) {
                                ?>
                                <div class="property span3">
                                    <div class="image">
                                        <div class="content">
                                            <a href="<?=base_url("property/detail/".$property['property_code']."");?>"></a>
                                            <img src="<?=base_url("photos/".$property['property_code']."/".$property['property_img']);?>" alt="" style="width: 270px; height: 200px">
                                        </div><!-- /.content -->

                                        <div class="reduced">from <?= fdisplayCurrency($property['property_rate_low']); ?></div><!-- /.reduced -->
                                    </div><!-- /.image -->

                                    <div class="title">
                                        <h2><a href="<?=base_url("property/detail/".$property['property_code']."");?>"><?=$property['property_code'];?></a></h2>
                                    </div><!-- /.title -->

                                    <div class="location"><?=$property['location_name'];?>, Hermanus</div><!-- /.location -->
                                    <div class="property-footer">
                                    <div class="area">
                                        <span class="key">Sleeps:</span><!-- /.key -->
                                        <span class="value"><?=$property['property_sleeps'];?></span><!-- /.value -->
                                    </div><!-- /.area -->
                                    <div class="bedrooms"><div class="content"><?=$property['property_bedrooms'];?></div></div><!-- /.bedrooms -->
                                    <div class="bathrooms"><div class="content"><?=$property['property_bathrooms'];?></div></div><!-- /.bathrooms -->
                                    </div>
                                </div><!-- /.property -->
                                <?php
                            }
                        }
                        ?>
                        
                    </div><!-- /.row -->
                </div><!-- /.properties-grid -->
                
            </div><!-- /.span12 -->
        </div><!-- /.row -->
    </div><!-- /.main -->
</div><!-- /.container -->
