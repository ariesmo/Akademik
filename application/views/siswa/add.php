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
									
										<?php echo form_open_multipart('siswa/add', 'role="form" class="form-horizontal"');?>
										<div class="form-group">
											<label class="col-sm-2 control-label" for="form-field-1">
												NIM
											</label>
											<div class="col-sm-9">
												<input type="text" name="nim" placeholder="Masukkan nim anda" id="form-field-1" class="form-control">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label" for="form-field-1">
												NAMA
											</label>
											<div class="col-sm-9">
												<input type="text" name="nama" placeholder="Masukkan nama anda" id="form-field-1" class="form-control">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label" for="form-field-1">
												TEMPAT / TANGGAL LAHIR
											</label>
											<div class="col-sm-6">
												<input type="text" name="tempat_lahir" placeholder="Masukkan tempat lahir anda" id="form-field-1" class="form-control">
											</div>
											<div class="col-sm-3">
												<input type="date" name="tanggal_lahir" placeholder="Masukkan tanggal lahir anda" id="form-field-1" class="form-control">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label" for="form-field-1">
												GENDER
											</label>
											<div class="col-sm-3">
												<?php echo form_dropdown('gender', array('P'=>'PRIA', 'W'=>'WANITA'), null, 'class="form-control"');?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label" for="form-field-1">
												AGAMA
											</label>
											<div class="col-sm-3">
												<?php 
												echo cmb_dinamis('agama','tbl_agama','nama_agama','kd_agama'); 
												?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label" for="form-field-1">
												FOTO
											</label>
											<div class="col-sm-3">
												<input type="file" name="userfile">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label" for="form-field-1">
												ID ROMBEL
											</label>
											<div class="col-sm-3">
												<?php 
												echo cmb_dinamis('rombel','tbl_rombel','nama_rombel','id_rombel'); 
												?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label" for="form-field-1">
							
											</label>
											<div class="col-sm-9">
												<button type="submit" name="submit" class="btn btn-danger btn-sm">Simpan</button>
												<?php echo anchor('siswa', 'Kembali', array('class'=>'btn btn-info btn-sm'));?>
											</div>
										</div>
										
									</form>
								</div>
							</div>
							<!-- end: TEXT FIELDS PANEL -->
						</div>
					</div>