<?php

class M_Paket extends CI_Model
{
    // Menampilkan Data Paket
    public function DataPaket()
    {
        $query = $this->db->query("SELECT id_paket, nama_paket, harga_paket, deskripsi_paket
                FROM data_paket
                ORDER BY id_paket ASC");

        return $query->result_array();
    }

    // Edit Paket
    public function EditPaket($id_paket)
    {
        $query = $this->db->query("SELECT id_paket, nama_paket, harga_paket, deskripsi_paket
        FROM data_paket

        WHERE id_paket = '$id_paket'
        ORDER BY id_paket ASC");

        return $query->result_array();
    }

    // Check data paket
    public function CheckDuplicatePaket($nama_paket)
    {
        $this->db->select('nama_paket, id_paket, harga_paket');
        $this->db->where('nama_paket', $nama_paket);

        $this->db->limit(1);
        $result = $this->db->get('data_paket');

        return $result->row();
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return false;
        }
    }
}
