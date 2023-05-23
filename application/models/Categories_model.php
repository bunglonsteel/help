<?php



defined('BASEPATH') or exit('No direct script access allowed');

class Categories_model extends CI_Model
{

    private $orderable = ['id', 'category', 'category_slug',];

    private function _get_query()
    {
        $this->db->select('*')->from('categories');
        if (strip_tags(htmlspecialchars($_POST['search']['value']))) {
            $this->db->like('category', strip_tags(htmlspecialchars($_POST['search']['value'])));
        }

        if ($_POST['order'][0]['column']) {
            $this->db->order_by($this->orderable[$_POST['order'][0]['column']], $_POST['order'][0]['dir']);
        } else {
            $this->db->order_by('id', 'DESC');
        }
    }

    public function result_data()
    {
        $this->_get_query();
        if ($_POST['length'] >= 0) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        return $this->db->get()->result();
    }

    public function count_filtered()
    {
        $this->_get_query();
        return $this->db->get()->num_rows();
    }

    public function count_all_result()
    {
        $this->_get_query();
        return $this->db->count_all_results();
    }

    public function select_categories()
    {
        $this->db->select('id, category as name, parent_id as parent');
        if ($this->input->post('s', TRUE)) {
            $this->db->like('category', $this->input->post('s', TRUE));
        }
        return $this->db->get('categories')->result();
    }

    public function find($where = [])
    {
        return $this->db->get_where('categories', $where);
    }

    public function findToPost($where = [])
    {
        return $this->db->get_where('posts', $where);
    }

    public function get($id)
    {
        $this->db->select('id as category_id, category, category_description as desc, parent_id as parent')
            ->from('categories');
        if ($id) {
            $this->db->where('parent_id', htmlentities($id));
        } else {
            $this->db->where('parent_id', NULL);
        }
        return $this->db->get()->result();
    }

    public function insert($data)
    {
        $this->db->insert('categories', $data);
    }

    public function update($id, $data)
    {
        $this->db->update('categories', $data, ['id' => $id]);
    }

    public function delete($id)
    {
        $this->db->delete('categories', ['id' => $id]);
    }
}
