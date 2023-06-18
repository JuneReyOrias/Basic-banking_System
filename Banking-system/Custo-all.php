<?php 
require_once('database.php')
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
        <div class="log-name">
            

        </div>

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
    <div class="envelope">
<!--
<div class="icon" > <span> <img src="https://img.freepik.com/premium-vector/online-banking-technology-concept-illustration-bank-electric-circuit-lines-background_387612-43.jpg?size=626&ext=jpg&ga=GA1.2.2085997953.1686419944&semt=ais"> </spam></div>



-->
      
</div>
<?php
   
    $sql = "SELECT * FROM customers";
    $result = mysqli_query($conn,$sql);
?>


<div class="container">

        <h2 class="text-center pt-3" style="color : #0a4275; margin-left:-90px; font-size:40px;">SF Customers</h2>
        <br>
            <div class="row">
                <div class="col">
                    <div class="table-responsive-sm">
                    <table class="table table-hover table-sm table-striped table-condensed table-bordered table-dark" style="border-color:white;background-color:#0a4275;#0a4275; ">
                        <thead style="color : white;">
                            <tr>
                            <th scope="col" class="text-center py-2">id</th>
                            <th scope="col" class="text-center py-2">Name</th>
                            <th scope="col" class="text-center py-2">Gender</th>
                            <th scope="col" class="text-center py-2">Total Balance</th>
                            <th scope="col" class="text-center py-2">Action</th>
                            <th scope="col" class="text-center py-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                <?php 
                    $cnt=1;
                    while($rows=mysqli_fetch_assoc($result)){
                ?>
                    <tr class="text-center pt-3" style="color : black; justify-content:center;">
                        <td class="py-2"><?php echo $cnt;; ?></td>
                        <td class="py-2"><?php echo $rows['name']?></td>
                        <td class="py-2"><?php echo $rows['gender']?></td>
                        <td class="py-2">Php <?php echo $rows['curr_balance']?></td>
                        <td><a href="custo-one.php?id= <?php echo $rows['id'] ;?>"><button  type="button" class="btn btn-success" style="border-radius:0%; margin-left:3px">View one</button></a> </td><td><a href="transaction.php?id= <?php echo $rows['id'] ;?>"><button type="button" class="btn btn-primary" style="border-radius:0%;">Transfer</button></a></td> 
                    </tr>
                <?php
                        $cnt=$cnt+1;
                    }
                ?>
            
                        </tbody>
                    </table>
                    </div>
                </div>
            </div> 
         </div>
         <footer class="text-center mt-5 py-2">
          <!-- <p>&copy 2021 Made by <b>AYUSH PRAJAPATI</b></p>-->
        </footer>
         <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script> 
</body>

</section>




</body>
</html>