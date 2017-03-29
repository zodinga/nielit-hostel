
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/ico" href="/images/hostel5.png"/>

    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>HMS <?php echo $__env->yieldContent('title'); ?></title>

    <!-- Bootstrap -->
    <!-- Latest compiled and minified CSS -->

<?php echo e(Html::style('css/bootstrap.min.css')); ?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<?php echo e(Html::style('css/styles.css')); ?>

  <?php echo Html::style('font-awesome/css/font-awesome.css'); ?>

<?php echo $__env->yieldContent('stylesheet'); ?>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->



  </head>