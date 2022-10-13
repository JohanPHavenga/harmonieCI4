<div class="container">
    <div id="main">
        <div class="row">
            <div class="span9">
                <h1 class="page-header">Contact us</h1>

                <?php
                if ($_POST) {
                    // as die post van 'n ander bladsy af kom, moet die kontak form nog klaar ingevul word
                    if (@$from) {
                        echo '<div class="alert alert-note" role="alert">';
                        echo "Please complete the form below to send us a query.";
                        echo '</div>';
                    } else {
                        // anders as daar 'n validation error was, wys dit
                        if (!@$email_send) {
                            echo '<div class="alert alert-danger" role="alert">';
                            echo $validation->listErrors();
                            echo '</div>';
                        } else {
                            // anders, gee 'n success message en hide alles anders
                            echo '<div class="alert alert-success" role="alert">';
                            echo "Thank you for contacting us. Your message has successfully been send.";
                            echo '</div>';
                        }
                    }
                } else {
                ?>

                    <iframe class="map" width="425" height="350" src="https://maps.google.com/maps?q=-34.418073,19.235384&amp;num=1&amp;ie=UTF8&amp;ll=-34.418073,19.235384&amp;spn=0.041038,0.077162&amp;t=m&amp;z=14&amp;output=embed"></iframe>

                    <p>
                        Please use one of the channels below to contact us. If you are unable to reach us on the phone, please leave us a message
                        and we will get back to you as soon as possible.
                    </p>

                    <div class="row">
                        <div class="span3">
                            <h3 class="address">Address</h3>
                            <p class="content-icon-spacing">
                                19 Bird Lane<br>Northcliff<br> Hermanus 7200<br>South Africa
                            </p>
                        </div>
                        <div class="span3">
                            <h3 class="call-us">Call us</h3>
                            <p class="content-icon-spacing">
                                +27 (0)71 505 9201
                            </p>
                        </div>
                        <div class="span3">
                            <h3 class="email">Email</h3>
                            <p class="content-icon-spacing">
                                <a href="mailto:info@harmonieprop.co.za">info@harmonieprop.co.za</a>
                            </p>
                        </div>
                    </div>

                    <h2>We'd love to hear from you. Say hello!</h2>

                <?php
                }

                if (!@$email_send) {

                    echo form_open(base_url('contact'), ["class" => "contact-form"]);

                    echo "<div class='row'>";
                    //  Name
                    echo "<div class='control-group span5'>";
                    echo form_label('Name <span class="form-required" title="This field is required.">*</span>', 'inputContactName');
                    echo form_input([
                        'name'      => 'inputContactName',
                        'id'        => 'inputContactName',
                        'value'     => set_value('inputContactName', @$_POST['inputContactName']),
                        // 'required'  => '',
                    ]);
                    echo "</div>";

                    //  Phone number
                    echo "<div class='control-group span4'>";
                    echo form_label('Phone Number <span class="form-required" title="This field is required.">*</span>', 'inputContactPhone');
                    echo form_input([
                        'name'      => 'inputContactPhone',
                        'id'        => 'inputContactPhone',
                        'value'     => set_value('inputContactPhone', @$_POST['inputContactPhone']),
                        // 'required'  => '',
                    ]);
                    echo "</div>";


                    echo "</div>"; // row

                    echo "<div class='row'>";
                    //  Email
                    echo "<div class='control-group span5'>";
                    echo form_label('Email <span class="form-required" title="This field is required.">*</span>', 'inputContactEmail');
                    echo form_input([
                        'name'      => 'inputContactEmail',
                        'id'        => 'inputContactEmail',
                        'value'     => set_value('inputContactEmail', @$_POST['inputContactEmail']),
                        'type'      => "email",
                        // 'required'  => '',
                    ]);
                    echo "</div>";

                    //  Property code
                    echo "<div class='span4 control-group'>";
                    echo form_label('Property equiring about? (optional)', 'inputPropCode');
                    echo form_input([
                        'name'          => 'inputPropCode',
                        'id'            => 'inputPropCode',
                        'placeholder'   => "Example: V15",
                        'value'     => set_value('inputPropCode', @$_POST['inputPropCode']),
                    ]);
                    echo "</div>";
                    echo "</div>"; // row


                    echo "<div class='row'>";
                    //  Sleeps
                    echo "<div class='span2 control-group'>";
                    echo form_label('Number of guests  <span class="form-required" title="This field is required.">*</span>', 'inputSleeps');
                    echo form_dropdown('inputSleeps', $sleeps_dropdown, @$_POST['inputSleeps'], ["id" => "inputSleeps", "style" => "width: 100%", "required" => ""]);
                    echo "</div>";

                    //  Bedrooms
                    echo "<div class='span2 control-group'>";
                    echo form_label('Bedrooms  <span class="form-required" title="This field is required.">*</span>', 'inputBeds');
                    echo form_dropdown('inputBeds', $beds_dropdown, @$_POST['inputBeds'], ["id" => "inputBeds", "style" => "width: 100%", "required" => ""]);
                    echo "</div>";

                    //  Dates
                    echo "<div class='span2 control-group'>";
                    echo form_label('Date From <span class="form-required" title="This field is required.">*</span>', 'inputDateFrom');
                    echo form_input([
                        'name'          => 'inputDateFrom',
                        'id'            => 'inputDateFrom',
                        'type'          => "text",
                        'placeholder'   => "yyyy-mm-dd",
                        'value'         => set_value('inputDateFrom', @$_POST['inputDateFrom']),
                        // 'required'      => '',
                    ]);
                    echo "</div>";

                    echo "<div class='span2 control-group'>";
                    echo form_label('Date To <span class="form-required" title="This field is required.">*</span>', 'inputDateTo');
                    echo form_input([
                        'name'          => 'inputDateTo',
                        'id'            => 'inputDateTo',
                        'type'          => "text",
                        'placeholder'   => "yyyy-mm-dd",
                        'value'         => set_value('inputDateTo', @$_POST['inputDateTo']),
                        // 'required'      => '',
                    ]);
                    echo "</div>";


                    echo "</div>"; // row



                    echo "<div class='row'>";
                    // Property Overview
                    echo "<div class='span9 control-group'>";
                    echo form_label('Message <span class="form-required" title="This field is required.">*</span>', 'inputContactMessage');
                    echo form_textarea([
                        'name'          => 'inputContactMessage',
                        'id'            => 'inputContactMessage',
                        'value'         => @$_POST['inputContactMessage'],
                        // 'required'  => '',
                    ]);

                    echo "</div>";
                    echo "</div>";

                    echo "<div class='row'>";
                    echo "<div class='span9 control-group'>";
                    echo "<div class='g-recaptcha' data-sitekey='6LegSS0aAAAAAGLy__UyCyCr_EXyZxNQerQdiK7D'></div>";
                    echo "</div>";
                    echo "</div>"; // row


                    echo '<div class="row form-actions">';
                    echo '<input type="submit" class="btn btn-primary arrow-right" value="Send">';
                    echo '</div>';

                    echo form_close();
                }
                ?>
                    <p>
                        <strong>Booking policy:</strong> Minimum stay of 14 nights during high season. Minimum of 4 nights stay during low and mid season.
                    </p>
            </div>

            <div class="sidebar span3">
                <div class="widget properties last">
                    <?= $latest_prop; ?>
                </div><!-- /.properties -->

            </div>
        </div>
    </div>
</div>