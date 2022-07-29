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
    $id = $_GET['catid'];
    $sql = "SELECT * FROM categories where categories_id=$id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $catname = $row['categories_name'];
        $catdesc = $row['categories_desc'];
    }
    ?>

    <?php 
    $showalert=false;
    $method=$_SERVER['REQUEST_METHOD'];
    if($method=='POST'){
        $th_title = $_POST['title'];
        $th_desc = $_POST['desc'];
        $th_title = str_replace( ">", "&gt;",$th_title);
        $th_title = str_replace("<", "&lt;",$th_title );
        $th_desc = str_replace( ">", "&gt;",$th_desc);
        $th_desc = str_replace("<", "&lt;",$th_desc );

        $sno=$_POST['sno'];
         $sql = "insert into threads (thread_title,thread_desc,thread_cat_id,thread_cat_userid,timestamp) values('$th_title','$th_desc','$id','$sno',current_timestamp())";
         $result = mysqli_query($conn, $sql);
         $showalert=true;
         if($showalert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> Your thread has been added.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
         }
    }
    ?>
    <div class="jumbotron">
        <h1 class="display-4">Welcome to <?php echo $catname; ?></h1>
        <p class="lead"><?php echo $catdesc; ?></p>
        <hr class="my-4">
        <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
        <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
    </div>
<?php
 if(isset($_SESSION['loggin']) && $_SESSION['loggin'] == true){

  echo  '<div class="container">
        <h1 class="py-2">Ask a Question</h1>
    <form action="'. $_SERVER['REQUEST_URI'].'" method="post">
  <div class="form-group ">
    <label for="title">Threat Title</label>
    <input type="text" class="form-control" id="title"  name="title" aria-describedby="emailHelp">
    <small id="emailHelp" class="form-text text-muted">Keep your title as short</small>
  </div>
   <input type="hidden" name="sno" value="'. $_SESSION["sno"]. '">
   
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Ellaborate your Concern</label>
    <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
    </div>';

}else{
   echo '<div class="container">
        <p class="lead">Please Login to enable  a start a Discussion</p>
    </div>';
}
?>
        <div class="container my-3">
        <h1 class="py-4">Browse Questions</h1>
        <?php
        $id = $_GET['catid'];
        $sql = "SELECT * FROM threads where thread_cat_id=$id";
        $result = mysqli_query($conn, $sql);
        $noresult=true;
        while ($row = mysqli_fetch_assoc($result)) {
            $noresult=false;
            $tid = $row['thread_id'];
            $ttitle = $row['thread_title'];
            $tdesc = $row['thread_desc'];
            $thread_time = $row['timestamp'];
            $thread_user_id = $row['thread_cat_userid'];
            $sql2="SELECT user_name FROM `users` WHERE sno='$thread_user_id'";
            $result2 = mysqli_query($conn, $sql2);
            $row2=mysqli_fetch_assoc($result2);
            

            echo '<div class="media my-3">
            <img src="img/avtar.png" width="54px" class="mr-3" alt="...">
            <div class="media-body">
                     
                <h5 class="mt-0 my-0"><a class="text-dark" href="thread.php?thread_id='.$tid.'">'.$ttitle.'</a></h5>
                <p class="my-3">'.$tdesc.'</p>
            </div>
            <div class="font-weight-bold my-0"> Asked by '. $row2['user_name'] .' at '.$thread_time.'</div>
        </div>';
        }
        if($noresult){
            echo '<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <p class="display-4">No threads found</p>
    <p class="lead">Be the first person to ask a question</p>
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