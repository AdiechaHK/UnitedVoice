<div class="container">
  <div class="login-container">
    <div id="output"></div>
    <div class="avatar"><img src=<?="'".base_url()."public/img/UV.png'"?> width="100%" /></div>
    <div class="form-box">
      <?=form_open("user/login")?>
      <!-- <form action="" method=""> -->
        <input name="email" type="email" placeholder="Email" />
        <input name="password" type="password" placeholder="password" />
        <input name="redirect_to" type="hidden" value="admin" />
        <button class="btn btn-info btn-block login" type="submit">Login</button>
      </form>
    </div>
  </div>
</div>
<!--

  <div class="">
    <h1>Hello there</h1>
      <div class="form-group">
        <input class="form-control" type="email" name="email" />
      </div>
      <div class="form-group">
        <input class="form-control" type="password" name="password" />
      </div>
      <div class="form-group">
        <input class="form-control" type="submit" value="Login" />
      </div>
    </form>
  </div>-->