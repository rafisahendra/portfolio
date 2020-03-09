  <!-- Main content -->
  <section class="content">
  	<div class="row">
  		<div class="col-12">


  			<div class="card">
  				<div class="card-header">
  					<h3 class="card-title">Kategori</h3>
  				</div>


  				<!-- /.card-header -->
  				<div class="card-body">
  					<button type="button" class="btn btn-info btn-sm" style="margin-bottom:10px" data-toggle="modal"
  						data-target="#addKategori" onClick="submit('tambah')">Tambah Data</button>
  					<table id="example1" class="table table-bordered table-striped">
  						<thead>
  							<tr>
  								<th width="6%">Exs</th>
  								<th>No</th>
  								<th>Nama Kategori</th>
  							</tr>
  						</thead>
  						<tbody id="target">
  						</tbody>
  					</table>
  				</div>
  				<!-- /.card-body -->
  			</div>
  			<!-- /.card -->
  		</div>
  		<!-- /.col -->
  	</div>
  	<!-- /.row -->
  </section>
  <!-- /.content -->


  <!-- Modal -->
  <div class="modal fade" id="addKategori" tabindex="-1" role="dialog" aria-labelledby="addKategoriLabel"
  	aria-hidden="true">
  	<div class="modal-dialog modal-lg" role="document">
  		<div class="modal-content">
  			<div class="modal-header">
  				<h5 class="modal-title" id="addKategoriLabel">Tambah Kategori</h5>
  				
  				<button id="btn-resetx" onClick="resetKategori() " type="button" class="close" data-dismiss="modal"
  					aria-label="Close">
  					<span aria-hidden="true">&times;</span>
  				</button>
  			</div>




  			<div class="modal-body">
			  <button id="tambah_kategori" class="btn btn-info btn-sm pull-right">ADD+1</button>
			<form id="submit_kategori">
  				<div class="row">
  					<div class="col-md-4">
  						<div class="form-group">
  							<p for="">Logo / Barand </p>
  							<input type="file" name="logo_kategori[]" class="form-control">
  							<h6 class="text-red" id="pesan"></h6>
  						</div>
  					</div>
  					<div class="col-md-6">
  						<div class="form-group">
  							<p for="">Nama Kategori </p>
  							<input type="hidden" name="idk">
  							<input type="text" name="nama_kategori[]" class="form-control"
  								placeholder="Nama kategori .....">
  							<h6 class="text-red" id="pesan"></h6>
  						</div>
  					</div>
					  <div class="col-md-2">
				<div class="form-group">
				<button type="button"  class="btn btn-danger btn-remove btn-sm"  style="margin-top:43px" >O</button>
            </div>
  					</div>
  				</div>

  				<div id="tambah_inputan"></div>

  			</div>
  			<div class="modal-footer">
  				<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"
  					id="btn-reset">Batal</button>
  				<!-- onClick="tambahData()" -->
  				<button type="button" id="btn-tambah" class="btn btn-primary btn-sm">Simpan
  				</button>
  			
  				</button>
  				<button type="button" id="btn-edit" onClick="editData()" class="btn btn-primary btn-sm">Update
  				</button>
  			</div>
  			</form>
  		</div>
  	</div>
  </div>
  <script type="text/javascript">
  	$(document).ready(function () {
  		var next = 1;

  		var app = {
  			addRow: function () {
  				next++;
  				$("#tambah_inputan").append(`<div id="rowNumber${next}" class="row" >
          <div class="col-md-4">
  						<div class="form-group">
  							<p for="">Logo / Brand </p>
  							<input type="file" name="logo_kategori[]" class="form-control">
  							<h6 class="text-red" id="pesan"></h6>
  						</div>
  					</div>
  					<div class="col-md-6">
  						<div class="form-group">
  							<p for="">Nama Kategori </p>
  							<input type="hidden" name="idk">
  							<input type="text" name="nama_kategori[]" class="form-control" placeholder="Nama Kategori .....">
  							<h6 class="text-red" id="pesan"></h6>
              </div>
              </div>
              <div class="col-md-2">
              <div class="form-group">
              <button type="button" id="${next}" class="btn btn-danger btn-remove btn-sm"  style="margin-top:43px" >X</button>
            </div>
  					</div>
  				</div>
          `);



  			},
  			remove: function () {
  				var idBtn = $(this).attr("id");
  				$("#rowNumber" + idBtn + "").remove()

  			},
  			insertData: function (e) {
  				e.preventDefault()
				$.ajax({
				type: "POST",
				data: $('#submit_kategori').serialize(),
				url: "<?= base_url('index.php/Home/add_kategori'); ?>",
				dataType: 'json',
				success: function (hasil) {
					//  console.log(hasil);   
					$('#pesan').html(hasil.pesanboss)
					if (hasil >= 1) {
						$('#addKategori').modal('hide');
						ambilDataKategori();
						resetKategori();
						

					}

				}
				});
  			}

  		} //Batas var app


  		$("#tambah_kategori").on("click", app.addRow)
  		$(document).on("click", ".btn-remove", app.remove)
  		$("#btn-tambah").on("click", app.insertData)

  		var rest = {
  			restx: function () {
  				resetKategori();
  			}
  		} //batas rest

  		$("#btn-resetx").on("click", rest.restx)
  		$("#btn-reset").on("click", rest.restx)



  	}) //Batas document ready

  	function resetKategori() {
  		$("[name='nama_kategori[]']").val('');
  		$("[name='logo_kategori[]']").val('');
  		$("#jumlah-fm").val('1');
  		$('#pesan').html('');
		  $("#tambah_inputan").html(""); 
  	}

  </script>


  <!-- ============================= Untuk Kategori ================================== -->
  <script type="text/javascript">
  	$(document).ready(function () {
  		ambilDataKategori();
  	});

  	function ambilDataKategori() {
  		$.ajax({
  			type: "post",
  			url: "<?php echo base_url('index.php/Home/ambil_kategori');  ?>",
  			dataType: "json",
  			success: function (data) {
  				// console.log(data);   
  				var baris = '';
  				for (var i = 0; i < data.length; i++) {
  					baris += '<tr>' +
  						'<td>' +
  						'<a href="#" onClick="hapusKategori(' + data[i].kategori_id +
  						')"> <span class="fas fa-trash text-info"></span> </a>' +
  						'<a href="#addKategori" data-toggle="modal"> <span class="fas fa-edit text-warning" onClick="submit(' +
  						data[i].kategori_id + ')"></span> </a>' +
  						'</td>' +
  						'<td>' + (i + 1) + '</td>' +
  						'<td>' + data[i].kategori_nama + '</td>' +

  						'</tr>';
  				}

  				$('#target').html(baris);

  			}
  		});
  	}


  	// function tambahData() {

  		//var nmkat = $("[name='nama_kategori[]']").val(); //Get Elemet ByNames
  		// var nmkat = $('#nama_kategori').val(); //Get Elemet ById
  		// $.ajax({
  		// 	type: "POST",
  		// 	data: $('#submit_kategori').serialize(),
  		// 	url: "<?= base_url('index.php/Home/add_kategori'); ?>",
  		// 	dataType: 'json',
  		// 	success: function (hasil) {
  		// 		 console.log(hasil);   
  		// 		$('#pesan').html(hasil.pesanboss)
  		// 		if (hasil >= 1) {
  		// 			$('#addKategori').modal('hide');
  		// 			ambilDataKategori();
  		// 			resetKategori();

  		// 		}

  		// 	}
  		// });
  	// }



  	function submit(nilai) {
  		if (nilai == 'tambah') {

  			$('#addKategoriLabel').html('Tambah Data Kategori ');
  			$('#btn-tambah').show();
  			$('#btn-edit').hide();
  		} else {
  			$('#addKategoriLabel').html('Edit Data Kategori');
  			$('#btn-edit').show();
  			$('#btn-tambah').hide();

  			$.ajax({
  				type: "POST",
  				data: 'idk=' + nilai,
  				url: "<?= base_url('index.php/Home/edd_kategori'); ?>",
  				dataType: 'json',
  				success: function (request) {
  					// console.log(request);

  					$('#nama_kategori').val(request[0].kategori_nama);
  					$('[name="idk"]').val(request[0].kategori_id);
  				}
  			});

  		}

  	}


  	function editData() {

  		var idkat = $('[name="idk"]').val(); //Get value dari form
  		var nmkat = $('#nama_kategori').val(); //Get value dari form

  		$.ajax({
  			type: "POST",
  			data: 'id=' + idkat + '&nmk=' + nmkat,
  			url: "<?php echo base_url('index.php/Home/upd_kategori') ?>",
  			dataType: 'json',
  			success: function (hasil) {
  				// console.log(hasil);

  				$('#pesan').html(hasil.pesanboss)
  				if (hasil.pesanboss == 0) {
  					$('#addKategori').modal('hide');
  					ambilDataKategori();
  					resetKategori();

  				}
  			}
  		});
  	}


  	function hapusKategori(idkat) {
  		var tanya = confirm('Apakah yakin ingin menghapus data');

  		if (tanya) {
  			$.ajax({
  				type: "post",
  				data: 'idk=' + idkat,
  				url: "<?php echo base_url('index.php/Home/kategori_del') ?>",
  				dataType: 'json',
  				success: function (hasil) {
  					//  console.log(hasil);
  					if (hasil == true) {
  						ambilDataKategori();
  					}



  				}
  			});
  		}
  	}

  </script>
  <!-- ==================================  Untuk kategori ======================= -->
