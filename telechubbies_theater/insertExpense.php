<?php
include_once 'connectDB.php';
error_reporting(E_ALL ^ E_NOTICE);
session_start();

$manager_ID = $_SESSION['employee-id'];


$sql = "INSERT INTO expenses(Manager_ID, DateTime) VALUES ('$manager_ID',CURRENT_TIMESTAMP())";
$result = $conn->query($sql);

$query2 = "SELECT * FROM expenses ORDER BY  Expense_ID DESC LIMIT 1";
$result2 = $conn->query($query2);
$expense_ID = $result2->fetch_assoc();
print_r($expense_ID['Expense_ID']);



foreach($_SESSION['manager_Expense'] as $key => $order):
    $sql2 = "INSERT INTO expenseitems(Expense_ID, ExpenseType, Amount, Quantity, Details) VALUES ('$expense_ID[Expense_ID]','$order[expenseType]','$order[amountExpense]','$order[quantityExpense]','$order[detailsExpense]')";
    $result1 = $conn->query($sql2);        
endforeach;

if($result && $result1){
    header("Location: managerExpense.php?addExpense=success");
    unset($_SESSION['manager_Expense']);
    unset($_SESSION['subtotal_Order']);

}$conn->close();

?>