<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {


    public function index()

    {
        $this->load->view('templates/header');
        $this->load->view('home/index');
        $this->load->view('templates/footer');
        $this->load->view('templates/js');
    }

}

/* End of file Home.php */
