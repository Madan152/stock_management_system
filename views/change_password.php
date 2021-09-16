<?php $this->load->view('header_view');?>

<div class="container" >
    <section class="col-md-9">
        <h1 class="page-title">Change password <small>In this category you can change password.</small></h1>
                <hr>
        
            <form action="<?php echo base_url(); ?>main/check_old_password" method="post" enctype="multipart/form-data">
                <div class="row">
                    
                    <div class="col-sm-2"></div>
                    <div class="form-group required" id="top">
                        <label class="col-sm-3 control-label" for="old_password">Current password</label>
                        <div class="col-sm-5">
                            <input type="password" placeholder="Current password" id="old_password" class="form-control" name="old_password" required>
                        </div>
                    </div>
                     <div class="col-sm-2"></div>
                </div>
            <div class="row">
                
                 <div class="col-sm-2"></div>
                <div class="form-group required" id="top">
                    <label class="col-sm-3 control-label" for="password">New password</label>
                    <div class="col-sm-5">
                        <input type="password" placeholder="New password" id="password" class="form-control" name ="password" required>
                    </div>
                </div>
                 <div class="col-sm-2"></div>
            </div> 
             <div class="row">
                
                 <div class="col-sm-2"></div>
                <div class="form-group required" id="top">
                    <label class="col-sm-3 control-label" for="password1">Re-enter password</label>
                    <div class="col-sm-5">
                        <input type="password" placeholder="same as new password" id="password1" class="form-control" name ="password1" required>
                    </div>
                </div>
                 <div class="col-sm-2"></div>
            </div> 
                
                    
              <div class="row align1 top1">
                        <div class="col-sm-12">
                            <input class="btn btn-primary" type="submit" value="Submit">
                        </div>
              </div>  
            </form>    
        </section>
   
</div>
<?php 
$this->load->view('footer');
$this->load->view('end_html');
?>
   