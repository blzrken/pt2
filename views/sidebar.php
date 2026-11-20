<div id="mySidebar" class="col-auto bg-dark text-white offcanvas-lg offcanvas-start">
  <div class="p-4">
    <a href="<?= BASE_URL ?>" class="navbar-brand">
      <div class="row">
        <h5 class="">OmniRead Systems</h5>
      </div>
    </a>
    <hr>
    <ul class="mynav nav nav-pills flex-column">
      <li class="nav-item mb-3 mt-2">
        <a href="<?= BASE_URL ?>" class="text-decoration-none text-white">
          <i class="bi bi-house-fill me-2"></i> Home
        </a>
      </li>
      <li class="nav-item mb-3">
        <a href="<?= BASE_URL ?>" class="text-decoration-none text-white">
          <i class="bi bi-bar-chart-line-fill me-2"></i> Dashboard
        </a>
      </li>
      <li class="nav-item mb-3">
        <a href="<?= BASE_URL ?>productcontroller" class="text-decoration-none text-white">
          <i class="bi bi-tablet me-2"></i> Products
        </a>
      </li>
      <li class="nav-item mb-3">
        <a href="<?= BASE_URL ?>customercontroller" class="text-decoration-none text-white">
          <i class="bi bi-people-fill me-2"></i> Customers
        </a>
      </li>
      <li class="nav-item mb-3">
        <a href="<?= BASE_URL ?>staffcontroller" class="text-decoration-none text-white">
          <i class="bi bi-person-badge-fill me-2"></i> Staffs
        </a>
      </li>
      <li class="nav-item mb-3">
        <a href="<?= BASE_URL ?>ordercontroller" class="text-decoration-none text-white">
          <i class="bi bi-cart-fill me-2"></i> Orders
        </a>
      </li>
    </ul>
    <hr>
    <div class="dropdown">
      <a href="#" class="text-decoration-none text-white dropdown-toggle d-inline-block align-middle" data-bs-toggle="dropdown">
        <div class="rounded-circle bg-secondary text-center d-inline-block align-middle" style="width: 50px; height: 50px; line-height: 50px;">
          <i class="bi bi-person-fill text-white fs-4"></i>
        </div>
        <div class="d-inline-block align-middle ms-2 text-start">
          <h6 class="mb-0 text-nowrap">Lutfil Hadi</h6>
          <small class="text-white-50 text-nowrap d-block">a223536@siswa.ukm.my</small>
        </div>
      </a>
      <ul class="dropdown-menu dropdown-menu-end">
        <li><a class="dropdown-item" href="<?= BASE_URL ?>">Logout</a></li>
      </ul>
    </div>
  </div>
</div>
