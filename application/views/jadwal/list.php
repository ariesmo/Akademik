					<div class="row">
						<div class="col-md-12">
							<!-- start: DYNAMIC TABLE PANEL -->
							<div class="panel panel-default">
								<div class="panel-heading">
									<i class=""></i>
									Data Jurusan
								</div>

									<div class="panel-body">
										<?= form_open('jadwal/cetak_jadwal');?>
										<table id="mytable1" class="table table-striped table-bordered table-hover table-full-width dataTable" cellspacing="0" width="100%">
							                <thead>
							                    <tr>
							                        <th>Jurusan</th>
							                        <td><?= cmb_dinamis('jurusan','tbl_jurusan','jurusan','kd_jurusan',null,'onchange=loadRombel()');?></td>  
							                    </tr>
							                    <tr>
							                        <th>Kelas</th>
							                        <td>
							                        	<select name="kelas" id="kelas" class="form-control" onchange="loadRombel()">
							                        	<?php 
							                        		for($i=1;$i<=$info['jumlah_kelas'];$i++){
							                        		echo "<option value='$i'>Kelas $i</option>";
							                        	}
							                        	?>
							                        	</select>
							                        </td> 
							                    </tr>
							                    <tr>
							                    	<td>Rombel</td>
							                    	<td>
							                    	<div id="showRombel"></div>
							                    	</td>
							                    </tr>
							                    <tr>
							                    	<td colspan=2>
							                    		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Generate</button>
							                    		<button type="submit" name="export_jadwal" class="btn btn-danger">Cetak PDF</button>
							                    	</td>
							                    </tr>
							                </thead>
							            </table>
							            <?= form_close();?>
									</div>
							</div>
							<!-- end: DYNAMIC TABLE PANEL -->
						</div>
						<div class="col-md-12">
							<!-- start: DYNAMIC TABLE PANEL -->
							<div class="panel panel-default">
								<div class="panel-heading">
									<i class=""></i>
									Data Kurikulum
									<div class="panel-tools">
										
										<?= anchor('kurikulum/add', '<i class="fa fa-pencil-square-o" title="Tambah"></i>','class="btn btn-xs btn-link"');?>
										<?= anchor('kurikulum', '<i class="fa fa-refresh" title="Refresh"></i>','class="btn btn-xs btn-link panel-refresh"');?>
										<a class="btn btn-xs btn-link panel-config" href="#panel-config" data-toggle="modal">
											<i class="fa fa-wrench" title="Setting"></i>
										</a>
										<a class="btn btn-xs btn-link panel-collapse collapses" href="#">
										</a>
										<a class="btn btn-xs btn-link panel-expand" href="#">
											<i class="fa fa-resize-full"></i>
										</a>
										<a class="btn btn-xs btn-link panel-close" href="#">
											<i class="fa fa-times"></i>
										</a>
									</div>
								</div>
									<div class="panel-body">
										<div id='table'>
											
										</div>
									</div>
								</div>
							</div>
							<!-- end: DYNAMIC TABLE PANEL -->
						</div>
					</div>

<script type="text/javascript" language="javascript" src="<?= base_url();?>vendor/datatables/datatables/media/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="<?= base_url();?>vendor/datatables/datatables/media/js/jquery.dataTables.js"></script>				

<script>     
        $(document).ready(function() {
           loadRombel();
        } );
</script>
<script type="text/javascript">
	function loadRombel(){
		var kelas = $("#kelas").val();
		var jurusan = $("#jurusan").val();
		
		$.ajax({
			type: 'GET',
			url: '<?= base_url();?>index.php/jadwal/loadRombel',
			data: 'kelas='+kelas+'&jurusan='+jurusan,
			success:function(html){
				$("#showRombel").html(html);
				loadPelajaran();
			}
		})
	}
	function loadPelajaran(){
		var kelas = $("#kelas").val();
		var jurusan = $("#jurusan").val();
		var rombel = $('#rombel').val();
	
		$.ajax({
			type: 'GET',
			url: '<?= base_url();?>index.php/jadwal/dataJadwal',
			data: 'jurusan='+jurusan+'&kelas='+kelas+'&rombel='+rombel+'&id_kurikulum=<?php echo $this->uri->segment(3) ?>',
			success:function(html){
				$("#table").html(html);
				
			}
		})
	}
	
	function updateGuru(id){
		var guru = $("#guru"+id).val();
		$.ajax({
			type: 'GET',
			url: '<?= base_url();?>index.php/jadwal/updateGuru',
			data: 'id_guru='+guru+'&id_jadwal='+id,
			success:function(html){
				loadData();
			}
		})
	}
	function updateRuangan(id){
		var kd_ruangan = $("#ruangan"+id).val();
		$.ajax({
			type: 'GET',
			url: '<?= base_url();?>index.php/jadwal/updateRuangan',
			data: 'kd_ruangan='+kd_ruangan+'&id_jadwal='+id,
			success:function(html){
				loadData();
			}
		})
	}
	function updateHari(id){
		var hari = $("#hari"+id).val();
		$.ajax({
			type: 'GET',
			url: '<?= base_url();?>index.php/jadwal/updateHari',
			data: 'hari='+hari+'&id_jadwal='+id,
			success:function(html){
				loadData();
			}
		})
	}
	function updateJam(id){
		var jam = $("#jam"+id).val();
		$.ajax({
			type: 'GET',
			url: '<?= base_url();?>index.php/jadwal/updateJam',
			data: 'jam='+jam+'&id_jadwal='+id,
			success:function(html){
				loadData();
			}
		})
	}
</script>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
        		</button>
      		</div>
      		<div class="modal-body">
      			<?= form_open('jadwal/generate_jadwal');?>
      				<div>
						<tr>
							<th>Kurikulum</th>
							<td><?= cmb_dinamis('kurikulum','tbl_kurikulum','nama_kurikulum','id_kurikulum');?></td>  
						</tr>
					</div>
					<div>
						<tr>
							<th>Semester</th>
							<td>
							    <?= form_dropdown('semester', array(1 => 'Semester 1', 2 => 'Semester 2'), null, "class='form-control'");?>
							</td> 
						</tr>
					</div>
					<div class="modal-footer">
        				<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        				<button type="submit" name="submit" class="btn btn-primary">Generate Data</button>
      				</div>
				<?= form_close();?>		
      		</div>
    	</div>
  	</div>
</div>
