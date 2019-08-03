<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }



    public function index()  // methood login
    {
        if ($this->session->userdata('email')) {
            redirect('menu');
        }

        $check = [
            'required' => 'harus diisi',
            'valid_email' => 'format email tidak valid',
        ];

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', $check);
        $this->form_validation->set_rules('password', 'Password', 'trim|required', $check);

        if ($this->form_validation->run() == false) {
            $data['title'] = "Login";
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            //validasi sukses & jalankan function login
            $this->_login();
        }
    }



    public function registrasi()
    {
        if ($this->session->userdata('email')) {
            redirect('menu');
        }

        $check = [
            'required' => 'harus diisi',
            'valid_email' => 'format email tidak valid',
            'is_unique' => 'email sudah terdaftar',
            'matches' => 'password tidak sama',
            'min_length' => 'password minimal 6 karakter'
        ];

        $this->form_validation->set_rules('nama', 'Nama', 'trim|required', $check);
        $this->form_validation->set_rules('kontingen', 'Kontingen', 'trim|required', $check);
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required', $check);
        $this->form_validation->set_rules('no_hp', 'No_hp', 'trim|required', $check);
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[user.email]', $check);
        $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[6]|matches[password2]', $check);
        $this->form_validation->set_rules('password2', 'Password', 'trim|required|matches[password1]', $check);

        if ($this->form_validation->run() == false) {
            $data['title'] = "Registrasi";
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registrasi');
            $this->load->view('templates/auth_footer');
        } else {
            $data = [
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'gambar' => 'default.jpg',
                'status' => htmlspecialchars($this->input->post('status', true)),
                'kontingen' => htmlspecialchars($this->input->post('kontingen', true)),
                'alamat' => htmlspecialchars($this->input->post('alamat', true)),
                'no_hp' => htmlspecialchars($this->input->post('no_hp', true)),
                'tanggal' => time(),
                'role_id' => 2,
                'is_active' => 1
            ];

            $this->db->insert('user', $data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"> Selamat! Akun anda berhasil terdaftar. Silahkan Login</div>');
            redirect('auth');
        }
    }




    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"> Anda telah keluar dari halaman akun</div>');
        redirect('auth');
    }


    public function blocked()
    {
        $data['title'] = "Halaman tidak ditemukan";
        $this->load->view('auth/blocked', $data);
    }




    /* Method private untuk fungsi login*/
    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        //jika user ada
        if ($user) {

            //jika user aktif
            if ($user['is_active'] == 1) {

                //jika password sesuai
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {
                        redirect('admin');
                    } else {
                        redirect('user');
                    }
                } else {

                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert"> Password salah </div>');
                    redirect('auth');
                }
            } else {

                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert"> Akun belum aktif. Silahkan aktifasi terlebih dahulu !!!</div>');
                redirect('auth');
            }
        } else {

            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert"> Email tidak terdaftar</div>');
            redirect('auth');
        }
    }
}
