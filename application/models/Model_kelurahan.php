<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_kelurahan extends CI_Model
{

    public function getAll()
    {
        return $this->db->get('tbl_kelurahan')->result();
    }
}
