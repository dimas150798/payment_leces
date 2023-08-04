<?php

defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('changeDateFormat')) {
    function changeDateFormat($format = 'd-m-Y', $givenDate = null)
    {
        return date($format, strtotime($givenDate));
    }
}

class C_DataJatuhTempo extends CI_Controller
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

    public function index()
    {
        // clear session login
        $this->session->unset_userdata('LoginBerhasil_icon');

        date_default_timezone_set("Asia/Jakarta");
        $toDay = date('Y-m-d');

        // Memisahkan Tanggal
        $pecahDay       = explode("-", $toDay);

        $tahun          = $pecahDay[0];
        $bulan          = $pecahDay[1];
        $tanggal        = $pecahDay[2];

        // Menyimpan Dalam Session
        $this->session->set_userdata('bulanSession', $bulan);
        $this->session->set_userdata('tahunSession', $tahun);
        $this->session->set_userdata('TanggalSession', $tanggal);

        // Menampilkan tanggal pada awal bulan
        $tanggal_awal     = date("01");
        // Menampilkan tanggal pada akhir bulan
        $tanggal_akhir    = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
        // Menggabungkan bulan dan tahun
        $TanggalAwal      = $tahun . '-' . $bulan . '-' . $tanggal_awal;
        $TanggalAkhir     = $tahun . '-' . $bulan . '-' . $tanggal_akhir;

        // Memanggil mysql dari model
        $data['JatuhTempo']         = $this->M_JatuhTempo->JatuhTempo($TanggalAwal, $TanggalAkhir, $tanggal);
        $data['JumlahJatuhTempo']   = $this->M_JatuhTempo->JumlahJatuhTempo($TanggalAwal, $TanggalAkhir, $tanggal);
        $NominalJatuhTempo          = $this->M_JatuhTempo->NominalJatuhTempo($TanggalAwal, $TanggalAkhir, $tanggal);

        $data['tanggal']            = $tanggal;
        $data['bulan']              = $bulan;
        $data['tahun']              = $tahun;

        $data['NominalJatuhTempo']  = $NominalJatuhTempo->hargaPaket;

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebarAdmin', $data);
        $this->load->view('admin/JatuhTempo/V_DataJatuhTempo', $data);
        $this->load->view('template/V_FooterJatuhTempo', $data);
    }

    public function GetJatuhTempo()
    {
        date_default_timezone_set("Asia/Jakarta");
        $toDay = date('Y-m-d');

        // Memisahkan Tanggal
        $pecahDay       = explode("-", $toDay);

        $tahun          = $pecahDay[0];
        $bulan          = $pecahDay[1];
        $tanggal        = $pecahDay[2];

        // Menampilkan tanggal pada awal bulan
        $tanggal_awal     = date("01");
        // Menampilkan tanggal pada akhir bulan
        $tanggal_akhir    = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
        // Menggabungkan bulan dan tahun
        $TanggalAwal      = $tahun . '-' . $bulan . '-' . $tanggal_awal;
        $TanggalAkhir     = $tahun . '-' . $bulan . '-' . $tanggal_akhir;

        $result        = $this->M_JatuhTempo->JatuhTempo($TanggalAwal, $TanggalAkhir, $tanggal);

        $no = 0;

        foreach ($result as $dataCustomer) {
            $GrossAmount = $dataCustomer['gross_amount'] == NULL;

            $row = array();
            $row[] = ++$no;
            $row[] = $dataCustomer['name_pppoe'];
            $row[] = '<div class="text-center">' . ($GrossAmount ? 'Penagihan Tanggal ' . $dataCustomer['tanggal'] : changeDateFormat('d-m-Y / H:i:s', $dataCustomer['transaction_time'])) . '</div>';
            $row[] = '<div class="text-center">' . $dataCustomer['namaPaket'] . '</div>';
            $row[] = '<div class="text-center">' . 'Rp. ' . number_format($dataCustomer['harga_paket'], 0, ',', '.') . '</div>';
            $row[] = '<div class="text-center">' . ($GrossAmount ? '<span class="badge bg-danger">BELUM LUNAS</span>' : changeDateFormat('d-m-Y / H:i:s', $dataCustomer['transaction_time'])) . '</div>';
            $row[] =
                '<div class="text-center">
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-info dropdown-toggle" data-bs-toggle="dropdown" data-bs-target="#dropdown" aria-expanded="false" aria-controls="dropdown">
                        Opsi
                    </button>
                    <div class="dropdown-menu text-black" style="background-color:aqua;">
                        <a onclick="PaymentJatuhTempo(' . $dataCustomer['id_customer'] . ')"class="dropdown-item text-black"></i> Lunasi Pelanggan</a>
                        <a onclick="KirimWAJatuhTempo(' . $dataCustomer['id_customer'] . ')"class="dropdown-item text-black"></i> Kirim Tagihan</a>
                    </div>
                </div>
                </div>';
            $data[] = $row;
        }

        $ouput = array(
            'data' => $data
        );

        $this->output->set_content_type('application/json')->set_output(json_encode($ouput));
    }
}
