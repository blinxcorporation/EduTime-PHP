<aside class="left-sidebar" data-sidebarbg="skin5">
        <!-- Sidebar scroll-->
        <div class="scroll-sidebar">
          <!-- Sidebar navigation-->
          <nav class="sidebar-nav">
            <ul id="sidebarnav" class="pt-4">
              <li class="sidebar-item">
                <a
                  class="sidebar-link waves-effect waves-dark sidebar-link"
                  href="index.php"
                  aria-expanded="false"
                  ><i class="mdi mdi-view-dashboard"></i
                  ><span class="hide-menu">Dashboard</span></a
                >
              </li>
              <?php
                       if ($_SESSION['role_name'] == 'Admin'){
                        // display the HTML code if the session variable 'role_name' is set to 'Admin'
                        ?>
              <li class="sidebar-item">
                <a
                  class="sidebar-link waves-effect waves-dark sidebar-link"
                  href="schools.php"
                  aria-expanded="false"
                  ><i class="mdi mdi-school"></i
                  ><span class="hide-menu">Schools</span></a
                >
              </li>
              <?php
                   }
              ?>

              <?php
               if ($_SESSION['role_name'] == 'Admin' || $_SESSION['role_name'] == 'Dean'){
              ?>
              <li class="sidebar-item">
                <a
                  class="sidebar-link waves-effect waves-dark sidebar-link"
                  href="departments.php"
                  aria-expanded="false"
                  ><i class="mdi mdi-chair-school"></i
                  ><span class="hide-menu">Departments</span></a
                >
              </li>
              <?php
                   }
              ?>
              <?php
               if ($_SESSION['role_name'] == 'Admin' || $_SESSION['role_name'] == 'Dean'  || $_SESSION['role_name'] == 'Chairperson'){
              ?>
              <li class="sidebar-item">
                <a
                  class="sidebar-link waves-effect waves-dark sidebar-link"
                  href="courses.php"
                  aria-expanded="false"
                  ><i class="mdi mdi-book"></i
                  ><span class="hide-menu">Courses</span></a
                >
              </li>
              <?php
                   }
              ?>

              <li class="sidebar-item">
                <a
                  class="sidebar-link waves-effect waves-dark sidebar-link"
                  href="users.php"
                  aria-expanded="false"
                  ><i class="mdi mdi-account"></i
                  ><span class="hide-menu">Users</span></a
                >
              </li>
            
              <li class="sidebar-item">
                <a
                  class="sidebar-link waves-effect waves-dark sidebar-link"
                  href="admin.php"
                  aria-expanded="false"
                  ><i class="mdi mdi-security"></i
                  ><span class="hide-menu">Admins</span></a
                >
              </li>
              <li class="sidebar-item">
                <a
                  class="sidebar-link has-arrow waves-effect waves-dark"
                  href="javascript:void(0)"
                  aria-expanded="false"
                  ><i class="mdi mdi-receipt"></i
                  ><span class="hide-menu">Add Users</span></a
                >
                <ul aria-expanded="false" class="collapse first-level">
                  <li class="sidebar-item">
                    <a href="add-student.php" class="sidebar-link"
                      ><i class="mdi mdi-account"></i
                      ><span class="hide-menu"> Add Student</span></a
                    >
                  </li>
                  <li class="sidebar-item">
                    <a href="add-admin.php" class="sidebar-link"
                      ><i class="mdi mdi-account-circle"></i
                      ><span class="hide-menu"> Add Admin</span></a
                    >
                  </li>
              
                </ul>
              </li>
              <li class="sidebar-item">
                <a
                  class="sidebar-link waves-effect waves-dark sidebar-link"
                  href="budget.php"
                  aria-expanded="false"
                  ><i class="mdi mdi-wallet"></i
                  ><span class="hide-menu">Budget</span></a
                >
              </li>
              <li class="sidebar-item mt-4">
                <a
                  class="sidebar-link waves-effect waves-dark sidebar-link"
                  href="../logout.php"
                  aria-expanded="false"
                 style="color:red;font-weight:bold; font-size:20px" ><i class="mdi mdi-login-variant"></i
                  ><span class="hide-menu">LOGOUT</span></a
                >
              </li>
            </ul>
          </nav>
          <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
      </aside>