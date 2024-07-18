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
       .square-image {
            max-width: 100%; 
            height: auto; 
            max-height: 200px; 
           
         }

    </style>
</head>
<body>
<div class="text-center">
<?php echo $this->Flash->render(); ?>
</div>
<div class="container">
    <div class="card" style="width: 30rem; padding:20px">
        <h1 class="text-center">User Profile</h1>

        <div class="text-center">
            <?php if (!empty($user['User']['photo'])): ?>
        <?php echo $this->Html->image($user['User']['photo'], ['alt' => 'Profile Picture','class' => 'img-fluid rounded square-image']);?> 
    <?php endif; ?>
        </div>

        <br>

        <div id="profile-info" class="text-center">
            <h3>Profile Information</h3>
            <p class="text-start"><strong>Name:</strong> <span id="name"><?php echo h($user['User']['name']) ?></span> </p>
            <p><strong>Birthday:</strong> <span id="birthday"><?php echo h($user['User']['birthdate']) ?></span></p>
            <p><strong>Gender:</strong> <span id="gender"><?php echo h($user['User']['gender']) ?></span>
            <p><strong>Hobby:</strong> 
                <div class="scrollable-container">
                    <span id="hobby"><?php echo h($user['User']['hobby']) ?></span> 
                    <input type="text" class="form-control edit-field" id="edit-hobby" style="display: none;">
                </div>
            </p>
           
            <?= $this->Html->link('Edit Profile', ['controller' => 'Users', 'action' => 'edit', $user['User']['id']], ['class' => 'btn btn-primary']) ?>
            <?= $this->Html->link('Go back', ['controller' => 'Users', 'action' => 'landing'], ['class' => 'btn btn-primary']) ?>


        </div>
    </div>
</div>
</body>
</html>

