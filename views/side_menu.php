<div class="col-md-3" id="left-margin"><div class="side">
        <!--    bootstrap side menu start-->
        
        <!--------------------------------------------Quick Add------------------------------------------->
        
        <!---------------------------------------------------Quick Add END--------------------------------------------->
        <!---------------------------------------------------Quick Manage---------------------------------------------->
        <div class="panel panel-primary" id="quick-manage-program">
            <div class="panel-heading">
                <h3 class="panel-title">Quick Link <span class="glyphicon glyphicon-cog pull-right"></span></h3>
            </div>
            <ul class="nav nav-pills nav-tabs nav-stacked nav-sidebar accordion">
              <?php
              if ($this->check_permission->validate_permissions("unit", "manage", "") == 7) {
                    echo '<li class = "pending"><a href = "' . base_url() . 'unit/manage">Unit</a></li>';   
                }
                if ($this->check_permission->validate_permissions("department", "manage", "") == 7) {
                    echo '<li class = "pending"><a href = "' . base_url() . 'department/manage">Department</a></li>';
                }
                if ($this->check_permission->validate_permissions("employee", "manage", "") == 7) {
                    echo '<li class = "pending"><a href = "' . base_url() . 'employee/manage">Employee</a></li>';
                }
                if ($this->check_permission->validate_permissions("assets", "manage", "") == 7) {
                    echo '<li class = "pending"><a href = "' . base_url() . 'assets/manage">Assets</a></li>';
                }
                if ($this->check_permission->validate_permissions("vendor", "manage", "") == 7) {
                    echo '<li class = "pending"><a href = "' . base_url() . 'vendor/manage">Vendor</a></li>';
                }
                if ($this->check_permission->validate_permissions("category", "manage", "") == 7) {
                    echo '<li class = "pending"><a href = "' . base_url() . 'category/manage">Category</a></li>';
                }
                if ($this->check_permission->validate_permissions("lead", "manage", "") == 7) {
                    echo '<li class = "pending"><a href = "' . base_url() . 'lead/manage">Lead</a></li>';
                }
                if ($this->check_permission->validate_permissions("controls", "manage", "") == 7) {
                    echo '<li class = "pending"><a href = "' . base_url() . 'controls/manage">Control Points</a></li>';
                }
                if ($this->check_permission->validate_permissions("permissions", "manage", "") == 7) {
                    echo '<li class = "pending"><a href = "' . base_url() . 'permissions/manage/control_points-permission_groups">Manage Permission Groups</a></li>';
                }
                if ($this->check_permission->validate_permissions("roles", "manage", "") == 7) {
                    echo '<li class = "pending"><a href = "' . base_url() . 'roles/manage">Roles</a></li>';
                }
                if ($this->check_permission->validate_permissions("project", "manage", "") == 7) {
                    echo '<li class = "pending"><a href = "' . base_url() . 'project/manage">Projects</a></li>';
                }
                if ($this->check_permission->validate_permissions("module", "manage", "") == 7) {
                    echo '<li class = "pending"><a href = "' . base_url() . 'module/manage">Module</a></li>';
                }
                if ($this->check_permission->validate_permissions("task", "manage", "") == 7) {
                    echo '<li class = "pending"><a href = "' . base_url() . 'task/manage">Task</a></li>';
                }
                
              ?>
            </ul>
        </div>
        <!---------------------------------------------------Quick Manage END----------------------------------------->
        <!---------------------------------------------------Employee Attendance--------------------------------------->
        <div class="panel panel-primary" id="quick-manage-program">
            <div class="panel-heading">
                <h3 class="panel-title">Employee Attendance <span class="glyphicon glyphicon-th-list pull-right"></span></h3>
            </div>
            <ul class="nav nav-pills nav-tabs nav-stacked nav-sidebar accordion">
                <?php

                if ($this->check_permission->validate_permissions("attendance", "getlog", "") == 7) {
                    echo '<li class = "pending"><a href = "' . base_url() . 'attendance/getlog">Update Attendance</a></li>';
                }
                if ($this->check_permission->validate_permissions("attendance", "getworksummary", "") == 7) {
                    echo '<li class = "pending"><a href = "' . base_url() . 'attendance/getworksummary">Staff Work Summary</a></li>';
                }              
                ?>
            </ul>
        </div>
        <!-------------------------------------------------Employee Attendance Ends-------------------------------------->
        <!-------------------------------------------------Leads Search-------------------------------------->
        <div class="panel panel-primary" id="quick-manage-program">
            <div class="panel-heading">
                <h3 class="panel-title ">Quick Search <span class="glyphicon glyphicon-search pull-right"></span></h3>
            </div>
            <ul class="nav nav-pills nav-tabs nav-stacked nav-sidebar accordion ">
                <?php 
                if ($this->check_permission->validate_permissions("lead", "search", "") == 7) {
                    echo '<li class = "pending"><a href = "' . base_url() . 'lead/search">Search Lead</a></li>';
                }
                if ($this->check_permission->validate_permissions("task", "my_task_show", "") == 7) {
                    echo '<li class = "pending"><a href = "' . base_url() . 'task/my_task_show">My Task</a></li>';
                }
                ?> 
            </ul>
        </div>
        <!-------------------------------------------------Leads Search End--------------------------------->
        <!-------------------------------------------------Reporting -------------------------------------->
        <div class="panel panel-primary" id="quick-manage-program">
            <div class="panel-heading">
                <h3 class="panel-title ">Report(Time Management) <span class="glyphicon glyphicon-time pull-right"></span></h3>
            </div>
            <ul class="nav nav-pills nav-tabs nav-stacked nav-sidebar accordion ">
                <?php 
                
                if ($this->check_permission->validate_permissions("task", "task_report", "") == 7) {
                    echo '<li class = "pending"><a href = "' . base_url() . 'task/task_report">Task Report</a></li>';
                }
                if ($this->check_permission->validate_permissions("project", "project_report", "") == 7) {
                    echo '<li class = "pending"><a href = "' . base_url() . 'project/project_report">Project Report</a></li>';
                }
                if ($this->check_permission->validate_permissions("employee_report", "show_employee_report_page", "") == 7) {
                    echo '<li class = "pending"><a href = "' . base_url() . 'employee_report/show_employee_report_page">Employee Report</a></li>';
                }
                ?> 
            </ul>
        </div>
        <!-------------------------------------------------End Reporting--------------------------------->
    </div>
</div>
<script>
    $(document).ready(function () {
        $(".nav:not(:has(li))").each(function () {
            $(this).closest('#quick-manage-program').hide();
        });
    });

</script>
