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
        <?php echo $form->field($model, 'name') ?>
    </div>
    <div class="col">
        <?php echo $form->field($model, 'family') ?>
    </div>
</div>
<!-- remainder input tage can be shown in seperated row -->
<label for="position" class="block mb-2 text-sm font-bold ">Please select your position form list</label>
<select id="position" name="position" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    <option>Patient</option>
    <option>Doctor</option>
    <option>Manager</option>
</select>
<?php echo $form->field($model, 'age') ?>
<?php echo $form->field($model, 'email') ?>
<?php echo $form->field($model, 'username') ?>
<?php echo $form->field($model, 'password')->passwordField() // change input type and then countiue as same as former
?>
<button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Register</button>
<?php Form::end() ?>