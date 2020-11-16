<?php 
    include_once 'connectDB.php';

    include 'account-controls.php';

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">


    <title>Telechubbies Theater</title>

    <link rel="stylesheet" href="styleHome.css" />
    <link rel="stylesheet" href="navMenuBodyStyle.css" />
    <link rel="stylesheet" href="jamie.css"/>
    <script>
        $.noConflict();
    </script>



    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="styleSidebar.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>

<body>
     <header class="header-fade" style="background: #2f3640;">
    <div class="inner-width">
      <a href="#" class="logo"><img src="logo.png" alt="" /></a>
      <div class="internal-welcome"><h3>Telechubbies Cinemas Internal Management System</h3></div>
      <nav class="navigation-menu">

          <!--check if user is already logged in from session-->
          <?php
            if(!isset($_SESSION['employee-id']))
            {
          ?>
          <form method="POST" action = "login.php?prev=<?php echo $curPageName;?>">
            <input type="submit" class="btn btn-info" name="sign-in" value = "Sign In"/>
          </form>
          <?php
            }
          ?>

          <?php
            if(isset($_SESSION['employee-id'])) 
            {
            $profile_name = $_SESSION['employee-name'];
          ?>
          <a href="home-manager.php"><?php echo "$profile_name"; ?></a>
          <form method="POST" action="home.php">
            <input type="submit" class="btn btn-danger" name="sign-out" value = "Sign Out"/>
          </form>
          <?php
            }
          ?>


        </nav>
    </div>
    </header>

    <div class="wrapper" style="margin-top: 90px;">
        <!-- Sidebar Holder -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>Telechubbies Cinemas</h3>
            </div>

            <ul class="list-unstyled components">
                <p>Welcome, <?php echo $_SESSION['employee-name'];?>!</p>
                <li>
                    <a href="./home-manager.php">Profile</a>

                </li>
                <li>
                  <a href="#manageSubmenu" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle">Management</a>
                  <ul class="collapse list-unstyled show" id="manageSubmenu">
                    <li>
                        <a href="managerClock.php">Clock In/Out</a>
                    </li>
                    <li>
                        <a href="showtimesPage.php">Manage Showtimes</a>
                    </li>
                    <li>
                        <a href="managerExpense.php">Manage Expenses</a>
                    </li>
                    <li class="active">
                        <a href="addItems.php">Add Merchandise</a>
                    </li>
                    <li>
                        <a href="film_buy.php">Buy/Lease Film Rolls</a>
                    </li>
                    <li>
                        <a href="add_movie.php">Add Movie</a>
                    </li>
                    <li>
                        <a href="add_discount.php">Add Discount</a>
                    </li>
                    <li>
                        <a href="./managerEmploy.php">Add Employee</a>
                    </li>
                    <li class="active">
                        <a href="managerEvaluate.php">Evaluate Employee</a>
                    </li>
                  </ul>
                </li>

                <li>
                  <a href="#reportSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Reports</a>
                  <ul class="collapse list-unstyled" id="reportSubmenu">
                      <li>
                        <a href="sales_report.php">Merchandise Sales</a>
                      </li>
                      <li>
                        <a href="movies_report.php">Movie Sales</a>
                      </li>
                      <li>
                        <a href="expenseAnalysis.php">Expense Report</a>
                      </li>
                      <li>
                        <a href="profit_report.php">Profit Analysis</a>
                      </li>
                  </ul>
                </li>
               
                <li>
                    <a href="#">Contact</a>
                </li>
            </ul>

        </nav>
        <!-- Page Content Holder -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="navbar-btn">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>


                    <div class="collapse navbar-collapse" id="navbarSupportedContent"></div>
                </div>
            </nav>
            <div class="col-sm-3"></div>
            <div class="col-sm-9">
                <h4>Adding Items</h4>
                <form action ="insertItems.php" method="POST" enctype="multipart/form-data" >
                <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Item Name</label>
                            <input type="text" name = "ItemName"class="form-control" placeholder="Item Name" required >
                        </div>
                </div>
                <div class = "form-row">
                        <div class="form-group col-md-6">
                            <label>Item Price</label>
                            <input type="number" name = "ItemPrice"class="form-control" min="0"placeholder="Price" required >
                        </div>
                </div>
                <div class = "form-row">
                        <div class="form-group col-md-6">
                            <label>Image</label>
                            <input type="file" name ="Image" id="Image" class="form-control" accept =".jpg, .png" placeholder="Image" required  >
                            <div class = "image-preview" id="imagePreview">
                                <img src="" alt="Image Preview" class="image-preview__image">
                                <span class ="image-preview__default-text">Image Preview</span>
                            </div>
                        </div>
                </div>
                <div class="form-row">
                    <button type="submit" name = 'submit'class="btn btn-primary">ADD</button>
                </form>

            </div>
        </div>
    </div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script>
        const inpFile=document.getElementById("Image");
        const previewContainer=document.getElementById("imagePreview");
        const previewImage = previewContainer.querySelector(".image-preview__image");
        const previewDefaultText=previewContainer.querySelector(".image-preview__default-text");

        inpFile.addEventListener("change",function(){
            const file = this.files[0];
            
            if(file){
                const reader =new FileReader();

                previewDefaultText.style.display="none";
                previewImage.style.display="block";

                reader.addEventListener("load",function(){
                    console.log(this);
                    previewImage.setAttribute("src",this.result);
                });
                reader.readAsDataURL(file);
            }
            else{
                previewDefaultText.style.display="null";
                previewImage.style.display="null";
            }
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').toggleClass('active');
                $(this).toggleClass('active');
            });
        });
    </script>

        <script>
      window.addEventListener("scroll", function() {

        if(window.scrollY > 0)
            {
            $("header").removeClass("header-fade");
            }
        else
            {
            $("header").addClass("header-fade");   
            }
    });
    </script> 



</body>

</html>
