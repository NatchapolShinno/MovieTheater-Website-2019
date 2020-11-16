<?php
include_once 'connectDB.php';

session_start();


function pre_r($array)
{
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}

#initialize session
#session_destroy();

#pre_r($_SESSION);

$product_type = array();

#check if add to cart button has been submitted
if (filter_input(INPUT_POST, 'add-order')) {
    if (isset($_SESSION['manager_Expense'])) {
        #count the number of elements in manager_Expense array
        $count = count($_SESSION['manager_Expense']);

        #create sequential array or matching array keys to product ids
        $product_type = array_column($_SESSION['manager_Expense'], 'expenseType');

        #check if product is already in array
        if (!in_array(filter_input(INPUT_GET, 'expenseType'), $product_type)) {
            #if not exist, proceed
            $_SESSION['manager_Expense'][$count] = array(

                'expenseType' => filter_input(INPUT_POST, 'expenseType'),
                'amountExpense' => filter_input(INPUT_POST, 'amountExpense'),
                'quantityExpense' => filter_input(INPUT_POST, 'quantityExpense'),
                'detailsExpense' => filter_input(INPUT_POST, 'detailsExpense')
            );
        } else #if already exist, add to quantity
        {
            #loop through product ids and match array key to id of product being added to cart
            for ($i = 0; $i < count($product_type); $i++) {
                if ($product_type[$i] == filter_input(INPUT_GET, 'expenseType')) {
                    #add quantity to existing product in array
                    $_SESSION['manager_Expense'][$i]['quantityExpense'] += filter_input(INPUT_POST, 'quantityExpense');
                }
            }
        }

        // pre_r($product_type);

        #keep track of product ids
    } else #if shopping cart does not exist, create first product with array key 0
    {
        #create array using submitted form data, starting from key 0, and fill with values
        $_SESSION['manager_Expense'][0] = array(

            'expenseType' => filter_input(INPUT_POST, 'expenseType'),
            'amountExpense' => filter_input(INPUT_POST, 'amountExpense'),
            'quantityExpense' => filter_input(INPUT_POST, 'quantityExpense'),
            'detailsExpense' => filter_input(INPUT_POST, 'detailsExpense')
        );
        $_SESSION['subtotal_Order'] = 0;
    }
}

#check for remove
if (filter_input(INPUT_GET, 'action') == 'deleteSalary') {
    #loop through products in shopping cart until matches with GET id var
    foreach ($_SESSION['manager_Expense'] as $key => $product) {
        if ($product['expenseType'] == "SALARY") {
            #remove product from shopping cart when matches
            unset($_SESSION['manager_Expense'][$key]);
        }
    }

    #reset session array keys
    $_SESSION['manager_Expense'] = array_values($_SESSION['manager_Expense']);
}
if (filter_input(INPUT_GET, 'action') == 'deleteEquipment') {
    #loop through products in shopping cart until matches with GET id var
    foreach ($_SESSION['manager_Expense'] as $key => $product) {
        if ($product['expenseType'] == "EQUIPMENT") {
            #remove product from shopping cart when matches
            unset($_SESSION['manager_Expense'][$key]);
        }
    }

    #reset session array keys
    $_SESSION['manager_Expense'] = array_values($_SESSION['manager_Expense']);
}
if (filter_input(INPUT_GET, 'action') == 'deleteOther') {
    #loop through products in shopping cart until matches with GET id var
    foreach ($_SESSION['manager_Expense'] as $key => $product) {
        if ($product['expenseType'] == "OTHER") {
            #remove product from shopping cart when matches
            unset($_SESSION['manager_Expense'][$key]);
        }
    }

    #reset session array keys
    $_SESSION['manager_Expense'] = array_values($_SESSION['manager_Expense']);
}
#clear shopping cart
elseif (filter_input(INPUT_GET, 'action') == 'clear') {
    session_destroy();
    unset($_SESSION);
}

include 'account-controls.php';

#initialize discountStatus in _SESSION for checkout
$_SESSION['discountStatus'] = 0;

#preview shopping cart array
// pre_r($_SESSION);


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
    <script>
        $.noConflict();
    </script>
    <script>
        $('#testMana').val(<?php echo $manager_ID ?>);
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
                    <li class="active">
                        <a href="managerExpense.php">Manage Expenses</a>
                    </li>
                    <li>
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



            <div class="col-sm-10">
                <form method="POST" action="managerExpense.php?action=add&id">
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label for="inputTypeExpense">ExpenseType </label>
                            <select id="inputTypeExpense" name="expenseType" class="form-control" required>
                                <option selected>Choose...</option>
                                <option value="SALARY">Salary</option>
                                <option value="EQUIPMENT">Equipment</option>
                                <option value="OTHER">Other</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputAmountExpense">Amount</label>
                            <input type="number" name="amountExpense" class="form-control" required />
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputQuantityExpense">Quantity</label>
                            <input type="number" name="quantityExpense" class="form-control" value="1" required />
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputDetails">Details</label>
                            <input type="text" name="detailsExpense" class="form-control" placeholder="..." value="...">
                        </div>
                        <div class="form-group col-md-2">
                            <br>
                            <input type="submit" name="add-order" class="btn btn-info btn-lg" value="Add Order" />
                        </div>
                    </div>


                </form>



            </div>

            <!--summary table-->
            <br>
            <div class="form=row">
                <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                    <div class="btn-group mr-2" role="group" aria-label="First group">
                        <a href="managerExpense.php?action=deleteSalary">
                            <div class="btn btn-danger">Remove Salary</div>
                        </a>
                    </div>
                    <div class="btn-group mr-2" role="group" aria-label="Second group">
                        <a href="managerExpense.php?action=deleteEquipment">
                            <div class="btn btn-danger">Remove Equipment</div>
                        </a>
                    </div>
                    <div class="btn-group mr-2" role="group" aria-label="Third group">
                        <a href="managerExpense.php?action=deleteOther">
                            <div class="btn btn-danger">Remove Other</div>
                        </a>
                    </div>
                </div>
            </div>
            <br>
            <div class="table-responsive summary">
                <table class="table table-hover">
                    <tr>
                        <th colspan="6" scope="col">
                            <h3>Order Summary</h3>
                        </th>
                    </tr>
                    <tr>
                        <th scope="col">ExpenseType</th>
                        <th scope="col">Details</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
                    </tr>

                    <!--loop and print out all shopping cart items-->
                    <?php
                    if (!empty($_SESSION['manager_Expense'])) {

                        #total variable to calculate sub total (before applying discount code)
                        $_SESSION['subtotal_Order'] = 0;

                        foreach ($_SESSION['manager_Expense'] as $key => $product) :

                    ?>

                            <tr>
                                <td><?php echo $product['expenseType']; ?></td>
                                <td><?php echo $product['quantityExpense']; ?></td>
                                <td>฿ <?php echo $product['amountExpense']; ?></td>
                                <td><?php echo $product['quantityExpense']; ?></td>

                                <td>฿ <?php echo number_format($product['quantityExpense'] * $product['amountExpense'], 2); ?></td>
                            </tr>

                            <!--calculate sub total-->
                    <?php
                            $_SESSION['subtotal_Order'] = $_SESSION['subtotal_Order'] + ($product['quantityExpense'] * $product['amountExpense']);
                        endforeach;
                    } else {
                        $_SESSION['subtotal_Order'] = 0;
                    }

                    ?>

                    <!--print grand total-->
                    <tr>
                        <td colspan="3" align="right">Total</td>
                        <td align="right"><b>฿ <?php echo number_format($_SESSION['subtotal_Order'], 2); ?></b></td>
                        <td></td>
                        <td>
                            <a href="managerExpense.php?action=clear">
                                <div class="btn btn-danger">Clear Cart</div>
                            </a>
                        </td>
                    </tr>


                    <!--checkout button-->
                    <tr>
                        <td colspan="6">
                            <?php
                            if (isset($_SESSION['manager_Expense'])) :
                                if (count($_SESSION['manager_Expense']) > 0) :
                            ?>
                                    <a href="insertExpense.php"><button type="button" class="btn btn-success">Confirm Order</button></a>
                            <?php
                                endif;
                            endif;
                            ?>
                        </td>
                    </tr>



                </table>

                <footer class="my-5 pt-5 text-muted text-center text-small">
                    <p class="mb-1">© 2019-2020 Telechubbies Theater Group</p>
                    <ul class="list-inline">
                        <li class="list-inline-item"><a href="https://getbootstrap.com/docs/4.0/examples/checkout/#">Privacy</a></li>
                        <li class="list-inline-item"><a href="https://getbootstrap.com/docs/4.0/examples/checkout/#">Terms</a></li>
                        <li class="list-inline-item"><a href="https://getbootstrap.com/docs/4.0/examples/checkout/#">Support</a></li>
                    </ul>
                </footer>
            </div>



        </div>
    </div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

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