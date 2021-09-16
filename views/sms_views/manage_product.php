<?php
/* ===============================================================================
  Created By:MADAN KUMAR VISHWAKARMA
  Created Date:21-07-2021
  File Purpose:This view is used for edit,delete stock
  Main Decription:display all stock category in a table and we can edit,delete it
  Modify By:MADAN KUMAR VISHWAKARMA
  Modify Date:
  What Modify:UI DESIGN CHANGE LARGE FIELDS
  Last Modify:14/9/16
  =============================================================================== */
$this->load->view('header_view');
$this->load->model('main_model');
$this->load->model('stock_model');
?>
<div class="container">

      <div class="row">
            <div class="col-md-12">
                <h1 class="page-header">
                    Manage Product  <small> In this category you can manage product information.</small>
                </h1>

            </div>
        </div>
    <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-info">
                        <div class="panel-heading">
                             <a class="btn btn-primary btn-sm" href = "<?php echo  base_url();?>stock/add_product">Add Product</a>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <th>S.N.</th>    
                            <th>Product Category </th>
                            <th>Product  Name</th>
                            <th>Product  ID</th>
                            <th>Product  MRP</th>
                            <th>Product  CP</th>
                            <th>Product  SP</th>                           
                            <th>Product  Description</th>
                            <th>Product  Manufacturing Date</th>
                            <th>Product  Expiry Date</th>
                            <th>Product  GST Type</th>
                            <th>Product  GST Percentage</th>                           
                            <th colspan="2" class="text-center">Action</th>
                            </thead>
                            <tbody>                         
                                <?php
                                $i = 1;
                                foreach ($data as $result)
                                 {    /*   $this->main_model->get_name_from_id('stock_category','category_name',$result['category_id']) 
                                        we are calling 'get_name_from_id' function from 'main_model'  to fetch particular column
                                        from 'stock_category' table by passing 'category_id' which is the reference of 'id' in
                                        the 'stock_category' table.   */           
                                echo '<tr>
                                    <td>' . $i++ . '</td>      
                                    <td>' . $this->stock_model->get_name_from_id('stock_category','category_name',$result['category_id']) . '</td>
                                    <td>' . $result['product_name'] . '</td>
                                    <td>' . $result['product_id'] . '</td>
                                    <td>' . $result['product_mrp'] . '</td>
                                    <td>' . $result['product_cp'] . '</td>
                                    <td>' . $result['product_sp'] . '</td>                                    
                                    <td>' . $result['product_desc'] . '</td>
                                    <td>' . $result['product_mfd'] . '</td>
                                    <td>' . $result['product_exp'] . '</td>
                                    <td>' . $result['product_gst'] . '</td>
                                    <td>' . $result['product_gst_per'] . '</td>                                   
                                    <td class="text-center"> <a href=' . base_url() . 'stock/edit_product/' . $result['id'] . '><span class="glyphicon glyphicon-pencil"></span></a></td>
                                    <td class="text-center"> <a><span class="glyphicon glyphicon-trash text-danger delete" data-id=' . $result['id'] . '></span></a></td>
                                    </tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</div>
<?php
$this->load->view('footer');
$this->load->view('end_html');
?>

<!-- creating a model (dialog box for sure delete -->
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Confirm Delete
            </div>
            <div class="modal-body">
                Are you sure you want to Delete  ?
            </div>  
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a  id="sureDelete" class="btn btn-danger success">Delete</a>
            </div>
        </div>
    </div>
</div>

<script>
//function for calling conform delete(suere delete)
    $(document).on('click', '.delete', function () {
        //var url = <?php ?>
        //$('#sureDelete').attr(href,url)   //stock->Controller name and delete_stock_category->Function name
        var url = "<?php echo base_url() . 'stock/delete_product/' ?>";
        var Id = $(this).attr('data-id');
        var href = url + Id;
        $('#sureDelete').attr('href', href);
        $('#confirm-delete').modal('show');
    });
    //end for calling delete model (sure delete)
</script>
