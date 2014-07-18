<div>
  <h1>Hello presidental</h1>
  <!-- Nav tabs -->
  <ul class="nav nav-tabs">
    <li class="active"><a href="#news_feeds" data-toggle="tab">News Feeds</a></li>
    <li><a href="#media" data-toggle="tab">Media</a></li>
    <li><a href="#development" data-toggle="tab">Development</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div class="tab-pane active" id="news_feeds">
      <div class="container" style="margin-top: 20px;">
        <div class="row" id="news_feed_btn_container">
          <button class="btn btn-info" id="add_news_feed_btn"><i class="glyphicon glyphicon-plus"></i> Add News</button>
        </div>
        <div class="row" id="news_feed_form_controller" style="display: none;">
          <?=form_open("presidental/add_news")?>
            <div class="form-group">
              <label for="inputHeadline">Headline</label>
              <input type="text" class="form-control" id="inputHeadline" placeholder="Headline" name="headline">
            </div>
            <div class="form-group">
              <label for="inputPlace">Place</label>
              <input type="text" class="form-control" id="inputPlace" placeholder="Place" name="place">
            </div>
            <div class="form-group">
              <label for="inputArticalText">Artical Text</label>
              <!-- <input type="te" class="form-control" id="exampleInputPassword1" placeholder="Password"> -->
              <textarea class="form-control" id="inputArticalText" placeholder="Artical content" name="artical_text"></textarea>
            </div>
            <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-ok"></i> Submit</button>
            <button class="btn btn-info" id="add_news_feed_back_btn" onclick="return false;"><i class="glyphicon glyphicon-arrow-left"></i> Back</button>
          </form>
        </div>
        <div class="row">
          <h3>List of news</h3>
            <?php foreach ($list_of_news as $key => $news) { ?>
            <div class="panel panel-default">
              <div class="panel-heading"><?=$news->headline?></div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-8">
                    <p style="color: green;"><?=$news->place?></p>
                    <p><?=$news->artical_text?></p>
                  </div>
                  <div class="col-md-4">
                    <?php if(isset($news->images) && $news->images != NULL) { foreach (explode(",", $news->images) as $key => $value) { ?>
                    <img src=<?="'".$value."'"?> style="max-height: 100px; max-width: 100px;" />
                    <?php } } ?>
                      <br/><br/>
                    <?=form_open_multipart("presidental/add_image/".$news->id)?>
                      <input type="file" name="nimage" /><br/>
                      <input type="submit" class="btn btn-success" />
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <div style="display: none;">
              <h4><?=$news->headline?></h4>
              <?php if(isset($news->images) && $news->images != NULL) { foreach (explode(",", $news->images) as $key => $value) { ?>
              <img src=<?="'".$value."'"?> style="max-height: 200px; max-width: 200px;" />
              <?php } } ?><br/>
              <?=form_open_multipart("presidental/add_image/".$news->id)?>
                <input type="file" name="nimage" >
                <input type="submit">
              </form>
            </div>
            <?php } ?>
        </div>
      </div>
    </div>
    <div class="tab-pane" id="media"> media </div>
    <div class="tab-pane" id="development"> development </div>
  </div>

</div>