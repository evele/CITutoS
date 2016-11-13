<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo (isset($title))?$title:'Sin titulo'; ?></title>

    <!-- Bootstrap -->
    <link href="<?php echo site_url();?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo site_url();?>assets/css/styles.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript">
    	var base_url = "<?php echo base_url();?>";
    </script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo site_url();?>assets/js/bootstrap.min.js"></script>
  </head>
  <body>
    <nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo site_url(); ?>"><img id="pokebola" src="<?php echo site_url(); ?>assets/img/pokebola.jpg"></a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li class="<?php echo (isset($section) ? ($section == 'clientes' ? 'active': '') :'')?>">
                <a href="<?php echo site_url('clientes'); ?>" class="">
                  <i class="glyphicon glyphicon-user"></i> Clientes
                </a>
            </li>
            <li class="<?php echo (isset($section) ? ($section == 'cosas' ? 'active': '') :'')?>">
                <a href="<?php echo site_url('cosas'); ?>" class="">
                  <i class="glyphicon glyphicon-gift"></i> Cosas
                </a>
            </li>
            <li class="<?php echo (isset($section) ? ($section == 'compras' ? 'active': '') :'')?>">
                <a href="<?php echo site_url('ordenCompra'); ?>" class="">
                <i class="glyphicon glyphicon-list-alt"></i> Compras
              </a>
            </li> 

          </ul>
        </div>
      </div>
   </nav>
  	<div class="container">

  	<h1><?php echo (isset($title))?$title:'Sin titulo'; ?></h1>