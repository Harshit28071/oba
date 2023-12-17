<div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../../theme/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION["s_username"];?></a>
        </div>
      </div>
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
           <li class="nav-item">
             <a href="dashboard.php" class="nav-link">
               <i class="nav-icon fas fa-home"></i>
               <p>
              Home
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Data Master
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./manage_role.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Role</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./manage_state.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage State</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./manage_city.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage City</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./manage_unit.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Unit</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./manage_category.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./manage_suffix.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Suffix</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="./manage_user.php" class="nav-link">
              <i class="nav-icon fas fa-user-edit"></i>
              <p>
              Manage User
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="./manage_firm.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
              Manage Firm
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="./manage_product.php" class="nav-link">
              <i class="nav-icon fas fa-shopping-basket"></i>
              <p>
              Manage Product
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="./manage_customer.php" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
              Manage Customer
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="./../../common/logout.php" class="nav-link">
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