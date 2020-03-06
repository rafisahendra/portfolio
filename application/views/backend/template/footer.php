</div>
</section>
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer" style="font-family:times new roman">
    <strong>Copyright &copy; <?= date('Y') ?><a href="#"> <i> Portfolio</i> </a></strong>
   
    <div class="float-right d-none d-sm-inline-block">
      <b>KT- Rafi sahendra</b> 
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?php echo base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url() ?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo base_url() ?>assets/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<!-- <script src="<?php echo base_url() ?>assets/plugins/sparklines/sparkline.js"></script> -->
<!-- JQVMap -->
<script src="<?php echo base_url() ?>assets/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url() ?>assets/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url() ?>assets/plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo base_url() ?>assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?php echo base_url() ?>assets/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo base_url() ?>assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url() ?>assets/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="<?php echo base_url() ?>assets/dist/js/pages/dashboard.js"></script> -->
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url() ?>assets/dist/js/demo.js"></script>
<!-- DataTable -->
<script src="<?php echo base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>

<script type="text/javascript" >
        ambilData(); 
        function ambilData(){
            $.ajax({
                type    :"post",
                url     :"<?php echo base_url('index.php/Home/ambil_kategori');  ?>",
                dataType:"json",
                success : function(data){
                    // console.log(hasil);   
                    var baris='';
                    for( var i=0;i< data.length;i++){
                      baris +=  '<tr>'+
                                '<td>'+
                                '<a href="#" onClick="hapusKategori('+data[i].kategori_id+')"> <span class="fas fa-trash text-info"></span> </a>'+
                                '<a href="#addKategori" data-toggle="modal"> <span class="fas fa-edit text-warning" onClick="submit('+data[i].kategori_id+')"></span> </a>'+
                                '</td>'+
                                '<td>'+ (i+1)+'</td>'+
                                '<td>'+ data[i].kategori_nama+'</td>'+
                                
                                '</tr>';
                    }

                    $('#target').html(baris);

                }
            });
        }


        function tambahData(){
          
          // var nmkat=$("[name='nama_kategori']").val(); Get Elemet ByNames
          var nmkat = $('#nama_kategori').val(); //Get Elemet ById

          $.ajax({
            type  :"POST",
            data  :'nmk='+nmkat,
            url   :"<?= base_url('index.php/Home/add_kategori'); ?>",
            dataType :'json',
            success :function(hasil){
               // console.log(hasil);   
                $('#pesan').html(hasil.pesanboss)
                  if(hasil.pesanboss == 0){
                    $('#addKategori').modal('hide');
                    ambilData();
                    resesetKategori();
                  
                   }
             
            }
          });
        }

        function resesetKategori(){
          $('#nama_kategori').val('');
          $('#pesan').html('');
        }


        function submit(nilai){
          if(nilai == 'tambah'){
            
            $('#addKategoriLabel').html('Tambah Data Kategori');
            $('#btn-tambah').show();
            $('#btn-edit').hide();
          }else{
            $('#addKategoriLabel').html('Edit Data Kategori');
            $('#btn-edit').show();
            $('#btn-tambah').hide();
           
            $.ajax({
              type  :"POST",
              data  :'idk='+nilai,
              url   :"<?= base_url('index.php/Home/edd_kategori'); ?>",
              dataType :'json',
              success: function(request){
                // console.log(request);

                  $('#nama_kategori').val(request[0].kategori_nama);
                  $('[name="idk"]').val(request[0].kategori_id);
              }
            });

          }
          
        }


        function editData(){
      
          var idkat = $('[name="idk"]').val(); //Get value dari form
          var nmkat = $('#nama_kategori').val(); //Get value dari form
          
          $.ajax({
            type  :"POST",
            data  :'id='+idkat+'&nmk='+nmkat,
            url   :"<?php echo base_url('index.php/Home/upd_kategori') ?>",
            dataType:'json',
            success : function(hasil){
              // console.log(hasil);

              $('#pesan').html(hasil.pesanboss)
                  if(hasil.pesanboss == 0){
                    $('#addKategori').modal('hide');
                    ambilData();
                    resesetKategori();
               
                   }
            }
          });
        }


        function hapusKategori(id){
          var tanya = confirm('Apakah yakin ingin menghapus data');

          if(tanya){
            $.ajax({
                type  :"post",
                data  :'idk='+id,
                url   :"<?php echo base_url('index.php/Home/kategori_del') ?>",
                success: function(hasil){
                //  console.log(hasil);
                ambilData();
                }
            });
          }
        }

</script>


</body>
</html>
