<?php $this->load->view('header_view');?>

<div class="container" >
    <section class="col-md-9">
            <h3>Add user Account</h3>
            <form action="<?php echo base_url(); ?>main/user_set/users" method="post" enctype="multipart/form-data">
                <input type="hidden" name="staff_id" value="<?php echo $id;?>">
                <input type="hidden" name="password" value="<?php echo $password;?>">
                       <div class="row">
                           <div class="col-sm-9">
                               <div class="form-group required">
                                   <label class="col-sm-3 control-label" for="user_name">User Name</label>
                                   <div class="col-sm-9">
                                       <input type="text"  id="user_name" class="form-control" name="user_name" value="<?php echo $first_name.' '. $last_name;?>" required>
                                   </div>
                               </div>
                           </div>
                        </div>
                        
                <div class="row" id="top">
                            <div class="col-sm-9">
                                <div class="form-group required">
                                    <label class="col-sm-3 control-label" for="email">Email <small>primary</small></label>
                                    <div class="col-sm-9">
                                        <input type="email" placeholder="Email" id="email" class="form-control" name ="email" value="<?php echo $email;?>" required>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-sm-12" style="text-align: center" id="top">
                            <button class="btn btn-primary" type="button">
                               Save your password. your password is <span class="badge"><?php echo $password;?></span>
                            </button>
                            </div>
                        </div>
                <div class="row align_center_margin" id="top">
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
   