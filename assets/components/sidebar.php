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
                  ><i class="mdi mdi-book-open-page-variant"></i
                  ><span class="hide-menu">Schools</span></a
                >
              </li>
              <?php
                   }
              ?>

              <?php
               if ($_SESSION['role_name'] == 'Admin'){
              ?>
              <li class="sidebar-item">
                <a
                  class="sidebar-link waves-effect waves-dark sidebar-link"
                  href="departments.php"
                  aria-expanded="false"
                  ><i class="mdi mdi-folder-multiple"></i
                  ><span class="hide-menu">Departments</span></a
                >
              </li>
              <?php
                   }
              ?>
              <?php
               if ($_SESSION['role_name'] == 'Admin'){
              ?>
              <li class="sidebar-item">
                <a
                  class="sidebar-link waves-effect waves-dark sidebar-link"
                  href="courses.php"
                  aria-expanded="false"
                  ><i class="mdi mdi-school"></i
                  ><span class="hide-menu">Courses</span></a
                >
              </li>
              <?php
                   }
              ?>
              <?php
               if ($_SESSION['role_name'] == 'Admin'){
              ?>
              <li class="sidebar-item">
                <a
                  class="sidebar-link waves-effect waves-dark sidebar-link"
                  href="units.php"
                  aria-expanded="false"
                  ><i class="mdi mdi-vector-square"></i
                  ><span class="hide-menu">Units</span></a
                >
              </li>
              <?php
                   }
              ?>
              <?php
                if ($_SESSION['role_name'] == 'Admin'){
              ?>
              <li class="sidebar-item">
                <a
                  class="sidebar-link waves-effect waves-dark sidebar-link"
                  href="academic-year.php"
                  aria-expanded="false"
                  ><i class="mdi mdi-calendar-range"></i
                  ><span class="hide-menu">Academic Year</span></a
                >
              </li>
              <?php
                   }
              ?>
                 <?php
               if ($_SESSION['role_name'] == 'Admin'){
              ?>
              <li class="sidebar-item">
                <a
                  class="sidebar-link waves-effect waves-dark sidebar-link"
                  href="semesters.php"
                  aria-expanded="false"
                  ><i class="mdi mdi-timetable"></i
                  ><span class="hide-menu">Semesters</span></a
                >
              </li>
              <?php
                   }
              ?>
              <?php
                if ($_SESSION['role_name'] == 'Admin'){
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
              <?php
                   }
              ?>
           
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