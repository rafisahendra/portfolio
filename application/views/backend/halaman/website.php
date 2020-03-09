<style type="text/css">
	#remove_button {
    height:30px;
    width:30px;
    
		border-radius: 50%;
		border: 1px solid #ff2b2b;
		display: block;
		text-align: center;
		position: absolute;
		top: -7px;
		right: 0px;
	}

</style>
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-12">


			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Website</h3>

				</div>


				<!-- /.card-header -->
				<div class="card-body">
					<button type="button" onClick="resesetWebsite()"  class="btn btn-info btn-sm" style="margin-bottom:10px" data-toggle="modal"
						data-target="#addWebsite">Tambah Data</button>
					<table id="example1" class="table table-bordered table-striped">
						<thead class="text-center">
							<tr>
								<th width="6%">Exs</th>
								<th>No</th>
								<th>Frontend</th>
								<th>Nama Website</th>
								<th>Kategori Website</th>
								<th>Tanggal Posting</th>
								<th>Detail Website</th>
							</tr>
						</thead>
						<tbody id="target_website" class="text-justify">
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
<div class="modal fade " id="addWebsite" tabindex="-1" role="dialog" aria-labelledby="addWebsiteLabel"
	aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="addWebsiteLabel">Tambah Website</h5>
				<button onClick="closeWebsite()" type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form class="form-horizontal" id="submit_website" name="submit_website">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="">Nama Website</label>
								<!-- <input type="hidden" name="idweb"> -->
								<input type="text" name="website_nama" id="website_nama" class="form-control" required>
								<h6 class="text-red" id="pesan"></h6>
							</div>

						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="">Kategori Website</label>
								<select class="form-control" id="kategori_id" name="kategori_id" required>
									<option>No selected</option>
								</select>
								<h6 class="text-red" id="pesan"></h6>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="">Keterangan Website</label>
						<input type="text" name="website_keterangan" id="website_keterangan" class="form-control" required>
						<h6 class="text-red" id="pesan"></h6>
					</div>
					<div class="row" id="div_gambar">
						<div class="col-md-6">
							<div class="form-group">
								<label id="website_gambarlabel" for="">Foto</label>
								<input type="file" name="website_gambar" id="website_gambar" required>
							</div>
							<div style="margin-left:35px" class="form-group">
								<input type="submit" name="upload_button" class="btn btn-info btn-sm" value="Upload" />
							</div>
						</div>
					</div>
        
         
      
							<div class="form-group">
								<h4 class="text-center">Image Preview<hr>
								</h4>
								<div id="image_preview"></div>
						
					
         </div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-secondary btn-sm" onClick="closeWebsite() "
						data-dismiss="modal">Batal</button>
					<button type="submit" id="btn_upload" class="btn btn-primary btn-sm">Simpan </button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- ==================================  Untuk Web ============================ -->
<script>
	$(document).ready(function () {
    
		$("[name='submit_website']").on('submit', function (e) {
			e.preventDefault(); 
			$.ajax({
				url: '<?php echo base_url();?>index.php/Home/do_upload_add_img',
				type: "POST",
				data: new FormData(this),
				contentType: false,
				processData: false,
       
				success: function (data) {
					console.log(data);
					$('#image_preview').html(data);
          $('#div_gambar').hide()
        
    
					
				}
			})
		});


    $(document).on('click', '#remove_button', function(){
       if(confirm("Apakah Anda yakin akan menghapus gambar ini?")){
          var path = $('#path_name').val();
          $.ajax({
             url: '<?php echo base_url();?>index.php/Home/do_upload_delete_tmp',
             type:"POST",
             data  :'path='+path,
             success:function(data){
              //  console.log(data);
                if(data != ''){
                  $('#image_preview').html('');
                  $('#div_gambar').show();
                  $('#website_gambar').val('');
                
                  
                }
             }
          });
       } else {  
          return false;
       }
    });

	});


  function hapus_dari_directory(){
    var path = $('#path_name').val();
          $.ajax({
             url: '<?php echo base_url();?>index.php/Home/do_upload_delete_tmp',
             type:"POST",
             data  :'path='+path,
             success:function(data){
              //  console.log(data);
                if(data != ''){
                  $('#image_preview').html('');
                  $('#div_gambar').show();
                  $('#website_gambar').val('');
                
                  
                }
             }
          });
  }
</script>



<script type="text/javascript">
	$(document).ready(function () {
		option_kategori();
		ambilDataWebsite();
    $('#div_gambar').show();

 

	});
	$('#submit_website').submit(function(e){
	        e.preventDefault(); 
	             $.ajax({
	                 url:'<?php echo base_url();?>index.php/Home/add_website',
	                 type:"POST",
	                 data:new FormData(this),
	                 processData:false,
	                 contentType:false,
	                 cache:false,
	                 async:false,
	                  success: function(data){

	                if(data == 1){
	                $('#addWebsite').modal('hide');
	                ambilDataWebsite();
                 
	                resesetWebsite();

	               }
	               }
	             });
	        });


	function resesetWebsite() {
    
    $('#div_gambar').show();
		$('#website_nama').val('');
    $('#kategori_id').val('No selected');
		$('#website_keterangan').val(''); //Get element ById
		$('#path_name').val(''); //Get element ById
		$('#pesan').html('');
		$('#image_preview').html('');
    $('#website_gambar').val('');
     
	}

function closeWebsite(){
  hapus_dari_directory();
  $('#div_gambar').show();
		$('#website_nama').val('');
		$('#website_keterangan').val(''); //Get element ById
		$('#path_name').val(''); //Get element ById
		$('#pesan').html('');
		$('#image_preview').html('');
    $('#website_gambar').val('');
    $('#kategori_id').val('No selected');
}
	function ambilDataWebsite() {
		$.ajax({
			type: "post",
			url: "<?php echo base_url('index.php/Home/ambil_website');  ?>",
			dataType: "json",
			success: function (data) {
				// console.log(data);   
				var baris = '';
			
				for (var i = 0; i < data.length; i++) {
				
					baris += '<tr>' +
						'<td>' +
						
						'<a href="#" onClick="hapusWebsite(\'' + data[i].website_id+ '\',\'' + data[i].website_gambar+ '\')"> <span class="fas fa-trash text-info"></span> </a>' +
						'<a href="#addwebsite" data-toggle="modal"> <span class="fas fa-edit text-warning" onClick="submit(' +
						data[i].website_id + ')"></span> </a>' +
						'</td>' +
						'<td>' + (i + 1) + '</td>' +
			    	'<td>' + ' <img style="width:250px;height:160px;" src="<?php echo base_url('upload/images/') ?>'+ data[i].website_gambar + ' " > ' + '</td>' +
						'<td>' + data[i].website_nama + '</td>' +
						'<td>' + data[i].kategori_nama + '</td>' +
						'<td>' + data[i].tanggal_posting + '</td>' +
						'<td>' + data[i].website_keterangan + '</td>' +

						'</tr>';
				}

				$('#target_website').html(baris);

			}
		});
	}

	function option_kategori() {

		$.ajax({
			type: "post",
			url: "<?php echo base_url('index.php/Home/ambil_kategori');  ?>",
			dataType: "json",
			success: function (data) {
				// console.log(data);
				var baris = '';
				var i;
				for (i = 0; i < data.length; i++) {
					baris += '<option value=' + data[i].kategori_id + '>' + data[i].kategori_nama + '</option>';
				}
				$('#kategori_id').html(baris);

			}
		});
		return false;
	}


	function hapusWebsite(id,name) {
		
//   console.log('hapusWebsite() - id: ', id, 'name: ', name);


		var tanya = confirm('Apakah yakin ingin menghapus data Website');
		if (tanya) {
			$.ajax({
				type: "post",
				data  :'idw='+id+'&gambar='+name,
				url: "<?php echo base_url('index.php/Home/website_del') ?>",
				dataType: 'json',
				success: function (hasil) {
					console.log(hasil);
					if (hasil != 0) {
						ambilDataWebsite();
						
					}



				}
			});
		}
	}

</script>
<!-- ==================================  Untuk Web ============================ -->
