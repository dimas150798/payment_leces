<?php

class M_BelumLunasUser extends CI_Model
{

    // Menampilkan Data Belum Lunas
    public function BelumLunas($bulan, $tahun, $tanggalAkhir, $area_1, $area_2, $area_3, $area_4, $area_5)
    {
        $query   = $this->db->query("SELECT 
        data_customer.id_customer, data_customer.kode_customer, data_customer.phone_customer, data_customer.nama_customer, data_customer.nama_paket, 
        data_customer.name_pppoe, data_customer.password_pppoe, data_customer.id_pppoe, data_customer.alamat_customer, data_customer.email_customer, 
        DAY(data_customer.start_date) as tanggal, data_customer.stop_date, data_customer.nama_area, data_customer.deskripsi_customer, data_customer.nama_sales,
        data_pembayaran.order_id, data_pembayaran.gross_amount, data_pembayaran.biaya_admin, 
        data_pembayaran.nama_admin, data_pembayaran.keterangan, data_pembayaran.payment_type, data_pembayaran.transaction_time, data_pembayaran.expired_date,
        data_pembayaran.bank, data_pembayaran.va_number, data_pembayaran.permata_va_number, data_pembayaran.payment_code, data_pembayaran.bill_key, 
        data_pembayaran.biller_code, data_pembayaran.pdf_url, data_pembayaran.status_code, data_paket.nama_paket as namaPaket, data_paket.harga_paket

        FROM data_customer
        LEFT JOIN data_paket ON data_customer.nama_paket = data_paket.nama_paket
        LEFT JOIN data_pembayaran ON data_customer.name_pppoe = data_pembayaran.name_pppoe
        AND MONTH(data_pembayaran.transaction_time) = '$bulan' AND YEAR(data_pembayaran.transaction_time) = '$tahun'

        WHERE data_customer.start_date BETWEEN '2020-01-01' AND '$tanggalAkhir' AND
        data_pembayaran.transaction_time IS NULL AND data_customer.stop_date IS NULL AND
        data_customer.nama_area in ('$area_1', '$area_2', '$area_3', '$area_4', '$area_5')

        GROUP BY data_customer.name_pppoe
        ORDER BY data_customer.nama_customer ASC");

        return $query->result_array();
    }

    // Menampilkan Jumlah Belum Lunas
    public function JumlahBelumLunas($bulan, $tahun, $tanggalAkhir, $area_1, $area_2, $area_3, $area_4, $area_5)
    {
        $query   = $this->db->query("SELECT 
        data_customer.id_customer, data_customer.kode_customer, data_customer.phone_customer, data_customer.nama_customer, data_customer.nama_paket, 
        data_customer.name_pppoe, data_customer.password_pppoe, data_customer.id_pppoe, data_customer.alamat_customer, data_customer.email_customer, 
        data_customer.start_date, data_customer.stop_date, data_customer.nama_area, data_customer.deskripsi_customer, data_customer.nama_sales,
        data_pembayaran.order_id, data_pembayaran.gross_amount, data_pembayaran.biaya_admin, 
        data_pembayaran.nama_admin, data_pembayaran.keterangan, data_pembayaran.payment_type, data_pembayaran.transaction_time, data_pembayaran.expired_date,
        data_pembayaran.bank, data_pembayaran.va_number, data_pembayaran.permata_va_number, data_pembayaran.payment_code, data_pembayaran.bill_key, 
        data_pembayaran.biller_code, data_pembayaran.pdf_url, data_pembayaran.status_code, data_paket.nama_paket as namaPaket, data_paket.harga_paket

        FROM data_customer
        LEFT JOIN data_paket ON data_customer.nama_paket = data_paket.nama_paket
        LEFT JOIN data_pembayaran ON data_customer.name_pppoe = data_pembayaran.name_pppoe
        AND MONTH(data_pembayaran.transaction_time) = '$bulan' AND YEAR(data_pembayaran.transaction_time) = '$tahun'

        WHERE data_customer.start_date BETWEEN '2020-01-01' AND '$tanggalAkhir' AND
        data_pembayaran.transaction_time IS NULL AND data_customer.stop_date IS NULL AND
        data_customer.nama_area in ('$area_1', '$area_2', '$area_3', '$area_4', '$area_5')

        GROUP BY data_customer.name_pppoe
        ORDER BY DAY(data_customer.start_date) ASC");

        return $query->num_rows();
    }

    // Menampilkan Jumlah Nominal Belum Lunas
    public function NominalBelumLunas($bulan, $tahun, $tanggalAkhir, $area_1, $area_2, $area_3, $area_4, $area_5)
    {
        $result   = $this->db->query("SELECT 
        SUM(data_paket.harga_paket) AS hargaPaket

        FROM data_customer 
        LEFT JOIN data_paket ON data_customer.nama_paket = data_paket.nama_paket
        LEFT JOIN data_area ON data_customer.nama_area = data_area.nama_area
        LEFT JOIN data_pembayaran ON data_customer.name_pppoe = data_pembayaran.name_pppoe
        AND MONTH(data_pembayaran.transaction_time) = '$bulan' AND YEAR(data_pembayaran.transaction_time) = '$tahun'
        
        WHERE data_customer.start_date BETWEEN '2020-01-01' AND '$tanggalAkhir'
        AND data_pembayaran.transaction_time IS NULL AND  data_customer.stop_date IS NULL AND
        data_customer.nama_area in ('$area_1', '$area_2', '$area_3', '$area_4', '$area_5')");

        return $result->row();
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return false;
        }
    }

    // Invoice payment
    public function invoice()
    {
        $sql = "SELECT MAX(MID(order_id,8,4)) AS invoiceID 
        FROM data_pembayaran
        WHERE MID(order_id,4,4) = DATE_FORMAT(CURDATE(), '%y%m')";
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $dataRow    = $query->row();
            $dataN      = ((int)$dataRow->invoiceID) + 1;
            $no         = sprintf("%'.04d", $dataN);
        } else {
            $no         = "0001";
        }

        $invoice = "INT" . date('ym') . $no;
        return $invoice;
    }

    // Pembayaran Pelanggan
    public function Payment($id_customer)
    {
        $query   = $this->db->query("SELECT 
            data_customer.id_customer, data_customer.kode_customer, data_customer.phone_customer, data_customer.nama_customer, data_customer.nama_paket, 
            data_customer.name_pppoe, data_customer.password_pppoe, data_customer.id_pppoe, data_customer.alamat_customer, data_customer.email_customer, 
            DAY(data_customer.start_date) as tanggal, data_customer.stop_date, data_customer.nama_area, data_customer.deskripsi_customer, data_customer.nama_sales,
            data_pembayaran.order_id, data_pembayaran.gross_amount, data_pembayaran.biaya_admin, 
            data_pembayaran.nama_admin, data_pembayaran.keterangan, data_pembayaran.payment_type, data_pembayaran.transaction_time, data_pembayaran.expired_date,
            data_pembayaran.bank, data_pembayaran.va_number, data_pembayaran.permata_va_number, data_pembayaran.payment_code, data_pembayaran.bill_key, 
            data_pembayaran.biller_code, data_pembayaran.pdf_url, data_pembayaran.status_code, data_paket.nama_paket as namaPaket, data_paket.harga_paket

            FROM data_customer
            LEFT JOIN data_paket ON data_customer.nama_paket = data_paket.nama_paket
            LEFT JOIN data_pembayaran ON data_customer.name_pppoe = data_pembayaran.name_pppoe

            WHERE data_customer.id_customer = '$id_customer'
    
            GROUP BY data_customer.name_pppoe
            ORDER BY DAY(data_customer.start_date) ASC");

        return $query->result_array();
    }

    // Check duplicate pembayaran
    public function CheckDuplicatePayment($bulan, $tahun, $nama)
    {
        $this->db->select('name_pppoe, nama_paket, status_code, transaction_time, MONTH(transaction_time) as bulan_payment, YEAR(transaction_time) as tahun_payment');
        $this->db->where('MONTH(transaction_time)', $bulan);
        $this->db->where('YEAR(transaction_time)', $tahun);
        $this->db->where('name_pppoe', $nama);

        $this->db->limit(1);
        $result = $this->db->get('data_pembayaran');

        return $result->row();
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return false;
        }
    }

    // Check data code client
    public function CheckDuplicateCode($code_invoice)
    {
        $this->db->select('order_id, name_pppoe');
        $this->db->where('order_id', $code_invoice);

        $this->db->limit(1);
        $result = $this->db->get('data_pembayaran');

        return $result->row();
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return false;
        }
    }
}
