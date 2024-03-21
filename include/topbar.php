 <!-- top navbar start -->
 <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <!-- offcanvas trigger start -->
        <button
          class="navbar-toggler me-2"
          type="button"
          data-bs-toggle="offcanvas"
          data-bs-target="#offcanvasExample"
          aria-controls="offcanvasExample"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <!-- offcanvas trigger end -->
        <a
          class="navbar-brand text-uppercase fw-bold text-uppercase me-auto"
          href="<?php echo base_url?>dashboard.php"
          >WOF Library</a
        >
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <form class="d-flex ms-auto" role="search">
            <div class="input-group">
              <input
                type="text"
                class="form-control"
                placeholder="Search"
                aria-describedby="button-addon2"
              />
              <button
                class="btn btn-outline-secondary btn-primary text-white"
                type="button"
                id="button-addon2"
              >
                <i class="fa-solid fa-magnifying-glass"></i>
              </button>
            </div>
          </form>
         
          <ul class="navbar-nav mb-2 mb-lg-0">
          
            <li class="nav-item dropdown">
            
              <a
                class="nav-link dropdown-toggle"
                href="#"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
              <img src="<?php echo base_url . 'assets/images/'?>user.png" class="user-icon"></img>
                Hi <?php echo $_SESSION['user']['name'] ?>
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="<?php echo base_url ?>my-profile.php">My Profile</a></li> 
                <li><a class="dropdown-item" href="<?php echo base_url ?>my-profile.php">Change Password</a></li>
                <li><hr class="dropdown-divider" /></li>
                <li>
                  <a class="dropdown-item" href="<?php echo base_url ?>logout.php">Logout</a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- top navbar end -->