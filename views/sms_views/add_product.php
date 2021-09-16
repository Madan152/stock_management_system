<?php
/* ===============================================================================
  Created By:DEWANGSHU PANDIT
  Created Date:old
  File Purpose:This view is used for add project
  Main Decription:This view is used for add project
  Modify By:Dewangshu Pandit
  Modify Date:
  What Modify:UI fields enlargement
  Last Modify:14/Sep/16
  =============================================================================== */
$this->load->view('header_view');
$this->load->model('main_model');


?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                Add Product <small> In this category you can add Product information.</small>
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    Add basic information of product
                </div>
                <div class="panel-body">
                    <form class="" role="form" action="<?php echo base_url() . 'stock/save_product' ?>" method="post">

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for = "productcategorytype" class="control-label">Product Category <font color="#FF0000">*</font></label>
                                    <select name="category_id" class="form-control">
                                        <!--fetching records from 'stock_category' table and put into <select> dropdown list -->
                                    <?php                                    
                                         foreach($rec as $col)  //it comes from 'stock/add_product()'
                                         {                             
                                           echo '<option value='.$col['id'].' >'.$col['category_name'].'</option>';
                                         }?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for = "productname" class="control-label">Product Name <font color="#FF0000">*</font></label>
                                    <input type="text" class="form-control" placeholder="Product category" name="product_name" value="" required="required">
                                </div>
                            </div>  
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for = "productid" class="control-label">Product ID <font color="#FF0000">*</font></label>
                                    <input type="text" class="form-control" placeholder="Product id" name="product_id" value="" required="required">
                                </div>
                            </div>  
                            
                            

                        </div>
                        

                        <div class="row"> 
                        <div class="col-lg-4">
                                <div class="form-group">
                                    <label for = "productmrp" class="control-label">Product MRP<font color="#FF0000">*</font></label>
                                    <input type="number" class="form-control" rows="3" placeholder="Product MRP" name="product_mrp" id="product_mrp">
                                    
                                </div>
                            </div>                          
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for = "productcp" class="control-label">Product CP<font color="#FF0000">*</font></label><br>
                                    <input type="number" class="form-control" rows="3" placeholder="Product CP" name="product_cp" id="product_cp" oninput="cal()">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for = "productsp" class="control-label">Product SP<font color="#FF0000">*</font></label>
                                    <input type="number" class="form-control" rows="3" placeholder="Product SP" name="product_sp" id="product_sp">
                                    
                                </div>
                            </div>
                                   
                        </div>  

                         
                            <div class="row">
                              <div class="col-lg-4">
                                <div class="form-group">
                                    <label for = "productdesc" class="control-label">Product Descrition <font color="#FF0000">*</font></label>
                                    <textarea type="text" class="form-control" placeholder="Product description" name="product_desc" value="" required="required">
                                    </textarea> 
                                </div>
                             </div> 
                             <div class="col-lg-4">
                                <div class="form-group">
                                    <label for = "mfd" class="control-label">Manufacture Date <font color="#FF0000">*</font></label>
                                    <input type="text" class="form-control "  name="product_mfd"  value="<?php echo date('d-m-Y'); ?>" required="required">
                                   
                                </div>
                             </div>  
                             <div class="col-lg-4">
                                <div class="form-group">
                                    <label for = "expirydate" class="control-label">Expiry Date <font color="#FF0000">*</font></label>
                                    <input type="text" class="form-control date-picker"  name="product_exp"  value="<?php echo date('d-m-Y'); ?>" required="required">
                                </div>
                             </div>   

                            </div>

                            <div class="row">
                              <div class="col-lg-6">
                                <div class="form-group">
                                    <label for = "gst" class="control-label">GST Type <font color="#FF0000">*</font></label>
                                    <select  class="form-control"  name="product_gst" value="" required="required">
                                        <option>...select GST type...</option>
                                        <option>CGST/SCGT</option>
                                        <option>IGST</option>  
                                    </select>                                  
                                </div>
                             </div> 
                             <div class="col-lg-6">
                                    <div class="form-group">
                                    <label for = "gstper" class="control-label">GST Percentage <font color="#FF0000">*</font></label>
                                    <select class="form-control"  name="product_gst_per" value="" required="required">
                                    <option>...select percentage...</option>
                                        <option>0</option>
                                        <option>5</option>
                                        <option>12</option>
                                        <option>18</option>
                                        <option>28</option>
                                     </select>
                                    </div>
                                </div>  
                             

                            </div>


                               
                                            
                 
                          <center> <button type="submit" id="submit" class="btn btn-primary">Add</button></center>
                    </form>


            </div>
        </div>
    </div>
</div>
</div>

<?php
$this->load->view('footer');
$this->load->view('end_html');
?>
<script>
        var docRows = 0;
        function cloneDocDiv() {
        $("#enclo_row").clone().appendTo("#enclosures_container");
        docRows++;
        var newId = "enclo_row" + docRows;
        var removeId = "removedoc" + docRows;
        $(".enclo_row").filter(':last').find(".technology").attr('id', "technology" + docRows);
        
        $(".enclo_row").filter(':last').find(".technology").attr('name', "technology[" + docRows + "][name]");
        
        $(".enclo_row").filter(':last').attr("id", newId);
        $(".enclo_row").filter(':last').find(".removedoc").attr("id", removeId);
        $(".enclo_row").filter(':last').attr("style", "");
    }

    function resetDocDivElementsAfterRemove(optionNumber) {
        var optNumber = parseInt(optionNumber);
        for (i = optNumber; i <= docRows; i++) {
            var targetIdNumber = i + 1;
            var newId = "enclo_row" + i;
            var removeId = "removedoc" + i;
        $(".enclo_row").filter(':last').find(".technology").attr('id', "technology" + i);
       
        $(".enclo_row").filter(':last').find(".technology").attr('name', "technology[" + i + "][name]");
               
        $('#' + 'enclo_row' + targetIdNumber).find(".removedoc").attr("id", removeId);
        $('#' + 'enclo_row' + targetIdNumber).attr("id", newId);
        }
    }
    function removeEnclo(e) {
        if (docRows <= 1) {
            return;
        }
        var divId = $(e).parent().parent().parent().attr('id');//alert(divId);
        var number = parseInt(divId.substring(9));
        $("#" + divId).remove();
        docRows--;
        if (number <= docRows) {//if removed div was not last one
            resetDocDivElementsAfterRemove(number);
        }
    }
    $(document).ready(function () {
        $('#addEnclo').click(function () {
            cloneDocDiv();
        });
        $('#addEnclo').trigger('click');
    });
    
    </script>




<script>
$('.date-picker').datepicker({
            dateFormat: "dd-mm-yy", 
            altField: "#date_to",
            altFormat: "yy-mm-dd"
        });


</script>