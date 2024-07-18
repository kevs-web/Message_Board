<!DOCTYPE html>
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


        .list-avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 10px;
        }

        .list-group-item {
            display: flex;
            align-items: center;
            padding: 10px;
            border: none;
        }

        .list-group-item p {
            margin: 0;
        }

        .ml-3 {
            margin-left: 1rem;
        }

        .mr-3 {
            margin-right: 1rem;
        }

        .list-unstyled {
            list-style-type: none;
            padding: 0;
        }

        .chat-container {
            height: 40rem;
            border: 1px solid #ddd;
            padding: 20px;
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
        }

        .chat-messages {
            height: 37rem;
            padding: 20px;
            border: 1px solid #ddd;
            overflow-y: auto;
        }

        .chat-input {
            display: flex;
            align-items: center;
        }

        .chat-input input {
            flex-grow: 1;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="chat-container">
        <div class="chat-messages">
            <div class="d-flex align-items-center mb-4">
                <img src="../img/profile_pictures/66978fe6eabc0_cat.jpeg" class="avatar" alt="User Avatar">
                <div>
                    <h3 class="h6 mb-1">Receiver</h3>
                </div>
            </div>
            <div style="height: 80%; border: 1px solid black " class="mb-2 mt-3">
            <ul class="list-group mb-4">
                <li class="list-group-item d-flex align-items-center justify-content-end">
                    <div class="mt-2">
                        <h3 class="h6 mb-1">Sender</h3>
                        <p class="mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam perferendis at veniam rem quisquam ea labore provident dolores, sit, quis ab! Tempora impedit eum dicta voluptas distinctio fuga at dignissimos!</p>
                    </div>
                    <img src="../img/profile_pictures/66978fe6eabc0_cat.jpeg" class="avatar mr-3" alt="Avatar 1">
                </li>
                <li class="list-group-item d-flex align-items-center justify-content-start">
                    <img src="../img/profile_pictures/66978fe6eabc0_cat.jpeg" class="avatar ml-3" alt="Avatar 2">
                    <div>
                        <h3 class="h6 mb-1">Receiver</h3>
                        <p class="mb-0">Description for the list item.</p>
                    </div>
                </li>
            </ul>
            </div>
            
            <div class="chat-input">
                <input type="text" class="form-control" placeholder="Type a message...">
                <button class="btn btn-primary" type="button">Send</button>
            </div>
        </div>
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
<script>
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
</script>

</html>