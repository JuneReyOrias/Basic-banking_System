<?php 
require_once('database.php');
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
            <li class="navitems"><a href="transacts.php">Transaction</a></li>
        
           
        </ul><!--end navigation-menu-->
        <hr class="divider">
    </div><!--end menu-wrap-->
    
    </div>
   </div>
<section>
   
	<div class="container">
        <h2 class="text-center pt-4" style="color : #0a4275; font-size:40px;">Transaction History</h2>
        
       <br>
       <div class="row">
         <div class="col">
          <div class="table-responsive-sm">
    <table class="table table-hover table-striped table-condensed table-dark table-bordered" style= "background-color: #0a4275;">
        <thead style="color : #ffffff;">
            <tr>
                <th class="text-center">Serial No.</th>
                <th class="text-center">Sender</th>
                <th class="text-center">Receiver</th>
                <th class="text-center">Amount</th>
                <th class="text-center">Date & Time</th>
            </tr>
        </thead>
        <tbody>
        <?php

      

            $sql ="SELECT * FROM transact";

            $query =mysqli_query($conn, $sql);

            while($rows = mysqli_fetch_assoc($query))
            {
        ?>

            <tr lass="text-center pt-3" style="color : black; justify-content:center;"style="color : black;">
            <td class="py-2"><?php echo $rows['serialno']; ?></td>
            <td class="py-2"><?php echo $rows['sender']; ?></td>
            <td class="py-2"><?php echo $rows['receiver']; ?></td>
            <td class="py-2">Php <?php echo $rows['balance']; ?> </td>
            <td class="py-2"><?php echo $rows['datetime']; ?> </td>
                
        <?php
            }

        ?>
        </tbody>
    </table>

    </div>
</div>
</body>
</html>