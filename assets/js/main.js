// const player = new Plyr('#player');

document.addEventListener('DOMContentLoaded', () => {
    // This is the bare minimum JavaScript. You can opt to pass no arguments to setup.
    const player = new Plyr('#player');


// return player;
});


document.querySelector('#btn_volume').addEventListener('click', function (e) {

    if (e.target.classList.contains('fa-volume-up')) {

        e.target.className = "fas fa-volume-mute";

    } else if (e.target.classList.contains('fa-volume-mute')) {

        e.target.className = "fas fa-volume-up";
    }

});


document.querySelector('.previewvideo').addEventListener('ended', function () {
    document.querySelector('.previewimg').removeAttribute("hidden");
    document.querySelector('.previewvideo').setAttribute("hidden", true);
});



function goBack() {
    window.history.back();
}

function startHide() {

    var timeout = null;
    var video = document.querySelector('#playerVideo');

    video.onmousemove = _ => {

        clearTimeout(timeout);
        document.querySelector('.btn_transprt').style.display = "block";
        // document.body.style.cursor = "default";

        timeout = setTimeout(() => {
            document.querySelector('.btn_transprt').style.display = "none";
            // document.body.style.cursor = "auto";
        }, 2000);

    }

}


function initVideo(videoId, userlogin) {
    startHide();
    setStartVideo(videoId, userlogin);
    progressTimer(videoId, userlogin);
    EndedVideo();
}

function progressTimer(videoId, userlogin){
    addDuration(videoId, userlogin);
    var timer;

    $("#player").on("playing", function(event){

        window.clearInterval(timer);
        timer= window.setInterval(function() {
           
            updateprogress(videoId, userlogin, event.target.currentTime)
        },3000);

    }).on("ended",function(){
        setFinished(videoId, userlogin);
        window.clearInterval(timer);

    })

}


function addDuration(videoId, userlogin){   
    $.post("ajax/addDuration.php",{id: videoId, username: userlogin} , function(data){
      if(data !== null && data !== ""){
        // alert(data);
      };
    });

}

function updateprogress(videoId, userlogin,progress) {
    $.post("ajax/updateDuration.php",{id: videoId, username: userlogin, progress: progress} , function(data){
        if(data !== null && data !== ""){
          alert(data);
        };
      });
}

function setFinished(videoId, userlogin) {
    $.post("ajax/setFinished.php",{id: videoId, username: userlogin} , function(data){
        if(data !== null && data !== ""){
          alert(data);
        };
      });
}

function setStartVideo(videoId, userlogin) {
    $.post("ajax/getProgress.php",{id: videoId, username: userlogin} , function(data){
        if(isNaN(data)){
          alert(data);
          return
        }

        $("#player").on("canplay",function(){
            this.currentTime = data;
            $("#player").off("canplay");
        })
      });
}


function restartVideo(){
    var video = document.getElementById('player');
    
    video.currentTime = 0;
    video.play();
    // video.pause();
    // video.load();
}

function playVideo(videoId){
    window.location.href = "watch.php?id="+videoId;
}

function EndedVideo(){
    $("#player").on("ended",function(){
        $(".refrechDiv").show();

        $(".plyr--full-ui.plyr--video .plyr__control--overlaid").hide();
        // $(this).addClass("video-overlay");
    }).on("playing",function(){
        $(".refrechDiv").hide();
        // $(this).removeClass("video-overlay");
    })
}

