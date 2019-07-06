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
									
										<?php echo form_open('kurikulum/edit', 'role="form" class="form-horizontal"');?>
										<?php echo form_hidden('id_kurikulum', $kurikulum['id_kurikulum']);?>

										
										<div class="form-group">
											<label class="col-sm-2 control-label" for="form-field-1">
												NAMA KURIKULUM
											</label>
											<div class="col-sm-9">
												<input type="text" value="<?= $kurikulum['nama_kurikulum'];?>" name="nama_kurikulum" placeholder="Masukkan nama kurikulum anda" id="form-field-1" class="form-control">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label" for="form-field-1">
												STATUS
											</label>
											<div class="col-sm-3">
												
												<?php echo form_dropdown('is_aktif', array('y'=>'Aktif', 'n'=>'Tidak Aktif'), $kurikulum['is_aktif'], 'class="form-control"');?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label" for="form-field-1">
							
											</label>
											<div class="col-sm-9">
												<button type="submit" name="submit" class="btn btn-danger btn-sm">Simpan</button>
												<?php echo anchor('kurikulum', 'Kembali', array('class'=>'btn btn-info btn-sm'));?>
											</div>
										</div>
										
									</form>
								</div>
							</div>
							<!-- end: TEXT FIELDS PANEL -->
						</div>
					</div>