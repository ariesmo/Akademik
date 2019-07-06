					<div class="row">
						<div class="col-md-4">
							<!-- start: DYNAMIC TABLE PANEL -->
							<div class="panel panel-default">
								<div class="panel-heading">
									<i class=""></i>
									Data Level
								</div>
									<div class="panel-body">
										<table id="mytable" class="table table-striped table-bordered table-hover table-full-width dataTable" cellspacing="0" width="100%">
							                <thead>
							                    <tr>
							                        <td>Level User</td>
							                        <td>
							                        	<?php echo cmb_dinamis('level_user','tbl_level_user','nama_level','id_level_user',null, "onchange='loadData()'");?>
							                        </td>
							                        
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
									Data Akses
									<div class="panel-tools">
									</div>
								</div>
									<div class="panel-body">
										<div id="modul">
											
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
		var level_user = $("#level_user").val();
		// var jurusan = $("#jurusan").val();
		
		$.ajax({
			type: 'GET',
			url: '<?= base_url();?>index.php/users/modul',
			data: 'level_user='+level_user,
			success:function(html){
				$("#modul").html(html);
			}
		})
	}
	function loadRule(id_menu){
		var level_user = $("#level_user").val();
		$.ajax({
			type: 'GET',
			url: '<?= base_url();?>index.php/users/addRule',
			data: 'level_user='+level_user+'&id_menu='+id_menu,
			success:function(html){
				// $("#modul").html(html);
				loadData();
				alert('Sukses memberikan akses');

			}
		})
	}
</script>
