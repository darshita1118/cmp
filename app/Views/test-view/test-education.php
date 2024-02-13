<form action="" method="post">
    <?= csrf_field() ?>
    <input type="text" name="education_level[0][type]" value="10">
    <input type="text" name="education_level[0][board_uni]" value="Test">
    <input type="text" name="education_level[0][institude_school]" value="Test">
    <input type="text" name="education_level[0][grade]" value="Test">
    <input type="text" name="education_level[0][marks]" value="Test">
    <input type="text" name="education_level[1][type]" value="13">
    <input type="text" name="education_level[1][board_uni]" value="Test">
    <input type="text" name="education_level[1][institude_school]" value="Test">
    <input type="text" name="education_level[1][grade]" value="Test">
    <input type="text" name="education_level[1][marks]" value="Test">
    <?php if (isset($validation)) : ?>
            <div class="form-group">
            <div class="alert alert-danger">
                <?= $validation->listErrors() ?>
            </div>
            </div>
        <?php endif; ?>
    <button type="submit" name="education">Submit</button>
</form>