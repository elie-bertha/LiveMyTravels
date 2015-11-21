<!DOCTYPE html>
<html>
    <head>
      <!-- Latest compiled and minified CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"> 
      <!-- Optional theme -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">  
      <!--<link rel="stylesheet" href="css/ui.jqgrid.css">  -->
      <link rel="stylesheet" href="css/ui.jqgrid-bootstrap.css"> 
      <!--<link rel="stylesheet" href="css/ui.jqgrid-bootstrap-ui.css">     -->
      <!-- Latest compiled and minified JavaScript -->
      <script src="js/jquery-1.11.0.min.js"></script>
      <script src="js/grid.locale-en.js"></script>
      <script src="js/jquery.jqGrid.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
      <title>Our Project</title>
      <script> 
        $.jgrid.defaults.responsive = true;
        $.jgrid.defaults.styleUI = 'Bootstrap';
        $.jgrid.styleUI.Bootstrap.base.rowTable = "table table-bordered table-striped";
        $(document).ready(function () {
          $("#tableUsers").jqGrid({
          url: 'users.json',
          editurl: 'clientArray',
          datatype: "json",
          colModel: [
              { label: 'ID', name: 'id', width: 20, formatter:'integer' },
              { label: 'First Name', name: 'firstname', width: 90, editable:true },
              { label: 'LastName', name: 'lastname', width: 90, editable:true  },
              { label: 'Email', name: 'email', width: 120, editable:true,formatter: 'email' },
              // sorttype is used only if the data is loaded locally or loadonce is set to true
              { label: 'Admin', name: 'is_admin', width: 30, editable:true,formatter: 'checkbox' },
              { label: 'Activated', name: 'is_activated', width: 45, editable:true,formatter: 'checkbox' },
              { label: 'Creation Date', name: 'create_date', width: 75},              
            ],
            width: 1024,
            rowNum: 30, 
            loadonce: true,// this is just for the demo
            pager: "#jqGridPager"
          });

          $('#tableUsers').navGrid("#jqGridPager", {edit: false, add: false, del: false, refresh: false, view: false});
          $('#tableUsers').inlineNav('#jqGridPager',
              // the buttons to appear on the toolbar of the grid
              { 
                  edit: true, 
                  add: true, 
                  del: true, 
                  cancel: true,
                  refresh: true,
                  editParams: {
                      keys: true,
                  },
                  addParams: {
                      keys: true
                  }
              });
        });
      </script>
  </head>
  <body>
    <?php
      include_once 'menubar.php';
      include_once 'database_connection.php';
      include_once 'user.php';
      getUsers();
    ?>
    <div>
      <!-- Nav tabs -->
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#userManagement" aria-controls="userManagement" role="tab" data-toggle="tab">User Management</a></li>
        <li role="presentation"><a href="#journeyManagement" aria-controls="journeyManagement" role="tab" data-toggle="tab">Journey Management</a></li>
        <li role="presentation"><a href="#pictureManagement" aria-controls="pictureManagement" role="tab" data-toggle="tab">Picture Management</a></li>
      </ul>

      <!-- Tab panes -->
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade in active" id="userManagement">
          <table id="tableUsers"></table>
          <div id="jqGridPager"></div>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="journeyManagement">

        </div>
        <div role="tabpanel" class="tab-pane fade" id="pictureManagement">

        </div>
      </div>
    </div>
  </body>
</html>