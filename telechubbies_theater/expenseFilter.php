<?php
include_once 'connectDB.php';
$sqlSet = "SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));";
$set = mysqli_query($conn, $sqlSet);
//filter.php  
if (isset($_POST["from_date"], $_POST["to_date"])) {
     $output = '';
     $query = "  
           SELECT * FROM expenseitems LEFT JOIN expenses ON expenseitems.Expense_ID=expenses.Expense_ID
              LEFT JOIN (SELECT Employee_Name AS Manager_Name, Employee_ID FROM employees)manager on expenses.Manager_ID = manager.Employee_ID  
           WHERE expenses.DateTime BETWEEN '" . $_POST["from_date"] . "' AND '" . $_POST["to_date"] . "ORDER BY expenses.DateTime DESC '  
      ";
     $result = mysqli_query($conn, $query);
     $querySum = "SELECT expenseitems.ExpenseType, SUM(expenseitems.Amount*expenseitems.Quantity) AS Total FROM expenseitems LEFT JOIN expenses ON expenseitems.Expense_ID = expenses.Expense_ID WHERE expenses.DateTime BETWEEN '" . $_POST["from_date"] . "' AND '" . $_POST["to_date"] . "' GROUP BY expenseitems.ExpenseType";
     $resultSum = mysqli_query($conn, $querySum);

     // 
     $output .= '  
           <h3 align="center">Expense Summary</h3>
            <center><span class="text-muted">for selected time period</span></center>
            <br>
           <table class="table table-hover table-sm table-bordered">  
               <thead>
                    <tr>                    
                         <th scope="col">Expense Type</th>
                         <th scope="col">Total</th>               
                    </tr>  
               </thead>
      ';
     if (mysqli_num_rows($resultSum) > 0) {
          while ($rowSum = mysqli_fetch_array($resultSum)) {
               $output .= '  
                     <tr>  
                          <td>' . $rowSum["ExpenseType"] . '</td>  
                          <td>' . $rowSum["Total"] . '</td>    
                     </tr>  
                ';
          }
     } else {
          $output .= '  
                <tr>  
                     <td colspan="6">No Order Found</td>  
                </tr>  
           ';
     }
     $output .= '</table>';
     // 

     $output .= '  
          <br>
            <h3 align="center">Expense Data</h3>
            <center><span class="text-muted">all expenses made in the selected time period</span></center>
            <br>
           <table class="table table-hover table-sm table-bordered">  
               <thead>
                    <tr>  
                         <th >Order Datetime</th>  
                         <th >Spending Manager</th>  
                         <th >Expense ID</th>  
                         <th >Expense Type</th>  
                         <th >Amount</th> 
                         <th >Quantity</th>   
                    </tr>  
               </thead>
      ';
     if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_array($result)) {
               $output .= '  
                     <tr>  
                          <td>' . $row["DateTime"] . '</td>  
                          <td>' . $row["Manager_Name"] . '</td>  
                          <td>' . $row["Expense_ID"] . '</td>  
                          <td>' . $row["ExpenseType"] . '</td>  
                          <td>฿ ' . $row["Amount"] . '</td> 
                          <td>' . $row["Quantity"] . '</td>   
                     </tr>  
                ';
          }
     } else {
          $output .= '  
                <tr>  
                     <td colspan="6">No Order Found</td>  
                </tr>  
           ';
     }
     $output .= '</table>';
     echo $output;
}
