<!-- add_user.php -->

<?php include("header.php"); ?>

<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0">Add User</h1>
            </div><!-- /.col -->
         </div><!-- /.row -->
      </div><!-- /.container-fluid -->
   </div>
   <!-- /.content-header -->

   <!-- Main content -->
   <section class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-12">
               <div class="card">
                  <div class="card-body">
                     <form action="process_add_user.php" method="POST">
                        <!-- Add input fields for user details -->
                        <label for="first_name">First Name:</label>
                        <input type="text" name="first_name" required>

                        <label for="middle_name">Middle Name:</label>
                        <input type="text" name="middle_name">

                        <label for="last_name">Last Name:</label>
                        <input type="text" name="last_name" required>

                        <label for="username_or_email">Username or Email Address:</label>
                        <input type="text" name="username_or_email" required>

                        <button type="submit" class="btn btn-primary">Add User</button>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- /.content -->
</div>

<?php include("footer.php"); ?>
