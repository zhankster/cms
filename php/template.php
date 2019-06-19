<?php

// $el_hide = ".bwp-test{display:none}";

// if (isset($_GET['testuser'])){
//     $el_hide = "";
// }
$active_class = "bwp-active";


function print_header($css_lib, $active)
{
print  <<<HEADER
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>CMS Template</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/simple-sidebar.css" rel="stylesheet">

  <!-- Jquery Datatables css -->
  <link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
  <!-- <link href="vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet"> -->


  <!--Style for active tab-->
  <style>
    $active{
      background-color: darkgray;
      font-weight: bold;
    }
  </style>

  <!-- PLACEHOLDER FOR CSS CUSTOM SCRIPTS -->
  $css_lib



</head>

<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">BWP CMS</div>
      <div class="list-group list-group-flush">
        <a href="index.php" class="list-group-item list-group-item-action bg-light bwp-index ">Dashboard</a>
        <a href="customers.php" class="list-group-item list-group-item-action bg-light bwp-customers">Customers</a>
        <a href="#" class="list-group-item list-group-item-action bg-light bwp-overview">Overview</a>
        <a href="#" class="list-group-item list-group-item-action bg-light bwp-events">Events</a>
        <a href="#" class="list-group-item list-group-item-action bg-light bwp-profile">Profile</a>
        <a href="#" class="list-group-item list-group-item-action bg-light status">Status</a>
        <a href="sql.php" class="list-group-item list-group-item-action bg-light bwp-test bwp-sql">SQL</a>
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle">Toggle Menu</button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Dropdown
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Something else here</a>
              </div>
            </li>
          </ul>
        </div>
      </nav>


      <div class="container-fluid">
      <!-- Page Content -->

      <!-- Modal -->
      <div class="modal" id="modErr">
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Modal Heading</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body" id="txtModErr">
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>

        </div>
      </div>
    </div>
HEADER;
}

function print_footer($js_lib)
{
print <<<FOOTER
      </div>
    </div>
    <!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Jquery Datatbles -->
  <script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
  <script src="js/env.js"></script>

  <!-- PLACEHOLDER FOR JS CUSTOM SCRIPTS -->
    $js_lib

  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function (e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>

</body>

</html>
FOOTER;
}
?>