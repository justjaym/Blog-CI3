<h1>Register User</h1>
<hr>
<?= validation_errors();?>

<?= form_open('register'); ?>
<div class="form-group">
    <label for="">First Name</label>
    <input type="text" name="first_name" value="" class="mt-2 form-control" autocomplete="off" placeholder="Enter your first name">
</div>
<div class="form-group">
    <label for="">Last Name</label>
    <input type="text" name="last_name" value="" class="mt-2 form-control" autocomplete="off" placeholder="Enter your last name">
</div>
<div class="form-group">
    <label for="">Username / Email</label>
    <input type="email" name="username" value="" class="mt-2 form-control" autocomplete="off" placeholder="Create email as username">
</div>
<div class="form-group">
    <label for="">Password</label>
    <input type="password" name="password" class="mt-2 form-control" placeholder="Create password">
</div>
<input type="hidden" name="is_admin" value=1>

<button type="submit" class="mt-3 btn btn-primary">Register</button>