<?php 
require_once('database.php');


if(isset($_POST['submit']))
{
    $from = $_GET['id'];
    $to = $_POST['to'];
    $amount = $_POST['amount'];

    $sql = "SELECT * from customers where id=$from";
    $query = mysqli_query($conn,$sql);
    $sql1 = mysqli_fetch_array($query); // returns array or output of user from which the amount is to be transferred.

    $sql = "SELECT * from customers where id=$to";
    $query = mysqli_query($conn,$sql);
    $sql2 = mysqli_fetch_array($query);



    // constraint to check input of negative value by user
    if (($amount)<0)
   {
        echo '<script type="text/javascript">';
        echo ' alert("Oops! Negative values cannot be transferred")';  // showing an alert box.
        echo '</script>';
    }


  
    // constraint to check insufficient balance.
    else if($amount > $sql1['curr_balance']) 
    {
        
        echo '<script type="text/javascript">';
        echo ' alert("Sorry, Insufficient Balance")';  // showing an alert box.
        echo '</script>';
    }
    


    // constraint to check zero values
    else if($amount == 0){

         echo "<script type='text/javascript'>";
         echo "alert('Oops! Zero value cannot be transferred')";
         echo "</script>";
     }


    else {
        
                // deducting amount from sender's account
                $newbalance = $sql1['curr_balance'] - $amount;
                $sql = "UPDATE customers set curr_balance=$newbalance where id=$from";
                mysqli_query($conn,$sql);
             

                // adding amount to reciever's account
                $newbalance = $sql2['curr_balance'] + $amount;
                $sql = "UPDATE customers set curr_balance=$newbalance where id=$to";
                mysqli_query($conn,$sql);
                
                $sender = $sql1['name'];
                $receiver = $sql2['name'];
                $sql = "INSERT INTO transact(`sender`, `receiver`, `balance`) VALUES ('$sender','$receiver','$amount')";
                $query=mysqli_query($conn,$sql);

                if($query){
                     echo "<script> alert('Transaction Completed');
                                     window.location='Custo-all.php';
                           </script>";
                    
                }

                $newbalance= 0;
                $amount =0;
        }
    
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


   
   
    <title>Dashboard</title>
    <title>Banking System</title>
</head>
<body>
<div class="Container">

      <div id="menu">
      <h1> <img src="Blue Yellow Modern Digital Creative Logo.png"> </h1>
                <div id="menu-wrap">
<ul id="navbar">
          <li class="navitems"><a href="homepage.php">Home</a></li>
            <li class="navitems"><a href="Custo-all.php">View all Customers</a></li>
            <li class="navitems"><a href="transfermoney.php">Transfer Money</a></li>
            <li class="navitems"><a href="transhistory.php">Transaction</a></li>
           
           
        </ul><!--end navigation-menu-->
        <hr class="divider">
    </div><!--end menu-wrap-->
    
    </div>
   </div>
<section>
 
<div class="container">
<a href="Custo-all.php" style="font-size:20px; color:#0a4275; text-decoration: none;" ><span class="glyphicon glyphicon-arrow-left"></span> Back</a> 

        <h2 class="text-center pt-4" style="color : #0a4275; font-size:40px;">View One Customer</h2>
            <?php
                include 'database.php';
                $sid=$_GET['id'];
                $sql = "SELECT * FROM  customers where id=$sid";
                $result=mysqli_query($conn,$sql);
                if(!$result)
                {
                    echo "Error : ".$sql."<br>".mysqli_error($conn);
                }
                $rows=mysqli_fetch_assoc($result);
            ?>
            <form method="post" name="tcredit" class="tabletext" ><br>
        <div>
            <table class="table table-striped table-condensed table-bordered table-dark" style="background-color:  #0a4275;#0a4275;">
                <tr style="color : #000000;">
                    <th class="text-center">Id</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Total Balance</th>
                </tr>
                <tr style="color : #ffffff;">
                    <td class="py-2"><?php echo $rows['id'] ?></td>
                    <td class="py-2"><?php echo $rows['name'] ?></td>
                    <td class="py-2"><?php echo $rows['email'] ?></td>
                    <td class="py-2">Php <?php echo $rows['curr_balance'] ?></td>
                </tr>
            </table>
        </div>
        <hr><br>
        <div class="container">
        <h2 class="text-center pt-4" style="color : #0a4275; font-size:40px;">Transaction History</h2>
            <?php
                include 'database.php';
                $sid=$_GET['id'];
                $sql = "SELECT * FROM  transact where serialno=$sid";
                $result=mysqli_query($conn,$sql);
                if(!$result)
                {
                    echo "Error : ".$sql."<br>".mysqli_error($conn);
                }
                $rows=mysqli_fetch_assoc($result);
            ?>
            <form method="post" name="tcredit" class="tabletext" ><br>
        <div>
            <table class="table table-striped table-condensed table-bordered table-dark" style="background-color:  #0a4275;#0a4275;">
                <tr style="color : #000000;">
                <th class="text-center">Serial No.</th>
                <th class="text-center">Sender</th>
                <th class="text-center">Receiver</th>
                <th class="text-center">Amount</th>
                <th class="text-center">Date & Time</th>
                </tr>
                <tr style="color : #ffffff;">
            <td class="py-2"><?php echo $rows['serialno']; ?></td>
            <td class="py-2"><?php echo $rows['sender']; ?></td>
            <td class="py-2"><?php echo $rows['receiver']; ?></td>
            <td class="py-2">Php <?php echo $rows['balance']; ?></td>
            <td class="py-2"><?php echo $rows['datetime']; ?> </td>
            </tr>
            </table>
        </div>
        <hr><br>
     
        
        </form>
    </div>
