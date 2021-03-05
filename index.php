<?php include("partials/menu.php");?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo HOMEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>

    <!-- fOOD sEARCH Section Ends Here -->

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            <?php
                if(isset($_SESSION['order'])){
                    echo $_SESSION['order'];
                    unset($_SESSION['order']);
                }
            ?>
            <?php
              $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' ";
              $res = mysqli_query($conn,$sql);
              $count = mysqli_num_rows($res);

              if($count>0){
                  while($rows=mysqli_fetch_assoc($res)){
                      $id = $rows['id'];
                      $title = $rows['title'];
                      $image_name = $rows['image_name'];
                      ?>
                          <a href="<?php echo HOMEURL;?>category-foods.php?category_id=<?php echo $id;?>">
                            <div class="box-3 float-container">
                                <?php
                                   if($image_name!=""){
                                       ?>
                                          <img src="<?php echo HOMEURL;?>images/category/<?php echo $image_name;?>" alt="Pizza" class="img-responsive img-curve">
                                       <?php
                                   }else{
                                       echo "<div class='error'>Image Not Available</div>";
                                   }

                                 ?>
                                <h3 class="float-text text-white"><?php echo $title; ?></h3>
                            </div>
                            </a>
                      <?php
                }
              }else{
                  echo "<div class='error'>Category Not Available</div>";
              }
            ?>
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
          <?php
           $sql2 = "SELECT * FROM tbl_food WHERE active='YES' AND featured='Yes'";
           $res2 = mysqli_query($conn,$sql2);
           $count2 = mysqli_fetch_assoc($res2);

           if($count2>0){
              while($row=mysqli_fetch_assoc($res2)){
                  $id = $row['id'];
                  $image_name=$row['image_name'];
                  $title = $row['title'];
                  $description = $row['description'];
                  $price = $row['price'];
                  ?>
                     <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php
                               if($image_name==""){
                                   echo "<div class='error'>Image Not Available</div>";
                               }else{
                                    ?>
                                       <img src="<?php echo HOMEURL?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                    <?php
                               }
                            ?>
                        </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="food-price">$<?php echo $price; ?></p>
                            <p class="food-detail">
                                <?php  echo $description; ?>
                            </p>
                            <br>

                            <a href="<?php echo HOMEURL; ?>order.php?food_id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
                      </div>
                   </div>
                  <?php
              }
           }else{
               echo "<div class='error'>Not Available</div>";
           }
          ?>
            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

    <!-- social Section Starts Here -->
    <section class="social">
        <div class="container text-center">
            <ul>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/50/000000/facebook-new.png"/></a>
                </li>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/48/000000/instagram-new.png"/></a>
                </li>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/48/000000/twitter.png"/></a>
                </li>
            </ul>
        </div>
    </section>
    <!-- social Section Ends Here -->

    <?php include("partials/footer.php");?>