<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    .square-image {
    width: 250px; /* Set a fixed width */
    height: 250px; /* Set a fixed height */
    object-fit: cover; /* Ensures the image covers the entire area */
}

</style>
<div class="text-center">
<?php echo $this->Flash->render(); ?>
</div>
<nav class="navbar navbar-expand-lg navbar-light ">
        <a class="navbar-brand" href="<?php echo $this->Html->url('/'); ?>">MyApp</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <?php echo $this->Html->link('New Message', ['controller' => 'messages', 'action' => 'message'], ['class' => 'nav-link']); ?>
                </li>
                <li class="nav-item">
                    <?php echo $this->Html->link('Profile', ['controller' => 'users', 'action' => 'profile'], ['class' => 'nav-link']); ?>
                </li>
                <li class="nav-item">
                    <?php echo $this->Html->link('Logout', ['controller' => 'Users', 'action' => 'logout'], ['class' => 'nav-link']); ?>
                </li>

            </ul>
        </div>
    </nav>
    <div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
       
        <?php if (!empty($user['User']['photo'])): ?>
        <?php echo $this->Html->image($user['User']['photo'], ['alt' => 'Profile Picture','class' => 'img-fluid rounded square-image']);?> 
    <?php endif; ?>
        </div>
        <div class="col-md-8">
            <!-- Welcome message -->
            <h1>Welcome, <?php h(ucwords($user['User']['name'])) ?> !</h1>
            <!-- Paragraph below welcome -->
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis libero ut ligula consectetur, quis fringilla libero eleifend.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis libero ut ligula consectetur, quis fringilla libero eleifend.</p>
        </div>
    </div>
</div>

<?php //print_r($user); ?>

<!-- <?php echo '<br>MY ID is ' . $user['id'];?> -->
<!-- <?print_r($user);?> -->


</body>
</html>