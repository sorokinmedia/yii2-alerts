<?php
namespace sorokinmedia\alert\tests\handlers\UserSiteAlert\actions;

use sorokinmedia\alerts\handlers\UserSiteAlert\UserSiteAlertHandler;
use sorokinmedia\alerts\tests\entities\UserSiteAlert\UserSiteAlert;
use sorokinmedia\alerts\tests\TestCase;

/**
 * Class UpdateViewsUserSiteAlertTest
 * @package sorokinmedia\alert\tests\handlers\UserSiteAlert\actions
 */
class UpdateViewsUserSiteAlertTest extends TestCase
{
    /**
     * @group user-site-alert-handler
     * @throws \Throwable
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function testHandler()
    {
        $this->initDb();
        $this->initDbAdditional();
        $model = UserSiteAlert::findOne(1);
        $handler = new UserSiteAlertHandler($model);
        $this->assertTrue($handler->updateViews());
    }
}