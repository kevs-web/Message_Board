 <!-- File: /app/View/Layouts/default.ctp -->

<!DOCTYPE html>
<html>
<head>
    <?php echo $this->Html->charset(); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo $title_for_layout; ?>
    </title>
    <?php
        echo $this->Html->meta('icon');
        echo $this->Html->css('https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css');
        echo $this->Html->script('https://code.jquery.com/jquery-3.5.1.slim.min.js');
        echo $this->Html->script('https://code.jquery.com/jquery-3.6.0.min.js');
        echo $this->Html->script('https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js');
        echo $this->Html->script('https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js');
        echo $this->Html->css('style'); // Your custom styles, if any
        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
    ?>
</head>
<body>

    <div class="d-flex flex-column align-items-center justify-content-center content-container" style="height: 100vh; width:100%">
         <div>
            <div class="text-center">
            <?php echo $this->Flash->render(); ?>
            </div>
           
            <?php echo $this->fetch('content'); ?>
        </div>
    </div>

    <!-- <footer class="footer mt-auto py-3 bg-light">
        <div class="container">
            <span class="text-muted">&copy; <?php echo date('Y'); ?> MyApp</span>
        </div>
    </footer> -->

    <?php echo $this->fetch('script'); ?>
</body>
<!-- In your layout file (e.g., default.ctp) -->
<script>
$(document).ready(function() {
    // Auto-dismiss flash messages after 5 seconds
    setTimeout(function() {
        $('.flash-message').fadeOut('slow');
    }, 5000); // Adjust the timeout (in milliseconds) as needed
});
</script>

</html>
