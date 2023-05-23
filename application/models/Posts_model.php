<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Posts_model extends CI_Model
{

    private $orderable = ['id', 'title', 'category', 'created_at', 'updated_at', 'status'];

    private function _get_query()
    {
        $this->db->select('posts.id as id, title, slug, description, status, created_at, updated_at, category')
            ->from('posts')
            ->join('categories', 'posts.category_id = categories.id');
        if (strip_tags(htmlspecialchars($_POST['search']['value']))) {
            $this->db->like('title', strip_tags(htmlspecialchars($_POST['search']['value'])))
                ->or_like('description', strip_tags(htmlspecialchars($_POST['search']['value'])));
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

    public function find($where = [])
    {
        return $this->db->get_where('posts', $where);
    }

    public function findWithJoin($where = [])
    {
        return $this->db->select('posts.id as id, title, slug, description, content, status, created_at, category_id, category')
            ->from('posts')
            ->join('categories', 'posts.category_id = categories.id')
            ->where($where)
            ->get()
            ->row();
    }

    public function get($limit, $offset, $category = '', $search = '')
    {
        $this->db->select('title, slug, description, content, status, category_id, category')
            ->from('posts')
            ->join('categories', 'posts.category_id = categories.id');
        if ($category) {
            $this->db->where('posts.category_id', htmlentities($category));
        }
        if ($search) {
            $this->db->like('posts.title', htmlentities($search));
            $this->db->or_like('posts.content', htmlentities($search));
        }
        return $this->db->order_by('posts.id', 'DESC')
            ->limit($limit)
            ->offset($offset)
            ->get()
            ->result();
    }

    public function insert($data)
    {
        $this->db->insert('posts', $data);
    }

    public function update($id, $data)
    {
        $this->db->update('posts', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }

    public function delete($where)
    {
        $this->db->delete('posts', $where);
    }
}

/* End of file Posts_model.php */
