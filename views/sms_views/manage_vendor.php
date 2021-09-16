<?php $this->load->view('header_view');?>
<div class="container">

    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                Manage Vendor <small> In this category you can Manage vendor information.</small>
            </h1>

        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- Advanced Tables -->
            <div class="panel panel-info">
                <div class="panel-heading">
                    <a class="btn btn-primary btn-sm" href = "<?php echo  base_url();?>stock/add_vendor">Add Vendor</a>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                    <table class="table table-bordered" id="manage_vendor">
                        <thead>
                        <th>S.No.</th>
                        
                        <th> Vendor Name</th>
                        <th>Contact Number</th>
                       <!-- <th>Image</th> -->
                       <th>Address</th>
                       <th>Email</th>
                       <th>Image</th>
                        <th>Web site</th>
                        <th class='text-center'>Edit</th>
                        <th class='text-center'>Delete</th>
                    </thead>
                    <tbody> 
                    <?php $i=1;
                    foreach ($data as $result)
                        {
                            if($result['is_deleted']==0){
                        echo '<tr>
                            <td>'.$i++.'</td>
                           
                            <td>' .$result['vendor_name'].'</td>
                            <td>' .$result['contact_number'].'</td>
                            <td>' .$result['address'].'</td>
                            <td>' .$result['email'].'</td>
                            <td>'.'<img height="60px" width="60px" src="'.base_url().'/assets/img/uploads/'.$result['image_file'].'"/>'.'</td>
                            <td>' .$result['website'].' </td>
                            <td class="text-center"> <a href='.base_url().'stock/edit_vendor/'.$result['id'].'><span class="glyphicon glyphicon-pencil"></span></a></td>
                            <td class="text-center"> <a><span class="glyphicon glyphicon-trash text-danger delete" id="deletell" data-id="' . $result['id']. '"></span></a></td>
                            </tr>';
                            }
                        }
                        ?>
                        <!--<td>'.'<img height="60px" width="60px" src="'.base_url().'/assets/img/uploads/'.$result['image_file'].'"/>'.'</td> -->
                    </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalDemo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    Confirm Delete
                </div>
                <div class="modal-body">
                    Are you sure you want to Delete  Vendor Details ?
                </div>  
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <a  id="sureDelete"><button  class="btn btn-danger success">Delete</button></a>
                </div>

            </div>
        </div>
    </div>
</div> 
<script type="text/javascript">
    $('#manage_vendor').dataTable( {
              'aoColumnDefs': [{
                     'bSortable': false,
                     'aTargets': [-1,-2] /* 1st one, start by the right */
                 }]
             } );

    //Model Function Call
    $(document).on('click', '.delete', function () {
        var url = "<?php echo base_url().'stock/delete_vendor/' ?>";
        var Id = $(this).attr('data-id');

        var href = url + Id;

        $('#sureDelete').attr('href', href);
        $('#modalDemo').modal('show');
    });
</script>
<?php 
$this->load->view('footer');
$this->load->view('end_html');
?>