<?php  include('layout/header.php')?>



 <!-- Orders -->
   <section  id="orders" class="orders container my-5 py-3">
    <div class="container  mt-5">
        <h2 class="font-weight-bolde text-center">Orders  Details</h2> 
        <hr class="mx-auto">
    </div>
    <table class="mt-5 pt-5">
        <tr>
            <th>Product Name</th>
             <th>Price</th>
              <th>Quantity</th>
               </tr>

               
       
        <tr>
            <td>
               <div class="product_info">
                <img src="assets/imgs/brand1.jpg" alt="">
              
               <div>
                <p class="mt-3"></p>
               </div>
                </div>
         

            </td>
            <td>
              <span></span>
            </td>
              <td>
              <span></span>
            </td>
    
            <td>
              <form action="">
                <input type="submit" class="btn  orders-details-btn" value="View detail" name="view_order">
              </form>
            </td>
                     
        </tr>

            
      </table>
   
   
   </section>







<?php  include('layout/footer.php');?>