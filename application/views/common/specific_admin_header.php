<div class="container">
  <h1><img src=<?="'".base_url()."public/img/UV.png'"?> width="40px"/> United Voice </h1>
  <nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <a class="navbar-brand" href="#">Admin</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <?=($active_page == "admin_home"? '<li class="active"><a href="#">Home</a></li>': '<li>'.anchor('admin', "Home").'</li>') ?>
          <?=($active_page == "admin_presidental"? '<li class="active"><a href="#">Presidental</a></li>': '<li>'.anchor('admin/presidental', "Presidental").'</li>') ?>
          <?=($active_page == "admin_sector"? '<li class="active"><a href="#">Sector</a></li>': '<li>'.anchor('admin/sector', "Sector").'</li>') ?>
          <?=($active_page == "admin_songs"? '<li class="active"><a href="#">Songs</a></li>': '<li>'.anchor('song', "Songs").'</li>') ?>
<!-- 
          <li><a href="#">Presidental</a></li>
          <li><a href="#">Sector</a></li>
          <li><a href="#">Songs</a></li>
 -->
          <!--
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="#">Action</a></li>
              <li><a href="#">Another action</a></li>
              <li><a href="#">Something else here</a></li>
              <li class="divider"></li>
              <li><a href="#">Separated link</a></li>
              <li class="divider"></li>
              <li><a href="#">One more separated link</a></li>
            </ul>
          </li>
        --></ul><!--
        <form class="navbar-form navbar-left" role="search">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Search">
          </div>
          <button type="submit" class="btn btn-default">Submit</button>
        </form>-->
        <ul class="nav navbar-nav navbar-right">
          <!-- <li><a href="#">Link</a></li> -->
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?=$user->name?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="#">Settings</a></li>
              <li><a href="#">Manage User</a></li>
              <!-- <li><a href="#">Something else here</a></li> -->
              <li class="divider"></li>
              <li><?=anchor("user/logout?redirect_to=admin", "Log out")?></li>
            </ul>
          </li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
