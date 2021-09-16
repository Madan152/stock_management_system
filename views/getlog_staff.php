<?php
$this->load->view('header_view');
?>
<!-- Begin Body -->
<div class="container color">
    <div class="row footer-space">
        <?php
//        $this->load->view('side_menu');

        ?>
        <div class="col-md-12" id="right-margin">
            <div class="row banner">
                <h1 class="page-title">Staff Attendance.</h1>
                <hr>
            </div>
            <!--question type search form-->
             <form class="form-inline" role="form" action="<?php echo base_url() . "attendance/log"; ?>" method="post">
               
                 <div class="row" style="margin-left: 15px;">
                                <div class="col-md-12">
                                <div id ="select_level_outer">
                                        <div class= "level-div space-bootom unit_lable" id="leveldiv" style=" margin-left: -60px; display:none">
                                            <label for="" class="col-md-2 control-label"></label>
                                            <div class="col-md-4" style= "padding-bottom: 20px;">
                                                <select class="form-control node-select" name="department">

                                                </select>
                                            </div>
                                        </div>
                                    <div class="level-div1 space-bootom unit_lable" id="leveldiv1" style=" margin-left: -60px;">
                                            <label for="" class="col-md-2 control-label">Level-1 Unit</label>
                                            <div class="col-md-4" style= "padding-bottom: 20px;">
                                                <select class="form-control node-select" id="level1" name="department" required>
                                                    <?php  $filters[0]['id'] = "parent_id";
                                                            $filters[0]['value'] = 0;
                                                            echo $this->main_model->fill_select("department", "dept_name", $filters, 0); ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                <hr />
    <!-- Table content -->
    <div>
               <div class="input-group">
                   <label for="date" class="sr-only">Date</label>
                   <div class="input-group-addon">Date</div>
                   <input type="date" id="date" name="date" class="form-control">
               </div>
                
    <button class="btn btn-primary space-bootom" type="submit">Fetch</button>
    </div>
</form>
               
            </div>
      
    </div>
</div>
                
<script>
    var max_level = 1;
    var parent = 0;
    function createSelect(JSONtext, elementID, parentId) {
        var JSONobject = eval("(" + JSONtext + ")");
        var noOfChild = parseInt(JSONobject);
        //alert(noOfChild);
        if (noOfChild > 0) {
            var id = parseInt(parentId);
            $("#leveldiv").clone().appendTo("#select_level_outer");
            max_level++;
            $(".level-div").filter(':last').attr('id', "leveldiv" + max_level);
            $("#leveldiv" + max_level).find(".control-label").text("Level-" + max_level + " Unit");
            $("#leveldiv" + max_level).find(".control-label").attr('for', "level" + max_level);
            $("#leveldiv" + max_level).find(".node-select").attr('id', "level" + max_level);
            $("#leveldiv" + max_level).find(".node-select").attr('dept_name', "department");
            $("#leveldiv" + max_level).show();
            initiateAjax('department', 'parent_id', id, ['id', 'dept_name', 'parent_id', 'status'], fillNodeSelect, 'level' + max_level);
        }
    }

    function updateSelect(parentId) {
        requestAjax1('no_of_children', "department", parentId, createSelect);
    }

    function destroy_lower_select(levelId) {
        for (; max_level > levelId; ) {
            $("#leveldiv" + max_level).remove();
            max_level--;
        }
        reset_select_name_field();
    }

    function reset_select_name_field() {
        if (max_level > 1) {
            for (i = 1; i < max_level; i++) {
                $("#leveldiv" + i).find(".node-select").removeAttr('dept_name');
            }
        }
        $("#level" + max_level).attr('dept_name', "department");
    }

    $(document.body).on("change", ".node-select", function () {
        var selectId = $(this).attr("id");
        var level = parseInt(selectId.substring(5));
          //  alert(level);
        destroy_lower_select(level);
        if ($("#" + selectId)[0].selectedIndex != 0) {
            var getValue = parseInt($(this).val());
            parent = getValue;
            updateSelect(getValue);
        } else {

        }
    });

</script>
    <?php
    $this->load->view('footer');
    $this->load->view('end_html');
    
    ?>