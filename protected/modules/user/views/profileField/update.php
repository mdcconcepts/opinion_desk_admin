<div class="row">
    <div class="col-md-12">
        <div class="block-web full">
            <div class="col-md-12">
                <div class="block-web">
                    <div class="header">
                        <div class="actions"> <a href="#" class="minimize"><i class="fa fa-chevron-down"></i></a> <a href="#" class="refresh"><i class="fa fa-repeat"></i></a> </div>
                        <h3 class="content-header">Update Field</h3>
                    </div>
                    <div class="porlets-content">
                        <?php echo $this->renderPartial('_form', array('model' => $model)); ?>
                    </div><!--/porlets-content-->
                </div><!--/block-web--> 
            </div><!--/col-md-6-->
        </div><!--/block-web--> 
    </div><!--/col-md-8--> 
</div><!--/row--> 



<?php /* * *
  $this->breadcrumbs = array(
  UserModule::t('Profile Fields') => array('admin'),
  $model->title => array('view', 'id' => $model->id),
  UserModule::t('Update'),
  );
  $this->menu = array(
  array('label' => UserModule::t('Create Profile Field'), 'url' => array('create')),
  array('label' => UserModule::t('View Profile Field'), 'url' => array('view', 'id' => $model->id)),
  array('label' => UserModule::t('Manage Profile Field'), 'url' => array('admin')),
  array('label' => UserModule::t('Manage Users'), 'url' => array('/user/admin')),
  );
  ?>

  <h1><?php echo UserModule::t('Update Profile Field ') . $model->id; ?></h1>
  <?php echo $this->renderPartial('_form', array('model' => $model)); ?>
 * 
 */
?>