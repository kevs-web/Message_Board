_<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Application</title>
    <style>
        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }
        .text-truncate-custom {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            display: inline-block;
            max-width: 100%;
        }
    </style>
</head>
<body>
    <div class="chat-container">
        <div class="chat-contacts">
            <!-- <button class="btn btn-secondary mb-3" type="button">New Message</button> -->
            <?= $this->Html->link('New Message', ['controller' => 'Messages', 'action' => 'message'], ['class' => 'btn btn-primary']) ?>
            <div>
            <?php foreach ($messages as $message): ?>             
            <div class="container my-5" style="border: 1px solid; width: 350px;">
                    <div class="row align-items-center">
                        <div class="col-auto">
                        <?php if (isset($users[$message['Message']['receiver_id']])): ?>
                            <?php echo $this->Html->image($users[$message['Message']['receiver_id']], ['alt' => 'Profile Picture','class' => 'img-fluid rounded square-image']);?> 
                        <?php endif; ?>
                        </div>
                        <div class="col">
                        <?php if (isset($users[$message['Message']['receiver_id']])): ?>
                        <h5><?= h($users[$message['Message']['receiver_id']]) ?></h5>
                    <?php else: ?>
                        <h3>Unknown User</h3>
                    <?php endif; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="text-truncate-custom" id="text-container">
                               <?php echo h($message['Message']['message']);?>
                            </div>
                        </div>
                    </div>
            </div>
            <?php endforeach; ?>
            </div>
        </div>
             
    </div>
</body>
<!-- <script>
    $(document).ready(function() {
        // Set maximum length for the message content
        var maxLength = 50; // Adjust as needed

        // Iterate through each message container
        $('.text-truncate-custom').each(function() {
            // Get the text content of the message
            var message = $(this).text();

            // Check if the message length exceeds the maxLength
            if (message.length > maxLength) {
                // Truncate the message and append ellipses
                var truncatedMessage = message.substring(0, maxLength) + '...';
                $(this).text(truncatedMessage);
            }
        });
    });
</script> -->

</html>