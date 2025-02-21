$("#videojs-player").on('contextmenu', function(e) {
    e.preventDefault();
});
var acao                    = $("#stream-info").attr("data-acao");
var stream_assistindo_type  = $("#stream-info").attr("data-type");
var stream_id               = $("#stream-info").attr("data-id");
var episodio                = $("#stream-info").attr("data-episodio");
var currentTime             = 0;
$.ajax({
    url: SITE_URL + '/controller/stream/stream_play.php?ajax=ajax',
    method: "POST",
    data:{acao:acao, stream_id:stream_id, episodio:episodio},
    success: function(res){
        try{ 
          var play = JSON.parse(res);
          if(play.status == 'ok'){
          var player = videojs('videojs-player', {
              poster: $("#stream-info").attr("data-image"),
              controls: true,
              autoplay: false,
              fluid: true,
              responsive: true,
              aspectRatio: '16:9',
              enableSmoothSeeking: true,
              controlBar: {
                skipButtons: {
                  forward: 10,
                  backward: 10,
                }
              },
              userActions: {
                click: true
              },

            });

            player.src(play.player_url);
            
            if(play.stream_assistindo_time != ''){
              player.currentTime(play.stream_assistindo_time);
            }
            /*
            player.on("play", function(){
              currentTime = parseInt(player.currentTime());
              if(currentTime != 0){
                  player.src(play.player_url);
                  player.currentTime(currentTime);
                  player.play();
              }
            });
            */
            
            setInterval(function(){
              if(!player.paused()){
                  currentTime = parseInt(player.currentTime());
                  $.ajax({
                    url: SITE_URL+"/controller/stream/stream_assistindo.php?ajax=ajax",
                    method: "POST",
                    data: {acao:'stream_assistindo_cad',stream_assistindo_type: stream_assistindo_type, stream_assistindo_stream:stream_id, stream_assistindo_episodio:episodio, stream_assistindo_time:currentTime},
                  });
              }
            },30000);
            
            }else{
              ajax_error("Não foi possível carregar o player de vídeo");
            }

        }catch(error){
            ajax_error("Não foi possível carregar o player de vídeo");
        }
    }
});