<?php
    include ("include/header.php");
    session_start();

    if(!isset($_SESSION['username'])){
        header("Location: ../home.php");
    }else{

        $user= $_SESSION['username'];

        // $sql="SELECT * FROM users WHERE username='$user'";
        // $isAdmin_query= mysqli_query($con, $sql);
        //
        // if(!$isAdmin_query){
        //     die("Error ".mysqli_error($con));
        // }else{
        //     while($row=mysqli_fetch_assoc($isAdmin_query)){
        //         if($row['isAdmin']==0 ){
        //             header("Location: ../home.php");
        //         }
        //     }
        // }

    if(isset($_POST['edit'])){

        $tag_id=$_POST['edit'];

        $sql="SELECT * FROM tags WHERE tag_id=$tag_id";

        $tag_query= mysqli_query($con,$sql);

        if(!$tag_query){
            die("Error: ". mysqli_error($con));
        }else {
            while($row= mysqli_fetch_assoc($tag_query)){
              $tag_title= $row['tag_title'];

}}
}else{

    header("Location: setting.php?edit_tag=failed");
}
            ?>


            <section id="add_tags">
                <div class="contaire">
                    <div class="col-xs-6 col-xs-offset-3">
                        <div class="form-wrap">

                        <h1>Add Tags</h1>
                            <form role="form" action="include/edit.php" method="post" id="login-form" autocomplete="off">
                                <div class="form-group">
                                    <label for="tag_title">
                                    <input type="text" name="tag_title" id="tag_title" class="form-control" value="<?php echo $tag_title; ?>" required>
                                </div>
                                <button name="edit_tag" class="btn btn-primary" value="<?php echo $tag_id;?>">Add Tag </button>
                            </form>
                        </div>
                    </div>
                </div>
            </section>

            </body>
           </html>

            <?php
        }

?>
