<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Data Perusahaan</h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Tables</a></li>
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
            <button class="btn btn-info pull-right" onclick="tambah_perusahaan()">Tambah</button>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="tabel_perusahaan" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th style="width:10px">No.</th>
                <th>Nama Perusahaan</th>
                <th>Badan Hukum</th>
                <th>Telepon</th>
                <th>Email</th>
                <th>Aksi</th>
              </tr>
              </thead>
              <tbody>
              <?php $no = 1; foreach ($data as $D) { ?>
                <tr>
                  <td><?= $no++."." ?></td>
                  <td><?= $D['NAMA_PERUSAHAAN'] ?></td>
                  <td><?= $D['BADAN_PERUSAHAAN'] ?></td>
                  <td><?= $D['TELEPON_PERUSAHAAN'] ?></td>
                  <td><?= $D['EMAIL_PERUSAHAAN'] ?></td>
                  <td>
                    <button class="btn btn-sm btn-warning" onclick="edit_perusahaan(<?= $D['ID_PERUSAHAAN'] ?>)"><i class="glyphicon glyphicon-pencil"></i></button>
                    <button class="btn btn-sm btn-danger" onclick="hapus_perusahaan(<?= $D['ID_PERUSAHAAN'] ?>)"><i class="glyphicon glyphicon-remove"></i></button>
                  </td>
                </tr>
              <?php } ?>
              </tbody>
              <tfoot>
              <tr>
                <th>No.</th>
                <th>Nama Perusahaan</th>
                <th>Badan Hukum</th>
                <th>Telepon</th>
                <th>Email</th>
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
</div>