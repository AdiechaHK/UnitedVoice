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