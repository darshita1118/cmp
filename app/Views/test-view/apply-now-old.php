<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply Now</title>
</head>
<body>
    <form action="" method="post">
        <?= csrf_field() ?>
        <input type="email" name="email" value="test@gmail.com">
        <input type="number" name="mobile" value="0123456789">
        <input type="text" name="firstname" value="Aakash">
        <input type="text" name="country_code" value="Aakash">
        <input type="text" name="lastname" value="Kumawat">
        <input type="text" name="middlename" value="">
        <input type="text" name='course' value='96'>
        <input type="text" name="level" value="2">
        <input type="text" name="department" id="2" value="2">
        <input type="submit" name='btntype' value="sid_create">
        <?php if (isset($validation)) : ?>
            <div class="form-group">
            <div class="alert alert-danger">
                <?= $validation->listErrors() ?>
            </div>
            </div>
        <?php endif; ?>
    </form>
</body>
</html>