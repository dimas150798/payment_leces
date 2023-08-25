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
                    <img src="<?php echo base_url(); ?>vendor/bootstrap-icons/icons/list.svg" alt="Bootstrap" ...> <b class="textmenuatas">Belum Lunas</b>
                </div>
                <div class="col-12 col-xl-auto mt-2">
                    <div class="container">
                        <div class="row">
                            <div class="col-6">
                                <a class="btn buttonmenuatas btn-sm" href="#"><img src="<?php echo base_url(); ?>vendor/bootstrap-icons/icons/file-excel-fill.svg" alt="Bootstrap" ...> Export Excel
                                </a>
                            </div>
                            <div class="col-6">
                                <select name="forma" id='SelectOption' class="form-control">
                                    <option value="day"><a href="#">Day</a></option>
                                    <option value="monthly"><a href="#">Monthly</a></option>
                                    <!-- <option value="custom_date"><a href="#">Custom Date</a></option> -->
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">

            <div class="row mt-3 mb-2">
                <form class="form-inline" action="<?php echo base_url('admin/BelumLunas/C_BelumLunas_Tanggal') ?>" method=" get">
                    <div class="row">

                        <div class="col-md-4">
                            <label for="start_date" class="form-label" style="font-weight: bold;">Pilih Tanggal : <span class="text-danger">*</span></label>
                            <input type="date" name="day" id="day" class="form-control" value="<?php if ($dayGET == '') {
                                                                                                    echo $day;
                                                                                                } else {
                                                                                                    echo $dayGET;
                                                                                                } ?>">
                        </div>

                        <div class="col-md-8 mt-auto justify-content-end d-flex">
                            <button type="submit" class="btn btn-info mt-2 justify-content-start"> <i class="fas fa-eye"></i>
                                Tampilkan</button>
                        </div>
                    </div>

                </form>
            </div>

            <div class="row">
                <div class="col-12 mt-3">
                    <div class="textPencarian">

                        <div class="row">
                            <div class="col-6">
                                <p class="dataPencarian">Data</p>
                            </div>
                            <div class="col-6">
                                <p class="dataPencarian">:
                                    <?php if ($dayGET == NULL) {
                                        echo changeDateFormat('d-m-Y', $day);
                                    } else {
                                        echo changeDateFormat('d-m-Y', $dayGET);
                                    } ?></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <p class="dataPencarian">Belum Lunas</p>
                            </div>
                            <div class="col-6">
                                <p class="dataPencarian">:
                                    <?php echo $JumlahBelumLunas; ?></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <p class="dataPencarian">Nominal</p>
                            </div>
                            <div class="col-6">

                                <p class="dataPencarian">: Rp.
                                    <?php echo number_format($NominalBelumLunas, 0, ',', '.') ?></p>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <h5 class="text-center font-weight-light mt-2 mb-2">
                        <?php echo $this->session->flashdata('pesan'); ?>
                    </h5>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h3><i class="fas fa-table me-1"></i>
                                Data Pelanggan
                            </h3>
                        </div>
                        <div class="card-body">
                            <table id="mytabledate" class="table table-bordered responsive nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="20%">Nama</th>
                                        <th width="20%">Name PPPOE</th>
                                        <th width="20%" class="text-center">Tanggal</th>
                                        <th width="20%" class="text-center">Paket</th>
                                        <th width="20%" class="text-center">Tarif</th>
                                        <th width="15%" class="text-center">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </main>