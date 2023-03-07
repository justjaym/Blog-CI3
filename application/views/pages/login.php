<h1>Login User</h1>
<hr>
<?php if($this->session->flashdata('failed_login')) : ?>
    <?= '<p class="alert alert-danger">'.$this->session->flashdata('failed_login').'</p>';?>
<?php endif; ?>
<?php if($this->session->flashdata('user_loggedout')) : ?>
    <?= '<p class="alert alert-danger">'.$this->session->flashdata('user_loggedout').'</p>';?>
<?php endif; ?>
<?= validation_errors();?>

<?= form_open('login'); ?>
<div class="form-group">
    <label for="">Username / Email</label>
    <input type="email" name="username" value="<?= set_value('username');?>" class="mt-2 form-control" autocomplete="off" placeholder="Enter email as username">
</div>
<div class="form-group">
    <label for="">Password</label>
    <input type="password" name="password" class="mt-2 form-control" placeholder="Enter password">
</div>
<button type="submit" class="mt-3 btn btn-primary">Login</button>