<?php

class content_model extends CI_Model {

    public function communication_data_save($data) {
        if ($this->db->insert('query', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
