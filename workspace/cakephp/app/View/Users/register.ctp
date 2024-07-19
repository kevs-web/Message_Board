

<style>
#login .container #login-row #login-column #login-box {
margin-top: 120px;
max-width: 600px;
height: 510px;
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

    <?php if (!empty($validationErrors)): ?>
<div class="validation-errors">
    <p>Please correct the following errors:</p>
    <ul>
        <?php foreach ($validationErrors as $field => $errors): ?>
            <?php foreach ($errors as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>
<div id="login" style="width: 60rem;">
   
    <div class="container text-center">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6" style="left: 25%;">
                <div id="login-box" class="col-md-12">
                     <?php echo $this->Form->create('User',['class'=>'form','id'=>'login-form']);?>
                        <h3 class="text-center text-info mt-3"> <?php echo __('Registration');?></h3>
                        <?php if (isset($errors) && !empty($errors)): ?>
                            <div class="error-message">
                                <ul>
                                    <?php foreach ($errors as $field => $error): ?>
                                        <?php foreach ($error as $msg): ?>
                                            <li><?php echo $msg ?></li>
                                        <?php endforeach; ?>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <div class="form-group">
                       <?php  echo $this->Form->input('UserDetail.name', array('error'=>false, 'class'=>'form-control mb-2', 'required' => false, 'label' => 'Name', 'style' => 'width: calc(100% - 22px)'));
                       
                       echo $this->Form->input('email', array('error'=>false, 'class'=>'form-control mb-2', 'required' => false, 'label' => 'Email', 'style' => 'width: calc(100% - 22px)'));?>
                        </div>
                        <div class="form-group">
                        <?php  echo $this->Form->input('password', array('error'=>false, 'class'=>'form-control mb-2', 'required' => false, 'label' => 'Password', 'type' => 'password', 'style' => 'width: calc(100% - 22px)'));
                            echo $this->Form->input('confirm_password', array('type' => 'password', 'label' => 'Confirm Password', 'class'=>'form-control mb-2', 'error' => false, 'required' => false, 'style' => 'width: calc(100% - 22px)'));
                        ?>
                      
                        <div class="form-group mt-4 text-center">
                        <?php echo $this->Form->submit('Regsiter', ['class' => 'btn-submit']);?>
                        <br>
                        <?php  echo $this->HTML->link('Login',array('controller'=> 'users', 'action' => 'login')); ?>
                        </div>
                   <?php $this->Form->end()?>
                </div>
            </div>
        </div>
    </div>
</div>
