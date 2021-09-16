


<?php $this->load->view('header_view');?>





<link href="<?php echo base_url() . 'assets/css/jquery-ui.min.css'; ?>" rel="stylesheet"/>
<script src="<?php echo base_url() . 'assets/js/moment.min.js'; ?>"></script>
<link href="<?php echo base_url() . 'assets/css/fullcalendar.print.css'; ?>" rel="stylesheet"  media='print' />
<link href="<?php echo base_url() . 'assets/css/fullcalendar.css'; ?>" rel="stylesheet"/>
<script src="<?php echo base_url() . 'assets/js/'; ?>jquery-ui.min.js"></script>
<script src="<?php echo base_url() . 'assets/js/fullcalendar.min.js'; ?>"></script> 
<script src="<?php echo base_url() . 'assets/js/jquery-ui.custom.min.js'; ?>"></script>
<style>
 .fc-sun {
    background-color: red ;
 }
</style>



<div class="container" >
 
        <section class="col-md-12">           
            <div class="row">
                <h1 class="page-title">Home <small>This is home page for Stock Management System</small></h1>
                <hr/>            
            </div>
        </section>
   
</div>
<?php 
$this->load->view('footer');
$this->load->view('end_html');
?>
