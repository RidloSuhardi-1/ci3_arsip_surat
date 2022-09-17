<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Surat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Surat_model');
        $this->load->helper('download');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data = null;
        $keyword = $this->input->post('search_by_judul');

        if (isset($keyword)) {
            $data = $this->Surat_model->find($keyword);
        } else {
            $data = $this->Surat_model->get();
        }

        $this->load->view('layouts/header');
        $this->load->view('admin/surat/index', ['data' => $data, 'keyword' => $keyword]);
        $this->load->view('layouts/footer');
    }

    public function find($keyword)
    {
    }

    public function detail($id)
    {
        $data = $this->Surat_model->get_by_id($id);

        $this->load->view('layouts/header');
        $this->load->view('admin/surat/detail', ['data' => $data]);
        $this->load->view('layouts/footer');
    }

    public function create()
    {
        $this->form_validation->set_rules('nomor_surat', 'Nomor Surat', 'required|is_unique[surat.nomor_surat]|min_length[5]');
        $this->form_validation->set_rules('judul', 'Judul', 'required|min_length[2]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layouts/header');
            $this->load->view('admin/surat/tambah');
            $this->load->view('layouts/footer');

            if (isset($_SESSION['error_file'])) {
                unset($_SESSION['error_file']);
            }
        } else {

            $file = $this->do_upload('file_surat');

            if (isset($file['error'])) {
                unlink('public/uploads/' . $file['filename']);

                $this->session->set_flashdata('error_file', $file['error']);
                redirect($_SERVER['HTTP_REFERER']);
            }

            if ($file['filename']) {
                $data['file_surat'] = $file['filename'];
            }

            $this->Surat_model->insert($data);
            $this->session->set_flashdata('pesan', 'ditambahkan');
            redirect('surat');
        }
    }

    public function edit($id)
    {
        $surat = $this->Surat_model->get_by_id($id);
        $file = null;
        $data['id'] = $surat['id'];
        $data['file_surat'] = '';

        $old_nomor = $this->input->post('old_nomor');
        $new_nomor = $this->input->post('nomor_surat');

        if ($old_nomor == $new_nomor) {
            $available = true;
        } else {
            foreach ($this->Surat_model->get() as $s) {
                if ($s['nomor_surat'] == $new_nomor) {
                    $available = false;
                    break;
                } else {
                    $available = true;
                }
            }
        }

        if ($available) {
            $rules = 'required|min_length[5]';
        } else {
            $rules = 'required|is_unique[surat.nomor_surat]|min_length[5]';
        }

        $this->form_validation->set_rules('nomor_surat', 'Nomor Surat', $rules);
        $this->form_validation->set_rules('judul', 'Judul', 'required|min_length[2]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layouts/header');
            $this->load->view('admin/surat/edit', ['data' => $surat]);
            $this->load->view('layouts/footer');

            if (isset($_SESSION['error_file'])) {
                unset($_SESSION['error_file']);
            }
        } else {

            if (file_exists($_FILES['file_surat']['tmp_name']) || is_uploaded_file($_FILES['file_surat']['tmp_name'])) {
                $file = $this->do_upload('file_surat');

                if (isset($file['error'])) {
                    unlink('public/uploads/' . $file['filename']);

                    $this->session->set_flashdata('error_file', $file['error']);
                    redirect($_SERVER['HTTP_REFERER']);
                }

                unlink('public/uploads/' . $surat['file']);
                $data['file_surat'] = $file['filename'];
            } else {
                $data['file_surat'] = $surat['file'];
            }

            $this->Surat_model->update($data);
            $this->session->set_flashdata('pesan', 'diperbarui');
            redirect('surat');
        }
    }

    public function delete($id)
    {
        $this->Surat_model->delete($id);
        $this->session->set_flashdata('pesan', 'Berhasil dihapus');
        redirect('surat');
    }

    protected function do_upload($field)
    {
        $config['upload_path'] = 'public/uploads/';
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = '4096';
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($field)) {
            $result['error'] = $this->upload->display_errors();
            return $result;
        } else {
            $upload_data = $this->upload->data();
            $result['filename'] = $upload_data['file_name'];
            return $result;
        }
    }

    // download

    public function download($id)
    {
        $data = $this->Surat_model->get_by_id($id);
        $file = file_get_contents(base_url() . 'public/uploads/' . $data['file']);
        force_download(str_replace(' ', '_', $data['judul']) . '.pdf', $file);
        redirect('surat');
    }
}
