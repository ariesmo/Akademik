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
							                        <th>NO</th>
							                     	<th>NAMA ROMBEL</th>
							                        <th>JURUSAN</th>
							                        <th>KELAS</th>
							                        <th>TAHUN AKADEMIK</th>
							                        <th>NAMA GURU</th>
							                    </tr>
							                </thead>
							            </table>
									</div>
								</div>
							</div>
							<!-- end: DYNAMIC TABLE PANEL -->
						</div>
					</div>

	

<script type="text/javascript" language="javascript" src="<?= base_url();?>/vendor/datatables/datatables/media/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="<?= base_url();?>/vendor/datatables/datatables/media/js/jquery.dataTables.js"></script>
<script type="text/javascript">
	function updateGuru(id_walikelas) {
		var id_guru = $("#guru"+id_walikelas).val();
		
		
		$.ajax({
			type: 'GET',
			url: '<?= base_url();?>index.php/walikelas/updateGuru',
			data: 'id_walikelas='+id_walikelas+'&id_guru='+id_guru,
			success:function(html){
				// $("#showRombel").html(html);
				// loadPelajaran();
			}
		})
	}
</script>			

<script>
        $(document).ready(function() {
            var t = $('#mytable').DataTable( {
                "ajax": '<?php echo site_url('walikelas/data'); ?>',
                "order": [[ 2, 'asc' ]],
                "columns": [
                    { 
                        "data": null,
                        "width": "30px",
                        "sClass": "text-center",
                        "orderable": false,
                    },
                    { 
                        "data": "nama_rombel",
                        "width": "100px",
                        "sClass": "text-center"
                    },
                    { 
                        "data": "jurusan",
                        "width": "200px",
                        "sClass": "text-center"
                    },
                    { 
                        "data": "kelas",
                        "width": "70px",
                        "sClass": "text-center"
                    },
                    { 	
                    	"data": "tahun_akademik",
                    	"sClass": "text-center" 
                    },
                    { 	"data": "nama_guru",
                		"width": "200px",
                        "sClass": "text-center" 
                    }
                ]
            } );
                
            t.on( 'order.dt search.dt', function () {
                t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                } );
            } ).draw();
        } );
    </script>
