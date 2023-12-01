<?php
include("header.php")
?>
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-dark">
    <div class="container">
      <a href="#" class="navbar-brand">
        <img src="./assets/image/logo.png" alt="ACRL Logo" class="brand-image img-circle elevation-3" style="opacity: .8; margin-right: 15px;">
        <span class="brand-text font-weight-light">ACRL</span>
      </a>
    <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation";>
      <span class="navbar-toggler-icon"></span>
    </button>
      <div class="collapse navbar-collapse order-3" id="navbarCollapse" style="text-align: center;">
        <!-- Left navbar links -->
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a href="#" class="nav-link" data-toggle="modal" data-target="#loginModal">Login</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link" data-toggle="modal" data-target="#loginModal">About Us</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</div>
<?php
include("modals.php")
?>
<!-- /.navbar -->
<?php
include("footer.php")
?>
