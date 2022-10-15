<?php
$table = new \CodeIgniter\View\Table();
?>
<div class="row">
    <div class="col-md-6">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-list font-dark"></i>
                    <span class="caption-subject bold uppercase"> List of Property Types</span>
                </div>
            </div>
            <div class="portlet-body">

<?php
                if ( ! (empty($type_data)))
                {
                    // create table
                    $table->setTemplate(ftable('types_table'));
                    $table->setHeading($heading);
                    foreach ($type_data as $id=>$data_entry) {
                        
                        $action_array=[
                                [
                                "url"=>"/admin/type/create/edit/".$data_entry['type_id'],
                                "text"=>"Edit",
                                "icon"=>"icon-pencil",
                                ],
                                [
                                "url"=>"/admin/type/delete/".$data_entry['type_id'],
                                "text"=>"Delete",
                                "icon"=>"icon-dislike",
                                "confirmation_text"=>"<b>Are you sure?</b>",
                                ],
                            ];
                        
        
                        $row['id']=$data_entry['type_id'];                  
                        $row['type_name']=$data_entry['type_name'];
                        $row['actions']= fbuttonActionGroup($action_array);
                        
                        $table->addRow(
                                $row['id'], 
                                $row['type_name'], 
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
                echo fbuttonLink(base_url($create_link)."/add","Add Property Type","primary");
                }
                ?>
            
            </div>
        </div>
    </div>
</div>

