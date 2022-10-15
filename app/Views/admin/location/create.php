<div class="row">
    <div class="col-md-6">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-edit font-dark"></i>
                    <span class="caption-subject font-dark bold uppercase"><?= ucfirst($action);?> entry</span>
                </div>
            </div>
            <div class="portlet-body">
            <?php 
                echo '<div class="alert alert-danger" role="alert">';
                echo $validation->listErrors();
                echo '</div>';

                echo form_open($form_url); 

                // Name
                echo '<div class="row"><div class="col-md-6">';
                echo "<div class='form-group'>";
                echo form_label('Location', 'location_name');
                echo form_input([
                        'name'          => 'location_name',
                        'id'            => 'location_name',
                        'value'         => set_value('location_name', @$location_detail['location_name']),
                        'class'         => 'form-control',
                        'required'      => '',
                    ]);

                echo '</div>';
                echo "</div></div>";          
                

                echo "<div class='btn-group'>";
                echo fbutton("Submit","submit","primary");
                echo fbuttonLink($return_url,"Cancel");
                echo "</div>";

                echo form_close();

            //    wts($user_detail);
            ?>
            </div>
        </div>
    </div>
</div>