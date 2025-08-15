<?php 
include('include/header.php');
?>

<div class="payment-wrapper">
    <h1 class="text-success">Proceed to Payment</h1>
     <div class="pay-form">
        <form class="col-md-12" style="text-align: center;">
          <label for="card-number">Card Number:</label>
          <input type="text" id="card-number" placeholder="1234 5678 9012 3456">
          <br/><br/>
          <label for="card-name">Name on Card:</label>
          <input type="text" id="card-name" placeholder="Type in Capital Letter">
          <br/><br/>
          <label for="expiration">Expiration Date:</label>
          <input type="text" id="expiration" placeholder="MM/YY">
          <br/><br/>
          <label for="cvv">CVV:</label>
          <input type="text" id="cvv" placeholder="***">
          <br/><br/>
          <a href="index.php"><button type="button" class="btn btn-success" style="text-align:center;">
            <span class="submit" >Pay Now</span></button></a>
          <br/>
        </form>
      </div>
</div>

<?php include('include/footer.php'); ?>
