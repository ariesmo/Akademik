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
									
										<?php echo form_open('sekolah', 'role="form" class="form-horizontal"');?>
										<?php echo form_hidden('id_sekolah', $info['id_sekolah']);?>

										<div class="form-group">
											<label class="col-sm-2 control-label" for="form-field-1">
												NAMA SEKOLAH
											</label>
											<div class="col-sm-9">
												<input type="text" value="<?= $info['nama_sekolah'];?>" placeholder="Masukkan nama sekolah" id="form-field-1" class="form-control">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label" for="form-field-1">
												ALAMAT SEKOLAH
											</label>
											<div class="col-sm-9">
												<input type="text" value="<?= $info['alamat_sekolah'];?>" name="nama" placeholder="Masukkan alamat sekolah" id="form-field-1" class="form-control">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label" for="form-field-1">
												EMAIL | TELEPON
											</label>
											<div class="col-sm-6">
												<input type="text" value="<?= $info['email'];?>" name="email" placeholder="Masukkan alamat email" id="form-field-1" class="form-control">
											</div>
											<div class="col-sm-3">
												<input type="text" value="<?= $info['telepon'];?>" name="telepon" placeholder="Masukkan nomor telepon" id="form-field-1" class="form-control">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label" for="form-field-1">
												JENJANG
											</label>
											<div class="col-sm-3">
												<?php 
												echo cmb_dinamis('jenjang','tbl_jenjang_sekolah','nama_jenjang','id_jenjang',$info['id_jenjang_sekolah']); 
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