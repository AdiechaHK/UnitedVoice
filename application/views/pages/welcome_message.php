<nav role="navigation" class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav"> 
         <li>
            <audio id="mejs" src="<?php echo base_url('php_uploads/'.$songs[0]['name']) ?>" type="audio/mp3" controls="controls" hieght="50px"></audio>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div style="margin-top: 90px" class="container">
  <div class="userArea col-md-3 col-lg-3">
    <?php if(isset($user)) { ?>
    <div>Welcome <?=$user->name?><span class="pull-right"><?=anchor("user/logout", "Log out")?></span></div>
    <?php } else  { ?>
    <div>Welcome  </div>
    <?php } ?>
    <h4>United Voice</h4>
    <?php if(isset($user)) { ?>
    <?=form_open("user/do_post")?>
      <textarea name="post" style="resize: none; border-color: lightgray; width: 100%" rows="4"></textarea>
      <br><br><button class="btn btn-success">Post</button>
    </form>
    <?php } else  { ?>
    <?=form_open("user/login")?>
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
    <?php } ?>

      <div style="background-color: black; color: white; padding: 10px; margin: 10px 0px;" class="userPostHeader">
        <h4>
          <span>
            news feeds
          </span>
          <span class="pull-right">
            <div class="btn glyphicon glyphicon-list-alt"></div>
            <div class="btn glyphicon glyphicon-envelope"></div>
            <div class="btn glyphicon glyphicon-bell"></div>
            <div class="btn glyphicon glyphicon-align-justify"></div>
          </span>
        </h4>
      </div>
      <div class="userPostContainer">
        <!-- <div class="userPost">
          <div class="title">by HK the champion<?=date("j M \| h:i a")?></div>
          <div class="content">this is testing post just test</div>
          <div class="actionBar">
            <span class="pull-left">14 Jun | 9:34 am</span>
            <span class="pull-right">
              <div class="btn glyphicon glyphicon-hand-up"></div>
              <div class="btn glyphicon glyphicon-heart"></div>
              <div class="btn glyphicon glyphicon-remove"></div>
            </span>
          </div>
        </div>
        <hr>
        <div class="userPost">
          <div class="title">by HK the champion</div>
          <div class="content">this is testing post just test</div>
          <div class="actionBar">
            <span class="pull-left">14 Jun | 9:34 am</span>
            <span class="pull-right">
              <div class="btn glyphicon glyphicon-hand-up"></div>
              <div class="btn glyphicon glyphicon-heart"></div>
              <div class="btn glyphicon glyphicon-remove"></div>
            </span>
          </div>
        </div>
        <hr>
        <div class="userPost">
          <div class="title">by HK the champion</div>
          <div class="content">this is testing post just test</div>
          <div class="actionBar">
            <span class="pull-left">14 Jun | 9:34 am</span>
            <span class="pull-right">
              <div class="btn glyphicon glyphicon-hand-up"></div>
              <div class="btn glyphicon glyphicon-heart"></div>
              <div class="btn glyphicon glyphicon-remove"></div>
            </span>
          </div>
        </div> -->
        <?php foreach ($posts as $i => $post) { ?>
        <div class="userPost">
          <div class="title">by <?=$post->user_name?></div>
          <div class="content"><?=$post->post_text?></div>
          <div class="actionBar">
            <span class=""><?=date("j M \| h:i a", strtotime($post->time))?></span>
            <span class="pull-right">
              <a class="commentBtn" title="toggle comment" base=<?="'".base_url()."'"?> commenturi=<?="'user/list_comment/".$post->id."'"?>  ><i class="btn glyphicon glyphicon-hand-up"></i></a>
              <a class=<?="'likeBtn ".(isset($post->liked) && $post->liked == 1?"liked'":"'")?> title=<?=(isset($post->liked) && $post->liked == 1?"'Click to unlike'":"'Click to like'")?> base=<?="'".base_url()."'"?> likeuri=<?="'user/post_like/".$post->id."'"?>  ><i class="btn glyphicon glyphicon-heart"></i></a>
              <a class="removeBtn" title="Click to remove post" base=<?="'".base_url()."'"?> removeuri=<?="'user/remove_post/".$post->id."'"?>  ><i class="btn glyphicon glyphicon-remove"></i></a>
              <!-- <div class="btn glyphicon glyphicon-heart"></div> -->
              <!-- <div class="btn glyphicon glyphicon-remove"></div> -->
            </span>
          </div>
          <div class="commentsBlock">
            <div class="list">
            </div>
            <?php if(isset($user)) { ?>
              <div class="form-div" style="margin-top: 10px;">
                <div class="input-group">
                  <input type="text" class="form-control" name="comment">
                  <span class="input-group-btn">
                    <button  base=<?="'".base_url()."'"?> commenturi=<?="'user/do_comment/".$post->id."'"?>  class="btn btn-default" type="button"><i class="glyphicon glyphicon-send"></i></button>
                  </span>
                </div><!-- /input-group -->
              </div>
            <?php } ?>
          </div><hr>
        </div>
        <?php } ?>
      </div>
  </div>
  <div class="presidentArea col-md-5 col-lg-5">
    <h4>United Voice Precident</h4>
    <ul class="nav nav-pills">
      <li>news feeds</li>
      <li>media</li>
      <li>development</li>
    </ul>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs">
      <li><a href="#pnews" data-toggle="tab">News feeds</a></li>
      <li class="active"><a href="#pmedia" data-toggle="tab">Media</a></li>
      <li><a href="#pdev" data-toggle="tab">Development</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
      <div class="tab-pane" id="pnews">

        <?php foreach ($list_of_pnews as $key => $pnews) { ?>
          <div class="news-block">
            <h2 class="news-headline"><?=$pnews->headline?></h2>
            <p style="font-weight: bold; color: green;"><?=$pnews->place?></p>
              <?php if(isset($pnews->images) && $pnews->images != NULL) {
                $pnews_image_arr = explode(",", $pnews->images);?>
                <div id=<?="'carousel-example-generic-".$pnews->id."'"?> class="carousel slide" data-ride="carousel">

                  <!-- Wrapper for slides -->
                  <div class="carousel-inner">
                <?php foreach ($pnews_image_arr as $key => $value) { ?>
                <div class=<?=($key > 0 ? "'item'": "'item active'")?> >
                  <!-- <img src="http://localhost/UnitedVoice/client_data/images/presidental_news_1_1403589379.jpg" alt="..."> -->
                  <img src=<?="'".$value."'"?> alt=<?="'".$pnews->headline." image ".$key."'"?> style="max-width: 100%" />
                  <div class="carousel-caption">
                    ...
                  </div>
                </div>
                  <!-- <img src=<?="'".$value."'"?> alt=<?="'".$pnews->headline." image ".$key."'"?> style="max-width: 100%" /> -->
                <?php } ?>
                </div>
                <!-- Controls -->
                <a class="left carousel-control" href=<?="'#carousel-example-generic-".$pnews->id."'"?> data-slide="prev">
                  <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="right carousel-control" href=<?="'#carousel-example-generic-".$pnews->id."'"?> data-slide="next">
                  <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
              </div>
             <?php } ?>

            <p><?=$pnews->artical_text?></p>
          </div>
        <?php } ?>
      </div>
      <div class="tab-pane active" id="pmedia">
        <?php foreach ($songs as $s): ?>
          <div class="media">
            <a class="pull-left" href="<?php echo base_url('php_uploads/'.$s['name']) ?>">
              <span class="glyphicon glyphicon-music"></span>
            </a>
            <div class="media-body">
              <h4 class="media-heading"><?= $s['actual_name'] ?></h4>
            </div>
          </div>
        <?php endforeach ?>
      </div>
      <div class="tab-pane" id="pdev">
        Development
      </div>
    </div>
  </div>
  <div class="secterArea col-md-4 col-lg-4">
    <h4>United Voice Sector</h4>
    <ul class="nav nav-pills">
      <li>news feeds</li>
      <li>social campaign</li>
      <li>progress map</li>
    </ul>
  </div>
</div>