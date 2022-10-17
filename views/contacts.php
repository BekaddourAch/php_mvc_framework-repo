<?php
/** @var $model  oo\Model 
 * @var $this oo\view
*/
use oo\Form\TextAreaField;

$this->title = 'Contacts';
echo '<h1> Contact Page </h1>' ?>


<div class="container col-3">
  <!-- ------ -->
  <?php $form = \oo\Form\Form::begin('', 'get'); ?>

  <?php echo $form->field($model, 'subject'); ?>
  <?php echo $form->field($model, 'email'); ?>
  <?php echo new TextAreaField($model,'body'); ?>

  <button class="btn btn-success">Submit</button>
  <?php echo \oo\Form\Form::end(); ?>

    <!-- <form method="post" action="">
  <div class="mb-3">
    <label for="input1" class="form-label">Subject</label>
    <input type="text" name="subject" class="form-control" id="input1">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="mb-3">
    <label for="input2" class="form-label">Email</label>
    <input type="text" name="email" class="form-control" id="input12">
  </div>
  <div class="mb-3">
    <label for="input3" class="form-label">Body</label>
    <textarea type="text" name="body" class="form-control" id="input13"></textarea>
  </div> 
  <button type="submit" class="btn btn-primary">Submit</button>
</form> -->
</div>

