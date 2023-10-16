<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
  <div class="row">
    <div class="col-lg-6">
      <?= form_error('menu','<div class="alert alert-danger" role="alert">', '</div>');  ?>
      <?= $this->session->flashdata('message'); ?>
      <a href="" class="btn btn-primary mb-3"  data-toggle="modal" data-target="#newMenuModal"><i class="fa fa-fw fa-plus"></i>
      Tambah Pilihan Baru</a>
      <table class="table table-striped table-hover" style="width: 100%">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Pilihan</th>
            <th scope="col">Lainnya</th>
            <th scope="col">Pertanyaan</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1?>
          <?php foreach($data_pilihan as $dpi) : ?>
          <tr>
            <td scope="col"><?= $i++; ?></td>
            <td><?=$dpi['pilihan']; ?></td>
            <td><?=$dpi['lainnya'] ?></td>
            <td><?=$dpi['id_pertanyaan'] ?></td>
            <td>
              <a href="<?=base_url("menu/indexpilihan/" .$dpi['id']); ?>" class="badge badge-pill badge-success">Edit</a>
              <a href="<?=base_url('menu/deletepilihan/'.$dpi['id'].'/'.$dpi['id_pertanyaan']); ?>"onclick =" return confirm('anda yakin ingin menghapus data')" class="badge badge-pill badge-danger">Delete</a>
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
        <h5 class="modal-title" id="newMenuModalLabel">Tambah Pilihan Baru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
     
      <form action="<?= base_url('menu/addPilihan'); ?>" method = 'post'>
        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control" id="pilihan" name="pilihan" placeholder="Pilihan">
          </div>    
          <div class="form-group">
            <input type="text" class="form-control" id="id_pertanyaan" name="id_pertanyaan" value="<?=$pertanyaan['id']; ?>" readonly>
          </div>
          <div class="form-check">
  <input class="form-check-input" type="checkbox" name="lainnya" id="lainnya">
  <label class="form-check-label" for="lainnya">
    Lainnya
  </label>
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