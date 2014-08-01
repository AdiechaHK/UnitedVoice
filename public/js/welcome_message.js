var addComment = function(holder, data, makeEmpty) {
  makeEmpty = makeEmpty || false;
  if(makeEmpty) {
    $(".list", holder).empty();
  }
  for (var i = 0; i < data.length; i++) {
    var comment = data[i];
    // console.log("<div class='comment'>" + comment.user_name + ": <i>" + comment.comment + "</i></div>");
    $(".list", holder).append("<div class='comment' title='" + comment.time + "'>" + comment.user_name + ": <i>" + comment.comment + "</i></div>");
  };
};



$(document).ready(function() {
  $(".commentBtn").click(function(){
    var commentBox = $(".commentsBlock", $(this).parents(".userPost"));
    var url = $(this).attr("base") + "index.php/" + $(this).attr("commenturi");
    if($(commentBox).css('display') == "none") {
      $.ajax(url, {
        success: function(data) {
          console.log(data);
          data = eval("("+data+")");
          console.log(data);

          addComment(commentBox, data.list, true);
        }
      })    
      $(commentBox).show(500);
    } else {
      $(commentBox).hide(300);
    }
  });

  $(".likeBtn").click(function(){
    var url = $(this).attr("base") + "index.php/" + $(this).attr("likeuri");
    if($(this).hasClass("liked")) {
      $(this).removeClass("liked");
      $.ajax(url, {
        success: function(data) {
          console.log(data);
          data = eval("("+data+")");
          console.log(data);

          //addComment(commentBox, data.list, true);
        }
      });
    } else {
      $(this).addClass("liked");
      $.ajax(url, {
        success: function(data) {
          console.log(data);
          data = eval("("+data+")");
          console.log(data);

          //addComment(commentBox, data.list, true);
        }
      })    
    }
  });

  $(".removeBtn").click(function(){
    var url = $(this).attr("base") + "index.php/" + $(this).attr("removeuri");
    $(this).parents(".userPost").remove();
    console.log(url);
    $.ajax(url, {
      success: function(data) {
        console.log(data);
        data = eval("("+data+")");
        console.log(data);

        //addComment(commentBox, data.list, true);
      }
    });
  });

  $("button[commenturi]", ".form-div").click(function() {
    var commentBox = $(".commentsBlock", $(this).parents(".userPost"));
    var url = $(this).attr("base") + "index.php/" + $(this).attr("commenturi");
    var inputField = $("input[name=comment]", $(this).parents(".form-div"));
    var data = {
        comment: $(inputField).val()
      };
    console.log(url);
    console.log(data);    
    $.ajax(url, {
      data: data,
      type: "POST",
      success: function(data) {
        data = eval("("+data+")");
        console.log(data);
        switch(data.status) {
          case "SUCCESS":
            addComment(commentBox, data.list);
            $(inputField).val("");
            break;
        }
      }
    });
  });
  // $("form[commenturi]").submit(function() {
  // })

  $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
    e.preventDefault();
    alert("Test: " + $(this).attr("href"));
  });
});

// player
$(function(){
    $('video,audio').mediaelementplayer({
      // shows debug errors on screen
      enablePluginDebug: false,
      // remove or reorder to change plugin priority
      plugins: ['flash','silverlight'],
      // specify to force MediaElement to use a particular video or audio type
      type: '',
      // path to Flash and Silverlight plugins
      pluginPath: '/build/',
      // name of flash file
      flashName: 'flashmediaelement.swf',
      // name of silverlight file
      silverlightName: 'silverlightmediaelement.xap',
      // default if the <video width> is not specified
      defaultVideoWidth: 480,
      // default if the <video height> is not specified    
      defaultVideoHeight: 270,
      // overrides <video width>
      pluginWidth: -1,
      // overrides <video height>      
      pluginHeight: -1,
      // rate in milliseconds for Flash and Silverlight to fire the timeupdate event
      // larger number is less accurate, but less strain on plugin->JavaScript bridge
      timerRate: 250,
        success: function (mediaElement, domObject) {
            mediaElement.addEventListener('ended', function (e) {
                mejsPlayNext(e.target);
            }, false);
        },
        keyActions: []
    });

    $('.media a').click(function(e) {
        e.preventDefault();
        $(this).addClass('current').siblings().removeClass('current');
        var audio_src = $(this).attr('href');
        $('audio#mejs:first').each(function(){
            this.player.pause();
            this.player.setSrc(audio_src);
            this.player.play();
        });
    });

});

// function mejsPlayNext(currentPlayer) {
//     if ($('.media a.current').length > 0){ // get the .current song
//         var current_item = $('.media a.current:first'); // :first is added if we have few .current classes
//         var audio_src = $(current_item).next().attr('href');
//         $(current_item).next().addClass('current').siblings().removeClass('current');
//     }else{ // if there is no .current class
//         var current_item = $('.media a:first'); // get :first if we don't have .current class
//         var audio_src = $(current_item).next().attr('href');
//         $(current_item).next().addClass('current').siblings().removeClass('current');
//     }

//     if( $(current_item).is(':last-child') ) { // if it is last - stop playing
//         $(current_item).removeClass('current');
//     }else{
//         currentPlayer.setSrc(audio_src);
//         currentPlayer.play();
//     }
// }