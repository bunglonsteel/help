<?php

if (!function_exists('access')) {

    function check_login()
    {
        $ci =  &get_instance();
        if (!$ci->session->userdata('email')) {
            redirect('auth');
        }
    }

    function check_access()
    {
        $ci   = &get_instance();
        $role = $ci->db->get_where('users', ['email' => $ci->session->userdata('email')])->row();
        if ($role->type != "superadmin") {
            show_404();
        }
    }
}
