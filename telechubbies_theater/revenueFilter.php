<?php
include_once 'connectDB.php';
$sqlSet = "SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));";
$set = mysqli_query($conn, $sqlSet);
//filter.php  
if (isset($_POST["from_date"], $_POST["to_date"])) {
    $output = '';

    $queryExpense = "SELECT SUM(Amount*Quantity) AS Total FROM expenseitems LEFT JOIN expenses ON expenseitems.Expense_ID = expenses.Expense_ID WHERE expenses.DateTime BETWEEN '" . $_POST["from_date"] . "' AND '" . $_POST["to_date"] . "' ORDER BY expenses.DateTime DESC ";
    $resultExpense = mysqli_query($conn, $queryExpense);
    $queryFilmRolls = "SELECT SUM(Amount) AS Total FROM filmrolls  WHERE LeaseDate BETWEEN '" . $_POST["from_date"] . "' AND '" . $_POST["to_date"] . "' ";
    $resultFilmRolls = mysqli_query($conn, $queryFilmRolls);
    $queryTicket = "SELECT SUM(Cost) AS Total FROM ticketbooking WHERE DateTime BETWEEN '" . $_POST["from_date"] . "' AND '" . $_POST["to_date"] . "' ";
    $resultTicket = mysqli_query($conn, $queryTicket);
    $queryMerchandise = "SELECT SUM(itemsold.Quantity*items.ItemPrice) AS Total FROM itemsold LEFT JOIN items ON items.ItemID = itemsold.ItemID LEFT JOIN merchandise ON merchandise.TransactionID = itemsold.TransactionID WHERE DateTime BETWEEN '" . $_POST["from_date"] . "' AND '" . $_POST["to_date"] . "' ";
    $resultMerchandise = mysqli_query($conn, $queryMerchandise);


    $rowExpense = mysqli_fetch_array($resultExpense);
    $rowFilmRolls = mysqli_fetch_array($resultFilmRolls);
    $rowTicket = mysqli_fetch_array($resultTicket);
    $rowMerchandise = mysqli_fetch_array($resultMerchandise);

    if (is_null($rowTicket["Total"])) {
        $rowTicket["Total"] = 0;
    }
    if (is_null($rowMerchandise["Total"])) {
        $rowMerchandise["Total"] = 0;
    }
    if (is_null($rowExpense["Total"])) {
        $rowExpense["Total"] = 0;
    }
    if (is_null($rowFilmRolls["Total"])) {
        $rowFilmRolls["Total"] = 0;
    }


    $Total = ($rowTicket["Total"] + $rowMerchandise["Total"]) - ($rowExpense["Total"] + $rowFilmRolls["Total"]);
    // 
    $output = '';
    $output .= '  
        <h3 align="center">Summary of Revenue</h3><br />
        <div>
            <table class="table table-hover table-sm table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Type</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Ticket</td>
                        <td style="color:green">฿ ' . $rowTicket["Total"] . '</td>
                    </tr>
                    <tr>
                        <td>Merchandise</td>
                        <td style="color:green">฿ ' . $rowMerchandise["Total"] . '</td>
                    </tr>
                    <tr>
                        <td>Expense</td>
                        <td style="color:red">฿ - ' . $rowExpense["Total"] . '</td>
                    </tr>
                    <tr>
                        <td>Film_Roll</td>
                        <td style="color:red">฿ - ' . $rowFilmRolls["Total"] . '</td>
                    </tr>';

    if ($Total > 0) {
            $output .= '  
                    <tr>
                    <td>Profit</td>
                    <td style="font-weight: bold; color:green">฿ ' . $Total . '</td>
                </tr>
            </tbody>
        </table>
        </div>
                              ';
    } else {
        $output .= '  
                <tr>
                <td>Profit</td>
                <td style="font-weight: bold; color:red">฿ ' . $Total . '</td>
            </tr>
        </tbody>
        </table>
        </div>
                         ';
    }
    echo $output;
}
