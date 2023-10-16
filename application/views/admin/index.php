                <!-- Begin Page Content -->
                <div class="container-fluid">


                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
                    <div class="row">
                      <div class="col-lg-6">
                        <?= form_error('menu','<div class="alert alert-danger" role="alert">', '</div>');  ?>
                        <?= $this->session->flashdata('message'); ?>


 <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nama</th>
      <th scope="col">Email</th>
      <th scope="col">Image</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
    <tbody>
      <?php $i = 1?>
      <?php foreach($data_admin as $da) : ?>
        <tr>
          <td scope="col"><?= $i++; ?></td>
          <td><?=$da['name'] ?></td>
          <td><?=$da['email'] ?></td>
          <td><?=$da['image'] ?></td>
          <td>
            <a href="" class="badge badge-pill badge-success">Edit</a>
        <a href="<?=base_url('admin/deleteuser/').$da['id']; ?>" onclick =" return confirm('anda yakin ingin menghapus data')"class="badge badge-pill badge-danger">Delete</a>
          </td>

            
        </tr>
         <?php endforeach; ?>
   </tbody>
  </table>







            </div>
          </div>
        </div>
            <!-- End of Main Content -->

    
