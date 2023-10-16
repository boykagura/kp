                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


                    <div class="row">
                    	<div class="col-lg-8">
                    		<form action="<?php echo site_url('menu/pilihanEdit/') .$pilihan['id']; ?>" method="post">
                    		<div class="form-group row">
    <label for="email" class="col-sm-2 col-form-label">Pilihan</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="pilihan" name="pilihan" value="<?= $pilihan['pilihan']; ?>">
      <?= form_error('pilihan','<small class="text-danger pl-3">','</small>'); ?>
    </div>
  </div>
  <div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label">Id Pertanyaan</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="id_pertanyaan" name="id_pertanyaan" value="<?= $pilihan['id_pertanyaan']; ?>">
       <?= form_error('id_pertanyaan','<small class="text-danger pl-3">','</small>'); ?>
    </div>
     <div class="form-check col-sm-12 col-lg-2">
      <div class="col-sm-8">
  <input class="form-check-input" type="checkbox" name="lainnya" id="lainnya">
  <label class="form-check-label" for="lainnya">
    Lainnya
  </label>
  </div>
  </div>

<div class="form-group row justify-content-end">
	<div class="col-sm-10">
		<button type="submit" class="btn btn-primary">Edit</button>
	</div>
</div>
  </form>


                    		</form>
                    	</div>
                    </div>


                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

    
