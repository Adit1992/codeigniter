<table id="tabel_provinsi" class="table table-bordered table-hover">
  <thead>
  <tr>
    <th style="width:10px">No.</th>
    <th>Provinsi</th>
    <th>Aksi</th>
  </tr>
  </thead>
  <tbody>
  <?php $no = 1; foreach ($data as $D) { ?>
    <tr>
      <td><?= $no++."." ?></td>
      <td><?= $D['NAMA_PROVINSI'] ?></td>
      <td>
      	<button class="btn btn-sm btn-warning" onclick="edit_provinsi(<?= $D['ID_PROVINSI'] ?>)"><i class="glyphicon glyphicon-pencil"></i></button>
      	<button class="btn btn-sm btn-danger" onclick="hapus_provinsi(<?= $D['ID_PROVINSI'] ?>)"><i class="glyphicon glyphicon-remove"></i></button>
      </td>
    </tr>
  <?php } ?>
  </tbody>
  <tfoot>
  <tr>
    <th>No.</th>
    <th>Provinsi</th>
    <th>Aksi</th>
  </tr>
  </tfoot>
</table>