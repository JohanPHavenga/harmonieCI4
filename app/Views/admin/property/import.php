<div class="row">
    <div class="col-md-12">

    <?php
    if (!isset($import_property_data)) {
        ?>
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-edit font-dark"></i>
                    <span class="caption-subject font-dark bold uppercase">Import Property Data</span>
                </div>
            </div>
            <?php
                if (@$error) {
                    echo "<div class='note note-danger' role='alert'>$error</div>";
                }
                echo form_open_multipart($form_url);

                echo "<div class='form-group'>";
                echo form_label('File to upload', 'propfile');
                echo form_upload([
                        'name'          => 'propfile',
                        'id'            => 'propfile',
                        'class'         => 'form-control',
                        'required'      => '',
                    ]);

                echo "</div>";

                echo "<div class='btn-group'>";
                echo fbutton($text="Upload",$type="submit",$status="primary");
                echo "</div>";

                echo form_close();
                ?>
        </div>
        <div class="m-heading-1 border-green m-bordered">
            <h3>Import file format guideline</h3>
            <p> Below click to export the full properties list. <br>
                <b>Lines with the property_id field completed will be updated, lines without will e treated as new properties.</b></p>
            <p> Export the
                <a class="btn green btn-outline" href="/admin/property/export" >properties list</a>
            </p>
        </div>

        <?php
        // if import data was successfull
            } else {
                
                foreach ($import_property_data as $property_action=>$property_list) {
                    $k=0;
                    ?>
                    <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-edit font-dark"></i>
                            <span class="caption-subject font-dark bold uppercase"><?=$property_action;?></span>
                        </div>
                    </div>
                    <?php
                    $this->table->set_template(ftable());
                    foreach ($property_list as $property_id=>$property) {
                        $data[$k]="<b>".$property['property_code']."</b>";
                        $data[$k].=" - Sleeps ".$property['property_sleeps'];
//                        $data[$k].=" - Featured ".@$property['property_isfeatured'];
                        $data[$k].="<br>".$property['property_address'];
                        
                        $this->table->add_row($data);
                        unset($data);
                        $k++;
                    }
                    echo $this->table->generate();
                    ?>
                    </div>
                    <?php
                }
                ?>
                    <div class='btn-group'>
                        <a href="./" class="btn btn-danger" role="button">Cancel</a>
                        <a href="../run_import" class="btn btn-success" role="button">Confirm</a>
                    </div>
                <?php
                // @wts($import_event_data);
            }
        ?>

    </div>
</div>
