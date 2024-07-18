
<style>
    #login .container #login-row #login-column #login-box {
  margin-top: 120px;
  max-width: 600px;
  height: 320px;
  border: 1px solid #9C9C9C;
  background-color: #EAEAEA;
}
#login .container #login-row #login-column #login-box #login-form {
  padding: 20px;
}
#login .container #login-row #login-column #login-box #login-form #register-link {
  margin-top: -85px;
}
</style>
<div class="text-center justify-content-center align-items-center">
<?php echo $this->Flash->render('auth'); ?>
</div>
<div id="login" style="width: 60rem">
<!-- <?php echo $this->Form->create('User'); ?> -->
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                         <?php echo $this->Form->create('User',['class'=>'form','id'=>'login-form']);?>
                       
                            <h3 class="text-center  mt-3"> <?php echo __('Login'); ?></h3>
                            <div class="form-group">
                           <?php echo $this->Form->input('email', ['label' => 'Email', 'style' => 'width: calc(100% - 22px)']);?>
                           
                            </div>
                            <div class="form-group">
                            <?php  echo $this->Form->input('password', ['label' => 'Password', 'type' => 'password', 'style' => 'width: calc(100% - 22px)']);?>
                            <div class="form-group mt-4 text-center">
                            <?php echo $this->Form->submit('Login', ['class' => 'btn-submit']);?>
                            <br>
                            <?php echo $this->Html->link('Sign Up', array('controller' => 'Users', 'action' => 'register')); ?>
                            </div>
                       <?php $this->Form->end()?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- <div class="users form">

    <fieldset>
        <legend>
           
        </legend>
        <?php echo $this->Form->input('email');
        echo $this->Form->input('password');
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Login')); ?>
<?php echo $this->Html->link('Sign Up', array('controller' => 'Users', 'action' => 'register')); ?>
</div> -->

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
       $("input[value='Login").click(function(){
            $.ajax({
                url: "/cakephp/users/ajaxLogin",
                type: "POST",
                data: {
                    username: $("input[name='data[User][username]']").val(),
                    password: $("input[name='data[User][password]']").val()
                },
                success: function(response){
                    var res = JSON.parse(response);
                    if (res.status == "success") {
                        window.location.href = "/cakephp/users/index";
                    }
                }
            });
            return false;
       });
    });
</script> -->