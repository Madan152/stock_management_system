<?php $this->load->view('header_view'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                Add Vendor <small> In this category you can add vendor information.</small>
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    Basic information of vendor(party).
                </div>
                <div class="panel-body">
                    <form action="<?php echo base_url(); ?>stock/set_vendor" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="vendor_name" class="required">Party Name <font color="red">*</font></label>
                                    <input type="text" class="form-control" id="vendor_name" name="vendor_name" placeholder="Party name" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="contact_person">Contact Person</label>
                                    <input type="text" class="form-control" id="contact_person" name="contact_person" placeholder="Contact person">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="contact_number">Contact No</label>
                                    <input type="text" class="form-control" id="contact_number" maxlength="10" name="contact_number" placeholder="Contact number">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <textarea class="form-control" rows="3" id="address" name="address" placeholder="Address"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label" for="email">Email</label>
                                    <input type="email" placeholder="Email" id="email" class="form-control" name ="email">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group"><label for="website">Website</label>
                                    <input type="text" class="form-control" id="website" name="website" placeholder="website">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                           <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label" for="image_file">Image</label>

                                    <input type="file" id="image_file" name="image_file"><p class="help-block">File size upto 2 MB</p>

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
   