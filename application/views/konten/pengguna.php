
<link href="<?= base_url('assets/plugins/datatables/dataTables.bootstrap.css') ?>" rel="stylesheet">


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Data Users</h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Data tables</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
      
        <?php if (!empty($this->session->flashdata('pesan'))) { ?>
          <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <b><i class="icon fa fa-check"></i> <?= $this->session->flashdata('pesan'); ?></b>
          </div>
        <?php } ?>
      
        <div class="box">
          <div class="box-header">
            <h3 class="box-title"><b>User</b></h3>
            <button class="btn btn-info pull-right" data-toggle="modal" data-target="#myModal">Tambah</button>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="tabel_pengguna" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th style="width:10px">No.</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Aksi</th>
              </tr>
              </thead>
              <tbody>
              <?php $no = 1; foreach ($pengguna as $D) { ?>
                <tr>
                  <td><?= $no++."." ?></td>
                  <td><?= $D['NAMA_PENGGUNA'] ?></td>
                  <td><?= $D['NAMA_LEVEL'] ?></td>
                  <td><button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#edit_<?= $D['ID_PENGGUNA'] ?>">Edit</button> <a href="<?= base_url('pengguna/hapus/'.$D['ID_PENGGUNA'].'/') ?>" onclick="return confirm('Apakah Anda yakin akan menghapus <?= $D['NAMA_PENGGUNA'] ?> ?')"><button class="btn btn-sm btn-danger">Delete</button></a></td>
                </tr>
              <?php } ?>
              </tbody>
              <tfoot>
              <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Jabata</th>
                <th>Aksi</th>
              </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
 
  <!-- Modal -->
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- konten modal-->
      <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Tambah Pengguna</h4>
        </div>
        <!-- body modal -->
        
        <!-- <form action="#" role="form" enctype="multipart/form-data" method="POST"> -->
        <?php echo form_open_multipart('pengguna/tambah');?>
          <div class="modal-body">
            <!-- text input -->
            <div class="form-group">
              <label>Nama</label>
              <input type="text" class="form-control" name="nama" pattern="[A-Z a-z]+" placeholder="Isikan nama lengkap Pengguna..." required>
            </div>
            <div class="form-group">
              <label>Jabatan</label>
              <select name="level" class="form-control" required x-moz-errormessage="Silahkan pilih kategori provinsi.">
                <option type hidden selected value="">- Pilih Jabatan -</option>
                <?php foreach ($level as $J) { ?>
                  <option value="<?= $J['ID_LEVEL']; ?>"><?= $J['NAMA_LEVEL']; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label>Sandi</label>
              <input type="password" class="form-control" name="sandi" placeholder="Isikan sandi Pengguna..." required>
            </div>
            <div class="form-group">
              <label>Foto</label>
              <input type="file" class="form-control" name="foto" accept="image/jpeg,image/jpg,image/png" required>
            </div>
          </div>
          <!-- footer modal -->
          <div class="modal-footer">
            <button type="submit" class="btn btn-info">Tambah</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <?php foreach ($pengguna as $O) { ?>
    <!-- Modal -->
    <div id="edit_<?= $O['ID_PENGGUNA'] ?>" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- konten modal-->
        <div class="modal-content">
          <!-- heading modal -->
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Perbarui Pengguna</h4>
          </div>
          <!-- body modal -->
          <form action="<?= base_url('pengguna/edit') ?>" role="form" method="POST">
            <div class="modal-body">
              <input type="hidden" name="id" value="<?= $O['ID_PENGGUNA'] ?>">
              <!-- text input -->
              <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control" name="nama" value="<?= $O['NAMA_PENGGUNA'] ?>" pattern="[A-z a-z]+" placeholder="Isikan nama Pengguna..." required>
              </div>
              <div class="form-group">
                <label>Jabatan</label>
                <select name="level" class="form-control" required x-moz-errormessage="Silahkan pilih kategori jabatan.">
                  <option type hidden selected value="">- Pilih Jabatan -</option>
                  <?php foreach ($level as $L) { ?>
                    <option value="<?= $L['ID_LEVEL']; ?>"<?php if ($L['ID_LEVEL']==$O['ID_LEVEL']) { echo 'selected'; } ?>><?= $L['NAMA_LEVEL']; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <label>Sandi</label>
                <input type="password" class="form-control" name="sandi" placeholder="Kosongkan jika tidak merubah sandi...">
              </div>
            </div>
            <!-- footer modal -->
            <div class="modal-footer">
              <button type="submit" class="btn btn-info">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  <?php } ?>

</div>


<?php $this->load->view('foot/javascript'); ?>


<script src="<?= base_url('assets/plugins/datatables/jquery.dataTables.min.js') ?>"></script>

<script src="<?= base_url('assets/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>

<?php if (empty($footer)) { ?>
  <script>
  $(function (){
    $('#tabel_pengguna').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true
    });
  });
  </script>
<?php } else { ?>
  <script>document.write("AAAAAAAAAAAAAAAAAAAAAAAAAAAAA");</script>
<?php } ?>