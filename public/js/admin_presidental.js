$(document).ready(function() {
  $("#add_news_feed_btn").click(function() {
    $("#news_feed_form_controller").show(200);
    $("#news_feed_btn_container").hide(200);
  });
  $("#add_news_feed_back_btn").click(function() {
    $("#news_feed_btn_container").show(200);
    $("#news_feed_form_controller").hide(200);
  });
});