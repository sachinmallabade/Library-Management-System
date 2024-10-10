
    <!-- offcanvas start -->
    <div
      class="offcanvas offcanvas-start bg-dark text-white sidebar-nav"
      tabindex="-1"
      id="offcanvasExample"
      aria-labelledby="offcanvasExampleLabel"
    >
      <div class="offcanvas-body">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <div class="text-secondary small text-uppercase fw-bold">core</div>
          </li>

          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="<?php echo base_url?>dashboard.php">
              <i class="fa-solid fa-gauge me-1"></i> Dashboard</a
            >
          </li>

          <li class="nav-item my-0">
            <hr />
          </li>

          <li class="nav-item">
            <div class="text-secondary small text-uppercase fw-bold">
              inventory
            </div>
          </li>

          <li class="nav-item"></li>
          <a
            class="nav-link sidebar-link"
            data-bs-toggle="collapse"
            href="#booksMgmt"
            role="button"
            aria-expanded="false"
            aria-controls="booksMgmt"
          >
            <i class="fa-solid fa-book me-2"></i> Books Management
            <span class="right-icon float-end"
              ><i class="fa-solid fa-chevron-down"></i
            ></span>
          </a>
          <div class="collapse" id="booksMgmt">
            <div>
              <ul class="navbar-nav ps-3">
                <li>
                  <a href="<?php echo base_url ?>books/add-book.php" class="nav-link">
                    <i class="fa-solid fa-plus me-2"></i>Add New</a
                  >
                </li>
                <li>
                  <a href="<?php echo base_url ?>books" class="nav-link">
                    <i class="fa-solid fa-list-ul me-2"></i>Manage All</a
                  >
                </li>
              </ul>
            </div>
          </div>

          <li class="nav-item"></li>
          <a
            class="nav-link sidebar-link"
            data-bs-toggle="collapse"
            href="#studentMgmt"
            role="button"
            aria-expanded="false"
            aria-controls="studentMgmt"
          >
            <i class="fa-solid fa-users me-2"></i> Students Management
            <span class="right-icon float-end"
              ><i class="fa-solid fa-chevron-down"></i
            ></span>
          </a>
          <div class="collapse" id="studentMgmt">
            <div>
              <ul class="navbar-nav ps-3">
                <li>
                  <a href="<?php echo base_url ?>students/add-student.php" class="nav-link">
                    <i class="fa-solid fa-plus me-2"></i>Add New</a
                  >
                </li>
                <li>
                  <a href="<?php echo base_url ?>students" class="nav-link">
                    <i class="fa-solid fa-list-ul me-2"></i>Manage All</a
                  >
                </li>
              </ul>
            </div>
          </div>

          <li class="nav-item my-0">
            <hr />
          </li>

          <li class="nav-item">
            <div class="text-secondary small text-uppercase fw-bold">
              business
            </div>
          </li>

          <li class="nav-item"></li>
          <a
            class="nav-link sidebar-link"
            data-bs-toggle="collapse"
            href="#booksLoanMgmt"
            role="button"
            aria-expanded="false"
            aria-controls="booksLoanMgmt"
          >
            <i class="fa-solid fa-landmark me-2"></i> Books Loan
            <span class="right-icon float-end"
              ><i class="fa-solid fa-chevron-down"></i
            ></span>
          </a>
          <div class="collapse" id="booksLoanMgmt">
            <div>
              <ul class="navbar-nav ps-3">
                <li>
                  <a href="<?php echo base_url ?>loans/add-loan.php" class="nav-link">
                    <i class="fa-solid fa-plus me-2"></i>Add New</a
                  >
                </li>
                <li>
                  <a href="<?php echo base_url ?>loans" class="nav-link">
                    <i class="fa-solid fa-list-ul me-2"></i>Manage All</a
                  >
                </li>
              </ul>
            </div>
          </div>

          <li class="nav-item"></li>
          <a
            class="nav-link sidebar-link"
            data-bs-toggle="collapse"
            href="#subsMgmt"
            role="button"
            aria-expanded="false"
            aria-controls="subsMgmt"
          >
            <i class="fa-solid fa-indian-rupee-sign me-2"></i> Subscription
            <span class="right-icon float-end"
              ><i class="fa-solid fa-chevron-down"></i
            ></span>
          </a>
          <div class="collapse" id="subsMgmt">
            <div>
              <ul class="navbar-nav ps-3">
                <li>
                  <a href="<?php echo base_url ?>subscriptions" class="nav-link">
                    <i class="fa-solid fa-plus me-2"></i>Plans</a
                  >
                </li>
                <li>
                  <a href="<?php echo base_url ?>subscriptions/purchase-history.php" class="nav-link">
                    <i class="fa-solid fa-list-ul me-2"></i>Purchase History</a
                  >
                </li>
              </ul>
            </div>
          </div>

          <li class="nav-item my-0">
            <hr />
          </li>

          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="<?php echo base_url ?>logout.php">
              <i class="fa-solid fa-right-from-bracket me-2"></i>Logout</a
            >
          </li>
        </ul>
      </div>
    </div>

    <!-- offcanvas end -->