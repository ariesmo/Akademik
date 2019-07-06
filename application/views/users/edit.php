					<div class ="row">
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
									
										<?php echo form_open_multipart('users/edit', 'role="form" class="form-horizontal"');?>
										<?php echo form_hidden('id_user', $users['id_user']);?>

										<div class="form-group">
											<label class="col-sm-2 control-label" for="form-field-1">
												NAMA LENGKAP
											</label>
											<div class="col-sm-9">
												<input type="text" value="<?= $users['nama_lengkap'];?>"  name="nama_lengkap" placeholder="Masukkan nama anda" id="form-field-1" class="form-control">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label" for="form-field-1">
												USERNAME
											</label>
											<div class="col-sm-9">
												<input type="text" value="<?= $users['username'];?>" name="username" placeholder="Masukkan username anda" id="form-field-1" class="form-control">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label" for="form-field-1">
												PASSWORD
											</label>
											<div class="col-sm-9">
												<input type="password" value="<?= $users['password'];?>" name="password" placeholder="Masukkan password anda" id="form-field-1" class="form-control">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label" for="form-field-1">
												LEVEL USER
											</label>
											<div class="col-sm-3">
												<?php 
												echo cmb_dinamis('id_level_user','tbl_level_user','nama_level','id_level_user',$users['id_level_user']); 
												?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label" for="form-field-1">
												FOTO
											</label>
											<div class="col-sm-9">
												<input type="file" name="userfile">
												<img src="<?php echo base_url()."uploads/foto_user/".$users['foto'];?>" width="200">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label" for="form-field-1">
							
											</label>
											<div class="col-sm-9">
												<button type="submit" name="submit" class="btn btn-danger btn-sm">Simpan</button>
												<?php echo anchor('users', 'Kembali', array('class'=>'btn btn-info btn-sm'));?>
											</div>
										</div>
										
									</form>
								</div>
							</div>
							<!-- end: TEXT FIELDS PANEL -->
						</div>
					</div>