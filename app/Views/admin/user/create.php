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
                echo validation_errors(); 

                echo form_open($form_url); 

                // Name
                echo '<div class="row"><div class="col-md-6">';
                echo "<div class='form-group'>";
                echo form_label('Name', 'user_name');
                echo form_input([
                        'name'          => 'user_name',
                        'id'            => 'user_name',
                        'value'         => set_value('user_name', @$user_detail['user_name']),
                        'class'         => 'form-control',
                        'required'      => '',
                    ]);

                echo '</div></div><div class="col-md-6">';   
                // Surname
                echo "<div class='form-group'>";
                echo form_label('Surname', 'user_surname');
                echo form_input([
                        'name'          => 'user_surname',
                        'id'            => 'user_surname',
                        'value'         => set_value('user_surname', @$user_detail['user_surname']),
                        'class'         => 'form-control',
                        'required'      => '',
                    ]);
                echo "</div>";     
                echo "</div></div>";          
                
                // Email
                echo "<div class='form-group'>";
                echo form_label('Email', 'user_email');
                echo '<div class="input-group"><span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>';
                echo form_input([
                        'name'          => 'user_email',
                        'id'            => 'user_email',
                        'value'         => set_value('user_email', @$user_detail['user_email']),
                        'class'         => 'form-control',
                    ]);
                echo "</span></div></div>";
                
                // Username
                echo "<div class='form-group'>";
                echo form_label('Username', 'user_username');
                echo form_input([
                        'name'          => 'user_username',
                        'id'            => 'user_username',
                        'value'         => set_value('user_username', @$user_detail['user_username']),
                        'class'         => 'form-control',
                    ]);
                echo '<span class="help-block"> Minimum 5 characters. Must be unique. </span>';
                echo "</div>";

                // Password
                echo '<div class="row"><div class="col-md-6">';
                echo "<div class='form-group'>";
                echo form_label('Password', 'user_password');
                echo form_input([
                        'name'          => 'user_password',
                        'id'            => 'user_password',
                        'value'         => set_value('user_password', @$user_detail['user_password']),
                        'class'         => 'form-control',
                        'type'          => 'password',
                    ]);

                echo '</div></div><div class="col-md-6">';                
                // Confirm Password
                echo "<div class='form-group'>";
                echo form_label('Confirm Password', 'passconf');
                echo form_input([
                        'name'          => 'passconf',
                        'id'            => 'passconf',
                        'value'         => set_value('passconf', @$user_detail['passconf']),
                        'class'         => 'form-control',
                        'type'          => 'password',
                    ]);

                echo "</div>";
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