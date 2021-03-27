<!DOCTYPE html>
<html lang="en">
<?php include("./login/index.php") ?>
<?php
if(isset($_GET['id'])){
  if(!empty($_GET['id'])){
    $uid = $_GET['id'];
    if(preg_match("/^[0-9]+$/", $uid)){
      $sql = "SELECT * from RECIPES where recipe_id=$uid";
      $result = mysqli_query($conn, $sql);
      mysqli_fetch_all($result);
      foreach($result as $value){
        $recipe = $value;
      }
      if(isset($recipe)){
        $user_id = $recipe['user_id'];
        $sql = "SELECT username, email, first_name, last_name from USERS where user_id=$user_id";
        $user = mysqli_query($conn, $sql);
        mysqli_fetch_row($user);

        foreach($user as $value){
          $user = $value;
        }

        $sql = "SELECT text from RECIPEINGREDIENTS where recipe_id=$uid";
        $result = mysqli_query($conn, $sql);
        mysqli_fetch_all($result);
        $ings = array();
        foreach($result as $value){
          array_push($ings, $value['text']);
        }

      }
      else{
        header("location: error");
      }


    }else{
      header("location: error");
    }
  }else{
    header("location: error");
  }
}

 ?>

<head>
  <title><?php
  echo $recipe['name']; ?></title>

  <!-- =======================================================
  * Template Name: Company - v4.0.1
  * Template URL: https://bootstrapmade.com/company-free-html-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <?php include("navbar.php") ?>


  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <?php
            echo "<h2>".$recipe['name']."</h2>";
           ?>
          <ol>
            <li><a href="index">Home</a></li>
            <li><a href="search">Search Recipes</a></li>
            <?php
              echo "<li>".$recipe['name']."</li>";
             ?>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Blog Single Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">

        <div class="row">

          <div class="col-lg-8 entries">

            <article class="entry entry-single">

              <div class="entry-img">
                <img src="<?php
                echo $recipe['image_url'] ?>" alt="" class="img-fluid">
              </div>

              <h2 class="entry-title">
                <a href="#"><?php
                  echo $recipe['name'];
                 ?></a>
              </h2>

              <div class="entry-meta">
                <ul>
                  <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="recipe1.html">
                    <?php
                    echo $user['first_name']." ".$user['last_name']; ?>
                  </a></li>
                  <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="recipe1.html"><time datetime="2020-01-01">
                    <?php
                      echo $recipe['date_created'];
                     ?>
                   </time></a></li>
                  <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="recipe1.html">0 Comments</a></li>
                </ul>
              </div>

              <div class="entry-content"><br>

                <h4 class="text-muted">Overview</h4>



        <div class="row">
          <div class="col-lg-6">
            <ul class="list-group overview">
              <li><i class="fas fa-clock"></i> <span class="overview-title"> Cooking time:</span>
                <?php
                  echo $recipe['time']." minutes";
                 ?>
               </li>
              <li><i class="fas fa-star"></i> <span class="overview-title"> Difficulty:
                <?php
                  $star = $recipe['difficulty'];
                  for($i=1;$i<=$star;$i++){
                    echo "<span class='fa fa-star checked'></span>";
                  }
                  for($i=1;$i<=5-$star;$i++){
                    echo "<span class='fa fa-star '></span>";
                  }
                 ?>
              </span></li>
            </ul>
          </div>
          <div class="col-lg-6">
            <ul class="list-group overview">

              <li><i class="fas fa-clock"></i> <span class="overview-title"> Total time:</span>
                <?php
                  echo ($recipe['time']+15)." minutes";
                 ?>
               </li>
              <li><i class="fas fa-list-ul"></i> <span class="overview-title"> Yield: </span>
                <?php
                  echo $recipe['servings']." servings";
                 ?>
               </li>
            </ul>
          </div>
        </div>

      <br>

      <h4 class="text-muted">Ingredients</h4>
      <ul class="list-group ingg">
        <?php
        if(isset($ings)){
          foreach ($ings as $value){
            echo "<li>".$value."</li>";
          }
        }
        if(count($ings)<1){
          echo "<b >&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspNo Ingredients Found</b>";
        }
         ?>
      </ul>
      <br>
      <h4 class="text-muted">Recipe</h4>

      <ol style="1" class="steps">

      <?php
      if(isset($recipe['instructions'])){
        $lines = explode("\n", $recipe['instructions']);


        if(!empty($recipe['instructions'])){
          foreach ($lines as $value){
            if(strlen($value)>5){
              echo "<li>$value</li>";
            }
          }
        }else{
            echo "<b>No Steps Found</b>";
        }
      }

       ?>
      </ol>


<figure class="text-end">
  <blockquote class="blockquote">
    <p>
      <?php
      if(isset($recipe['story'])){
        if(!empty($recipe['story'])){
          echo $recipe['story'];
        }
        else{
          echo "NO STORY FOUND";
        }

      }


       ?>
    </p>
  </blockquote>
  <figcaption class="blockquote-footer">
    Owner of the recipe
  </figcaption>
</figure>
                <img src="" class="img-fluid" alt="">



              </div>

              <div class="entry-footer">


                <i class="bi bi-tags"></i>
                <ul class="tags">
                  <li><a href="#">Biscuits</a></li>
                  <li><a href="#">Quick</a></li>
                  <li><a href="#">Easy</a></li>
                </ul>
              </div>

            </article><!-- End blog entry -->

            <div class="blog-author d-flex align-items-center">
              <img src="assets/img/blog/6.png" class="rounded-circle float-left" alt="">
              <div>
                <h4>  <?php
                  echo $user['first_name']." ".$user['last_name']; ?></h4>
                <p>
                  I am a cooking enthusiast. I love trying out new recipes and also sharing my recipes with the world.
                </p>
              </div>
            </div><!-- End blog author bio -->

            <div class="blog-comments">

              <h4 class="comments-count">3 Comments</h4>

              <div id="comment-1" class="comment">
                <div class="d-flex">
                  <div class="comment-img"><img src="assets/img/blog/1.png" alt=""></div>
                  <div>
                    <h5><a href="">Georgia Reader</a> <a href="#" class="reply"><i class="bi bi-reply-fill"></i> Reply</a></h5>
                    <time datetime="2020-01-01">6 March, 2021</time>
                    <p>
                     Would love to try it out soon!
                    </p>
                  </div>
                </div>
              </div><!-- End comment #1 -->

              <div id="comment-2" class="comment">
                <div class="d-flex">
                  <div class="comment-img"><img src="assets/img/blog/2.png" alt=""></div>
                  <div>
                    <h5>Aron Alvarado <a href="#" class="reply"><i class="bi bi-reply-fill"></i> Reply</a></h5>
                    <time datetime="2020-01-01">10 March, 2021</time>
                    <p>
                      Looks delicious!
                    </p>
                  </div>
                </div>

                <div id="comment-reply-1" class="comment comment-reply">
                  <div class="d-flex">
                    <div class="comment-img"><img src="assets/img/blog/3.png" alt=""></div>
                    <div>
                      <h5><a href="">Lynda Small</a> <a href="#" class="reply"><i class="bi bi-reply-fill"></i> Reply</a></h5>
                      <time datetime="2020-01-01">11 March, 2021</time>
                      <p>
                        Couldn't agree more
                      </p>
                    </div>
                  </div>


                </div><!-- End comment reply #1-->

              </div><!-- End comment #2-->


              <div class="reply-form">
                <h4>Leave a Reply</h4>
                <p>Your email address will not be published. Required fields are marked * </p>
                <form action="">
                  <div class="row">
                    <div class="col-md-6 form-group">
                      <input name="name" type="text" class="form-control" placeholder="Your Name*">
                    </div>
                    <div class="col-md-6 form-group">
                      <input name="email" type="text" class="form-control" placeholder="Your Email*">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col form-group">
                      <input name="website" type="text" class="form-control" placeholder="Your Website">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col form-group">
                      <textarea name="comment" class="form-control" placeholder="Your Comment*"></textarea>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary">Post Comment</button>

                </form>

              </div>

            </div><!-- End blog comments -->

          </div><!-- End blog entries list -->

          <div class="col-lg-4">
              <?php include("sidebar.php") ?>
          </div><!-- End blog sidebar -->

        </div>

      </div>
    </section><!-- End Blog Single Section -->

  </main><!-- End #main -->

    <?php include("footer.php") ?>


  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>
