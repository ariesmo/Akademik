					<div class="row">
						<div class="col-md-12">
							<div class="panel-body">
										<table class="table table-striped table-bordered table-hover table-full-width dataTable" cellspacing="0" width="100%">
							                <thead>
							                    <tr>
							                        <td width="200">TAHUN AKADEMIK</td>
							                        <td><?php echo get_tahun_akademik_aktif('tahun_akademik');?></td>
							                    </tr>
							                    <tr>
							                        <td>SEMESTER</td>
							                        <td><?php echo get_tahun_akademik_aktif('semester_aktif');?></td>
							                    </tr>
							                    <tr>
							                        <td>JURUSAN</td>
							                        <td>Kelas <?= $rombel['kelas'].' '.$rombel['jurusan'];?> (<?php echo $rombel['nama_rombel'];?>) </td>
							                    </tr>
							                    <tr>
							                        <td>MATA PELAJARAN</td>
							                        <td><?= $rombel['nama_mapel'];?></td>
							                    </tr>
							                </thead>
							            </table>
							</div>
						</div>

						<div class="col-md-12">
							<!-- start: DYNAMIC TABLE PANEL -->
							<div class="panel panel-default">
								<div class="panel-heading">
									<i class=""></i>
									Data Mata Pelajaran
									<div class="panel-tools">
										
										<?= anchor('mapel/add', '<i class="fa fa-pencil-square-o" title="Tambah"></i>','class="btn btn-xs btn-link"');?>
										<?= anchor('mapel', '<i class="fa fa-refresh" title="Refresh"></i>','class="btn btn-xs btn-link panel-refresh"');?>
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
										<table id="mytable" class="table table-striped table-bordered table-hover table-full-width dataTable" cellspacing="0" width="100%">
							                <thead>
							                    <tr>
							                        <td align="center">NIS</td>
							                        <td align="center">NAMA </td>
							                     	<td align="center">NILAI</td>
							                    </tr>
							                  
							                </thead>
							                <tbody>
							                	<?php
							           			
							                		foreach($siswa as $row){
							                			echo "<tr>       		
							                     			<td align='center'>$row->nim</td>
							                        		<td align='center'>$row->nama</td>
							                        		<td width='150'><input type='number' id='nilai".$row->nim."' onKeyup='updateNilai(\"$row->nim\")' value='".check_nilai($row->nim, $this->uri->segment(3))."' class='form-control'></td>
							                    			</tr>";
							                    	
							                		}
							                	?>
							                </tbody>
							            </table>
									</div>
								</div>
							</div>
							<!-- end: DYNAMIC TABLE PANEL -->
						</div>
					</div>

<script type="text/javascript" language="javascript" src="<?= base_url();?>vendor/datatables/datatables/media/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="<?= base_url();?>vendor/datatables/datatables/media/js/jquery.dataTables.js"></script>				

<script type="text/javascript">
	function updateNilai(nim){
		var nilai = $('#nilai'+nim).val();
		
		$.ajax({
			type: 'GET',
			url: '<?= base_url();?>index.php/nilai/update_nilai',
			data: 'nim='+nim+'&id_jadwal='+<?php echo $this->uri->segment(3);?>+'&nilai='+nilai,
			success:function(html){
				
			}
		})
	}
</script>	


