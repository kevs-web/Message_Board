<!-- 
div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h3>New Message</h3>
                </div>
                <div class="card-body">
                    <?php echo $this->Form->create('Message', array('class' => 'form-horizontal')); ?>
                    
                    <div class="form-group">
                        <?php echo $this->Form->label('receiver', 'Receiver', array('class' => 'control-label')); ?>
                        <?php echo $this->Form->input('receiver', array('class' => 'form-control', 'div' => false, 'label' => false)); ?>
                    </div>

                    <div class="form-group">
                        <?php echo $this->Form->label('message', 'Message', array('class' => 'control-label')); ?>
                        <?php echo $this->Form->textarea('message', array('class' => 'form-control', 'rows' => '5', 'div' => false, 'label' => false)); ?>
                    </div>

                    <div class="form-group">
                        <?php echo $this->Form->button('Send Message', array('class' => 'btn btn-primary')); ?>
                    </div>

                    <?php echo $this->Form->end(); ?>
                </div>
            </div>
        </div>
    </div>
</div> --> 
<!-- In your view file (e.g., new_message.ctp) -->
 <style>
       .search-container {
        position: relative;
    }
    
    .search-results {
        position: absolute;
        /* top: 100%; */
        left: 10;
        width: 50%;
        background-color: #fff;
        border: 6px solid thin black;
        padding: 10px;
        z-index: 1;
        max-height: 200px;
        overflow-y: auto;
    }

 </style>
<body>
 <div class="container mt-5" style="width: 40rem; padding:20px">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card ">
                <div class="card-header">
                    <h3 class="mt-2">New Message</h3>
                </div>
                <div class="card-body">
                    <?php echo $this->Form->create('Message'); ?>
                        <div class="form-group">
                            <!-- <label class="control-label text-start">Receiver</label> -->
                            <?php echo $this->Form->label('receiver_id', 'Receiver', ['class' => 'control-label']) ?>
                            <div>
                                <!-- <input type="text" id="search-input" placeholder="Search users by name"> -->
                                <?= $this->Form->input('', ['type' => 'text', 'id' => 'search-input']) ?>
                                <?= $this->Form->input('receiver_id', ['type' => 'hidden', 'id' => 'receiver_id']) ?>
                                <!-- <input type="hidden" name="receiver_id" id="receiver_id" value="id"> -->
                                <div id="search-results" class="search-results"></div>
                            </div>
                        </div>

                        <div class="form-group">
                        <?php echo $this->Form->label('message', 'Message', ['class' => 'control-label']) ?>
                        <?php echo $this->Form->textarea('message', ['class' => 'form-control', 'rows' => '5']) ?>
                        </div>

                        <div class="form-group text-center">
                    <?php echo $this->Form->end('Send Message', ['class' => 'btn btn-primary']); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 </body>
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script>
    $(document).ready(function() {
        $('#search-input').on('input', function() {
            var query = $(this).val();
            if (query.length >= 2) {
                $.ajax({
                    url: '<?php echo $this->Html->url(array('controller' => 'Users', 'action' => 'search')); ?>',
                    data: { query: query },
                    dataType: 'json',
                    success: function(data) {
                        $('#search-results').empty();
                    if (data.length > 0) {
                        $.each(data, function(index, user) {
                            var resultDiv = $('<div>').addClass('search-result d-flex align-items-center');
                            var imageDiv = $('<div>').addClass('result-image mr-3');
                            var imageElement = $('<img>').attr('src', user.User.photo).addClass('img-fluid rounded-circle');
                            imageDiv.append(imageElement);
                            var nameDiv = $('<div>').addClass('result-name').text(user.User.email);
                            resultDiv.append(imageDiv, nameDiv);
                            resultDiv.css({
                                'border': '1px solid #ccc',
                                'padding': '10px',
                                'cursor': 'pointer'
                            });
                            resultDiv.click(function() {
                                $('#search-input').val(user.User.name);
                                $('#receiver_id').val(user.User.id);
                                $('#search-results').empty();
                            });
                            $('#search-results').append(resultDiv);
                        });
                    } else {
                        var noResultDiv = $('<div>').text('No users found.');
                        noResultDiv.css({
                            'border': '1px solid #ccc',
                            'padding': '10px',
                            'cursor': 'pointer',
                            'margin-top': '-10px'
                        });
                        $('#search-results').append(noResultDiv);
                    }
                }
            });
        } else {
            $('#search-results').empty();
        }
        });
    });
</script>