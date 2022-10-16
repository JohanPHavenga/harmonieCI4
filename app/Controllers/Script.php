<?php

namespace App\Controllers;

use App\Models\ExtendedUserModel;

class Script extends BaseController
{
    public function port_user_table()
    {
        $user_model = model(ExtendedUserModel::class);
        $old_user_list = $user_model->get_user_list_old();
        $new_user_list = $user_model->get_user_list();

        $updated=0;
        $added=0;
        $check_arr=[];

        foreach ($new_user_list as $user) {
            $check_arr[$user['id']] = $user['email'];
        }

        foreach ($old_user_list as $user_id => $user) {
            $data_arr = [
                "name" => $user['user_name'],
                "surname" => $user['user_surname'],
            ];

            if (in_array($user['user_email'], $check_arr)) {
                // check if the email address already in user table
                $user_model->set_user("edit", array_search($user['user_email'],$check_arr), $data_arr);
                $updated++;
            } else {
                // else add the user
                $data_arr['username']=$user['user_username'];
                $data_arr['email']=$user['user_email'];
                $data_arr['active']=1;
                $data_arr['created_at']=date("Y-m-d H:i:s");
                $user_model->set_user("add", null, $data_arr);
                $added++;
            }
        }

        d("Updated: ".$updated);
        d("Added: ".$added);
        d($user_model->get_user_list_old());
        dd($user_model->get_user_list());
    }
}
