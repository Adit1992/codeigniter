
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js" type="text/javascript"></script>
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
            <button class="btn btn-info pull-right" onclick="tambah_pengguna()">Tambah</button>
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
                  <td>
                    <button class="btn btn-sm btn-warning" onclick="edit_pengguna(<?= $D['ID_PENGGUNA'] ?>)"><i class="glyphicon glyphicon-pencil"></i></button>
                    <button class="btn btn-sm btn-danger" onclick="hapus_pengguna(<?= $D['ID_PENGGUNA'] ?>)"><i class="glyphicon glyphicon-remove"></i></button>
                  </td>
                </tr>
              <?php } ?>
              </tbody>
              <tfoot>
              <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Jabatan</th>
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


<?php $this->load->view('foot/javascript'); ?>


<script src="<?= base_url('assets/plugins/datatables/jquery.dataTables.min.js') ?>"></script>

<script src="<?= base_url('assets/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>

<!-- page script -->
<script>
$(document).ready(function() {
  $('#tabel_pengguna').DataTable({
    "paging": true,
    "lengthChange": true,
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": true
  });
});

$("#save").click(function(){
  var data = new FormData();
  $.each($("#foto")[0].files,function(i,file){
    data.append("foto",file);
  })

  $.ajax({
    url: "<?php echo site_url('index.php/pengguna_ajax/tambah/'); ?>",
    type: 'post',
    dataType: 'json',
    resetForm: true,
    beforeSubmit: function() {
      $('#modal_form').html('Submitting...');
    },
    success: function(data) {
      if(data.status){
        //if success close modal and reload ajax table
        $('#modal_form').modal('hide');
        location.reload();// for reload a page
      } else {
        alert('Error deleting data !');
      }
    }
  });
})



var save_method;

function tambah_pengguna()
{
  $('#form')[0].reset();
  $('#modal_form').modal('show');
  $('.modal-title').text('Tambah Pengguna'); // Set title to Bootstrap modal title
}

function edit_pengguna(id)
{
  save_method = 'perbarui';
  $('#form')[0].reset(); // reset form on modals

  //Ajax Load data from ajax
  $.ajax({
    url : "<?php echo site_url('index.php/provinsi/edit') ?>/" + id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
        $('[name="id_pengguna"]').val(data.ID_PENGGUNA);
        $('[name="nama"]').val(data.NAMA_PENGGUNA);

        $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
        $('.modal-title').text('Edit Pengguna'); // Set title to Bootstrap modal title
    },
    error: function (jqXHR, textStatus, errorThrown)
    {
        alert('Error get data from ajax !!!');
    }
  });
}

function save()
{
  var url;
  if (save_method == 'tambah')
  {
    url = "<?php echo site_url('index.php/pengguna_ajax/tambah/') ?>";
  }
  else if (save_method == 'perbarui')
  {
    url = "<?php echo site_url('index.php/pengguna_ajax/simpan_edit/') ?>";
  }
  
  // ajax adding data to database
  // $.ajax({
  //     url : url,
  //     type: "POST",
  //     dataType: "JSON",
  //     fileElementId: "foto",
  //     data: $('#form').serialize(),
  //     success: function(data)
  //     {
  //       //if success close modal and reload ajax table
  //       $('#modal_form').modal('hide');
  //       location.reload();// for reload a page
  //     },
  //     error: function (jqXHR, textStatus, errorThrown)
  //     {
  //         alert('Error adding / update data');
  //     }
  // });
}

function hapus_pengguna(id)
{
  if(confirm('Are you sure delete this data ?'))
  {
    // ajax delete data from database
    $.ajax({
      url : "<?= site_url('index.php/pengguna_ajax/hapus')?>/"+id,
      type: "POST",
      dataType: "JSON",
      fileElementId: "foto",
      success: function(data, json)
      {
        location.reload();
      },
      error: function (jqXHR, textStatus, errorThrown)
      {
        alert('Error deleting data !');
      }
    });
  }
}
</script>

<!-- Modal -->
<div id="modal_form" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- konten modal-->
    <div class="modal-content">
      <!-- heading modal -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Provinsi</h4>
      </div>
      <form id="form" method="POST" enctype="multipart/form-data">
        <!-- body modal -->
        <div class="modal-body form">
          <input type="hidden" value="" name="id_pengguna">
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
            <input type="file" class="form-control" id="foto" name="foto" accept="image/jpeg,image/jpg,image/png" required>
          </div>
        </div>
        <!-- footer modal -->
        <div class="modal-footer">
          <button id="save" class="btn btn-info">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>