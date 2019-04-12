<?php require APPROOT . "/views/inc/header.php"; ?>
 <div class="container">

  
       <header>
            <h1>Shop</h1>
        </header>

        <hr>

         <div class="row text-center">

         	<?php foreach($data["products"] as $key => $value): ?>

                <div class="col-md-3 col-sm-6 hero-feature">

                    <form  method="post" action="<?php echo URLROOT; ?>/pages/cart/?action=add&code=<?php echo $data["products"][$key]->product_id; ?>">
                        <div class="thumbnail">
                            <img style="height:100px" src="assets/images/<?php echo $data["products"][$key]->product_image; ?>" alt="">
                            <div class="caption">
                            	<h4 class="pull-right">&#36;<?php echo $data["products"][$key]->product_price; ?></h4>
                                <h3><?php echo $data["products"][$key]->product_title; ?></h3>    
                                <p>
                                    <input type="hidden"  name="quantity" value="1" />
                                    <input type="submit" class="btn btn-primary" value="Add to cart">
                                </p>
                                Rate:
                                <hr>
                                <p><?php echo round($data["products"][$key]->rating); ?>/5 </p>
                                
                            </div>
                        </div>
                    </form>

                </div>
            

        	<?php endforeach; ?>
         </div>
            
         

           
</div>        

<?php require APPROOT . "/views/inc/footer.php"; ?>