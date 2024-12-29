<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>
    <h1>Edit User</h1>
    <?php echo validation_errors(); ?>
    <form method="POST" action="<?php echo base_url('users/update/' . $user->id); ?>">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="<?php echo set_value('name', $user->name); ?>"><br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo set_value('email', $user->email); ?>"><br><br>

        <label for="password">Password (Leave blank if not changing):</label>
        <input type="password" name="password" id="password"><br><br>

        <label for="dob">Date of Birth:</label>
        <input type="date" name="dob" id="dob" value="<?php echo set_value('dob', $user->dob); ?>"><br><br>

        <button type="submit">Update</button>
        <a href="<?php echo base_url('users'); ?>">Cancel</a>
    </form>
</body>
</html>
