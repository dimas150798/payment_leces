<div id="layoutSidenav_content">
    <main>

        <div class="menuatas">
            <div class="row align-items-center justify-content-between">
                <div class="col-xl-6">
                    <i class="fa fa-list"></i> <b class="textmenuatas">Tambah Mikrotik</b>
                </div>
                <div class="col-12 col-xl-auto mt-2">
                    <a class="btn bg-danger text-white" href="<?php echo base_url('superadmin/DataMikrotik/C_DataMikrotik') ?>"><img src="<?php echo base_url(); ?>vendor/bootstrap-icons/icons/backspace-fill.svg" alt="Bootstrap" ...> Kembali
                    </a>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="card mb-3 mt-3">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Data Mikrotik
                </div>
                <div class="card-body">
                    <div class="container">

                        <form method="POST" action="<?php echo base_url('superadmin/DataMikrotik/C_TambahMikrotik/TambahMikrotikSave') ?>">

                            <div class="row mt-3">
                                <div class="col-sm-4">
                                    <label for="ip_mikrotik" class="form-label" style="font-weight: bold;"> IP Mikrotik : <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="ip_mikrotik" value="" placeholder="Masukkan ip mikrotik...">
                                    <div class="bg-danger">
                                        <small class="text-white"><?php echo form_error('ip_mikrotik'); ?></small>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label for="username_mikrotik" class="form-label" style="font-weight: bold;"> Username Mikrotik: <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="username_mikrotik" id="username_mikrotik" value="" placeholder="Masukkan username...">
                                    <div class="bg-danger">
                                        <small class="text-white"><?php echo form_error('username_mikrotik'); ?></small>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label for="password_mikrotik" class="form-label" style="font-weight: bold;"> Password Mikrotik: <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="password_mikrotik" id="password_mikrotik" value="" placeholder="Masukkan username...">
                                    <div class="bg-danger">
                                        <small class="text-white"><?php echo form_error('password_mikrotik'); ?></small>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-sm-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-success mt-2 justify-content-end"><i class="bi bi-plus-circle"></i> Simpan</button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>

    </main>