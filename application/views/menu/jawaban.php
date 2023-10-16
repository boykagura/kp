                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


 <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nama</th>
      <th scope="col">Pertanyaan</th>
      <th scope="col">Pilihan</th>
      <th scope="col">Lainnya</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
    <tbody>
    	<?php $i = 1?>
    		<tr>
    			<td scope="col"><?= $i++; ?></td>
    			<td></td>
          <td></td>
          <td></td>
          <td></td>
    			<td>
    				<a href="" class="badge badge-pill badge-success">Edit</a>
  			<a href=""class="badge badge-pill badge-danger">Delete</a>
        <a href=""class="badge badge-pill badge-warning">Detail</a>
    			</td>

    				
    		</tr>
   </tbody>
  </table>

            </div>
            <!-- End of Main Content -->

    
