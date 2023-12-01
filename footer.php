<!-- Main Footer -->
<footer class="main-footer text-center" style="color: white;">
  <!-- Default to the left -->
  <strong>Copyright &copy; 2023 <a href="#">Vivid Ventures</a>.</strong> All rights reserved.
</footer>

<!-- Function Scripts -->
<script>
  function openRegisterModal() {
    $('#loginModal').modal('hide'); // Hide the login modal
    $('#registerModal').modal('show'); // Show the register modal
  }
  function returnToMainPage() {
    $('#registerModal').modal('hide'); // Hide the register modal
    window.location.href = 'index.php'; // Redirect to the main page (index.php)
  }
</script>
<script>
  $(document).ready(function() {
    $("#registerButton").click(function() {
      console.log("Register button clicked");
      $.ajax({
        type: "POST",
        url: "register.php",
        data: $("#registrationForm").serialize(),
        success: function(response) {
          // Handle the response from the server
          alert(response);
        },
        error: function(xhr, status, error) {
          // Handle errors
          console.log(xhr.responseText);
        }
      });
    });
  }); // Closing document.ready
</script>
<script>
  $("#loginButton").click(function() {
    console.log("Login button clicked");
    $.ajax({
      type: "POST",
      url: "login.php",
      data: $("#loginForm").serialize(),
      success: function(response) {
        if (response === "admin") {
          // Redirect to the admin page
          window.location.href = "admin/dashboard.php";
        } else if (response === "user") {
          // Redirect to the user page
          window.location.href = "user/dashboard.php";
        } else {
          // Display the error message
          $("#loginUsernameOrEmailError").text(response);
        }
      },
      error: function(xhr, status, error) {
        // Handle errors
        console.log(xhr.responseText);
      }
    });
  });
</script>
<script>
  function disableButton() {
    document.getElementById("registerButton").disabled = true;
  }
</script>
<?php
include("scripts.php")
?>
</body>
</html>