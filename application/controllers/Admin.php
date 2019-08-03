<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_login();

        $this->load->model('Admin_model');
    }

    public function index()
    {
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();

        $data['peserta'] = $this->Admin_model->dataPeserta();

        $data['title'] = "Administrator";
        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/user_footer');
    }

    public function kontingen()
    {
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();

        $data['kontingen'] = $this->Admin_model->daftarKontingen();
        //var_dump($data['kontingen']);
        //die;

        $data['title'] = "Administrator";
        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('admin/daftarKontingen', $data);
        $this->load->view('templates/user_footer');
    }

    public function cekBayar($id)
    {
        $this->Admin_model->gantiBayar($id);
        $this->session->set_flashdata('pesan', 'diubah');
        redirect('admin');
    }


    public function unduh_data()
    {
        $data['peserta'] = $this->Admin_model->dataPeserta();

        require(APPPATH . 'libraries\PHPExcel\Classes\PHPExcel.php');
        require(APPPATH . 'libraries\PHPExcel\Classes\PHPExcel\Writer\Excel2007.php');

        $objExcel = new PHPExcel();

        $objExcel->getProperties()->setCreator('MPUB');
        $objExcel->getProperties()->setLastModifiedBy('MPUB');
        $objExcel->getProperties()->setTitle('Data Peserta Kejurnas');
        $objExcel->getProperties()->setSubject('');
        $objExcel->getProperties()->setDescription('');

        $objExcel->setActiveSheetIndex(0);

        $objExcel->getActiveSheet()->setCellValue('A1', 'No');
        $objExcel->getActiveSheet()->setCellValue('B1', 'Kontingen');
        $objExcel->getActiveSheet()->setCellValue('C1', 'Nama Manager');
        $objExcel->getActiveSheet()->setCellValue('D1', 'Nama Atlit');
        $objExcel->getActiveSheet()->setCellValue('E1', 'Tempat Lahir');
        $objExcel->getActiveSheet()->setCellValue('F1', 'Tgl Lahir');
        $objExcel->getActiveSheet()->setCellValue('G1', 'Tingkatan MP');
        $objExcel->getActiveSheet()->setCellValue('H1', 'Tinggi Badan');
        $objExcel->getActiveSheet()->setCellValue('I1', 'Berat Badan');
        $objExcel->getActiveSheet()->setCellValue('J1', 'Golongan Darah');
        $objExcel->getActiveSheet()->setCellValue('K1', 'Kolat');
        $objExcel->getActiveSheet()->setCellValue('L1', 'Alamat');
        $objExcel->getActiveSheet()->setCellValue('M1', 'No Induk');
        $objExcel->getActiveSheet()->setCellValue('N1', 'Pembayaran');
        $objExcel->getActiveSheet()->setCellValue('O1', 'Jenis Kelamin');
        $objExcel->getActiveSheet()->setCellValue('P1', 'Kategori');
        $objExcel->getActiveSheet()->setCellValue('Q1', 'Sub Kategori');
        $objExcel->getActiveSheet()->setCellValue('R1', 'Kelas');

        $baris = 2;
        $no = 1;

        foreach ($data['peserta'] as $data) {
            /* Ubah data Pembayaran*/
            if ($data['bayar'] == 1) {
                $data['bayar'] = 'Sudah Bayar';
            } else {
                $data['bayar'] = 'Belum Bayar';
            }
            /* Ubah data Jenis Kelamin*/
            if ($data['gender'] == 'P') {
                $data['gender'] = 'Perempuan';
            } else {
                $data['gender'] = 'Laki-laki';
            }
            /* Ubah data Golongon darah yang kosong*/
            if ($data['goldar'] == '0') {
                $data['goldar'] = 'Null';
            }

            $objExcel->getActiveSheet()->setCellValue('A' . $baris, $no);
            $objExcel->getActiveSheet()->setCellValue('B' . $baris, $data['kontingen']);
            $objExcel->getActiveSheet()->setCellValue('C' . $baris, $data['nama_mgr']);
            $objExcel->getActiveSheet()->setCellValue('D' . $baris, $data['nama']);
            $objExcel->getActiveSheet()->setCellValue('E' . $baris, $data['tempat_lahir']);
            $objExcel->getActiveSheet()->setCellValue('F' . $baris, $data['tgl_lahir']);
            $objExcel->getActiveSheet()->setCellValue('G' . $baris, $data['tingkatan']);
            $objExcel->getActiveSheet()->setCellValue('H' . $baris, $data['tb']);
            $objExcel->getActiveSheet()->setCellValue('I' . $baris, $data['bb']);
            $objExcel->getActiveSheet()->setCellValue('J' . $baris, $data['goldar']);
            $objExcel->getActiveSheet()->setCellValue('K' . $baris, $data['kolat']);
            $objExcel->getActiveSheet()->setCellValue('L' . $baris, $data['alamat']);
            $objExcel->getActiveSheet()->setCellValue('M' . $baris, $data['no_induk']);
            $objExcel->getActiveSheet()->setCellValue('N' . $baris, $data['bayar']);
            $objExcel->getActiveSheet()->setCellValue('O' . $baris, $data['gender']);
            $objExcel->getActiveSheet()->setCellValue('P' . $baris, $data['kategori']);
            $objExcel->getActiveSheet()->setCellValue('Q' . $baris, $data['jenis']);
            $objExcel->getActiveSheet()->setCellValue('R' . $baris, $data['kelas']);

            $no++;
            $baris++;
        }

        $filename = 'Data Peserta Kejurnas ' . date('d-m-Y H:i:s') . '.xlsx';
        $objExcel->getActiveSheet()->setTitle('Data Peserta Kejurnas');

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheet.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age-0');

        $writer = PHPExcel_IOFactory::createWriter($objExcel, 'Excel2007');
        $writer->save('php://output');
        exit;
    }


    public function report()
    {
        //koding
    }

    public function notificationPopup() {
        // notif here
    }

    public function jancok () {
        $jancok = 'jancok kon';
    }
}
