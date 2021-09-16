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
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
              Edit Stock Category <small> In this category you can edit stock category information.</small>
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    Edit basic information of stock
                </div>
                <div class="panel-body">
                    <form class="" role="form" action="<?php echo base_url() . 'stock/save_stock_category' ?>" method="post">

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input type="hidden" name="id" value=<?php echo $user['id']?>>
                                    <label for = "name" class="control-label">Stock category Name <font color="#FF0000">*</font></label>
                                    <input type="text" class="form-control" placeholder="Stock category name" name="category_name" value="<?php echo $user['category_name'];?>" required="required">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for = "description" class="control-label">Stock category Type</label>
                                    <select name="category_type" id="category_type" class="form-control" value="">
                                     <?php 
                                         //$this->load->model('stock_model');
                                            echo $this->stock_model->fill_stock_category($user['category_type']);
                                        ?>
                                    </select>
                                </div>
                            </div>

                            

                        </div>
                        <div class="row">

                        <div class="col-lg-6">
                                <div class="form-group">
                                    <label for = "description" class="control-label">Stock category Description</label>
                                    <textarea 
                                        class="form-control" rows="3" placeholder="Stock category description" name="category_desc"
                                        value=""
                                        id="category_desc"

                                    ><?php echo $user['category_desc'];?></textarea>
                                    
                                </div>
                            </div>
                            <!-- <div class="col-lg-6">
                                <div class="form-group">
                                    <label for = "status" class="control-label">Current-status</label><br>
                                    <label class="radio-inline"><input type="radio" name="status" value="Active" checked>Active</label>
                                    <label class="radio-inline"><input type="radio" name="status" value="Inactive">Inactive</label>
                                </div>
                            </div> -->

        <!--Cndition written in radio button used at the time of updation to set the exact value -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for = "status" class="control-label">Current-status</label><br>
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="Active" <?php if($user['status']=="Active"){echo "checked";}?>>Active</label>
                                    <label class="radio-inline">
                                        <input <?php if($user['status']=="Inactive"){echo "checked";}?> type="radio" name="status" value="Inactive">Inactive</label>
                                </div>
                            </div>
                            
                            
                    
                           

                            

                               
                                            
                        </div>
                          <center> <button type="submit" id="submit" name="submit" class="btn btn-primary">Update</button></center>
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