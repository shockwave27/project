<?php

include("header.php");



   
   $username = $_SESSION['email'];
   $sql="select * from registration where email='$username'" ;
   $res=select_data($sql);
   $arr=mysqli_fetch_assoc($res);
   ?>





<main id="main" class="main">

  <div class="pagetitle">
    <h1>Complaints</h1>
    <nav>
      <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Pages</li>
          <li class="breadcrumb-item active">Complaint</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->



  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Create a complaint</h5>

      <!-- Floating Labels Form -->
      <form action="../php/phpcomplaint.php" class="row g-3" method="POST">

      
      <div class="col-md-6">
          <div class="col-md-12">
          <label for="floatingName">Email</label>
          <input name="email" disabled type="text" class="form-control" id="email" value=<?php echo $arr['email'];?>>
          </div>
        </div>

      
        <div class="col-md-6">
          <div class="col-md-12">
            <div class="form-floating mb-3">
              <select class="form-select" id="" aria-label="State" name="type">
                <option selected disabled>Select Type</option>

                
                  <option value="car">Turf</option>
                  
                  <option value="website">Website</option>



              </select>
              <label for="floatingSelect">Type</label>
            </div>
          </div>
        </div> 

        <div class="col-md-12">
          <div class="form-floating">
            <input type="text" class="form-control" id="title" placeholder="Name of Context" name="title">
            <label for="floatingName">Title of the complaint</label>
          </div>
        </div>
        


        

        <!-- <div class="col-md-4"> 
      <div class="form-floating mb-3">
        <select class="form-select" id="floatingSelect" aria-label="State">
          <option selected>New York</option>
          <option value="1">Oregon</option>
          <option value="2">DC</option>
        </select>
        <label for="floatingSelect">State</label>
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-floating">
        <input type="text" class="form-control" id="floatingZip" placeholder="Zip">
        <label for="floatingZip">Zip</label>
      </div>
    </div>-->
        <div class="col-12">
          <div class="form-floating">
            <textarea class="form-control" placeholder="Discription" id="description" name="description"
              style="height: 100px;"></textarea>
            <label for="floatingTextarea">Description</label>
          </div>
        </div>

        


                  
        <div class="text-center">
          <button type="submit" name="submit" class="btn btn-primary">Submit</button>
          <!--<button type="reset" class="btn btn-secondary">Reset</button>-->
        </div>
      </form><!-- End floating Labels Form -->

    </div>
  </div>

  </div>
  </div>
  </section>

</main><!-- End #main -->

<?php



require 'footer.html';

?>