<?php
$months = array(1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember');

if (!function_exists('changeDateFormat')) {
    function changeDateFormat($format = 'd-m-Y', $givenDate = null)
    {
        return date($format, strtotime($givenDate));
    }
}

?>

<div id="layoutSidenav_content">
    <main>

        <div class="menuatas">
            <div class="row align-items-center justify-content-between">
                <div class="col-xl-6">
                    <i class="fa fa-list"></i> <b class="textmenuatas">Kirim Tagihan</b>
                </div>
                <div class="col-12 col-xl-auto mt-2">
                    <a class="btn bg-danger text-white" onclick="history.back()"><img src="<?php echo base_url(); ?>vendor/bootstrap-icons/icons/backspace-fill.svg" alt="Bootstrap" ...> Kembali
                    </a>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="card mb-3 mt-3">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Data Pelanggan
                </div>
                <div class="card-body">
                    <div class="container">
                        <?php foreach ($DataPelanggan as $data) : ?>
                            <form method="POST" action="<?php echo base_url('admin/JatuhTempo/C_WA_TagihanJatuhTempo/KirimWAAksi') ?>">
                                <div class="row">
                                    <input type="hidden" class="form-control" name="id_customer" value=" <?php echo $data['id_customer'] ?>" readonly>
                                    <input type="hidden" class="form-control" name="nama_paket" value=" <?php echo $data['nama_paket'] ?>" readonly>
                                    <input type="hidden" class="form-control" name="harga_paket" value=" <?php echo $data['harga_paket'] ?>" readonly>
                                    <input type="hidden" class="form-control" name="tanggal_penagihan" value=" <?php echo changeDateFormat('d', $data['start_date']) ?>" readonly>
                                    <input type="hidden" class="form-control" name="tahun_penagihan" value=" <?php echo date("Y"); ?>" readonly>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4 mt-3">
                                        <label for="nama_customer" class="form-label" style="font-weight: bold;"> Nama Customer : <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="nama_customer" value="<?php echo $data['nama_customer'] ?>" placeholder="Data Kosong" readonly>
                                    </div>
                                    <div class="col-sm-4 mt-3">
                                        <label for="nama_pppoe" class="form-label" style="font-weight: bold;"> Name PPPOE : <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="name_pppoe" value="<?php echo $data['name_pppoe'] ?>" placeholder="Data Kosong" readonly>
                                    </div>
                                    <div class="col-sm-4 mt-3">
                                        <label for="kode_pelanggan" class="form-label" style="font-weight: bold;"> Kode Pelanggan : <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="kode_pelanggan" value="<?php echo $data['kode_pelanggan'] ?>" placeholder="Data Kosong" readonly>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-4 mt-3">
                                        <label for="bulan_penagihan" class="form-label" style="font-weight: bold;"> Penagihan Bulan : <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="bulan_penagihan" value="<?php
                                                                                                                echo $months[(int)$this->session->userdata('bulanSession')];
                                                                                                                ?>" placeholder="Data Kosong" readonly>
                                    </div>
                                    <div class="col-sm-4 mt-3">
                                        <label for="phone_customer" class="form-label" style="font-weight: bold;"> No Telephon : <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="phone_customer" value="<?php echo $data['phone_customer'] ?>" placeholder="Data Kosong" readonly>
                                    </div>
                                    <div class="col-sm-4 mt-3">
                                        <label for="" class="form-label" style="font-weight: bold;"> Paket : <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="" value="<?php echo $data['nama_paket'] ?> / Rp.  <?php echo number_format($data['harga_paket'], 0, ',', '.') ?>" placeholder="Data Kosong" readonly>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-sm-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-success mt-2 justify-content-end"><img src="<?php echo base_url(); ?>vendor/bootstrap-icons/icons/whatsapp.svg" alt="Bootstrap" ...> Kirim</button>
                                    </div>
                                </div>

                            </form>
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>
        </div>

    </main>