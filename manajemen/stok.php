<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Stok
      <small>Data Stok</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-12">
        <div class="box box-info">

          <div class="box-header">
            <h3 class="box-title">Data Akun Stok</h3>
            <div class="btn-group pull-right">            

              <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-plus"></i> &nbsp Tambah Stok
              </button>
            </div>
          </div>
          <div class="box-body">

            <!-- Modal -->
            <form action="stok_act.php" method="post">
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Tambah Stok</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">

                      <div class="form-group">
                        <label>Tanggal</label>
                        <input type="text" name="tanggal" required="required" class="form-control datepicker2">
                      </div>

                      <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" name="nama" required="required" class="form-control" placeholder="Nama Barang ..">
                      </div>                      

                      <div class="form-group">
                        <label>Kode Barang</label>
                        <input type="text" name="nomor" class="form-control" placeholder="Kode Barang ..">
                      </div>

                      <div class="form-group">
                        <label>Jumlah Barang</label>
                        <input type="number" name="jumlah" required="required" class="form-control" placeholder="Jumlah Barang ..">
                      </div>

                      <div class="form-group">
                        <label>Harga</label>
                        <input type="number" name="nominal" required="required" class="form-control" placeholder="Masukkan Nominal ..">
                      </div>

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                      <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>


            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                  <tr>
                    <th width="1%">NO</th>
                    <th>TANGGAL</th>                    
                    <th>NAMA BARANG</th>                    
                    <th>KODE BARANG</th>
                    <th>JUMLAH</th>
                    <th>HARGA</th>
                    <th width="10%">OPSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  include '../koneksi.php';
                  $no=1;
                  $data = mysqli_query($koneksi,"SELECT * FROM stok");
                  while($d = mysqli_fetch_array($data)){
                    ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo date('d-m-Y', strtotime($d['stok_tanggal'])); ?></td>
                      <td><?php echo $d['stok_nama']; ?></td>                      
                      <td><?php echo $d['stok_nomor']; ?></td>
                      <td><?php echo "".number_format($d['stok_jumlah'])." Pcs"; ?></td>
                      <td><?php echo "Rp. ".number_format($d['stok_nominal']); ?></td>
                                            
                      <td>    
                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_stok_<?php echo $d['stok_id'] ?>">
                          <i class="fa fa-cog"></i>
                        </button>

                        <?php 
                        if($d['stok_id'] != 1){
                          ?>
                          <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_stok_<?php echo $d['stok_id'] ?>">
                            <i class="fa fa-trash"></i>
                          </button>
                          <?php
                        }
                        ?>

                        <form action="stok_update.php" method="post">
                          <div class="modal fade" id="edit_stok_<?php echo $d['stok_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title" id="exampleModalLabel">Edit stok</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">

                                  <div class="form-group" style="width:100%;margin-bottom:20px">
                                    <label>Tanggal</label>
                                    <input type="hidden" name="id" value="<?php echo $d['stok_id'] ?>">
                                    <input type="text" style="width:100%" name="tanggal" required="required" class="form-control datepicker2" value="<?php echo $d['stok_tanggal'] ?>">
                                  </div> 

                                  <div class="form-group" style="margin-bottom:15px;width: 100%">
                                    <label>Nama Barang</label>
                                    <input type="hidden" name="id" required="required" class="form-control" placeholder="Nama barang .." value="<?php echo $d['stok_id']; ?>">
                                    <input type="text" name="nama" style="width:100%" required="required" class="form-control" placeholder="Nama barang .." value="<?php echo $d['stok_nama']; ?>">
                                  </div>                                  

                                  <div class="form-group" style="margin-bottom:15px;width: 100%">
                                    <label>Kode Barang</label>
                                    <input type="text" name="nomor" style="width:100%" class="form-control" placeholder="Kode barang .." value="<?php echo $d['stok_nomor']; ?>">
                                  </div>

                                  <div class="form-group" style="margin-bottom:15px;width: 100%">
                                    <label>Jumlah Stok</label>
                                    <input type="number" name="jumlah" style="width:100%" required="required" class="form-control" placeholder="Jumlah Barang .." value="<?php echo $d['stok_jumlah']; ?>">
                                  </div>

                                  <div class="form-group" style="width:100%;margin-bottom:20px">
                                    <label>Harga</label>
                                    <input type="number" style="width:100%" name="nominal" required="required" class="form-control" placeholder="Masukkan Nominal .." value="<?php echo $d['stok_nominal'] ?>">
                                  </div>

                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                  <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </form>

                        <!-- modal hapus -->
                        <div class="modal fade" id="hapus_stok_<?php echo $d['stok_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Peringatan!</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">

                                <p>Yakin ingin menghapus data ini ?</p>
                                <p>Semua data yang berhubungan dengan akun stok ini akan dipindah ke akun stok default.</p>

                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <a href="stok_hapus.php?id=<?php echo $d['stok_id'] ?>" class="btn btn-primary">Hapus</a>
                              </div>
                            </div>
                          </div>
                        </div>

                      </td>
                    </tr>
                    <?php 
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>

        </div>
      </section>
    </div>
  </section>

</div>
<?php include 'footer.php'; ?>