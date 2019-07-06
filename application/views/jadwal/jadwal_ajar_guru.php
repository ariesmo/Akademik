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
							                        <td align="center">NO</td>
							                        <td align="center">JURUSAN</td>
							                     	<td align="center">MATA PELAJARAN</td>
							                        <td align="center">HARI</td>
							                        <td align="center">JAM</td>
							                        <td align="center">RUANG</td>
							                    </tr>
							                </thead>
							                <tbody>
							                	<?php
							                		$no=1;
							                		foreach($jadwal->result() as $row){
							                			echo "<tr>
							                        		<td align='center'>$no</td>
							                        		<td>Kelas $row->kelas $row->jurusan</td>
							                     			<td>$row->nama_mapel</td>
							                        		<td>$row->hari</td>
							                        		<td align='center'>$row->jam</td>
							                        		<td align='center'>$row->nama_ruangan</td>
							                    			</tr>";
							                    	$no++;
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

	


