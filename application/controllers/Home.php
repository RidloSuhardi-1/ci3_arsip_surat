<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return redirect('surat');
    }

    public function about()
    {
        $this->load->view('layouts/header');
        $this->load->view('pages/about');
        $this->load->view('layouts/footer');
    }
}
