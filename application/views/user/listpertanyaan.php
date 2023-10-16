                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

                    <div class="row">
                      <div class="col-lg-8">
                        <?= $this->session->flashdata('message');?>
                      </div>
                    </div>

                    <div class="card mb-3 col-lg-12" >
  
 

  <?php $dataKategori = $this->db->query("SELECT * FROM tbl_kategori")->result_array(); ?>
  <?php foreach($dataKategori as $dK): ?>
    <?php $i=1; ?>
    <?= $dK['kategori']; ?> <br>
  <?php $dataPertanyaan = $this->db->get_where('tbl_pertanyaan', ['id_kategori' => $dK['id']])->result_array(); ?>
  <?php foreach($dataPertanyaan as $dP): ?>
    <?= $i.' '.$dP['pertanyaan']; ?> <br>
  <?php $dataPilihan = $this->db->get_where('tbl_pilihan', ['id_pertanyaan' => $dP['id']])->result_array(); ?>
  <?php foreach($dataPilihan as $dPi): ?>
    <?php if($dPi['lainnya'] == 0){ ?>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="PI<?=$dK['id'].$dP['id']?>" id="<?=$dK['id'].$dP['id'] ?>" value="option2">
        <label class="form-check-label" for="<?= $dK['id'].$dP['id'] ?>">
          <?= $dPi['pilihan'] ?> , <?= $dK['id'].$dP['id'] ?>
        </label>
      </div>  
    <?php }else{ ?>
      <?= $dPi['pilihan'] ?><textarea></textarea> <br><br>
    <?php } ?>
  <?php endforeach; ?>
  <?php $i++; ?>
  <?php endforeach ?>  
  <?php endforeach; ?>





</div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

    
