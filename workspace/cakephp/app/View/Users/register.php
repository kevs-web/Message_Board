<!-- <div class="users form"> -->
    <?php echo $this->Flash->render(); ?>

    <!-- <?php if ($userAdded): ?>
        <div class="alert alert-success text-center">
            <p>Thank you for registering!</p>
            <?php echo $this->Html->link('Back to Home Page', ['controller' => 'users', 'action' => 'login'], ['class' => 'btn btn-primary']); ?>
        </div>
    <?php else: ?>
        <?php echo $this->Form->create('User'); ?>
        <fieldset>
            <legend><?php echo __('Registration'); ?></legend>
            <?php
                echo $this->Form->input('name');
                echo $this->Form->control('email', ['required' => true]);
                echo $this->Form->input('password', ['type' => 'password']);
                echo $this->Form->input('confirm_password', ['type' => 'password']);
            ?>
        </fieldset>
        
        <?php echo $this->Form->end(__('Submit')); ?>
    <?php endif; ?>
</div> -->

<style>
    #login .container #login-row #login-column #login-box {
  margin-top: 120px;
  max-width: 600px;
  height: 420px;
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
<!-- debug($validationErrors); -->
<?php if ($userAdded): ?>
        <div class="alert alert-success text-center">
            <p>Thank you for registering!</p>
            <?php echo $this->Html->link('Back to Home Page', ['controller' => 'users', 'action' => 'login'], ['class' => 'btn btn-primary']); ?>
        </div>
        
    <?php else: ?>
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
<div id="login" style="width: 60rem">
       
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                         <?php echo $this->Form->create('User',['class'=>'form','id'=>'login-form']);?>
                       
                            <h3 class="text-center text-info mt-3"> <?php echo __('Registration');?></h3>
                            <div class="form-group">
                           <?php echo $this->Form->input('name', ['label' => 'Name', 'style' => 'width: calc(100% - 22px)']);?>
                           <?php echo $this->Form->input('email', ['label' => 'Email', 'style' => 'width: calc(100% - 22px)']);?>
                            </div>
                            <div class="form-group">
                            <?php  echo $this->Form->input('password', ['label' => 'Password', 'type' => 'password', 'style' => 'width: calc(100% - 22px)']);
                             echo $this->Form->input('confirm_password', ['label' => 'Confirmed Password', 'type' => 'password', 'style' => 'width: calc(100% - 22px)']);
                            ?>
                          
                            <div class="form-group mt-4 text-center">
                            <?php echo $this->Form->submit('Regsiter', ['class' => 'btn-submit']);?>
                            </div>
                       <?php $this->Form->end()?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>