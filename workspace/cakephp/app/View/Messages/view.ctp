<div class="row message-wrapper">
    <div class="col-sm-3">
        <input type="text" class="form-control mb-2" id="search" placeholder="Search">
        <div class="wrapper-data">
            <ul class="list-group"></ul>   
        </div>
    </div>
    <div class="col-sm-9">
        <div class="card">
            <div class="card-body">
                <div class="messages-wrapper">
                    <div class="data">
                    <?php foreach ($messages as $message): ?>
                        <?php  
                            $profilePic = $message['Sender']['profile'] ?? 'avatar.jpg';
                            
                            if ($message['Sender']['user_id'] === $authId) {
                                $msgClasses = 'my-message';
                            } 
                            else  {
                                $msgClasses = 'not-my-message';
                            }
                        ?>
                        
                        <div class="message-wrap <?php echo $msgClasses ?>">
                            <img src="<?php echo $this->Html->url('/upload/'.$profilePic) ?>" alt="profile">
                            <div>
                                <p><?php echo $message['Sender']['name']; ?></p>
                                <p><?php echo $message['Message']['content']; ?></p>
                                <p>Sent: <?php echo $this->Time->niceShort($message['Message']['created_at']) ?></p>
                                <a href="delete" style="color:red;">Delete</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    </div>
                </div>
                <div class="message-field-wrapper">
                    <form id="sendForm" method="POST">
                        <input type="text" name="data[Message][content]">
                        <button class="btn btn-primary">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .message-wrapper {  
        overflow:auto;
        position: relative;
    }

    ul li {
        cursor: pointer;
    }
    ul li:hover{
        background:#ccc;
        opacity:0.9;
    }
    ul li img{
        width:50px!important;
        height: 50px!important;
        object-fit:contain;
        border-radius:50%;
        margin-right:1rem;
        background-color:#000;
    }
    ul li > div{
        display:flex;
        align-items:center;
    }

    ul li div > p.name{
        font-weight:bold;
        text-transform:uppercase;
        font-size:16px;
        margin:0;
    }

    ul li div > p{
        margin:0;
        font-size:14px;
    }

    ul li div p.date{
        font-size:10px;
        text-align:right;
    }

    ul li div.lastMsg{
        color:#777;
    }

    ul li div.lastMsg div{
        width: 100%;
    }

    ul li div.lastMsg p.name{
        color:#000;
    }

</style>

<style>
    .wrapper{
        margin:auto;
        width:700px;
    }
    .messages-wrapper{
        height:500px;
        margin:auto;
        padding:2rem;
        position: relative;
        overflow:auto;
    }
    .messages-wrapper .message-wrap{
        width:60%;
        padding:1rem;
        margin-bottom:1rem;
        border-radius:10px;
        display:flex;
    }
    .messages-wrapper .message-wrap.my-message {
        background:#ccf0ff;
        margin-left:auto;
    }
    .messages-wrapper .message-wrap.not-my-message {
        background:#ddd;
        margin-right:auto;
        color:#000;
    }
    .messages-wrapper .message-wrap img{
        width:50px;
        height:50px;
        border-radius:50%;
        margin-right:1rem;
        object-fit:contain;
        background-color:#000;
    }
    .message-field-wrapper{
        position: relative;
    }
    .message-field-wrapper input{
        width:79%;
        box-sizing:border-box;
        height:80px;
    }
    .message-field-wrapper button{
        width:20%;
        box-sizing:border-box;
        height:80px;
        margin:0;
    }
    .messages-wrapper .message-wrap a{
        display: none;
    }
</style>

<script>
    $(document).ready(function(){

        runChatMessage('start');

        displayUsers();

        $(document).on('click', '.message-wrapper li', function(){
            $('#messageUserModal .modal-title').text($(this).find('p.name').text()).css('text-transform','uppercase');
            $('#messageUserModal .modal-footer button.view').attr('data-url',$(this).attr('data-url'));
            $('#messageUserModal .modal-footer button.delete').attr('data-id',$(this).attr('data-id'));
            $('#messageUserModal').modal({
                keyboard: false,
                backdrop:'static'
            });
        });

        $('#search').on('keyup', function(){
            var value =  $(this).val();
            displayUsers('search', value);
        }); 
        
        $(document).on('click','#show-more', function(e){
            e.preventDefault();
            const page = $(this).data('current');

            const limit =10;

            if($(this).hasClass('back')) {
                selectedPage = page - limit;
            } else {
                selectedPage = page + limit;
            }

            displayUsers('limit', selectedPage);
        });
        
        function displayUsers(option,value) {
            var data = {};
            if (option === "search") {
                data = { keywords:value};
            } 
            if (option === "page") {
                data = { page:value }
            } 
            if (option === "limit") {
                data = {limit:value};
            }


            $.ajax({
                url: "<?php echo $this->Html->url(array('controller'=>'messages','action' => 'list'))?>",
                type:'GET',
                dataType:'json',
                contentType: 'application/json',
                data: data,
                success:function(res){
                    $('.message-wrapper .wrapper-data').html(res.html);
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error(error);
                }
            });
        }

        $('.messages-wrapper').scrollTop($('.messages-wrapper')[0].scrollHeight);
        var countArr = $('.messages-wrapper .message-wrap').length;

        function newData() {
            $('.messages-wrapper').load(location.href + ' .messages-wrapper>*', "");
            var count = $('.messages-wrapper .message-wrap').length;
            if (countArr != count) {
                countArr = count;
                $('.messages-wrapper').animate({
                    scrollTop:$('.messages-wrapper')[0].scrollHeight
                }, "slow");
            }
            
        }

        function chatContainer() {
            $('.messages-wrapper').load(location.href + ' .messages-wrapper>*', "");
        }

        $(document).on('click', '.message-wrapper .wrapper-data ul li', function(){
            window.location.href = $(this).attr('data-url');
        });

        $('#sendForm').submit(function(e){
            e.preventDefault();
            var formData = $(this).serialize();

            $.ajax({
                type: 'POST',
                data: formData,
                success: function(response) {
                    newData();
                    $('#sendForm').trigger("reset");
                    displayUsers();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });   

        function runChatMessage(stats) {
            var reFresh = "";
            if (stats === 'start') {
                reFresh = setInterval(() => {
                    newData();
                    displayUsers();
                }, 5000);
            } else {
                clearInterval(reFresh);
            }
        }
       
    });

    
</script>
