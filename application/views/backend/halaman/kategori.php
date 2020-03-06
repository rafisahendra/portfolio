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
                  <button type="button" class="btn btn-info btn-sm" style="margin-bottom:10px" data-toggle="modal" data-target="#addKategori" onClick="submit('tambah')">Tambah Data</button>
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
<div class="modal fade" id="addKategori" tabindex="-1" role="dialog" aria-labelledby="addKategoriLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addKategoriLabel" >Tambah Kategori</h5>
        <button onClick="resesetKategori()"  type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="form-group">
           <label for="">Nama Kategori</label>
           <input type="hidden" name="idk">
           <input type="text" name="nama_kategori" id="nama_kategori" class="form-control" >
           <h6 class="text-red" id="pesan"></h6>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" onClick="resesetKategori()" data-dismiss="modal">Batal</button>
        <button type="button" id="btn-tambah" onClick="tambahData()" class="btn btn-primary btn-sm">Simpan </button>
        <button type="button" id="btn-edit" onClick="editData()" class="btn btn-primary btn-sm">Update </button>
      </div>
    </div>
  </div>
</div>