<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Posts extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Posts_model', 'posts');
        $this->load->model('Categories_model', 'categories');
        check_login();
        check_access();
    }


    public function index()
    {
        if ($this->input->is_ajax_request()) {
            $result = $this->posts->result_data();
            $rows   = [];
            $start  = $_POST['start'];

            foreach ($result as $res) {
                $class = $res->status == 1 ? 'text-green bg-soft-success' : 'bg-label-info';
                $status = $res->status == 1 ? 'publish' : 'draft';

                $row   = [];
                $row[] = ++$start . ".";
                $row[] = htmlspecialchars($res->title);
                $row[] = htmlspecialchars($res->category);
                $row[] = date('d M Y', strtotime($res->created_at));
                $row[] = date('d M Y', strtotime($res->updated_at));
                $row[] = '<span class="badge w-100 px-3 py-2 ' . $class . '">
                            ' . $status . '
                            </span>';
                $row[] = '<div class="d-flex gap-2">
                            <a href="' . base_url('admin/posts/edit/' . $res->slug) . '" class="d-flex btn edit btn-sm btn-icon btn-secondary">
                                <i class="tf-icons bx bx-edit-alt"></i>
                            </a>
                            <button type="button" class="d-flex btn delete btn-sm btn-icon btn-danger" data-id="' . $res->slug . '">
                                <i class="tf-icons bx bx-trash"></i>
                            </button>
                            <a target="_BLANK" href="' . base_url('post/' . $res->slug) . '" class="d-flex btn edit btn-sm btn-icon btn-info">
                                <i class="tf-icons bx bx-low-vision"></i>
                            </a>
                        </div>';
                $rows[] = $row;
            }
            // var_dump($rows);die;
            $output = [
                "draw"            => $_POST['draw'],
                "recordsTotal"    => $this->posts->count_all_result(),
                "recordsFiltered" => $this->posts->count_filtered(),
                "data"            => $rows,
                "csrf_hash"       => $this->security->get_csrf_hash()
            ];
            return $this->output->set_content_type('application/json')->set_output(json_encode($output));
        }
        $data['title'] = 'Postingan';
        render_template_admin('backend/posts/index', $data);
    }

    public function add()
    {
        $this->_rules();
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Tambah Postingan';
            render_template_admin('backend/posts/add', $data);
        } else {
            $title    = htmlentities($this->input->post('title', TRUE));

            $slug     = url_title(htmlentities($this->input->post('slug', TRUE)), '-', TRUE);

            $category = htmlentities($this->input->post('category', TRUE));
            $desc     = htmlentities($this->input->post('desc', TRUE));

            $content  = htmlentities($this->input->post('content'));
            $content  = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $content);

            $dom      = new DOMDocument();
            $dom->loadHTML($content);
            $script   = $dom->getElementsByTagName('h2');
            foreach ($script as $key => $item) {
                $add_id = 'heading-' . $key;
                $item->setAttribute('id', $add_id);
            }

            $status  = htmlentities($this->input->post('status', TRUE));

            $data = [
                "category_id" => $category,
                "title"       => $title,
                "slug"        => $slug,
                "description" => $desc,
                "content"     => $content,
                "status"      => 0
            ];

            if ($status == null) {
                $data['status'] = 1;
            }

            $this->posts->insert($data);
            $this->session->set_flashdata('message', '<div class="alert alert-primary alert-dismissible fs-7 py-2_5" role="alert">Postingan berhasil ditambahkan
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="padding:1rem"></button>
                                                    </div>');
            redirect('admin/posts');
        }
    }

    public function edit($slug = '')
    {
        $this->_rules();
        $data['post'] = $this->posts->findWithJoin(['slug' => htmlentities($slug)]);
        if (!$data['post']) {
            show_404();
        }

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Edit Postingan';
            render_template_admin('backend/posts/edit', $data);
        } else {
            $title    = htmlentities($this->input->post('title', TRUE));

            $slug     = url_title(htmlentities($this->input->post('slug', TRUE)), '-', TRUE);

            $category = htmlentities($this->input->post('category', TRUE));
            $desc     = htmlentities($this->input->post('desc', TRUE));

            $content  = htmlentities($this->input->post('content'));
            $content  = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $content);

            $dom      = new DOMDocument();
            $dom->loadHTML($content);
            $script   = $dom->getElementsByTagName('h2');
            foreach ($script as $key => $item) {
                $add_id = 'heading-' . $key;
                $item->setAttribute('id', $add_id);
            }

            $status  = htmlentities($this->input->post('status', TRUE));
            $post_id = $data['post']->id;
            $data    = [
                "category_id" => $category,
                "title"       => $title,
                "slug"        => $slug,
                "description" => $desc,
                "content"     => $content,
                "status"      => $status,
            ];
            if ($status == null) {
                $data['status'] = 1;
            }


            $this->posts->update($post_id, $data);
            $this->session->set_flashdata('message', '<div class="alert alert-primary alert-dismissible fs-7 py-2_5" role="alert">Postingan berhasil diperbarui
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="padding:1rem"></button>
                                                    </div>');
            redirect('admin/posts');
        }
    }

    private function _rules()
    {
        $this->form_validation->set_rules(
            'title',
            'Judul',
            'trim|required'
        );
        $this->form_validation->set_rules(
            'slug',
            'Slug',
            'trim|required',
        );
        $this->form_validation->set_rules(
            'category',
            'Kategori',
            'trim|required'
        );
        $this->form_validation->set_rules(
            'desc',
            'Deskripsi',
            'trim|required',
        );
        $this->form_validation->set_rules(
            'content',
            'Konten',
            'trim|required',
        );
    }

    public function remove()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $slug       = htmlentities($this->input->post('target', TRUE));
            $check_post = $this->posts->find(['slug' => $slug])->row();
            if ($check_post) {
                $message = [
                    'success'   => 'true',
                    'message'   => 'Postingan berhasil dihapus.',
                    'csrf_hash' => $this->security->get_csrf_hash(),
                ];
                preg_match_all('~<img.*?src=["\']+(.*?)["\']+~', html_entity_decode($check_post->content), $urls);
                $urls = $urls[1];
                foreach ($urls as $url) {
                    $img = str_replace(base_url('public/image/notes/'), "", $url);
                    unlink(FCPATH . 'public/image/notes/' . $img);
                }
                $this->posts->delete(['id' => $check_post->id]);
            } else {
                $message = [
                    'error'     => 'true',
                    'message'   => 'Postingan tidak atau anda mencoba sesuatu yang tidak ada.',
                    'csrf_hash' => $this->security->get_csrf_hash(),
                ];
            }

            echo json_encode($message);
        }
    }

    function upload_image_summernote()
    {
        if ($_FILES['file']['name']) {
            $config['allowed_types']    = 'jpg|jpeg|png|gif';
            $config['upload_path']      = './public/image/notes/';
            $config['file_ext_tolower'] = TRUE;
            $config['encrypt_name']     = TRUE;
            $config['max_size']         = '5000';

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('file')) {
                $message = [
                    'error'     => true,
                    'message'   => $this->upload->display_errors('', ''),
                    'csrf_hash' => $this->security->get_csrf_hash()
                ];
            } else {
                $file_name = $this->upload->data('file_name');
                $message = [
                    'success'   => true,
                    'data'      => base_url('public/image/notes/') . $file_name,
                    'csrf_hash' => $this->security->get_csrf_hash()
                ];
            }
            echo json_encode($message);
        }
    }

    function delete_image_summernote()
    {

        $target_image = htmlspecialchars($_POST['src']);
        if ($target_image) {
            $file_name = str_replace(base_url('public/image/notes/'), "", $target_image);
            if (unlink(FCPATH . 'public/image/notes/' . $file_name)) {
                $message = [
                    'success'   => true,
                    'message'   => 'Gambar Berhasil dihapus',
                    'csrf_hash' => $this->security->get_csrf_hash()
                ];

                echo json_encode($message);
            }
        }
    }
}

/* End of file Posts.php */
