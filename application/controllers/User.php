<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_login();

        $this->load->library('form_validation');
        $this->load->model('User_model');
    }



    public function index()
    {
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();

        $data['peserta'] = $this->User_model->userPeserta($email);

        $data['title'] = "Halaman User";
        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/user_footer');
    }


    public function tambahPeserta()
    {
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();

        $check = [
            'required' => 'harus diisi',
            'numeric' => 'isi dengan angka'
        ];
        $this->form_validation->set_message('check', 'harus diisi');

        $this->form_validation->set_rules('nama', 'Nama', 'trim|required', $check);
        $this->form_validation->set_rules('tempat_lahir', 'Tempat_lahir', 'trim|required', $check);
        $this->form_validation->set_rules('tgl_lahir', 'Tgl_lahir', 'trim|required|callback_check', $check);
        $this->form_validation->set_rules('kolat', 'Kolat', 'trim|required', $check);
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required', $check);
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required|callback_check', $check);
        $this->form_validation->set_rules('tingkatan', 'Gender', 'trim|required|callback_check', $check);
        $this->form_validation->set_rules('tb', 'Tb', 'trim|required|numeric', $check);
        $this->form_validation->set_rules('bb', 'Bb', 'trim|required|numeric', $check);
        $this->form_validation->set_rules('kategori', 'Kategori', 'trim|required|callback_check', $check);
        $this->form_validation->set_rules('jenis', 'Jenis', 'trim|required|callback_check', $check);
        $this->form_validation->set_rules('kelas', 'Jenis', 'trim|required|callback_check', $check);

        if ($this->form_validation->run() == false) {
            $data['title'] = "Tambah Data Peserta";
            $this->load->view('templates/user_header', $data);
            $this->load->view('templates/user_sidebar', $data);
            $this->load->view('templates/user_topbar', $data);
            $this->load->view('user/tambahPeserta', $data);
            $this->load->view('templates/user_footer');
        } else {

            $upload_gambar = $_FILES['gambar']['name'];

            if ($upload_gambar) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']     = '2048';        // maks 1 Mb
                $config['upload_path'] = './assets/img/profile/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('gambar')) {
                    $gambarBaru = $this->upload->data('file_name');
                } else {
                    $error = $this->upload->display_errors();
                    //echo $error;
                    $gambarBaru = 'default.jpg'; //jika yang diupload melebihi kapasistas
                }
            } else {
                $gambarBaru = 'default.jpg'; // jika tidak ada gambar yg diupload
            }

            $data = [
                'user_email' => $email,
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'tempat_lahir' => htmlspecialchars($this->input->post('tempat_lahir', true)),
                'tgl_lahir' => $this->input->post('tgl_lahir'),
                'gender' => $this->input->post('gender'),
                'tingkatan' => $this->input->post('tingkatan'),
                'tb' => $this->input->post('tb'),
                'bb' => $this->input->post('bb'),
                'goldar' => $this->input->post('goldar'),
                'kolat' => $this->input->post('kolat'),
                'alamat' => $this->input->post('alamat'),
                'no_induk' => $this->input->post('no_induk'),
                'gambar' => $gambarBaru,
                'bayar' => 0,
                'kategori' => $this->input->post('kategori'),
                'jenis' => $this->input->post('jenis'),
                'kelas' => $this->input->post('kelas'),
            ];

            $this->User_model->tambahDataPeserta($data);
            $this->session->set_flashdata('pesan', 'ditambahkan');
            redirect('user');
        }
    }


    public function editPeserta($id)
    {
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();
        $data['peserta'] = $this->User_model->ambilDataPeserta($id);

        if ($data['peserta']['user_email'] == $email && $data['peserta']['id']  == $id) {

            $check = [
                'required' => 'harus diisi',
                'numeric' => 'isi dengan angka'
            ];
            $this->form_validation->set_message('check', 'harus diisi');

            $this->form_validation->set_rules('nama', 'Nama', 'trim|required', $check);
            $this->form_validation->set_rules('tempat_lahir', 'Tempat_lahir', 'trim|required', $check);
            $this->form_validation->set_rules('tgl_lahir', 'Tgl_lahir', 'trim|required|callback_check', $check);
            $this->form_validation->set_rules('kolat', 'Kolat', 'trim|required', $check);
            $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required', $check);
            $this->form_validation->set_rules('gender', 'Gender', 'trim|required|callback_check', $check);
            $this->form_validation->set_rules('tingkatan', 'Gender', 'trim|required|callback_check', $check);
            $this->form_validation->set_rules('tb', 'Tb', 'trim|required|numeric', $check);
            $this->form_validation->set_rules('bb', 'Bb', 'trim|required|numeric', $check);



            if ($this->form_validation->run() == false) {
                $data['title'] = "Edit Data Peserta";
                $this->load->view('templates/user_header', $data);
                $this->load->view('templates/user_sidebar', $data);
                $this->load->view('templates/user_topbar', $data);
                $this->load->view('user/editpeserta', $data);
                $this->load->view('templates/user_footer');
            } else {
                $upload_gambar = $_FILES['gambar']['name'];

                if ($upload_gambar) {
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['max_size']     = '2048';        // maks 1 Mb
                    $config['upload_path'] = './assets/img/profile/';

                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('gambar')) {
                        $gambarBaru = $this->upload->data('file_name');
                    } else {
                        $error = $this->upload->display_errors();
                        //echo $error;
                        $gambarBaru = 'default.jpg'; //jika yang diupload melebihi kapasistas
                    }
                } else {
                    $gambarBaru = 'default.jpg'; // jika tidak ada gambar yg diupload
                }

                $dataUpdate = [
                    'user_email' => $email,
                    'nama' => htmlspecialchars($this->input->post('nama', true)),
                    'tempat_lahir' => htmlspecialchars($this->input->post('tempat_lahir', true)),
                    'tgl_lahir' => $this->input->post('tgl_lahir'),
                    'gender' => $this->input->post('gender'),
                    'tingkatan' => $this->input->post('tingkatan'),
                    'tb' => $this->input->post('tb'),
                    'bb' => $this->input->post('bb'),
                    'goldar' => $this->input->post('goldar'),
                    'kolat' => $this->input->post('kolat'),
                    'alamat' => $this->input->post('alamat'),
                    'no_induk' => $this->input->post('no_induk'),
                    'gambar' => $gambarBaru,
                    'bayar' => 0,
                    'kategori' => $this->input->post('kategori'),
                    'jenis' => $this->input->post('jenis'),
                    'kelas' => $this->input->post('kelas'),
                ];

                $this->db->where('id', $id);
                $this->db->update('peserta', $dataUpdate);

                $this->session->set_flashdata('pesan', 'diubah');
                redirect('user');
            }
        } else {
            redirect('auth/blocked');
        }
    }


    public function hapusPeserta($id)
    {
        //$this->User_model->hapusDataPeserta($id);
        $this->session->set_flashdata('pesan', 'dihapus');
        redirect('user');
    }

    public function detail($id)
    {
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();
        $data['peserta'] = $this->User_model->ambilDataPeserta($id);

        $data['title'] = "Detail Data Peserta";
        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('user/detailPeserta', $data);
        $this->load->view('templates/user_footer');
    }



    public function check($post_string)
    {
        return $post_string == '0' ? FALSE : TRUE;
    }
}
