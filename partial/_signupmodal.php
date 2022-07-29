
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="signupModalLabel">Create an Account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="partial/_handlesignup.php" method="post">
          <div class="form-group">
            <label for="user_name">Username</label>
            <input type="text" class="form-control" id="user_name" name="user_name" aria-describedby="emailHelp">
          </div>
          <div class="form-group">
            <label for="user_email">Email address</label>
            <input type="email" class="form-control" id="user_email" name="user_email" aria-describedby="emailHelp">
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password">
          </div>
          <div class="form-group">
            <label for="cpassword">Password</label>
            <input type="password" class="form-control" id="cpassword" name="cpassword">
          </div>
         
          <button type="submit" class="btn btn-primary">Signup</button>
        </form>
      </div>
      
    </div>
  </div>
</div>