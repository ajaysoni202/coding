<?php 
session_start();

echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php">Coding</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.php">About</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
          Categories
        </a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
    </ul>';
    if(isset($_SESSION['loggin']) && $_SESSION['loggin'] == true){

  
  echo '<form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
      <p class="text-light my-2 mx-2">welcome '.$_SESSION['user_name'].'</p>
       <a href="partial/logout.php" class="btn btn-outline-success ml-2">Logout</a>
      </form>';
}else{
   echo  '<div class="mx-2">
      <button class="btn btn-outline-success ml-2" data-toggle="modal" data-target="#loginModal">Login</button>
    <button class="btn btn-outline-success mx-2" data-toggle="modal" data-target="#signupModal">Signup</button>
    </div>';
}
    
    
  echo '</div>
</nav>';
include 'partial/_loginmodal.php';
include 'partial/_signupmodal.php';
if(isset($_GET['signupsuccess']) && $_GET['signupsuccess'] =="true"){
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Hurray!</strong> Your Account Has been Created
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
if(isset($_GET['signupsuccess']) && $_GET['signupsuccess'] =="false"){
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Ohh!</strong> Something went wrong due
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
?>