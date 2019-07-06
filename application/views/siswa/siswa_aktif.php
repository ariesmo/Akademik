                    <div class="row">
                        <div class="col-md-4">
                            <!-- start: DYNAMIC TABLE PANEL -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class=""></i>
                                    Filter Data
                                    <div class="panel-tools">
                                        
                                    </div>
                                </div>
                                    <div class="panel-body">
                                        <?php echo form_open('siswa/data_by_rombel_excel');?>
                                        <table class="table table-striped table-bordered table-hover table-full-width dataTable" cellspacing="0" width="100%">
                                            <thead>
                                               <tr>
                                                    <td>JURUSAN</td>
                                                    <td><?php echo cmb_dinamis('jurusan','tbl_jurusan','jurusan','kd_jurusan',null,"onchange='loadData()'");?></td>
                                                </tr>
                                                <tr>
                                                    <td>ROMBEL</td>
                                                    <td>
                                                        <div id="rombel">
                                                            
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td><button type="submit" class="btn btn-danger">Export Excel</button></td>
                                                </tr>
                                            </thead>
                                        </table>
                                        <?php form_close();?>
                                    </div>
                                
                            </div>
                            <!-- end: DYNAMIC TABLE PANEL -->
                        </div>
                        <div class="col-md-8">
                            <!-- start: DYNAMIC TABLE PANEL -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class=""></i>
                                    Data Siswa
                                    <div class="panel-tools">
                                        
                                    </div>
                                </div>
                                    <div class="panel-body">
                                       <div id="loadSiswa">
                                           
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
           loadData();
           
        } );
</script>
<script type="text/javascript">
    function loadData(){
        var jurusan = $("#jurusan").val();
        
        $.ajax({
            type: 'GET',
            url: '<?= base_url();?>index.php/rombel/show_combobox_rombel_by_jurusan',
            data: 'jurusan='+jurusan,
            success:function(html){
                $("#rombel").html(html);
                var rombel = $("#rombel2").val();
                loadSiswa(rombel);
            }
        })
    }
    function loadSiswa(rombel){
        var rombel = $("#rombel2").val();
        $.ajax({
            type: 'GET',
            url: '<?= base_url();?>index.php/siswa/show_siswa_by_rombel',
            data: 'rombel='+rombel,
            success:function(html){
                $("#loadSiswa").html(html);
            }
        })
    }
</script>            

