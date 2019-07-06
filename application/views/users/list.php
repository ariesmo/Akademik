					<div class="row">
						<div class="col-md-12">
							<div class="panel-body">
								<?php echo anchor('users/rule','HAK AKSES', array('class' => 'btn btn-red btn-block'));?>
							</div>
							
							<!-- start: DYNAMIC TABLE PANEL -->
							<div class="panel panel-default">

								<div class="panel-heading">
									<i class=""></i>
									Data Siswa
									<div class="panel-tools">
										
										<?= anchor('users/add', '<i class="fa fa-pencil-square-o" title="Tambah"></i>','class="btn btn-xs btn-link"');?>
										<?= anchor('users', '<i class="fa fa-refresh" title="Refresh"></i>','class="btn btn-xs btn-link panel-refresh"');?>
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
							                        <th>NO</th>
							                        <th>NAMA LENGKAP</th>
							                        <th>NAMA LEVEL</th>
							                        <th>AKSI</th>
							                    </tr>
							                </thead>
							            </table>
									</div>
								</div>
							</div>
							<!-- end: DYNAMIC TABLE PANEL -->
						</div>
					</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.0/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.js"></script>				

<script>
        $(document).ready(function() {
            var t = $('#mytable').DataTable( {
                "ajax": '<?php echo site_url('users/data'); ?>',
                "order": [[ 2, 'asc' ]],
                "columns": [
                    { 
                        "data": "id_user",
                        "width": "30px",
                        "sClass": "text-center",
                        "orderable": false,
                    },
                    {
                    	"data": "nama_lengkap",
                    	"width": "50px",
                        "sClass": "text-center"
                    },
                    { 
                        "data": "nama_level",
                        "width": "70px",
                        "sClass": "text-center"
                    },
                    { 	"data": "aksi",
                		"width": "120px",
                        "sClass": "text-center" 
                    },
                ]
            } );
                
            t.on( 'order.dt search.dt', function () {
                t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                } );
            } ).draw();
        } );
    </script>
