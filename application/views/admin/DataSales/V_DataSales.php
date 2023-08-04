<div id="layoutSidenav_content">
    <main>

        <div class="menuatas">
            <div class="row align-items-center justify-content-between">
                <div class="col-xl-6">
                    <i class="fa fa-list"></i> <b class="textmenuatas">Data Sales</b>
                </div>
                <div class="col-12 col-xl-auto mt-2">
                    <a class="btn buttonmenuatas" href="<?php echo base_url(); ?>admin/DataSales/C_TambahSales"><img src="<?php echo base_url(); ?>vendor/bootstrap-icons/icons/plus-circle.svg" alt="Bootstrap" ...> Tambah Data Akses
                    </a>
                </div>
            </div>
        </div>

        <div class="container-fluid">

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
                            <i class="fas fa-table me-1"></i>
                            Data Sales
                        </div>
                        <div class="card-body">
                            <table id="mytable" class="table table-bordered responsive nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="30%">Nama</th>
                                        <th width="30%" class="text-center">Telephone</th>
                                        <th width="30%" class="text-center">Jabatan</th>
                                        <th width="5%" class="text-center">Opsi</th>
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