<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogs - CI3 </title>
    <link rel="icon" type="image/png" sizes="32x32" href="https://codeigniter.com/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="https://codeigniter.com/favicons/favicon-16x16.png">
    <!-- <link rel="stylesheet" href="bootstrap.min.css"> -->
    <link rel="stylesheet" href="<?= base_url();?>css/bootstrap.min.css">
</head>
<body>
<header>
  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a class="navbar-brand mx-2" href="<?= base_url()?>">Blog Post</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="<?= base_url()?>">Home <span class="sr-only"></span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="add">Add new post</a>
        </li>
        <?php if($this->session->logged_in){?>
        <li class="nav-item">
          <a class="nav-link " href="<?= base_url()?>logout" tabindex="-1" aria-disabled="true">Log out</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" disabled><b><?= ucfirst($this->session->full_name) ?></b></a>
        </li>
        <?php }else {?>
          <li class="nav-item">
          <a class="nav-link " href="<?= base_url()?>login" tabindex="-1" aria-disabled="true">Log in</a>
        </li>
        <?php } ?>
      </ul>
    <form class="form-inline" method="post" action="<?=base_url();?>search">
    <input class=" mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-info my-2 my-sm-0" type="submit">Search</button>
    </form>
    </div>
  </nav>
</header>

<div class="container mt-5">