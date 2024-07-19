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
                            <?php echo $this->Form->input('to_user_id', array('label' => 'To', 'options' => $users, 'id' => 'selectTo')); ?>                          
                        </div>

                        <div class="form-group">
                        <?php echo $this->Form->label('message', 'Message', ['class' => 'control-label']) ?>
                        <?php echo $this->Form->textarea('content', ['class' => 'form-control', 'rows' => '5']) ?>
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
 <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
 <script>
    $(document).ready(function() {
        $('select#selectTo').select2({
            width: '100%'
        });
    });
</script>
