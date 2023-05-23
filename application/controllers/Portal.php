<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Portal extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Posts_model', 'posts');
        $this->load->model('Categories_model', 'categories');
        $this->user =  $this->db->where('email', $this->session->userdata('email'))->from('users')->get()->row();
        check_login();
    }


    public function index()
    {
        $data['title'] = 'Help Center - Bunglon Steel';
        render_template('front/portal', $data);
    }

    public function post($slug = '')
    {
        $data['post'] = $this->posts->findWithJoin(['slug' => htmlentities($slug)]);
        if (!$data['post']) {
            show_404();
        }

        $data['title'] = $data['post']->title;
        render_template('front/post', $data);
    }

    public function top_posts()
    {
        $post = $this->posts->get(3, 0);
        if ($post || $post == NULL) {
            $data = $post != null ? $post : [];
            $response = [
                'success'    => true,
                'code'       => 200,
                'data'       => $data,
                "csrf_hash" => $this->security->get_csrf_hash()
            ];
            $this->output->set_status_header(200);
        } else {
            $response = [
                'error'      => true,
                'code'       => 500,
                "csrf_hash" => $this->security->get_csrf_hash()
            ];
            $this->output->set_status_header(500);
        }
        return $this->output
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    }

    public function categories()
    {
        $id       = $this->input->get('child', TRUE);
        $category = $this->categories->get($id);
        if ($category || $category == NULL) {
            $data = $category != null ? $category : [];
            $response = [
                'success'    => true,
                'code'       => 200,
                'data'       => $data,
                "csrf_hash" => $this->security->get_csrf_hash()
            ];
            $this->output->set_status_header(200);
        } else {
            $response = [
                'error'      => true,
                'code'       => 500,
                "csrf_hash" => $this->security->get_csrf_hash()
            ];
            $this->output->set_status_header(500);
        }
        return $this->output
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    }

    public function list_posts()
    {
        $limit    = $this->input->post('limit');
        $offset   = $this->input->post('offset');
        $category = $this->input->post('category');
        $search   = $this->input->post('search');
        $post     = $this->posts->get($limit, $offset, $category, $search);

        if ($post || $post == NULL) {
            $data = $post != null ? $post : [];
            $response = [
                'success'    => true,
                'code'       => 200,
                'data'       => $data,
                "csrf_hash" => $this->security->get_csrf_hash()
            ];
            $this->output->set_status_header(200);
        } else {
            $response = [
                'error'      => true,
                'code'       => 500,
                "csrf_hash" => $this->security->get_csrf_hash()
            ];
            $this->output->set_status_header(500);
        }
        return $this->output
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    }
}

/* End of file Page.php */
