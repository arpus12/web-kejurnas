<?php
class Admin_model extends CI_Model
{

    public function dataPeserta()
    {
        $this->db->select('user.nama as nama_mgr, user.kontingen, user.email,peserta.id, peserta.nama, peserta.tempat_lahir, peserta.tgl_lahir, peserta.gender, peserta.tingkatan, peserta.tb, peserta.bb, peserta.goldar, peserta.kolat, peserta.alamat, peserta.no_induk, peserta.gambar, peserta.bayar, peserta.kategori, peserta.jenis, peserta.kelas');
        $this->db->from('user');
        $this->db->join('peserta', 'peserta.user_email = user.email');
        $this->db->order_by('user.kontingen', 'ASC');
        $this->db->order_by('jenis', 'DESC');
        $this->db->order_by('kategori', 'ASC');
        $this->db->order_by('Kelas', 'ASC');
        return $this->db->get()->result_array();
    }

    public function gantiBayar($id)
    {
        $query = $this->db->get_where('peserta', ['id' => $id])->row_array();
        if ($query['bayar'] == 1) {
            $this->db->set('bayar', 0);
            $this->db->where('id', $id);
            $this->db->update('peserta');
        } else {
            $this->db->set('bayar', 1);
            $this->db->where('id', $id);
            $this->db->update('peserta');
        }
    }

    public function daftarKontingen()
    {
        $query = $this->db->query('SELECT user_email, kontingen, kategori, COUNT( kontingen ) as jml FROM user JOIN peserta ON peserta.user_email = user.email GROUP BY kontingen, kategori');
        $Peserta =  $query->result_array();

        //var_dump($Peserta);
        //die;
        /*$query = $this->db->query('SELECT user.kontingen, COUNT( peserta.kategori ) as total FROM user JOIN peserta ON peserta.user_email = user.email GROUP BY user.kontingen');
        return $query->result_array(); */

        $dataBaru = array();
        $ch_user = "";
        $no = 0;
        foreach ($Peserta as $data) {
            if ($data['user_email'] == $ch_user) {
                $ch_user = $data['user_email'];
                if (in_array('Tanding', $data)) {
                    $dataBaru['data' . $no]['Tanding'] = $data['jml'];
                    continue;
                }
                if (in_array('Seni', $data)) {
                    $dataBaru['data' . $no]['Seni'] = $data['jml'];
                    continue;
                }
                if (in_array('Getaran', $data)) {
                    $dataBaru['data' . $no]['Getaran'] = $data['jml'];
                    continue;
                }
                if (in_array('Staga', $data)) {
                    $dataBaru['data' . $no]['Staga'] = $data['jml'];
                    continue;
                }
            } else {
                $no++;
                $ch_user = $data['user_email'];
                $dataBaru['data' . $no]['nama'] = $data['kontingen'];
                $dataBaru['data' . $no]['Tanding'] = 0;
                $dataBaru['data' . $no]['Seni'] = 0;
                $dataBaru['data' . $no]['Getaran'] = 0;
                $dataBaru['data' . $no]['Staga'] = 0;
                if (in_array('Tanding', $data)) {
                    $dataBaru['data' . $no]['Tanding'] = $data['jml'];
                    continue;
                }
                if (in_array('Seni', $data)) {
                    $dataBaru['data' . $no]['Seni'] = $data['jml'];
                    continue;
                }
                if (in_array('Getaran', $data)) {
                    $dataBaru['data' . $no]['Getaran'] = $data['jml'];
                    continue;
                }
                if (in_array('Staga', $data)) {
                    $dataBaru['data' . $no]['Staga'] = $data['jml'];
                    continue;
                }
            }
        }

        return $dataBaru;
    }
}
