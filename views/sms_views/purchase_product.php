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
                Purchase Product <small> In this category you can add  Purchase Product information.</small>
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    Add basic information of  Purchase Product
                </div>
                <div class="panel-body">
                    <form class="" role="form" action="<?php echo base_url() . 'stock/save_purchase_product' ?>" method="post">

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for = "product_name" class="control-label">Product Name <font color="#FF0000">*</font></label>
                                    <select name="p_id" id="p_id" class="form-control" required="required">
                                        <!--fetching records from 'product_table' table and put into <select> dropdown list -->
                                        <option value="NULL">---select product name---</option>
                                    <?php                                    
                                         foreach($rec as $col1)  //it comes from 'stock/purchase_product()'
                                         {                                           
                                           echo '<option  value='.$col1['id'].'>'.$col1['product_name'].'</option>';
                                         }?>
                                    </select>
                                </div>
                            </div>
                           
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for = "vendorname" class="control-label">Vendor Name <font color="#FF0000">*</font></label>
                                    <select name="v_id" id="v_id" class="form-control" >
                                        <!--fetching records from 'stock_vendor' table and put into <select> dropdown list -->
                                        <option value="NULL">---select vendor name---</option>
                                    <?php                                    
                                         foreach($stockvendor as $col2)  //it comes from 'stock/purchase_product()'
                                         {                             
                                           echo '<option value='.$col2['id'].' >'.$col2['vendor_name'].'</option>';
                                         }?>
                                    </select>
                                </div>
                            </div>  
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for = "productmrp" class="control-label">Product MRP <font color="#FF0000">*</font></label>
                                    <input type="number" name="product_mrp" id="product_mrp" 
                                    value="" 
                                    class="form-control" >
                                </div>
                            </div>                          
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for = "productsp" class="control-label">Product SP <font color="#FF0000">*</font></label>
                                    <input type="number" name="product_sp" id="product_sp" value="" class="form-control">
                                </div>
                            </div>  
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for = "productcp" class="control-label">Product CP <font color="#FF0000">*</font></label>
                                    <input type="number" name="product_cp" id="product_cp" value="" class="form-control">
                                </div>
                            </div>                          
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for = "productunit" class="control-label">Product Unit <font color="#FF0000">*</font></label>
                                    <input type="number" name="product_unit" id="product_unit" value="" class="form-control"  oninput="cal()" required="required"><!-- 'oninput' is used whenever we have to do particular task using function then we can use 'oninput' attrribute , definition of cal() function is given below -->
                                </div>
                            </div>  
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for = "producttotal" class="control-label">Product Total <font color="#FF0000">*</font></label>
                                    <input type="number" name="product_total" id="product_total" value="" class="form-control">
                                </div>
                            </div> 
                        

                        
                 
                          <center> <button type="submit" id="submit" class="btn btn-primary">Save</button></center>
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
    //for on changing projects get all modules according to project id
    $(document).ready(function () {
        $('#p_id').change(function () {
            var product_id = $('#p_id').val();
            //alert(product_id );

            if(product_id!='---select product name---'){
                $.ajax({
                url: "<?php echo base_url() . 'stock/fill_product_details/'; ?>",// sending
                type: 'POST',   // sending             
                datatype:'json',// 
                data: {
                    product_id: product_id // sending

                },
                success: function (result) // receiving all results in 'result' 
                {
                    //alert(data);   
                    const obj = JSON.parse(result); // Very useful here 'data' is converted
                    // Display Contents of data on the console 
                    // console.log(obj[0].id); 
                    // console.log(obj[0].product_mrp); 
                    // console.log(obj[0].product_sp); 
                    // console.log(obj[0].product_cp); 

                    // Putting the value in the html by using their id    
                    document.getElementById('product_mrp').value=obj[0].product_mrp;
                    document.getElementById('product_sp').value=obj[0].product_sp;
                    document.getElementById('product_cp').value=obj[0].product_cp;
                   
                    
                },
                error: function () {

                    alert("ajax error");
                }
            });
            }else{
                    document.getElementById('product_mrp').value='';
                    document.getElementById('product_sp').value='';
                    document.getElementById('product_cp').value='';
                    document.getElementById('vendor_id').value='---select vendor name---';
            }
            //destroy_lower_select(project_id);
        });
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





<script>
$('.date-picker').datepicker({
            dateFormat: "dd-mm-yy", 
            altField: "#date_to",
            altFormat: "yy-mm-dd"
        });


</script>
