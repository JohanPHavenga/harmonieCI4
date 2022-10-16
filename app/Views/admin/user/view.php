<?php
$table = new \CodeIgniter\View\Table();
?>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-list font-dark"></i>
                    <span class="caption-subject bold uppercase"> List of all Users</span>
                </div>
            </div>
            <div class="portlet-body">

                <?php
                //    wts($user_data);
                if (!(empty($user_data))) {
                    // create table
                    $table->setTemplate(ftable('users_table'));
                    $table->setHeading($heading);
                    foreach ($user_data as $id => $data_entry) {

                        $action_array = [
                            [
                                "url" => "/admin/user/create/edit/" . $data_entry['id'],
                                "text" => "Edit",
                                "icon" => "icon-pencil",
                            ],
                            [
                                "url" => "/admin/user/delete/" . $data_entry['id'],
                                "text" => "Delete",
                                "icon" => "icon-dislike",
                                "confirmation_text" => "<b>Are you sure?</b>",
                            ],
                        ];


                        $row['id'] = $data_entry['id'];
                        $row['name'] = $data_entry['name'];
                        $row['surname'] = $data_entry['surname'];
                        $row['email'] = $data_entry['email'];

                        $row['actions'] = fbuttonActionGroup($action_array);

                        $table->addRow(
                            $row['id'],
                            $row['name'],
                            $row['surname'],
                            $row['email'],
                            $row['actions']
                        );
                        //                        $table->add_row($row);
                        unset($row);
                    }
                    echo $table->generate();
                } else {
                    echo "<p>No data to show</p>";
                }

                // add button
                if (@$create_link) {
                    echo fbuttonLink(base_url($create_link) . "/add", "Add User", "primary");
                }
                ?>

            </div>
        </div>
    </div>
</div>