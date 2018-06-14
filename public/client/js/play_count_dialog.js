var myVar = setInterval(myTimer, 500);
var modal, span, napBtn;
function myTimer() {
  modal = document.getElementById('myModal');
  span = document.getElementsByClassName("close")[0];
  napBtn = document.getElementById('napBtn');
  span.onclick = function() {
    modal.style.display = "none";
  }
  napBtn.onclick = function(){
    createCookie('theo_gai_play_count', 5, 1);
    console.log('Thêm lượt')
    modal.style.display = "none";
  }
  window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
  }
}


var createCookie = function(name, value, days) {
    var expires;
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toGMTString();
    }
    else {
        expires = "";
    }
    document.cookie = name + "=" + value + expires + "; path=/";
}

function getCookie(c_name) {
    if (document.cookie.length > 0) {
        c_start = document.cookie.indexOf(c_name + "=");
        if (c_start != -1) {
            c_start = c_start + c_name.length + 1;
            c_end = document.cookie.indexOf(";", c_start);
            if (c_end == -1) {
                c_end = document.cookie.length;
            }
            return unescape(document.cookie.substring(c_start, c_end));
        }
    }
    return "";
}

function sendScore(gameID, score) {

  var request = $.ajax({
    url: "https://dev.vainglory.vn/api/v1/track-score",
    type: 'POST',
    dataType: 'json',
    // beforeSend: function(request) {
    //   request.setRequestHeader("Access-Control-Allow-Origin", "*");
    // },
    data: {
      'access_token': 'wtf',
      'game_id': gameID,
      'score': score
    },
    success: function(data) {
      return data;
    }
  });

  request.done(function(msg) {
    console.log('done');
  });

  request.fail(function(jqXHR, textStatus) {
    console.log(jqXHR.responseText + '     ' + textStatus);
  });
}
