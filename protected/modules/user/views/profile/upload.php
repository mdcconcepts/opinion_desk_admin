
<form method="post" action="<?php echo Yii::app()->request->baseUrl . '/index.php/user/profile/upload' ?>" enctype="multipart/form-data">
    <div class="row">
        <label>Profile pic</label>
        <input type="file" name="organisation_logo"/>
        <span><?php if (isset($error['organisation_logo'])) echo $error['organisation_logo'][0]; ?></span>
    </div>
    <input type="hidden" value="50" name="user_id"/>
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>