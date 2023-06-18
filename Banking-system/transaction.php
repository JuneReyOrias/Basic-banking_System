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

    echo "<script> alert('Oops! Negative values cannot be transferred');
    window.location='Custo-all.php';
</script>";
        
    }


  
    // constraint to check insufficient balance.
    else if($amount > $sql1['curr_balance']) 
    {
        
        echo '<script type="text/javascript">';
        echo ' alert(" Insufficient Balance")';  // showing an alert box.
        echo '</script>';
    }
    


    // constraint to check zero values
    else if($amount == 0){


        echo "<script> alert('Invalid, Zero cannot be transfered');
        window.location='Custo-all.php';
</script>";
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

        <h2 class="text-center pt-4" style="color : #0a4275; font-size:40px;">Transaction</h2>
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
            <table class="table table-striped table-condensed table-bordered table-dark" style="background-color:  #0a4275;">
                <tr style="color : #000;">
                    <th class="text-center">Id</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Total Balance</th>
                </tr>
                <tr style="color : #ffffff;">
                    <td class="sf-bank"><?php echo $rows['id'] ?></td>
                    <td class="sf-bank"><?php echo $rows['name'] ?></td>
                    <td class="sf-bank"><?php echo $rows['email'] ?></td>
                    <td class="sf-bank">Php <?php echo $rows['curr_balance'] ?></td>
                </tr>
            </table>
        </div>
        <hr><br>
        
        <div class="row" >
        
            <div class="col-6">
        <label style="color : #0a4275; font-size:15px; align-item:center;"><b>Transfer To:</b></label>
        <select name="to" class="form-control"  style="width:40%; height:50%; color:#000000;"required>
            <option value="" disabled selected>Select Account</option>
            <?php
               
                $sid=$_GET['id'];
                $sql = "SELECT * FROM customers where id!=$sid";
                $result=mysqli_query($conn,$sql);
                if(!$result)
                {
                    echo "Error ".$sql."<br>".mysqli_error($conn);
                }
                while($rows = mysqli_fetch_assoc($result)) {
            ?>
                <option class="table" value="<?php echo $rows['id']; ?>" >
                
                    <?php echo $rows['name'] ;?> (Balance: Php  
                    <?php echo $rows['curr_balance'] ;?> ) 
               
                </option>
            <?php 
                } 
            ?>
            <div>
        </select>
        </div>


        <div class="col-6">
            <label style="color : #0a4275; font-size:15px; margin-top:9px; "><b>Amount:</b></label>
            <input type="number" class="form-control" style="width:40%; height:50%; color:#000000;"name="amount" required> 
        </div>
        
        </div>
              
            <br><br>
                <div class="text-center" >
            <button class="btn" name="submit" type="submit" id="myBtn" style="color : #0a4275; font-size:20px;">Transfer Amount</button>
            </div>
        </form>
    </div>
   <!-- <footer class="text-center mt-5 py-2">
           
    </footer>-->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>