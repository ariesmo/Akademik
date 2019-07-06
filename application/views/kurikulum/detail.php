					<div class="row">
						<div class="col-md-4">
							<!-- start: DYNAMIC TABLE PANEL -->
							<div class="panel panel-default">
								<div class="panel-heading">
									<i class=""></i>
									Data Jurusan
								</div>
									<div class="panel-body">
										<table id="mytable1" class="table table-striped table-bordered table-hover table-full-width dataTable" cellspacing="0" width="100%">
							                <thead>
							                    <tr>
							                        <th>Jurusan</th>
							                        <td><?= cmb_dinamis('jurusan','tbl_jurusan','jurusan','kd_jurusan',null,"onchange='loadData()'");?></td>  
							                    </tr>
							                    <tr>
							                        <th>Kelas</th>
							                        <td>
							                        	<select name="kelas" id="kelas" class="form-control" "onchange='loadData()'">
							                        		<option value="semua_kelas">Semua Kelas</option>
							                        	<?php 
							                        		for($i=1;$i<=$info['jumlah_kelas'];$i++){
							                        		echo "<option value='$i'>Kelas $i</option>";
							                        	}
							                        	?>
							                        	</select>
							                        </td> 
							                    </tr>
							                    <tr>
							                    	<td colspan=2><?= anchor('kurikulum/addDetail/'.$this->uri->segment(3), '<i class="fa fa-pencil-square-o" title="Tambah"></i> Tambah Data','class="btn btn-danger btn-sm"').' '.anchor('kurikulum', '<i class="fa fa-times" title="Back"></i> Kembali','class="btn btn-success btn-sm"');?> </td>
							                    </tr>
							                </thead>
							            </table>
									</div>
							</div>
							<!-- end: DYNAMIC TABLE PANEL -->
						</div>
						<div class="col-md-8">
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
           loadData();
        } );
</script>
<script type="text/javascript">
	function loadData(){
		var kelas = $('#kelas').val();
		var jurusan = $('#jurusan').val();
		$.ajax({
			type: 'GET',
			url: '<?= base_url();?>index.php/kurikulum/kurikulumDetail',
			data: 'jurusan='+jurusan+'&kelas='+kelas+'&id_kurikulum='+<?php echo $this->uri->segment(3)?>,
			success:function(html){
				$('#table').html(html);
			}
		})
	}
</script>
