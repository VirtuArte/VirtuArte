<div class="accordion" id="accordionExample">
        <div class="accordion-item">
          <div class="accordion-header" id="headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
              Converse com o Vitu
            </button>
          </div>
          <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
            <div class="wrapper">
              <div class="form">
                <div class="bot-inbox inbox">
                  <div class="icon">
                    <img src="/assets/img/vitu-chat.png" alt="">
                  </div>
                  <div class="msg-header">
                    <p class="text-break">Olá, eu sou o Vitu! Em que posso te ajudar?</p>
                    <input type="hidden" id="nivel" value="<?= $nivelChat ?>">
                  </div>
                </div>
              </div>
              <div class="typing-field">
                <div class="input-data">
                  <input id="data" type="text" placeholder="Escreva aqui..." required>
                  <button id="send-btn">Enviar</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <script>
      // var input = document.getElementById('data');

      // input.addEventListener('focus', () => {

      // })

      $(document).ready(function(){
        $nivel = $("#nivel").val();
        $("#send-btn").on("click", function(){
          $value = $("#data").val();
          $msg = '<div class="user-inbox inbox"><div class="msg-header"><p class="text-break">'+ $value +'</p></div></div>';
          $(".form").append($msg);
          $("#data").val('');

          $nivel++;
          $("#nivel").val($nivel);

          $estado       = '';
          $cidade       = '';
          $preferencia  = '';

          if($nivel == 2){
            $estado = $value;
          }
          if($nivel == 3){
            $cidade = $value;
          }
          if($nivel == 4){
            $preferencia = $value;
          }
          
          // start ajax code
          $.ajax({
            url: 'message.php',
            type: 'POST',
            // data: 'text='+$value,
            data: {text: $value, nivel: $nivel, estado: $estado, cidade: $cidade, preferencia: $preferencia},
            success: function(result){
              if(result == "Desculpe, não consegui te entender" || result == "Desculpe, não encontrei informações relacionadas"){
                $nivel--;
                $("#nivel").val($nivel);

                $replay = '<div class="bot-inbox inbox"><div class="icon"><img src="/assets/img/vitu-chat.png" alt=""></div><div class="msg-header"><p class="text-break">'+ result +'. Tente responder novamente</p></div></div>';
                $(".form").append($replay);
                // when chat goes down the scroll bar automatically comes to the bottom
                $(".form").scrollTop($(".form")[0].scrollHeight);
              }
              else if(result == "Desculpe, não tenho nenhuma sugestão para esse local"){
                $nivel = 1;
                $("#nivel").val($nivel);

                $replay = '<div class="bot-inbox inbox"><div class="icon"><img src="/assets/img/vitu-chat.png" alt=""></div><div class="msg-header"><p class="text-break">'+ result +'. Vamos tentar novamente</p></div></div>';
                $(".form").append($replay);
                $replay = '<div class="bot-inbox inbox"><div class="icon"><img src="/assets/img/vitu-chat.png" alt=""></div><div class="msg-header"><p class="text-break">'+ 'Que estado você pretende visitar?' +'</p></div></div>';
                $(".form").append($replay);
                // when chat goes down the scroll bar automatically comes to the bottom
                $(".form").scrollTop($(".form")[0].scrollHeight);
              }
              else if (result == "Foi um prazer te ajudar =D"){
                $nivel = 0;
                $("#nivel").val($nivel);

                $replay = '<div class="bot-inbox inbox"><div class="icon"><img src="/assets/img/vitu-chat.png" alt=""></div><div class="msg-header"><p class="text-break">'+ result +'</p></div></div>';
                $(".form").append($replay);
                $replay = '<div class="bot-inbox inbox"><div class="icon"><img src="/assets/img/vitu-chat.png" alt=""></div><div class="msg-header"><p class="text-break">'+ '<a href="#" class="text-white" onclick="window.location.reload()">Recomeçar</a>' +'</p></div></div>';
                $(".form").append($replay);
                // when chat goes down the scroll bar automatically comes to the bottom
                $(".form").scrollTop($(".form")[0].scrollHeight);
              }
              else{
                  alert(result)
                $replay = '<div class="bot-inbox inbox"><div class="icon"><img src="/assets/img/vitu-chat.png" alt=""></div><div class="msg-header"><p class="text-break">'+ result +'</p></div></div>';
                $(".form").append($replay);
                // when chat goes down the scroll bar automatically comes to the bottom
                $(".form").scrollTop($(".form")[0].scrollHeight);
              }
            }
          });
        });
      });
    </script> 

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Chatbot in PHP | CodingNepal</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}
html,body{
    display: grid;
    height: 100%;
    place-items: center;
}
::selection{
    color: #fff;
    background: #007bff;
}
::-webkit-scrollbar{
    width: 3px;
    border-radius: 25px;
}
::-webkit-scrollbar-track{
    background: #f1f1f1;
}
::-webkit-scrollbar-thumb{
    background: #ddd;
}
::-webkit-scrollbar-thumb:hover{
    background: #ccc;
}
.wrapper{
    width: 370px;
    background: #fff;
    border-radius: 5px;
    border: 1px solid lightgrey;
    border-top: 0px;
}
.wrapper .title{
    background: lightgreen;
    color: #fff;
    font-size: 20px;
    font-weight: 500;
    line-height: 60px;
    text-align: center;
    border-bottom: 1px solid lightgreen;
    border-radius: 5px 5px 0 0;
}
.wrapper .form{
    padding: 20px 15px;
    min-height: 400px;
    max-height: 400px;
    overflow-y: auto;
}
.wrapper .form .inbox{
    width: 100%;
    display: flex;
    align-items: baseline;
}
.wrapper .form .user-inbox{
    justify-content: flex-end;
    margin: 13px 0;
}
.wrapper .form .inbox .icon{
    height: 40px;
    width: 40px;
    color: #fff;
    text-align: center;
    line-height: 40px;
    border-radius: 50%;
    font-size: 18px;
    background: #007bff;
}
.wrapper .form .inbox .msg-header{
    max-width: 53%;
    margin-left: 10px;
}
.form .inbox .msg-header p{
    color: #fff;
    background: #007bff;
    border-radius: 10px;
    padding: 8px 10px;
    font-size: 14px;
    word-break: break-all;
}
.form .user-inbox .msg-header p{
    color: #333;
    background: #efefef;
}
.wrapper .typing-field{
    display: flex;
    height: 60px;
    width: 100%;
    align-items: center;
    justify-content: space-evenly;
    background: #efefef;
    border-top: 1px solid #d9d9d9;
    border-radius: 0 0 5px 5px;
}
.wrapper .typing-field .input-data{
    height: 40px;
    width: 335px;
    position: relative;
}
.wrapper .typing-field .input-data input{
    height: 100%;
    width: 100%;
    outline: none;
    border: 1px solid transparent;
    padding: 0 80px 0 15px;
    border-radius: 3px;
    font-size: 15px;
    background: #fff;
    transition: all 0.3s ease;
}
.typing-field .input-data input:focus{
    border-color: rgba(0,123,255,0.8);
}
.input-data input::placeholder{
    color: #999999;
    transition: all 0.3s ease;
}
.input-data input:focus::placeholder{
    color: #bfbfbf;
}
.wrapper .typing-field .input-data button{
    position: absolute;
    right: 5px;
    top: 50%;
    height: 30px;
    width: 65px;
    color: #fff;
    font-size: 16px;
    cursor: pointer;
    outline: none;
    opacity: 0;
    pointer-events: none;
    border-radius: 3px;
    background: #007bff;
    border: 1px solid #007bff;
    transform: translateY(-50%);
    transition: all 0.3s ease;
}
.wrapper .typing-field .input-data input:valid ~ button{
    opacity: 1;
    pointer-events: auto;
}
.typing-field .input-data button:hover{
    background: #006fef;
}
    </style>
<body>
    <div class="wrapper">
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
    </div>

    <script>
        $(document).ready(function(){
            $("#send-btn").on("click", function(){
                $value = $("#data").val();
                $msg = '<div class="user-inbox inbox"><div class="msg-header"><p>'+ $value +'</p></div></div>';
                $(".form").append($msg);
                $("#data").val('');
                
                // start ajax code
                $.ajax({
                    url: 'message.php',
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
    
</body>
</html> -->