<?php

class M_Pelanggan extends CI_Model
{
    // Menampilkan Data Pelanggan
    public function DataPelanggan()
    {
        $query   = $this->db->query("SELECT data_customer.id_customer, data_customer.kode_customer, data_customer.phone_customer, data_customer.nama_customer,
            data_customer.nama_paket, data_customer.name_pppoe, data_customer.password_pppoe, data_customer.id_pppoe, data_customer.nama_area, data_customer.nama_sales,
            data_customer.alamat_customer, data_customer.email_customer, data_customer.start_date, data_customer.stop_date, data_customer.deskripsi_customer,
            data_area.nama_area, data_sales.nama_sales, data_paket.nama_paket
            
            FROM data_customer
            
            LEFT JOIN data_area ON data_customer.nama_area = data_area.nama_area
            LEFT JOIN data_sales ON data_customer.nama_sales = data_sales.nama_sales
            LEFT JOIN data_paket ON data_customer.nama_paket = data_paket.nama_paket
            
            GROUP BY data_customer.name_pppoe
            ORDER BY data_customer.nama_customer ASC");

        return $query->result_array();
    }

    // Menampilkan Jumlah Pelanggan
    public function JumlahPelanggan()
    {
        $query   = $this->db->query("SELECT data_customer.id_customer, data_customer.kode_customer, data_customer.phone_customer, data_customer.nama_customer,
        data_customer.nama_paket, data_customer.name_pppoe, data_customer.password_pppoe, data_customer.id_pppoe, data_customer.nama_area, data_customer.nama_sales,
        data_customer.alamat_customer, data_customer.email_customer, data_customer.start_date, data_customer.stop_date, data_customer.deskripsi_customer,
        data_area.nama_area, data_sales.nama_sales, data_paket.nama_paket
        
        FROM data_customer
        
        LEFT JOIN data_area ON data_customer.nama_area = data_area.nama_area
        LEFT JOIN data_sales ON data_customer.nama_sales = data_sales.nama_sales
        LEFT JOIN data_paket ON data_customer.nama_paket = data_paket.nama_paket
        
        GROUP BY data_customer.name_pppoe
        ORDER BY data_customer.nama_customer ASC");

        return $query->num_rows();
    }

    // Menampilkan Jumlah Pelanggan
    public function JumlahPelangganAktif()
    {
        $query   = $this->db->query("SELECT data_customer.id_customer, data_customer.kode_customer, data_customer.phone_customer, data_customer.nama_customer,
            data_customer.nama_paket, data_customer.name_pppoe, data_customer.password_pppoe, data_customer.id_pppoe, data_customer.nama_area, data_customer.nama_sales,
            data_customer.alamat_customer, data_customer.email_customer, data_customer.start_date, data_customer.stop_date, data_customer.deskripsi_customer,
            data_area.nama_area, data_sales.nama_sales, data_paket.nama_paket
            
            FROM data_customer
            
            LEFT JOIN data_area ON data_customer.nama_area = data_area.nama_area
            LEFT JOIN data_sales ON data_customer.nama_sales = data_sales.nama_sales
            LEFT JOIN data_paket ON data_customer.nama_paket = data_paket.nama_paket

            WHERE data_customer.stop_date IS NULL
            
            GROUP BY data_customer.name_pppoe
            ORDER BY data_customer.nama_customer ASC");

        return $query->num_rows();
    }

    // Menampilkan Jumlah Pelanggan
    public function JumlahPelangganAktifMonth()
    {
        date_default_timezone_set("Asia/Jakarta");
        $bulan                      = date("m");
        $tahun                      = date("Y");

        $query   = $this->db->query("SELECT data_customer.id_customer, data_customer.kode_customer, data_customer.phone_customer, data_customer.nama_customer,
                data_customer.nama_paket, data_customer.name_pppoe, data_customer.password_pppoe, data_customer.id_pppoe, data_customer.nama_area, data_customer.nama_sales,
                data_customer.alamat_customer, data_customer.email_customer, data_customer.start_date, data_customer.stop_date, data_customer.deskripsi_customer,
                data_area.nama_area, data_sales.nama_sales, data_paket.nama_paket
                
                FROM data_customer
                
                LEFT JOIN data_area ON data_customer.nama_area = data_area.nama_area
                LEFT JOIN data_sales ON data_customer.nama_sales = data_sales.nama_sales
                LEFT JOIN data_paket ON data_customer.nama_paket = data_paket.nama_paket
    
                WHERE data_customer.stop_date IS NULL AND MONTH(data_customer.start_date) = '$bulan' AND YEAR(data_customer.start_date) = '$tahun'
                
                GROUP BY data_customer.name_pppoe
                ORDER BY data_customer.nama_customer ASC");

        return $query->num_rows();
    }

    // Edit Data Pelanggan
    public function EditPelanggan($id_customer)
    {
        $query   = $this->db->query("SELECT data_customer.id_customer, data_customer.kode_customer, data_customer.phone_customer, data_customer.nama_customer,
            data_customer.nama_paket, data_customer.name_pppoe, data_customer.password_pppoe, data_customer.id_pppoe, data_customer.nama_area, data_customer.nama_sales,
            data_customer.alamat_customer, data_customer.email_customer, data_customer.start_date, data_customer.stop_date, data_customer.deskripsi_customer,
            data_area.nama_area, data_sales.nama_sales, data_paket.nama_paket
            
            FROM data_customer
            
            LEFT JOIN data_area ON data_customer.nama_area = data_area.nama_area
            LEFT JOIN data_sales ON data_customer.nama_sales = data_sales.nama_sales
            LEFT JOIN data_paket ON data_customer.nama_paket = data_paket.nama_paket

            WHERE id_customer = '$id_customer'
            
            GROUP BY data_customer.name_pppoe
            ORDER BY data_customer.nama_customer ASC");

        return $query->result_array();
    }

    // Check data pelanggan
    public function CheckDuplicatePelanggan($Name_PPPOE)
    {
        $this->db->select('nama_customer, id_pppoe, name_pppoe');
        $this->db->where('name_pppoe', $Name_PPPOE);

        $this->db->limit(1);
        $result = $this->db->get('data_customer');

        return $result->row();
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return false;
        }
    }
}
