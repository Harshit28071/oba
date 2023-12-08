<?php
session_start();
require_once("../../common/database.php");
$db = new Database();
$conn = $db->connect();
if (!isset($_SESSION['s_username']) && $_SESSION["s_role"] != "4") {
  header("location:../admin/user_login.php");
}
//city select box
$quarycity = "SELECT id,name FROM city";
$stmt = $conn->prepare($quarycity);
$stmt->execute();
$stmt->bind_result($id, $cityname);
$options_city = "";

while ($stmt->fetch()) {

  $options_city .= "<option value='$id' >$cityname</option>";
}
//city select box close

?>
<!DOCTYPE html>
<html lang="en">
<?php require_once("./../common/mobile_layout/header.php"); ?>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="../../theme/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Navbar -->
    <?php
    require_once("./../common/mobile_layout/navbar.php") ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-12 text-center">

            </div>
            <!-- /.col -->
            <!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>

      <section class="content text-center ">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
          <div class="card card-primary align-middle">
            <div class="card-body">
              <form role="form">
                <div class="form-group">
                  <select class="form-control" id="city-value">
                    <option selected style="text-align: center;" value="">SELECT CITY </option>
                    <?php echo  $options_city ?>
                  </select><br>
                  <div class="form-group">
                    <select class="form-control" id="show-customer">
                      <option selected style="text-align: center;" value="">SELECT CUSTOMER </option>
                    </select> <br>
                    <div>
                      <div class="row">
                        <!--
<div class="col-6">
<button type="button" class="btn  btn-outline-danger btn-block">Auto Generate Order</button>
</div>-->
                        <div class="col-12">
                          <button type="button" onclick="selectOrderItems()" class="btn  btn-danger btn-block">Create Manual Order</button>
                        </div>
                      </div>
                      <br>
                      <b>OR</b>
                    </div><br>
                    <div><a href="./add_customer.php" id="add-cust"><button type="button" class="btn btn-info btn-block">Add New Customer</button></a></div><br>

                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </section>
    </div>


    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <?php require_once("./../common/mobile_layout/footer_links.php"); ?>
  <script src="../../js/salesman/createorder.js"></script>
  <script>
    $("#heading").text("Create Order");
    $("#three-dot").css("display", "none");
  </script>
</body>

</html>