<?php
/** @var $model \thecodeholic\phpmvc\Model */

use core\form\Form;

$form = new Form();
?>

<h1>Register</h1>
<!-- action ="" we don't want to go to any page and 
     we don't authorized to rout to another page (in this stage)
     we only send inputed data to $_POST and the controller 
     will decide to send us to new page by redirect
     be carefull that Register page will be reload which time 
     we enter false input and Regiseter method will be created
     each time again and then controller will decide to send us
     to final page or not?(after validation of inputs)-->
<?php $form = Form::begin('', 'post') ?>
    <div class="row">
        <div class="col">
            <!-- $model has been created by renderview in View class == OBJ User/login/... -->
            <?php echo $form->field($model, 'firstname') ?>
        </div>
        <div class="col">
            <?php echo $form->field($model, 'lastname') ?>
        </div>
    </div>
    <!-- remainder input tage can be shown in seperated row -->
    <?php echo $form->field($model, 'email') ?>
    <?php echo $form->field($model, 'password')->passwordField() // change input type and then countiue as same as former?>
    <?php echo $form->field($model, 'passwordConfirm')->passwordField()// change input type and then countiue as same as former ?>
    <button class="btn btn-success">Submit</button>
<?php Form::end() ?>