<h1>Register With Us</h1>
<?php
require_once '../vendor/autoload.php';

use src\core\Forms\Form;
use src\core\Forms\Field;

?>

    <?php $form = new Form(["method" => "POST", "action" => "/register"], $model = $params['model']);?>

        <?php $form->createNewField('name', "input", ["placeholder" => "Enter text here", "name" => "email"], ["class" => "form-group"]);?>
        <button type="submit" name="submit" id="submit">Submit</button>
    <?php echo Form::end();?>
<!-- 
    <input type="text" name="name" id="name" placeholder="name"> <br>
        <input type="email" name="email" id="email" placeholder="Email"> <br>
        <input type="password" name="password" id="password" placeholder="Password"> <br>
        <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password"> <br>
        <input type="submit" name="submit" id="submit"> -->