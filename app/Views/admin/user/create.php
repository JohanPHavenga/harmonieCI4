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
                echo form_label('Name', 'name');
                echo form_input([
                        'name'          => 'name',
                        'id'            => 'name',
                        'value'         => set_value('name', @$user_detail['name']),
                        'class'         => 'form-control',
                        'required'      => '',
                    ]);

                echo '</div></div><div class="col-md-6">';   
                // Surname
                echo "<div class='form-group'>";
                echo form_label('Surname', 'surname');
                echo form_input([
                        'name'          => 'surname',
                        'id'            => 'surname',
                        'value'         => set_value('surname', @$user_detail['surname']),
                        'class'         => 'form-control',
                        'required'      => '',
                    ]);
                echo "</div>";     
                echo "</div></div>";          
                
                // Email
                echo "<div class='form-group'>";
                echo form_label('Email', 'email');
                echo '<div class="input-group"><span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>';
                echo form_input([
                        'name'          => 'email',
                        'id'            => 'email',
                        'value'         => set_value('email', @$user_detail['email']),
                        'class'         => 'form-control',
                    ]);
                echo "</span></div></div>";
                
                // Username
                echo "<div class='form-group'>";
                echo form_label('Username', 'username');
                echo form_input([
                        'name'          => 'username',
                        'id'            => 'username',
                        'value'         => set_value('username', @$user_detail['username']),
                        'class'         => 'form-control',
                    ]);
                echo '<span class="help-block"> Minimum 5 characters. Must be unique. </span>';
                echo "</div>";
               

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