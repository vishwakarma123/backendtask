<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
</head>
<body>
    <h1>Create New User</h1>
    
    <?php if (validation_errors()): ?>
        <div style="color: red;">
            <?php echo validation_errors(); ?>
        </div>
    <?php endif; ?>

    <form method="post" action="<?php echo site_url('users/create'); ?>">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" value="<?php echo set_value('name'); ?>"><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="<?php echo set_value('email'); ?>"><br><br>

        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br><br>

        <label for="dob">Date of Birth:</label><br>
        <input type="date" id="dob" name="dob" value="<?php echo set_value('dob'); ?>"><br><br>

        <button type="submit">Create User</button>
    </form>

    <br>
    <a href="<?php echo site_url('users'); ?>">Back to List</a>
</body>
</html>
