<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of login_model
 *
 * @author my
 */
class Login_model extends CI_Model {

    public function login_fn($user_name, $password) {
    $this->db->select('*');
        $this->db->from('user');
        $query = $this->db->get();

        $result = $query->result();

        $flag = 0;


        foreach ($result as $value) {
            if ($value->user_name == $user_name && $value->password == $password)
                $flag = 1;
        }
        if ($flag == 0) {
            return FALSE;
        } else {
            return true;
        }
    }

    //put your code here
}
