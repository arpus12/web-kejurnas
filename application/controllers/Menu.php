<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_login();

        $this->load->library('form_validation');
    }

    public function index()
    {
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();

        $data['title'] = "Profile Kotingen";
        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('user/profile', $data);
        $this->load->view('templates/user_footer');
    }


    public function editprofile()
    {
        $check = [
            'required' => 'harus diisi',
            'numeric' => 'isi dengan angka'
        ];

        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();

        $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
        $this->form_validation->set_rules('kontingen', 'Kontingen', 'trim|required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
        $this->form_validation->set_rules('no_hp', 'No_hp', 'trim|required|numeric');

        if ($this->form_validation->run() == false) {
            $data['title'] = "Perbarui Profile";
            $this->load->view('templates/user_header', $data);
            $this->load->view('templates/user_sidebar', $data);
            $this->load->view('templates/user_topbar', $data);
            $this->load->view('user/editprofile', $data);
            $this->load->view('templates/user_footer');
        } else {
            $newNama = $this->input->post('nama');
            $newKontingen = $this->input->post('kontingen');
            $newAlamat = $this->input->post('alamat');
            $newHp = $this->input->post('no_hp');

            $upload_gambar = $_FILES['gambar']['name'];
            if ($upload_gambar) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']     = '526';        // maks 500 kb
                $config['upload_path'] = './assets/img/profile/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('gambar')) {
                    $gambarLama = $data['user']['gambar'];
                    if ($gambarLama != 'default.jpg') {
                        unlink(FCPATH, 'assets/img/profile' . $gambarLama);
                    }

                    $gambarBaru = $this->upload->data('file_name');
                    $this->db->set('gambar', $gambarBaru);
                } else {
                    $error = $this->upload->display_errors();
                }
            }

            $this->db->set('nama', $newNama);
            $this->db->set('kontingen', $newKontingen);
            $this->db->set('alamat', $newAlamat);
            $this->db->set('no_hp', $newHp);

            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"> Profile berhasil diperbarui !</div>');
            redirect('user/editprofile');
        }
    }




    public function gantipassword()
    {
        $check = [
            'required' => 'harus diisi',
            'matches' => 'password tidak sama',
            'min_length' => 'password minimal 6 karakter'
        ];

        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();


        $this->form_validation->set_rules('password0', 'Password', 'trim|required', $check);
        $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[6]|matches[password2]', $check);
        $this->form_validation->set_rules('password2', 'Password', 'trim|required|matches[password1]', $check);

        if ($this->form_validation->run() == false) {
            $data['title'] = "Ganti Password";
            $this->load->view('templates/user_header', $data);
            $this->load->view('templates/user_sidebar', $data);
            $this->load->view('templates/user_topbar', $data);
            $this->load->view('user/gantipassword', $data);
            $this->load->view('templates/user_footer');
        } else {
            $passLama = $this->input->post('password0');
            $passBaru = $this->input->post('password1');
            $pass = $data['user']['password']; // pass di tabel

            if (!password_verify($passLama, $pass)) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert"> Password yang ada masukkan tidak sesuai !</div>');
                redirect('user/gantipassword');
            } else {
                if ($passLama == $passBaru) {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert"> Password baru tidak boleh sama dengan password lama !</div>');
                    redirect('user/gantipassword');
                } else {
                    $passBaruHash = password_hash($passBaru, PASSWORD_DEFAULT);

                    $this->db->set('password', $passBaruHash);
                    $this->db->where('email', $email);
                    $this->db->update('user');

                    $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"> Password berhasil diganti !</div>');
                    redirect('user/gantipassword');
                }
            }
        }
    }



    public function check($post_string)
    {
        return $post_string == '0' ? FALSE : TRUE;
    }
}
