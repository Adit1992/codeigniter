<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Data Kota</h1>
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
            <h3 class="box-title"><b>Kota</b></h3>
            <button class="btn btn-info pull-right" onclick="tambah_kota()">Tambah</button>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="tabel_kota" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th style="width:10px">No.</th>
                <th>Provinsi</th>
                <th>Kota</th>
                <th>Aksi</th>
              </tr>
              </thead>
              <tbody>
              <?php $no = 1; foreach ($kota as $D) { ?>
                <tr>
                  <td><?= $no++."." ?></td>
                  <td><?= $D['NAMA_PROVINSI'] ?></td>
                  <td><?= $D['NAMA_KOTA'] ?></td>
                  <td>
                  	<button class="btn btn-sm btn-warning" onclick="edit_kota(<?= $D['ID_KOTA'] ?>)"><i class="glyphicon glyphicon-pencil"></i></button>
                  	<button class="btn btn-sm btn-danger" onclick="hapus_kota(<?= $D['ID_KOTA'] ?>)"><i class="glyphicon glyphicon-remove"></i></button>
                  </td>
                </tr>
              <?php } ?>
              </tbody>
              <tfoot>
              <tr>
                <th>No.</th>
                <th>Provinsi</th>
                <th>Kota</th>
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