<?php
/* ===============================================================================
  Created By:MADAN KUMAR VISHWAKARMA
  Created Date:22-07-2021
  File Purpose:This view is used for add product
  Main Decription:This view is used for add product
  Modify By:MADAN KUMAR VISHWAKARMA
  Modify Date:
  What Modify:UI fields enlargement
  Last Modify:21/July/2021
  =============================================================================== */
$this->load->view('header_view');
$this->load->model('stock_model');
$this->load->model('main_model');
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
              Edit Product <small> In this category you can edit product information.</small>
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    Edit basic information of product
                </div>
                <div class="panel-body">
                    <form class="" role="form" action="<?php echo base_url() . 'stock/save_product' ?>" method="post">

    <div class="row">

        <div class="col-lg-4">
            <div class="form-group">   <!-- here hidden input given for 'id' of 'product_table' 
                                        at the clicking of 'Update' button  -->
                <input type="hidden" name="id" value=<?php echo $user['id'];?>>           
                <label for = "productcategorytype" class="control-label">Product Category <font color="#FF0000">*</font></label>
                <select name="category_id" class="form-control">
                                        <!--fetching records from 'stock_category' table and put into <select> dropdown list -->
                                    <?php                                    
                                         foreach($rec as $col)  //it comes from 'stock/add_product()'
                                         {   
                                             if($col['id']==$user['category_id'])  {                        
                                           echo '<option value='.$col['id'].' selected>'.$col['category_name'].'</option>';
                                             }
                                             else{
                                                echo '<option value='.$col['id'].' >'.$col['category_name']. '</option>';
                                             }
                                         }?>
                                    </select>
            </div>                                                                                               <!-- this is used at the time of
                                                                                    editing or fetching the data from the table 'product_table' -->                                  
        </div>                                                                                                                                          

        <div class="col-lg-4">
            <div class="form-group">
                <label for = "productname" class="control-label">Product Name <font color="#FF0000">*</font></label>
                <input type="text" class="form-control" placeholder="Product category" name="product_name" value="<?php echo $user['product_name'];?>" required="required">
            </div>
        </div>   
        <div class="col-lg-4">
                                <div class="form-group">
                                    <label for = "productid" class="control-label">Product ID <font color="#FF0000">*</font></label>
                                    <input type="text" class="form-control" placeholder="Product id" name="product_id" value="<?php echo $user['product_id'];?>" required="required">
                                </div>
                            </div>   
        
     </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label for = "productmrp" class="control-label">Product MRP<font color="#FF0000">*</font></label>
                <input type="text" class="form-control" rows="3" placeholder="Product MRP" name="product_mrp" id="product_mrp" value="<?php echo $user['product_mrp'];?>">
            </div>
        </div>                                
        <div class="col-lg-4">
                <div class="form-group">
                    <label for = "productcp" class="control-label">Product CP<font color="#FF0000">*</font></label><br>
                    <input type="text" class="form-control" rows="3" placeholder="Product CP" name="product_cp" id="product_cp" value="<?php echo $user['product_cp'];?>" oninput="cal()">
                </div>
        </div>

        <div class="col-lg-4">
                <div class="form-group">
                    <label for = "productsp" class="control-label">Product SP<font color="#FF0000">*</font></label>
                    <input type="text" class="form-control" rows="3" placeholder="Product SP" name="product_sp" id="product_sp" value="<?php echo $user['product_sp'];?>" >
            
                </div>
         </div>
        
    </div>
    <div class="row">
        <div class="col-lg-4">
             <div class="form-group">
                <label for = "productdesc" class="control-label">Product Descrition <font color="#FF0000">*</font></label>
                    <textarea type="text" class="form-control" rows="3" placeholder="Product description" name="product_desc"  required="required"><?php echo $user['product_desc'];?>               
                </textarea>
            </div>
        </div>  
        <div class="col-lg-4">
            <div class="form-group">
                <label for = "mfd" class="control-label">Manufacture Date <font color="#FF0000">*</font></label>
                <input type="text" class="form-control date-picker" id="date"  name="product_mfd" value="<?php echo $user['product_mfd'];?>" required="required">
                                   
            </div>
        </div>  
        <div class="col-lg-4">
            <div class="form-group">
                 <label for = "expirydate" class="control-label">Expiry Date <font color="#FF0000">*</font></label>
                <input type="text" class="form-control date-picker"  id="date" name="product_exp" value="<?php echo $user['product_exp'];?>" required="required">
             </div>
        </div>  
     </div>
                        <div class="row">
                              <div class="col-lg-6">
                                <div class="form-group">
                                    <label for = "gst" class="control-label">GST Type <font color="#FF0000">*</font></label>
                                    <select  class="form-control"  name="product_gst" value="" required="required">
                                         
                                        <option value="CGST/SCGT" <?php if($user['product_gst']=="CGST/SCGT") echo 'selected="selected"'; ?> >CGST/SCGT</option>
                                        <option value="IGST" <?php if($user['product_gst']=="IGST") echo 'selected="selected"'; ?> >IGST</option>
                                    </select>                                  
                                </div>
                             </div> 
                             <div class="col-lg-6">
                                    <div class="form-group">
                                    <label for = "gstper" class="control-label">GST Percentage <font color="#FF0000">*</font></label>
                                    <select class="form-control"  name="product_gst_per" value="<?php echo $user['product_gst_per'];?>" required="required">
                                    
                                        <option value="0" <?php if($user['product_gst_per']=="0") echo 'selected="selected"'; ?>>0</option>
                                        <option value="5" <?php if($user['product_gst_per']=="5") echo 'selected="selected"'; ?>>5</option>
                                        <option value="12" <?php if($user['product_gst_per']=="12") echo 'selected="selected"'; ?>>12</option>
                                        <option value="18" <?php if($user['product_gst_per']=="18") echo 'selected="selected"'; ?>>18</option>
                                        <option value="28" <?php if($user['product_gst_per']=="28") echo 'selected="selected"'; ?>>28</option>
                                     </select>
                                    </div>
                                </div>  
                             

                         </div>

       
                    
</div>
  <center> <button type="submit" id="submit" class="btn btn-primary">Update</button></center>
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

 <!-- product_cp*product_unit=Total  using javascript-->
<script>
    function cal()
     {
        var product_cp = document.getElementById('product_cp').value; 
        var product_unit = document.getElementById('product_unit').value;
        var product_total = document.getElementById('product_total'); 
        var myResult = product_cp * product_unit;
        document.getElementById('product_total').value = myResult;

    }
</script>   
<!-- for date picker control-->
<script>
$('.date-picker').datepicker({
            dateFormat: "dd-mm-yy",
            altField: "#date_to",
            altFormat: "yy-mm-dd"
        });


</script>