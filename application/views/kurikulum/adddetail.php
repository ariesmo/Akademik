					<div class="row">
						<div class="col-sm-12">
							<!-- start: TEXT FIELDS PANEL -->
							<div class="panel panel-default">
								<div class="panel-heading">
									<i class=""></i>
									Text Fields
									<div class="panel-tools">
										<a class="btn btn-xs btn-link panel-collapse collapses" href="#">
										</a>
										<a class="btn btn-xs btn-link panel-config" href="#panel-config" data-toggle="modal">
											<i class="fa fa-wrench"></i>
										</a>
										<a class="btn btn-xs btn-link panel-refresh" href="#">
											<i class="fa fa-refresh"></i>
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
									
										<?php echo form_open('kurikulum/addDetail', 'role="form" class="form-horizontal"');?>
										<div class="form-group">
											<label class="col-sm-2 control-label" for="form-field-1">
												KURIKULUM
											</label>
											<div class="col-sm-9">
												<?= cmb_dinamis('id_kurikulum','tbl_kurikulum','nama_kurikulum','id_kurikulum',$this->uri->segment(3));?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label" for="form-field-1">
												MATA PELAJARAN
											</label>
											<div class="col-sm-9">
												<?= cmb_dinamis('kd_mapel','tbl_mapel','kd_mapel','kd_mapel');?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label" for="form-field-1">
												JURUSAN
											</label>
											<div class="col-sm-9">
												<?= cmb_dinamis('jurusan','tbl_jurusan','jurusan','kd_jurusan');?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label" for="form-field-1">
												KELAS
											</label>
											<div class="col-sm-4">
												<select name="kelas" id="kelas" class="form-control">
							                        	<?php 
							                        		for($i=1;$i<=$info['jumlah_kelas'];$i++){
							                        		echo "<option value='$i'>Kelas $i</option>";
							                        	}
							                        	?>
							                    </select>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label" for="form-field-1">
							
											</label>
											<div class="col-sm-9">
												<button type="submit" name="submit" class="btn btn-danger btn-sm">Simpan</button>
												<?php echo anchor('kurikulum/detail/'.$this->uri->segment(3), 'Kembali', array('class'=>'btn btn-info btn-sm'));?>
											</div>
										</div>
										
									</form>
								</div>
							</div>
							<!-- end: TEXT FIELDS PANEL -->
						</div>
					</div>