<?php



defined('BASEPATH') or exit('No direct script access allowed');

class Categories extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Categories_model', 'categories');
        check_login();
        check_access();
    }

    private $show_child_category;

    public function index()
    {
        if ($this->input->is_ajax_request()) {
            $result = $this->categories->result_data();
            $rows   = [];
            $start  = $_POST['start'];

            foreach ($result as $res) {
                $row        = [];
                $row[]      = ++$start . ".";
                $row[]      = '<span class="d-block fw-bold">' . htmlentities($res->category) . '</span><small><i>' . implode(' ->  ', $this->_displayCategories($result, $res->parent_id)) . '</i></small>';
                $row[]      = htmlentities($res->category_slug);
                $row[]      = '<div class="d-flex">
                                <button type="button" class="d-flex btn edit btn-sm btn-secondary me-2" data-id="' . $res->id . '">
                                    <i class="tf-icons bx bx-edit-alt"></i>Ubah
                                </button>
                                <button type="button" class="d-flex btn delete btn-sm btn-danger" data-id="' . $res->id . '">
                                    <i class="tf-icons bx bx-trash"></i>Hapus
                                </button>
                            </div>';
                $rows[] = $row;
            }

            $output = [
                "draw"            => $_POST['draw'],
                "recordsTotal"    => $this->categories->count_all_result(),
                "recordsFiltered" => $this->categories->count_filtered(),
                "data"            => $rows,
                "csrf_hash"       => $this->security->get_csrf_hash()
            ];
            return $this->output->set_content_type('application/json')->set_output(json_encode($output));
        }
        $data['title'] = 'Kategori';
        render_template_admin('backend/categories', $data);
    }

    public function action(String $type = "add")
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        } else {
            $this->form_validation->set_rules(
                'category',
                'Nama Kategori',
                'trim|required',
                ['required' => '%s tidak boleh kosong.']
            );

            $cat_id    = strip_tags(htmlentities($this->input->post('target', TRUE)));
            $cat_name  = strip_tags(htmlentities($this->input->post('category', TRUE)));
            $desc      = strip_tags(htmlentities($this->input->post('desc', TRUE)));
            $parent_id = strip_tags(htmlentities($this->input->post('parent', TRUE)));

            $cat_slug  = url_title($cat_name);

            if ($type == "add") {
                $message = $this->_add_categories($cat_name, $cat_slug, $desc, $parent_id);
            }

            if ($type == "edit") {
                $message = $this->_update_categories($cat_id, $cat_name, $cat_slug, $desc, $parent_id);
            }

            if ($type == "delete") {
                $message = $this->_remove_categories($cat_id);
            }

            echo json_encode($message);
        }
    }

    private function _add_categories($cat_name, $cat_slug, $desc, $parent_id)
    {
        if ($this->form_validation->run() == false) {
            return [
                'errors'    => 'true',
                'message'   => validation_errors('<div class="alert alert-danger alert-dismissible fs-7 py-2_5" role="alert">', '</div>'),
                'csrf_hash' => $this->security->get_csrf_hash(),
            ];
        } else {

            $is_slug_ready = $this->categories->find(['category_slug' => $cat_slug])->row_array();

            if ($is_slug_ready) {
                $cat_slug .= strtoupper(substr(sha1(rand()), 0, 3));
            }

            $data = [
                'category'             => $cat_name,
                'category_slug'        => $cat_slug,
                'category_description' => $desc,
            ];

            if ($parent_id) {
                $data['parent_id'] = $parent_id;
            }

            $this->categories->insert($data);
            return [
                'success'   => 'true',
                'message'   => 'Kategori berhasil ditambahkan, terimakasih.',
                'csrf_hash' => $this->security->get_csrf_hash(),
            ];
        }
    }

    private function _update_categories($cat_id, $cat_name, $cat_slug, $desc, $parent_id)
    {
        if ($this->form_validation->run() == false) {
            return [
                'errors'    => 'true',
                'message'   => validation_errors('<div class="alert alert-danger alert-dismissible fs-7 py-2_5" role="alert">', '</div>'),
                'csrf_hash' => $this->security->get_csrf_hash(),
            ];
        } else {
            $check = $this->categories->find(['id' => $cat_id])->row();
            if (!$check) {
                return [
                    'error'     => 'true',
                    'message'   => 'Kategori yang anda ingin rubah tidak ditemukan.',
                    'csrf_hash' => $this->security->get_csrf_hash(),
                ];
            } else {
                $data = [
                    'category'             => $cat_name,
                    'category_slug'        => $cat_slug,
                    'category_description' => $desc,
                    'parent_id'            => $parent_id,
                ];
                $this->categories->update($cat_id, $data);
                return [
                    'success'   => 'true',
                    'message'   => 'Kategori berhasil diperbarui, terimakasih.',
                    'csrf_hash' => $this->security->get_csrf_hash(),
                ];
            }
        }
    }

    private function _remove_categories($cat_id)
    {
        $check = $this->categories->find(['id' => $cat_id])->row();
        if (!$check) {
            return [
                'error'     => 'true',
                'message'   => 'Kategori yang ingin dihapus tidak ditemukan.',
                'csrf_hash' => $this->security->get_csrf_hash(),
            ];
        } else {
            $check_post = $this->categories->findToPost(['category_id' => $cat_id])->row();
            if ($check_post) {
                return [
                    'error'     => 'true',
                    'message'   => 'Kategori tidak bisa dihapus karena ada postingan yang menggunakan kategori ini.',
                    'csrf_hash' => $this->security->get_csrf_hash(),
                ];
            } else {
                $this->categories->delete($cat_id);
                return [
                    'success'   => 'true',
                    'message'   => 'Kategori berhasil dihapus, terimakasih.',
                    'csrf_hash' => $this->security->get_csrf_hash(),
                ];
            }
        }
    }

    private function _displayCategories($categories, $parent_id, $parents = [])
    {
        $this->show_child_category = $parents;
        foreach ($categories as $cat) {
            if ($cat->id == $parent_id) {
                array_push($this->show_child_category, $cat->category);
                Self::_displayCategories($categories, $cat->parent_id, $this->show_child_category);
            }
        }
        return $this->show_child_category;
    }

    public function get_categories($id = '')
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        } else {
            $target = strip_tags(htmlentities($id));
            $result = $this->categories->find(['id' => $target])->row();
            $parent = $this->categories->find(['id' => $result->parent_id])->row();

            $newCategory           = new stdClass();
            $newCategory->id       = $result->id;
            $newCategory->category = $result->category;
            $newCategory->desc = $result->category_description;
            $newCategory->parent   = $result->parent_id;

            if ($parent) {
                $newCategory->parent_category = $parent->category;
            }

            if (!$result) {
                $message = [
                    'errors'    => 'true',
                    'message'   => 'Data tidak ditemukan',
                    'csrf_hash' => $this->security->get_csrf_hash(),
                ];
            } else {
                $message = [
                    'success'   => 'true',
                    'message'   => 'Data berhasil ditemukan',
                    'data'      => $newCategory,
                    'csrf_hash' => $this->security->get_csrf_hash(),
                ];
            }
            echo json_encode($message);
        }
    }

    public function select_categories()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        } else {
            $result = $this->categories->select_categories();
            if (!$result) {
                $message = [
                    'errors'    => 'true',
                    'message'   => 'Data tidak ditemukan',
                    'csrf_hash' => $this->security->get_csrf_hash(),
                ];
            } else {
                $message = [
                    'success'   => 'true',
                    'message'   => 'Data berhasil ditemukan',
                    'data'      => $result,
                    'csrf_hash' => $this->security->get_csrf_hash(),
                ];
            }
            echo json_encode($message);
        }
    }
}

/* End of file Categories.php */
