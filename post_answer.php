<?php
    include "include/header.php";


    if(!isset($_GET['q_id'])){
        echo "You have not choosen a question!";

    }else{
        $q_id = $_GET['q_id'];
    }
?>

<!-- font awesome js link -->
<script src="https://use.fontawesome.com/5d66a18552.js"></script>
<div class="header">
<nav>
<a href="home.php" class="logo">ComPioneer</a>
<a class= "iconNav" href="profile.php"><i class="fa fa-user-o" aria-hidden="true"></i></a>
</nav>
</div>


    <div class="col align-self-center">


  <!-- show the selected question -->
      <?php
      session_start();
         $sql="SELECT * FROM questions WHERE q_id = $q_id";
         $q_query = mysqli_query($con, $sql);
            if(!$q_query){
                die("Error: ".mysqli_error($con));
            }else{
              while($q_row=mysqli_fetch_assoc($q_query)){
                    $q_title= $q_row['q_title'];
                    $q_body= $q_row['q_body'];
                    $q_username= $q_row['username'];
                    $q_timestamp=$q_row['timestamp'];
                      ?>

                        <!-- echo   $q_username ."<br>";
                        echo  $q_title."<br>";
                        echo $q_body."<br>";
                        echo $q_timestamp."<br>"; -->

                        <div class="container-home">
                        <div class="card bg-light mb-3" id="Acoloring">
                          <div class="card-header">  <?php
                            echo $q_username;
                            ?></div>
                          <div class="card-body">
                            <h5 class="card-title"> <p><?php
                             echo $q_title;
                             ?></p></h5>
                            <p class="card-text"><?php echo $q_row['q_body']; ?></p>
                           <div class="timestamp">
                             <?php echo $q_timestamp;?>
                           </div>



                      <?php
                        $sql_tags= "SELECT * FROM q_tags WHERE q_id= $q_id";
                        $tag_id_query = mysqli_query($con, $sql_tags);
                        if(!$tag_id_query){
                            die("Error: ". mysqli_error($con));
                        }else{
                            while($tag_id_row= mysqli_fetch_assoc($tag_id_query)){
                            $tag_id= $tag_id_row['tag_id'];
                            $sql_tag_title= "SELECT * FROM tags WHERE tag_id= $tag_id";
                            $tag_title_query= mysqli_query($con, $sql_tag_title);

                            if(!$tag_title_query){
                                die("Error: ".mysqli_error($con));
                                }else{
                                        while($tag_title_row=mysqli_fetch_assoc($tag_title_query)){
                                        $tag_title= $tag_title_row['tag_title'];
                                        ?> <span class= "badge badge-pill badge-primary"><?php echo $tag_title; ?></span> <?php
                                    }

                                }
                            }
                        }
                    }
                }
            ?>
        </div>
      </div>
    </div>



    <!-- answers part -->


                <?php
                    $sql= "SELECT * FROM answers WHERE q_id= $q_id";
                    $a_query=mysqli_query($con, $sql);

                    if(!$a_query){
                        die("Error: ".mysqli_error($con));
                    }else{
                        while($a_row=mysqli_fetch_assoc($a_query)){
                            $a_id= $a_row['a_id'];
                            $a_body = $a_row['answer'];
                            $a_username = $a_row['username'];
                            $a_timestamp = $a_row['timestamp'];
                             ?>
                            <div class="container-home">
                            <div class="card bg-light mb-3" id="coloring">

                              <div class="card-header"> <?php
                                     echo $a_username;
                               ?></div>

                               <div class="card-body">
                               <p class="card-text"> <?php echo $a_body; ?></p>
                               <div class="timestamp">   <?php echo $a_timestamp;?> </div>

                             </div>
                             </div>
                        <?php


                        }
                    }
                ?>

    </div>

    <hr>

    <!-- Answer Form: this form will not show up unless the user is a registed user -->

        <div class="col align-self-center">
        <?php
            if(!isset($_SESSION['username'])){
                echo "<h3>To add an answer you have to be <a href='landing.php'>logged in</a></h3>";
            }else{
        ?>
            <form action="include/insertAnswer.php" method="post">
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Write your answer here:</label>
                    <textarea name="answer" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    <input type="hidden" name="q_id" value="<?php echo $q_id; ?>">
                </div>
                <div class="form-group">
                    <button name="submit" value="submit">Post an Answer</button>
                </div>
            </form>
        </div>

            <?php } ?>
</body>
</html>
