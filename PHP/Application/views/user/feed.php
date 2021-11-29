<link rel="stylesheet" href="/assets/css/user/chatbot.css">

<!-- <div class="wrapper">
    <div class="title">Simple Online Chatbot</div>
    <div class="form">
        <div class="bot-inbox inbox">
            <div class="icon">
                <i class="fas fa-user"></i>
            </div>
            <div class="msg-header">
                <p>Hello there, how can I help you?</p>
            </div>
        </div>
    </div>
    <div class="typing-field">
        <div class="input-data">
            <input id="data" type="text" placeholder="Type something here.." required>
            <button id="send-btn">Send</button>
        </div>
    </div>
</div> -->
<form action="" method="post" id="ja_shoutbox">
    <div class="row">
        <div class="col-md-12">
            <textarea cols="30" rows="20" class="form-control" readonly style='resize:none' placeholder='Mensagens...'></textarea>
        </div>
        <div class="col-md-8">
            <input type="text" placeholder="Escreva sua mensagem..." class="form-control" name="mensagem">
        </div>
        <div class="col-md-4">
            <input type="submit" value="Enviar mensagem" class="form-control btn btn-info">
        </div>
        <div class='col-md-12 alert alert-info' style='display:none' id='msg'>
            
        </div>
    </div>
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

<script src="/assets/js/user/chatbot.js"></script>

<script>
    $(document).ready(function(){
        $("#send-btn").on("click", function(){
            $value = $("#data").val();
            $msg = '<div class="user-inbox inbox"><div class="msg-header"><p>'+ $value +'</p></div></div>';
            $(".form").append($msg);
            $("#data").val('');
            
            // start ajax code
            $.ajax({
                url: '/user/chatbot',
                type: 'POST',
                data: 'text='+$value,
                success: function(result){
                    $replay = '<div class="bot-inbox inbox"><div class="icon"><i class="fas fa-user"></i></div><div class="msg-header"><p>'+ result +'</p></div></div>';
                    $(".form").append($replay);
                    // when chat goes down the scroll bar automatically comes to the bottom
                    $(".form").scrollTop($(".form")[0].scrollHeight);
                }
            });
        });
    });
</script>