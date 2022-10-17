<?php 
/** @var  $model PHPMVC\models\User */

 
?>

<?php echo '<h1> Create an acount </h1>'?>
<div class="btn btn-success" onclick="alert('aloo');"> Login</div>
<div class="container col-3">
  <!-- ------ -->

  <?php $form = \oo\Form\Form::begin('', 'post'); ?>
<div class="row">
  <?php echo $form->field($model, 'email'); ?>
  <div class="col"><?php echo $form->field($model, 'password')->passwordField(); ?></div>
</div> 

  <button type="password" class="btn btn-primary">Submit</button>
  <?php echo \oo\Form\Form::end(); ?>

 
</div>