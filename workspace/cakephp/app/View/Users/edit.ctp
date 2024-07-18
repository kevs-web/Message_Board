<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Profile</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!-- Include datepicker CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <style>
        .scrollable-container {
            max-height: 100px;
            overflow-y: auto;
        }
        #profile-picture {
            max-width: 100%; 
            height: auto; 
            max-height: 200px; 
        }
    </style>
</head>
<body>
<div class="container">
<div class="text-center">
<?php echo $this->Flash->render(); ?>
</div>
    <div class="card" style="width: 30rem; padding:20px">
        <h1 class="text-center">User Profile</h1>
        <?= $this->Form->create('User', ['type' => 'file']); ?>
        <div class="text-center">
        <div class="text-center">
        <?php if (!empty($user['User']['photo'])) : ?>
            <?= $this->Html->image($user['User']['photo'], ['id' => 'profile-picture', 'class' => 'img-thumbnail', 'width' => '200', 'height' => '200', 'alt' => 'Profile Picture']) ?>
        <?php else : ?>
            <img id="profile-picture" class="img-thumbnail" src="#" alt="Profile Picture" style="display: none; width: 200px; height: 200px;" />
            <p id="no-image-msg">No profile image available.</p>
        <?php endif; ?>
        <br><br>
        <?= $this->Form->button('Upload Picture', ['type' => 'button', 'class' => 'btn btn-default', 'id' => 'upload-button']) ?>
        <?= $this->Form->file('photo', ['type' => 'file', 'id' => 'file-input', 'accept' => 'image/*', 'style' => 'display: none']) ?>
        <br>
        <div id="profile-info">
            <h3>Profile Information</h3>
            <?echo $this->Form->input('name', ['value' => $user['User']['name']]);?>
            <?= $this->Form->input('birthdate', ['id' => 'birth-date', 'type' => 'text', 'value' => $user['User']['birthdate']]) ?>
            <?php echo $this->Form->radio('gender', [
                    'male' => 'Male',
                    'female' => 'Female',
                ], ['default' => $user['User']['gender']]);?>
              <? echo $this->Form->input('hobby', ['label' => 'Hobby','type'=>'text', 'value' => $user['User']['hobby']]); ?>
              <br>
              <?= $this->Form->end('Update') ?>
        </div>
    </div>
</div>

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<!-- Include Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<!-- Include datepicker JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

<script>
    $(document).ready(function() {
        $('#birth-date').datepicker({
        dateFormat: 'yy-mm-dd', // Set the format you want to use when sending to server
        changeYear: true,
        changeMonth: true,
        yearRange: "-100:+0" // Adjust as needed
    });
        $('#upload-button').click(function() {
            $('#file-input').click(); // Trigger the file input click
        });

        $('#file-input').change(function() {
            var file = this.files[0];
            if (file) {
                // Validate file type
                var validTypes = ['image/png', 'image/jpeg', 'image/gif'];
                if (validTypes.indexOf(file.type) === -1) {
                    alert('Invalid file type. Please select a PNG, JPG, or GIF image.');
                    return;
                }

                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#profile-picture').attr('src', e.target.result).show(); // Update the image src and show the image
                    $('#no-image-msg').hide();
                }
                reader.onerror = function(error) {
                    console.error("Error loading file: ", error); // Debugging
                }
                reader.readAsDataURL(file);
            } else {
                $('#profile-picture').hide(); // Hide the image if no file is selected
                $('#no-image-msg').hide();
            }
        });
    });
</script>
</body>
</html>