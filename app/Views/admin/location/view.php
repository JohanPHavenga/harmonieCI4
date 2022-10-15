<?php
$table = new \CodeIgniter\View\Table();
?>
<div class="row">
    <div class="col-md-6">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-list font-dark"></i>
                    <span class="caption-subject bold uppercase"> List of Locations</span>
                </div>
            </div>
            <div class="portlet-body">

<?php
//    wts($location_data);
                if ( ! (empty($location_data)))
                {
                    // create table
                    $table->setTemplate(ftable('locations_table'));
                    $table->setHeading($heading);
                    foreach ($location_data as $id=>$data_entry) {
                        
                        $action_array=[
                                [
                                "url"=>"/admin/location/create/edit/".$data_entry['location_id'],
                                "text"=>"Edit",
                                "icon"=>"icon-pencil",
                                ],
                                [
                                "url"=>"/admin/location/delete/".$data_entry['location_id'],
                                "text"=>"Delete",
                                "icon"=>"icon-dislike",
                                "confirmation_text"=>"<b>Are you sure?</b>",
                                ],
                            ];
                        
        
                        $row['id']=$data_entry['location_id'];                  
                        $row['location_name']=$data_entry['location_name'];
                        $row['actions']= fbuttonActionGroup($action_array);
                        
                        $table->addRow(
                                $row['id'], 
                                $row['location_name'], 
                                $row['actions']
                                );
//                        $table->add_row($row);
                        unset($row);
                    }
                    echo $table->generate();

                }
                else
                {
                    echo "<p>No data to show</p>";
                }

                // add button
                if (@$create_link)
                {
                echo fbuttonLink(base_url($create_link)."/add","Add Location","primary");
                }
                ?>
            
            </div>
        </div>
    </div>
</div>

