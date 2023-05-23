<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_login();
        check_access();
    }


    public function index()
    {
        $data['posts']      = $this->db->select('COUNT(id) as total, SUM(status = "1") as publish, SUM(status = "0") as draft')->from('posts')->get()->row();
        $data['categories'] = $this->db->select('COUNT(id) as total')->from('categories')->get()->row();
        // var_dump($data['posts']);die;
        $data['title'] = 'Dashboard';
        render_template_admin('backend/dashboard', $data);
    }
}

/* End of file Dashboard.php */
