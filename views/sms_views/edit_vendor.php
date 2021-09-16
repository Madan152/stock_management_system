<?php $this->load->view('header_view'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                Edit Vendor <small> In this category you can edit vendor information.</small>
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    Edit basic information of vendor(party).
                </div>
                <div class="panel-body">
                    <form action="<?php echo base_url(); ?>stock/set_vendor" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value = "<?php echo $user['id']; ?>">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="vendor_name">Vendor Name <font color="red">*</font></label>
                                    <input type="text" class="form-control" required id="vendor_name" name="vendor_name" value="<?php echo  $user['vendor_name']; ?>" placeholder="Vendor name">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="contact_person">Contact Person</label>
                                    <input type="text" class="form-control" id="contact_person" name="contact_person" placeholder="Contact person" value="<?php echo $user['contact_person']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="contact_number">Contact No</label>
                                    <input type="text" class="form-control" id="contact_number" maxlength="10" name="contact_number" value="<?php echo $user['contact_number']; ?>" placeholder="Contact number">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <textarea class="form-control" rows="3" id="address" name="address" placeholder="Address"><?php echo $user['address']; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label" for="email">Email</label>
                                    <input type="email" placeholder="Email" id="email" class="form-control" name ="email" value="<?php echo$user['email']; ?>">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="website">Website</label>
                                    <input type="text" class="form-control" id="website" name="website" value="<?php echo $user['website']; ?>" placeholder="website">
                                </div>
                            </div>
                        </div>
                       <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label" for="image_file">Image</label><br> 
                                    <div class="col-sm-10">
                                       <img height="75px" width="75px" src="<?php
                                       echo (base_url() . '/assets/img/uploads/');
                                        if ($user['image_file'] == '') {
                                            echo 'no-image.jpg';
                                        } else {
                                            echo $user['image_file'];
                                        }
                                        ?>  "/>  
                                       <input type="file" id="image_file" name="image_file"><p class="help-block"></p>  
                                    
                                </div>
                            </div>
                        </div>
                        <button type="submit" id="submit" class="btn btn-primary">Submit</button>
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
   