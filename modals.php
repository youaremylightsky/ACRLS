<?php
include("header.php")
?>
<!-- Modal for Login -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" style="background-color: rgba(0, 0, 0, 0.5);">
      <div class="modal-header" style="background-color: #3c8dbc; color: #fff;">
        <h5 class="modal-title" id="loginModalLabel">LOGIN</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="loginForm" action="login.php" method="POST">
          <div class="form-group">
            <label for="loginUsernameOrEmail">Username or Email</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
              </div>
              <input type="text" class="form-control" id="loginUsernameOrEmail" name="usernameOrEmail" placeholder="Username or Email" required>
            </div>
            <span class="text-danger" id="loginUsernameOrEmailError"></span>
          </div>

          <div class="form-group">
            <label for="loginPassword">Password</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
              </div>
              <input type="password" class="form-control" id="loginPassword" name="password" placeholder="Password" required>
            </div>
            <span class="text-danger" id="loginPasswordError"></span>
          </div>

          <!-- Add a hidden field to specify the login type (admin or user) -->
          <input type="hidden" id="loginType" name="loginType" value="user">

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="loginUserButton" class="btn btn-primary" onclick="login('user')"><i class="fas fa-sign-in-alt"></i> Login as User</button>
        <button type="button" id="loginAdminButton" class="btn btn-primary" onclick="login('admin')"><i class="fas fa-sign-in-alt"></i> Login as Admin</button>
        <button type="button" class="btn btn-success" onclick="openRegisterModal()"><i class="fas fa-user-plus"></i> Register</button>
      </div>
    </div>
  </div>
</div>
<!-- JavaScript for handling login type -->
<script>
  function login(type) {
    document.getElementById('loginType').value = type;
    document.getElementById('loginForm').submit();
  }
</script>
  <!-- Modal for Register -->
  <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" style="background-color: rgba(0, 0, 0, 0.5);">
        <div class="modal-header" style="text-align:center;">
          <h5 class="modal-title" id="registerModalLabel">REGISTER</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="returnToMainPage()">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="registrationForm" action="register.php" method="POST">
            <div class="form-row">
              <div class="col">
                <div class="form-group">
                  <label for="firstName">First Name</label>
                  <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name" required>
                  <span class="text-danger" id="firstNameError"></span>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="middleName">Middle Name (optional)</label>
                  <input type="text" class="form-control" id="middleName" name="middleName" placeholder="Middle Name">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="lastName">Last Name</label>
              <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last Name" required>
              <span class="text-danger" id="lastNameError"></span>
            </div>

            <div class="form-group">
              <label for="registerUsernameOrEmail">Username or Email</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-user"></i></span>
                </div>
                <input type="text" class="form-control" id="registerUsernameOrEmail" name="usernameOrEmail" placeholder="Username or Email" required>
              </div>
              <span class="text-danger" id="registerUsernameOrEmailError"></span>
            </div>

            <div class="form-group">
              <label for="contactNumber">Contact Number</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-phone"></i></span>
                </div>
                <input type="text" class="form-control" id="contactNumber" name="contactNumber" placeholder="Contact Number" required>
              </div>
              <span class="text-danger" id="contactNumberError"></span>
            </div>

            <div class="form-group">
              <label for="registerPassword">Password</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-lock"></i></span>
                </div>
                <input type="password" class="form-control" id="registerPassword" name="password" placeholder="Password" required>
              </div>
              <span class="text-danger" id="registerPasswordError"></span>
            </div>
            <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="returnToMainPage()">Close</button>
          <button type="submit" id="registerButton" class="btn btn-primary" onclick="disableButton()">Register</button>
          </form>
        </div>
        <div class="modal-footer">         
        </div>
      </div>
    </div>
  </div>
<?php
include("footer.php")
?>