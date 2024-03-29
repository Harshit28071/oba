<div class="sidebar">
  <!-- Sidebar user panel (optional) -->
  <div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
      <img src="../../../theme/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
    </div>
    <div class="info">
      <a href="#" class="d-block"><?php echo $_SESSION["s_username"]; ?></a>
    </div>
  </div>
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
      <li class="nav-item">
        <a href="/new/oba/accountant/pages/web/dashboard.php" class="nav-link">
          <i class="nav-icon fas fa-home"></i>
          <p>
            Dashboard
          </p>
        </a>
      </li>



      <li class="nav-item">
        <a href="/new/oba/accountant/pages/web/manage_product.php" class="nav-link">
          <i class="nav-icon fas fa-shopping-basket"></i>
          <p>
            All Products
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="/new/oba/accountant/pages/web/manage_customer.php" class="nav-link">
          <i class="nav-icon fas fa-users"></i>
          <p>
            All Customers
          </p>
        </a>
      </li>


      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-copy"></i>
          <p>
            GST Invoice
            <i class="fas fa-angle-left right"></i>
           
          </p>
        </a>
        <ul class="nav nav-treeview">
        <li class="nav-item">
            <a onclick="redirect('/new/oba/accountant/pages/web/create_gst_invoice.php')" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Create GST Invoice</p>
            </a>
          </li>
          <li class="nav-item">
            <a onclick="redirect('/new/oba/accountant/pages/web/all_gst_invoices.php?id=1&name=Agarwal')" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Agarwal GST Invoices</p>
            </a>
          </li>

          <li class="nav-item">
            <a onclick="redirect('/new/oba/accountant/pages/web/all_gst_invoices.php?id=2&name=Harihar')" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Harihar GST Invoices</p>
            </a>
          </li>
         
        </ul>
      </li>

      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-copy"></i>
          <p>
            Purchase
            <i class="fas fa-angle-left right"></i>
           
          </p>
        </a>
        <ul class="nav nav-treeview">
        <li class="nav-item">
            <a onclick="redirect('/new/oba/accountant/pages/web/add_purchase.php')" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Add Purchase</p>
            </a>
          </li>
          <li class="nav-item">
            <a onclick="redirect('/new/oba/accountant/pages/web/all_purchases.php?id=1&name=Agarwal')" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Agarwal Purchases</p>
            </a>
          </li>

          <li class="nav-item">
            <a onclick="redirect('/new/oba/accountant/pages/web/all_purchases.php?id=2&name=Harihar')" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Harihar Purchases</p>
            </a>
          </li>
         
        </ul>
      </li>


      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-copy"></i>
          <p>
            Invoice
            <i class="fas fa-angle-left right"></i>
           
          </p>
        </a>
        <ul class="nav nav-treeview">
        <li class="nav-item">
            <a onclick="redirect('/new/oba/accountant/pages/web/create_invoice.php')" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Create Invoice</p>
            </a>
          </li>
          <li class="nav-item">
            <a onclick="redirect('/new/oba/accountant/pages/web/all_invoices.php')" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>All Invoices</p>
            </a>
          </li>
         
        </ul>
      </li>



      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-shopping-basket"></i>
          <p>
            Orders
            <i class="fas fa-angle-left right"></i>
           
          </p>
        </a>
        <ul class="nav nav-treeview">
        <li class="nav-item">
            <a onclick="redirect('/new/oba/accountant/pages/web/create_order.php')" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Create Order</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/new/oba/accountant/pages/web/manage_order.php" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>All Orders</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/new/oba/accountant/pages/web/my_orders.php" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>My Orders</p>
            </a>
          </li>
         
        </ul>
      </li>



  
      <li class="nav-item">
        <a href="/new/oba/common/user_login.php" class="nav-link">
          <i class="nav-icon fas fa-sign-out-alt" aria-hidden="true"></i>
          <p>
            Logout
          </p>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.sidebar-menu -->
</div>