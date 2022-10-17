<?php 
/** @var  $model PHPMVC\models\User */

 
?>

<?php echo '<h1> Create an acount </h1>'?>
<div class="btn btn-success" onclick="alert('aloo');"> Login</div>
<div class="container col-3">
  <!-- ------ -->

  <?php $form = \oo\Form\Form::begin('', 'post'); ?>
  <div class="row">
        <div class="col">
            <?php echo $form->field($model, 'firstName') ?>
        </div>
        <div class="col">
            <?php echo $form->field($model, 'lastName') ?>
        </div>
    </div>
    <?php echo $form->field($model, 'email') ?>
    <?php echo $form->field($model, 'password')->passwordField() ?>
    <?php echo $form->field($model, 'cnfrmPassword')->passwordField() ?>
    <button class="btn btn-success">Submit</button>


 
  <?php echo \oo\Form\Form::end(); ?>

 
</div>