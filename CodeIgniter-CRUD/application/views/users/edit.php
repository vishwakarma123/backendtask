<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
</head>
<body>
    <h1>Edit User</h1>
    <?php if (validation_errors()): ?>
        <div style="color: red;">
            <?php echo validation_errors(); ?>
        </div>
    <?php endif; ?>

    <form method="post" action="<?php echo site_url('users/update/' . $user->id); ?>">
        <label>Name:</label><br>
        <input type="text" name="name" value="<?php echo set_value('name', $user->name); ?>"><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" value="<?php echo set_value('email', $user->email); ?>"><br><br>

        <label>Password (leave blank to keep unchanged):</label><br>
        <input type="password" name="password"><br><br>

        <label>Date of Birth:</label><br>
        <input type="date" name="dob" value="<?php echo set_value('dob', $user->dob); ?>"><br><br>

        <button type="submit">Update User</button>
    </form>
    <br>
    <a href="<?php echo site_url('users'); ?>">Back to List</a>
</body>
</html>
