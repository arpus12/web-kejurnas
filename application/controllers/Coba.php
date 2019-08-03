<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Coba extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model');
    }

    public function index()
    {

        //$data['peserta'] = $this->Admin_model->dataPeserta();
        //var_dump($data['peserta']);
        $query = $this->db->query('SELECT kontingen, kategori, COUNT( kontingen ) as total FROM user JOIN peserta ON peserta.user_email = user.email GROUP BY kontingen, kategori');
        $hasil = $query->result_array();

        var_dump($hasil);
        die;
        $hasil1 = $hasil[0]->kontingen;
        $hasil2 = $hasil[0]->kategori;
        $hasil3 = $hasil[0]->total;
        echo $hasil1, " : ", $hasil2, "  = ", $hasil3;
    }
}
