<?php

use yii\db\Migration;
use backend\models\User;
/**
 * Class m210618_074420_rbac_data
 */
class m210618_074420_rbac_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;
        // Define permissions
        $viewUserPermission = $auth->createPermission('viewUser');// admin see and upload rabotnikov
        $auth->add($viewUserPermission);
        $viewCustomerPermission = $auth->createPermission('viewCustomer');//manager and admin
        $auth->add($viewCustomerPermission);
        $viewStagePermission = $auth->createPermission('viewStage');// admin
        $auth->add($viewStagePermission);
        $viewPricePermission = $auth->createPermission('viewPrice');// admin
        $auth->add($viewPricePermission);
        $updateProjectsPermission = $auth->createPermission('updateProjects');// manager, main_artist, admin
        $auth->add($updateProjectsPermission);

        // Define roles with permissions
        $mainArtistRole = $auth->createRole('main_artist');
        $auth->add($mainArtistRole);
        $auth->addChild($mainArtistRole, $updateProjectsPermission);

        $managerRole = $auth->createRole('manager');
        $auth->add($managerRole);
        $auth->addChild($managerRole, $updateProjectsPermission);
        $auth->addChild($managerRole, $viewCustomerPermission);

        $adminRole = $auth->createRole('admin');
        $auth->add($adminRole);
        $auth->addChild($adminRole,  $managerRole);
        $auth->addChild($adminRole,  $viewUserPermission);
        $auth->addChild($adminRole,  $viewStagePermission);
        $auth->addChild($adminRole,  $viewPricePermission);

        $artistRole = $auth->createRole('artist');
        $auth->add($artistRole);

        // Create admin user
        // Расчитывается, что после создания суперпользователя пароль будет изменен (или права админа переданы другому пользователю).
        $user = new User([
            'email' => 'admin@admin.com',
            'username' => 'Admin',
            'password_hash' => '$2y$13$P9.d7KUb8C6BHCvkdzMsrOi5U.vIAw01UmriB.34PiN50e8nTGFge', // 111111
        ]);
        $user->generateAuthKey();
        $user->save();
        // Assign admin role to
        $auth->assign($adminRole, $user->getId());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210618_074420_rbac_data cannot be reverted.\n";

        return false;
    }


}
