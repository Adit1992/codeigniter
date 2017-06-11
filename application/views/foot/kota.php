  <div class="control-sidebar-bg"></div>
</div>
<!-- Mainly scripts -->
<script src="<?= base_url('assets/plugins/jQuery/jquery-2.2.3.min.js') ?>"></script>

<script src="<?= base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>

<script src="<?= base_url('assets/plugins/datatables/jquery.dataTables.min.js') ?>"></script>

<script src="<?= base_url('assets/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>

<script src="<?= base_url('assets/plugins/slimScroll/jquery.slimscroll.min.js') ?>"></script>

<script src="<?= base_url('assets/plugins/fastclick/fastclick.js') ?>"></script>

<script src="<?= base_url('assets/dist/js/app.min.js') ?>"></script>

<script src="<?= base_url('assets/dist/js/demo.js') ?>"></script>

<!-- page script -->
<script>
$(document).ready(function() {
  $('#tabel_kota').DataTable({
    "paging": true,
    "lengthChange": true,
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": true
  });
});

var save_method;

function tambah_kota()
{
  save_method = 'tambah';
  $('#form')[0].reset();
  $('#modal_form').modal('show');
  $('.modal-title').text('Tambah Kota'); // Set title to Bootstrap modal title
}

function edit_kota(id)
{
  save_method = 'perbarui';
  $('#form')[0].reset(); // reset form on modals

  //Ajax Load data from ajax
  $.ajax({
    url : "<?php echo site_url('index.php/kota/edit') ?>/" + id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
        $('[name="id_kota"]').val(data.ID_KOTA);
        $('[name="nama"]').val(data.NAMA_KOTA);
        $('[name="provinsi"]').val(data.ID_PROVINSI);

        $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
        $('.modal-title').text('Edit Kota'); // Set title to Bootstrap modal title
    },
    error: function (jqXHR, textStatus, errorThrown)
    {
        alert('Pengambilan data dari AJAX bermasalah !!!');
    }
  });
}

function save()
{
  var url;
  if (save_method == 'tambah')
  {
    url = "<?php echo site_url('index.php/kota/tambah/') ?>";
  }
  else if (save_method == 'perbarui')
  {
    url = "<?php echo site_url('index.php/kota/simpan_edit/') ?>";
  }
    if (form.provinsi.value == "")
    {
      alert("Provinsi wajib di isi !!!");
      form.provinsi.focus();
      return (false);
    }
    else if (form.nama.value == "")
    {
      alert("Kota wajib di isi !!!");
      form.nama.focus();
      return (false);
    }
   // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data)
        {
          //if success close modal and reload ajax table
          $('#modal_form').modal('hide');
          location.reload();// for reload a page
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Data gagal disimpan, pastikan seluruh data telah terisi !!!');
        }
    });
}

function hapus_kota(id)
{
  if(confirm('Are you sure delete this data ?'))
  {
    // ajax delete data from database
    $.ajax({
      url : "<?= site_url('index.php/kota/hapus')?>/"+id,
      type: "POST",
      dataType: "JSON",
      success: function(data)
      {
        location.reload();
      },
      error: function (jqXHR, textStatus, errorThrown)
      {
        alert('Hapus data gagal !!!');
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
        <h4 class="modal-title">Tambah Kota</h4>
      </div>
      <!-- body modal -->
      <div class="modal-body form">
        <form id="form">
          <input type="hidden" value="" name="id_kota">
          <!-- text input -->
          <div class="form-group">
            <label>Provinsi</label>
            <select name="provinsi" class="form-control" required x-moz-errormessage="Silahkan pilih kategori provinsi.">
              <option type hidden selected value="">- Pilih Provinsi -</option>
              <?php foreach ($provinsi as $P) { ?>
                <option value="<?= $P['ID_PROVINSI']; ?>"<?php if ($P['ID_PROVINSI']=='provinsi') { echo 'selected'; } ?>><?= $P['NAMA_PROVINSI']; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label>Kota</label>
            <input type="text" class="form-control" name="nama" pattern="[A-z a-z]+" placeholder="Isikan nama Kota..." required>
          </div>
        </form>
      </div>
      <!-- footer modal -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-info" onclick="save()">Simpan</button>
      </div>
    </div>
  </div>
</div>

</body>
</html>