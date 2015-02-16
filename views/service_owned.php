<?php
require('tmpl.inc.php');
$tmpl = new Template();
require_once("/srv/http/hub.hyperboria/inc/core.inc.php");
$p_title = 'Services';
$ip = filter_var($_SERVER['REMOTE_ADDR']);
$serv = $services->getOwnedServices($ip);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" href="/favicon.ico">
<title><?=$p_title?> - Hub</title>
<?=$tmpl->getCss()?>
</head>
<body role="document" class="services">
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
<div class="container">
<div class="navbar-header">
<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
<span class="sr-only">Toggle navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
<a class="navbar-brand" href="/"><?=appName?></a>
</div>
<div class="navbar-collapse collapse">
<ul class="nav navbar-nav">
<?=$tmpl->getNav(null,$p_title)?>
</ul>
</div>
</div>
</div>
    <div class="promo promo-services">
      <div class="container">
        <div class="text-center">
          <h1>Your Services</h1>
          <p class="lead">An overview of your known services.</p>
        </div>
      </div>
    </div>
<div class="container" role="main">
<div class="col-xs-12 col-md-8 col-md-offset-2 centered-pills" style="padding:40px 0;">
<ul class="nav nav-pills nav-pills-services">
  <li role="presentation"><a href="/services">All</a></li>
  <li role="presentation"><a href="/services/recent">Recently Added</a></li>
  <li role="presentation"><a href="/services/search">Search</a></li>
  <li role="presentation"><a href="/services/tags">Tags</a></li>
  <li role="presentation" class="active"><a href="/services/me">My Services</a></li>
  <li role="presentation"><a href="/services/add">Add New</a></li>
</ul>
<hr>
</div>
<div class="row">
<div class="col-xs-12 col-md-8 col-md-offset-2">

<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Name</th>
      <th>Description</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($serv as $s) { 
      $desc = htmlentities($s['short_description']);
    ?>
  <tr>
  <td><strong><a href='/service/<?=$s['pid']?>'><?=htmlentities($s['name'])?></a></strong></td>
  <td><?=$desc?></td>
</tr>
<?php } ?>
</tbody>
</table>

</div>
</div>


</div>
<?=$tmpl->getJs('basic')?>
</body>
</html>
