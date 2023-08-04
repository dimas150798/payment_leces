<?php

defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('changeDateFormat')) {
    function changeDateFormat($format = 'd-m-Y', $givenDate = null)
    {
        return date($format, strtotime($givenDate));
    }
}

class C_PayJatuhTempo extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('email') == null) {

            // Notifikasi Login Terlebih Dahulu
            $this->session->set_flashdata('BelumLogin_icon', 'error');
            $this->session->set_flashdata('BelumLogin_title', 'Login Terlebih Dahulu');

            redirect('C_FormLogin');
        }
    }

    public function PaymentJatuhTempo($id_customer)
    {
        $data['DataPelanggan']  = $this->M_JatuhTempo->Payment($id_customer);

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebarAdmin', $data);
        $this->load->view('admin/JatuhTempo/V_PayJatuhTempo', $data);
        $this->load->view('template/V_FooterJatuhTempo', $data);
    }

    public function PaymentSave()
    {
        // Mengambil data post pada view
        $id_pppoe               = $this->input->post('id_pppoe');
        $id_customer            = $this->input->post('id_customer');
        $nama_paket             = $this->input->post('nama_paket');
        $gross_amount           = $this->input->post('gross_amount');
        $order_id               = $this->input->post('order_id');
        $name_pppoe             = $this->input->post('name_pppoe');
        $biaya_admin            = $this->input->post('biaya_admin');
        $transaction_time       = $this->input->post('transaction_time');
        $nama_admin             = $this->input->post('nama_admin');
        $keterangan             = $this->input->post('keterangan');

        $explode = explode("-", $transaction_time);
        echo $explode[0]; //untuk tahun
        echo $explode[1]; //untuk bulan
        echo $explode[2]; //untuk tanggal

        // Menyimpan data payment ke dalam array
        $dataPayment = array(
            'order_id'          => $order_id,
            'gross_amount'      => $gross_amount,
            'biaya_admin'       => $biaya_admin,
            'name_pppoe'        => $name_pppoe,
            'nama_paket'        => $nama_paket,
            'nama_admin'        => $nama_admin,
            'keterangan'        => $keterangan,
            'transaction_time'  => $transaction_time,
            'expired_date'      => $transaction_time,
            'status_code'       => 200,
        );

        // Memanggil mysql dari model
        $data['DataPelanggan']  = $this->M_JatuhTempo->Payment($id_customer);
        $checkDuplicatePay      = $this->M_JatuhTempo->CheckDuplicatePayment($explode[1], $explode[0], $name_pppoe);

        // Rules form validation
        $this->form_validation->set_rules('biaya_admin', 'Biaya Admin', 'required');
        $this->form_validation->set_rules('transaction_time', 'Tanggal Transaksi', 'required');
        $this->form_validation->set_rules('nama_admin', 'Nama Admin', 'required');
        $this->form_validation->set_message('required', 'Masukan data terlebih dahulu...');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebarAdmin', $data);
            $this->load->view('admin/JatuhTempo/V_PayJatuhTempo', $data);
            $this->load->view('template/V_FooterJatuhTempo', $data);
        } else {
            if ($checkDuplicatePay->bulan_payment == $explode[1] && $checkDuplicatePay->tahun_payment == $explode[0] && $checkDuplicatePay->name_pppoe == $name_pppoe) {
                // Notifikasi duplicate payment
                $this->session->set_flashdata('DuplicatePay_icon', 'error');
                $this->session->set_flashdata('DuplicatePay_title', 'Payment Gagal');
                $this->session->set_flashdata('DuplicatePay_text', 'Customer sudah melakukan <br> Pembayaran bulan ini');

                echo "
                <script>history.go(-1);            
                </script>
                ";
            } else {
                // Notifikasi Login Berhasil
                $this->session->set_flashdata('payment_icon', 'success');
                $this->session->set_flashdata('payment_title', 'Pembayaran An. <b>' . $name_pppoe . '</b> Berhasil');

                $this->M_CRUD->insertData($dataPayment, 'data_pembayaran');
                $this->M_CRUD->insertData($dataPayment, 'data_pembayaran_history');
                redirect('admin/JatuhTempo/C_DataJatuhTempo');
            }
        }
    }
}
