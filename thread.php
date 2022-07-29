<?php include 'partial/_dbconnect.php'; ?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>My Site</title>
</head>

<body>
    <?php include 'partial/_header.php'; ?>
    <?php
    $id = $_GET['thread_id'];
    $sql = "SELECT * FROM threads where thread_id=$id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $title = $row['thread_title'];
        $desc = $row['thread_desc'];
        

         $thread_user_id = $row['thread_cat_userid'];
            $sql2="SELECT user_name FROM `users` WHERE sno='$thread_user_id'";
            $result2 = mysqli_query($conn, $sql2);
            $row2=mysqli_fetch_assoc($result2);
            $posted_by=$row2['user_name'];
    }
    ?>

    <?php
    $showalert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == 'POST') {
        $comment = $_POST['comment'];
        $comment = str_replace( ">", "&gt;",$comment);
        $comment = str_replace("<", "&lt;",$comment );
        $sno=$_POST["sno"];
        $sql = "insert into comments(comment_content,thread_id,comment_by,comment_time) values('$comment','$id','$sno',current_timestamp())";
        $result = mysqli_query($conn, $sql);
        $showalert = true;
        if ($showalert) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> Your comment has been added.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
        }
    }
    ?>



    <div class="container">
        <div class="jumbotron">
            <h1 class="display-4"><?php echo $title; ?></h1>
            <p class="lead"><?php echo $desc; ?></p>
            <hr class="my-4">
            <p>Posted By <em><?php echo $posted_by; ?></em> </p>
            <!-- <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a> -->
        </div>
    </div>



<?php if(isset($_SESSION['loggin']) && $_SESSION['loggin'] == true){
    echo '<div class="container">
        <h1 class="py-2">Post a Comment</h1>
        <form action="'.$_SERVER['REQUEST_URI'].'" method="post">

            <div class="form-group">
                <label for="exampleFormControlTextarea1">Type your Comment</label>
                <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                <input type="hidden" name="sno" value="'.$_SESSION["sno"].'">
            </div>
            <button type="submit" class="btn btn-primary">Post Comment</button>
        </form>
    </div>';
}else{
    echo '<div class="container">
        <p class="lead">Please Login to enable  a start a Discussion</p>
    </div>';
}
?>

   


    <div class="container my-3">
        <h1 class="py-4">Discussion</h1>

        <?php
        $id = $_GET['thread_id'];
        $sql = "SELECT * FROM comments where thread_id=$id";
        $result = mysqli_query($conn, $sql);
        $noresult = true;
        while ($row = mysqli_fetch_assoc($result)) {
            $noresult = false;
            $tid = $row['comment_id'];
            $content = $row['comment_content'];
            $comment_time = $row['comment_time'];
            $comment_by = $row['comment_by'];
            $sql3="SELECT user_name FROM `users` WHERE sno='$comment_by'";
            $result3 = mysqli_query($conn, $sql3);
            $row3=mysqli_fetch_assoc($result3);
            


            echo '<div class="media my-4">
            <img src="img/avtar.png" width="54px" class="mr-3" alt="...">
            <div class="media-body">
                <p class="font-weight-bold my-0">'. $row3['user_name']. ' at ' . $comment_time . '</p>
                <p">' . $content . '</p>
            </div>
        </div>';
        }
        if ($noresult) {
            echo '<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <p class="display-4">No Comments or Reply Found</p>
    <p class="lead">Be the first person to Reply on post</p>
  </div>
</div>';
        }
        ?>



    </div>
    <?php include 'partial/_footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>



</body>

</html>