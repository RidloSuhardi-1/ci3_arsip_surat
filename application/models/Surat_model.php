<?php

class Surat_model extends CI_Model
{


    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get($limit = 0)
    {
        return $this->db->get('surat', $limit)->result_array();
    }

    public function find($keyword)
    {
        $this->db->like('judul', $keyword);
        $this->db->order_by('judul', 'ASC');
        return $this->db->get('surat')->result_array();
    }

    public function get_by_id($id)
    {
        if ($id == null) {
            show_error('Surat yang anda maksud tidak ditemukan. Periksa kembali surat anda', 404, 'Terjadi Kesalahan Pada Surat');
        }

        return $this->db->get_where('surat', ['id' => $id])->row_array();
    }

    public function insert($data = '')
    {
        $data = [
            'nomor_surat' => $this->input->post('nomor_surat', true),
            'judul' => $this->input->post('judul', true),
            'kategori' => $this->input->post('kategori', true),
            'file' => $data['file_surat'],
        ];

        $this->db->insert('surat', $data);
    }

    public function update($data)
    {
        $data = [
            'id' => $data['id'],
            'nomor_surat' => $this->input->post('nomor_surat', true),
            'judul' => $this->input->post('judul', true),
            'kategori' => $this->input->post('kategori', true),
            'file' => $data['file_surat'],
        ];

        $this->db->where('id', $data['id']);
        $this->db->update('surat', $data);
    }

    public function delete($id)
    {
        if ($id == null) {
            show_error('Surat yang anda maksud tidak ditemukan. Periksa kembali surat anda', 404, 'Terjadi Kesalahan Pada Surat');
        }

        $data = $this->get_by_id($id);
        unlink('public/uploads/' . $data['file']);

        $this->db->where('id', $id);
        $this->db->delete('surat');
    }
}
