<?php
class User_model extends CI_Model
{

    public function userPeserta($email)
    {
        $this->db->where('user_email', $email);
        $this->db->order_by('jenis', 'ASC');
        $this->db->order_by('kategori', 'ASC');
        $this->db->order_by('kelas', 'ASC');
        return $this->db->get('peserta')->result_array();
    }

    public function hapusDataPeserta($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('peserta');
    }

    public function tambahDataPeserta($data)
    {
        $this->db->insert('peserta', $data);
    }

    public function ambilDataPeserta($id)
    {

        $this->db->where('id', $id);
        return $this->db->get('peserta')->row_array();
    }
}
