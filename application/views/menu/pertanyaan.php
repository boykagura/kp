<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
  <div class="row">
    <div class="col-md-12">
      <?= form_error('menu','<div class="alert alert-danger" role="alert">', '</div>');  ?>
      <?= $this->session->flashdata('message'); ?>
      <a href="" class="btn btn-primary mb-3"  data-toggle="modal" data-target="#newMenuModal"><i class="fa fa-fw fa-plus"></i>
      Pertanyaan</a>
      <table class="table table-striped table-hover" style="width: 100%">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Pertanyaan</th>
            <th scope="col">Kategori</th>
            <th scope="col" width="20%">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1?>
          <?php foreach($data_pertanyaan as $dp) : ?>
          <tr>
            <td scope="col"><?= $i++; ?></td>
            <td><?=$dp['pertanyaan']; ?></td>
            <td><?=$dp['kategori']; ?></td>
            <td>
              <a href="<?=base_url ('menu/indexedit/'. $dp['id']) ?>" class="badge badge-pill badge-success">Edit</a>
              <a href="<?=base_url('menu/deletepertanyaan/').$dp['id']; ?>"onclick =" return confirm('anda yakin ingin menghapus data')" class="badge badge-pill badge-danger">Delete</a>
              <a href="<?= base_url('menu/pilihan/'. $dp['id']) ?>" class="badge badge-pill badge-warning">Detail</a>
            </td>
            
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- End of Main Content -->
<!-- Isi Modal -->
<div class="modal fade" id="newMenuModal" tabindex="-1" role="dialog" aria-labelledby="newMenuModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newMenuModalLabel">Tambah Pertanyaan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('menu/tambahPertanyaan'); ?>" method = 'post'>
        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control" id="menu" name="pertanyaan" placeholder="Pertanyaan">
          </div>
          <div class="form-group">
            <select class="form-control" name="id_kategori">
                <option>Pilih Kategori Pertanyaan</option>
              <?php foreach($kategori as $kt): ?>
                <option value="<?= $kt['id'] ?>"><?= $kt['kategori'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add</button>
        </div>
      </form>
    </div>
  </div>
</div>