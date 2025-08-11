<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Barang
      <small>Data Barang</small>
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
            <h3 class="box-title">Barang Masuk & Keluar</h3>
            <div class="btn-group pull-right">            

              <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-plus"></i> &nbsp Tambah Barang
              </button>
            </div>
          </div>
          <div class="box-body">

            <!-- Modal -->
            <form action="barang_act.php" method="post">
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="exampleModalLabel">Tambah Barang</h4>
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
                        <label>Jenis</label>
                        <select name="jenis" class="form-control" required="required">
                          <option value="">- Pilih -</option>
                          <option value="masuk">Masuk</option>
                          <option value="keluar">Keluar</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label>Kategori</label>
                        <select name="kategori" class="form-control" required="required">
                          <option value="">- Pilih -</option>
                          <?php 
                          $kategori = mysqli_query($koneksi,"SELECT * FROM kategori ORDER BY kategori ASC");
                          while($k = mysqli_fetch_array($kategori)){
                            ?>
                            <option value="<?php echo $k['kategori_id']; ?>"><?php echo $k['kategori']; ?></option>
                            <?php 
                          }
                          ?>
                        </select>
                      </div>

                      <div class="form-group">
                        <label>Jumlah</label>
                        <input type="number" name="jumlah" required="required" class="form-control" placeholder="Masukkan Jumlah">
                      </div>

                      <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control" rows="3"></textarea>
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
                    <th width="1%" rowspan="2">NO</th>
                    <th width="10%" rowspan="2" class="text-center">TANGGAL</th>
                    <th rowspan="2" class="text-center">KATEGORI</th>
                    <th rowspan="2" class="text-center">KETERANGAN</th>
                    <th colspan="2" class="text-center">JENIS</th>
                    <th rowspan="2" width="10%" class="text-center">OPSI</th>
                  </tr>
                  <tr>
                    <th class="text-center">MASUK</th>
                    <th class="text-center">KELUAR</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  include '../koneksi.php';
                  $no=1;
                  $data = mysqli_query($koneksi,"SELECT * FROM barang,kategori where kategori_id=barang_kategori order by barang_id desc");
                  while($d = mysqli_fetch_array($data)){
                    ?>
                    <tr>
                      <td class="text-center"><?php echo $no++; ?></td>
                      <td class="text-center"><?php echo date('d-m-Y', strtotime($d['barang_tanggal'])); ?></td>
                      <td><?php echo $d['kategori']; ?></td>
                      <td><?php echo $d['barang_keterangan']; ?></td>
                      <td class="text-center">
                        <?php 
                        if($d['barang_jenis'] == "Masuk"){
                          echo " ".number_format($d['barang_jumlah'])." pcs";
                        }else{
                          echo "-";
                        }
                        ?>
                      </td>
                      <td class="text-center">
                        <?php 
                        if($d['barang_jenis'] == "Keluar"){
                          echo " ".number_format($d['barang_jumlah'])." pcs";
                        }else{
                          echo "-";
                        }
                        ?>
                      </td>
                      <td>    
                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_barang_<?php echo $d['barang_id'] ?>">
                          <i class="fa fa-cog"></i>
                        </button>

                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_barang_<?php echo $d['barang_id'] ?>">
                          <i class="fa fa-trash"></i>
                        </button>


                        <form action="barang_update.php" method="post">
                          <div class="modal fade" id="edit_barang_<?php echo $d['barang_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title" id="exampleModalLabel">Edit barang</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">

                                  <div class="form-group" style="width:100%;margin-bottom:20px">
                                    <label>Tanggal</label>
                                    <input type="hidden" name="id" value="<?php echo $d['barang_id'] ?>">
                                    <input type="text" style="width:100%" name="tanggal" required="required" class="form-control datepicker2" value="<?php echo $d['barang_tanggal'] ?>">
                                  </div>

                                  <div class="form-group" style="width:100%;margin-bottom:20px">
                                    <label>Jenis</label>
                                    <select name="jenis" style="width:100%" class="form-control" required="required">
                                      <option value="">- Pilih -</option>
                                      <option <?php if($d['barang_jenis'] == "masuk"){echo "selected='selected'";} ?> value="masuk">Masuk</option>
                                      <option <?php if($d['barang_jenis'] == "keluar"){echo "selected='selected'";} ?> value="keluar">Keluar</option>
                                    </select>
                                  </div>

                                  <div class="form-group" style="width:100%;margin-bottom:20px">
                                    <label>Kategori</label>
                                    <select name="kategori" style="width:100%" class="form-control" required="required">
                                      <option value="">- Pilih -</option>
                                      <?php 
                                      $kategori = mysqli_query($koneksi,"SELECT * FROM kategori ORDER BY kategori ASC");
                                      while($k = mysqli_fetch_array($kategori)){
                                        ?>
                                        <option <?php if($d['barang_kategori'] == $k['kategori_id']){echo "selected='selected'";} ?> value="<?php echo $k['kategori_id']; ?>"><?php echo $k['kategori']; ?></option>
                                        <?php 
                                      }
                                      ?>
                                    </select>
                                  </div>

                                  <div class="form-group" style="width:100%;margin-bottom:20px">
                                    <label>Jumlah</label>
                                    <input type="number" style="width:100%" name="nominal" required="required" class="form-control" placeholder="Masukkan Nominal .." value="<?php echo $d['barang_jumlah'] ?>">
                                  </div>

                                  <div class="form-group" style="width:100%;margin-bottom:20px">
                                    <label>Keterangan</label>
                                    <textarea name="keterangan" style="width:100%" class="form-control" rows="4"><?php echo $d['barang_keterangan'] ?></textarea>
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
                        <div class="modal fade" id="hapus_barang_<?php echo $d['barang_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title" id="exampleModalLabel">Peringatan!</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">

                                <p>Yakin ingin menghapus data ini ?</p>

                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <a href="barang_hapus.php?id=<?php echo $d['barang_id'] ?>" class="btn btn-primary">Hapus</a>
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