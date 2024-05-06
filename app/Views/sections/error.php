<?php $errors = session()->getFlashdata('errors');?>
<?php if (isset($errors)):?>
    <div class="alert alert-danger" role="alert">
        <?php foreach ($errors as $error):?>
            <div class="alert__message">
                <p><?= esc($error)?></p>
            </div>
        <?php endforeach;?>
    </div>
<?php endif;?>

<?php $errorAge = session()->getFlashdata('errorAge');?>
<?php if (isset($errorAge)):?>
    <div class="alert alert-danger" role="alert">
        <div class="alert__message">
            <p><?= esc($errorAge)?></p>
        </div>
    </div>
<?php endif;?>
