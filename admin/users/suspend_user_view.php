<?php

require '../header.php';

?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

      <section class="section">
      <div class="row">
        <div class="col-lg-12">

        <div class="card"> 
          <div class="card-body"> 
            <h5 class="card-title"> 
           Users
            </h5>


         
              <!-- Table with stripped rows -->
              <table class="table datatable">
    <thead>
        <tr>
            <th scope="col">User ID</th>
            <th scope="col">Username</th>
            <th scope="col">Email</th>
            <th scope="col">Password</th>
            <th scope="col">User Type</th>
            <th scope="col">User Status</th>
        </tr>
    </thead>
    <tbody>
        <?php
         $sql = "SELECT * FROM `login` WHERE user_status = 'inactive'";
        $data = select_data($sql);
        $n = 1;

        while ($row = mysqli_fetch_assoc($data)) {
          ?>
              <tr>
                  <th scope='row'><?php echo $n++; ?></th>
                  <td><?php echo $row['user_name'] ?></td>
                  <td><?php echo $row['user_email'] ?></td>
                  <td><?php echo $row['user_password'] ?></td>
                  <td><?php echo $row['user_type'] ?></td>
                  <td><?php echo $row['user_status'] ?></td>
                  <td>
                      <!-- Form for the "Suspend" button -->
                      <form method="POST" action="restore_user.php">
                          <input type="hidden" name="user_id" value="<?php echo $row['user_id'] ?>">
                          <button type="submit" name="suspend" class="btn btn-success">Restore</button>

                      </form>
                  </td>
              </tr>
          <?php
          }
          
        ?>
    </tbody>
</table>

              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->


    




      </div>
    </section>

  </main><!-- End #main -->