
<?php
session_start();
if (!isset($_SESSION["UserName"])) {
  header("location: index.php");
  exit();
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <title>Travel Hunter</title>
    <!-- CSS -->
    <link rel="stylesheet" href="../style/boracaybook.css" />
    <link
      href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet"
    />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
  </head>
  <body>


    <section class="overlay"></section>
    
    <section class="main">
                    
        <div class="container">
        
            <form id="bookingForm" action="../include/boracaymarket1.php" method="post">
                <h2>Booking Form</h2>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required><br><br>
    
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required><br><br>
    
                <label for="phone">Phone:</label>
                <input type="text" id="phone" name="phone" min="1" max="11" required><br><br>
               
                <label for="name">Address:</label>
                <input type="text" id="address" name="address" required><br><br>
    
                <label for="package">Product Name:</label>
                <input class="package" type="text" id="Product" name="Product" required><br><br>
    
    
                <label for="amount">Total Amount:</label>
                <input class="amount" type="number" id="amount" name="amount" step="0.01" required><br><br>
    
                <label for="payment">Payment Method:</label>
                <input class="payment" type="text" id="payments" name="payments" required><br><br>
    
                <label for="Reference">Reference Number:</label>
                <input class="Reference" type="text" id="reference" name="reference" required><br><br>
    
                
    
                <input class="submit" type="submit" value="Book and Pay">
            </form>
        </div>

    </section>
    <script src="../js/home.js"></script>
    <script src="../js/language.js"></script>
  </body>
</html>