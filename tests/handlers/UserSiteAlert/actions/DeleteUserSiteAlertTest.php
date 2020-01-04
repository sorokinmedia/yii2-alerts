<?php

namespace sorokinmedia\alert\tests\handlers\UserSiteAlert\actions;

use sorokinmedia\alerts\handlers\UserSiteAlert\UserSiteAlertHandler;
use sorokinmedia\alerts\tests\entities\UserSiteAlert\UserSiteAlert;
use sorokinmedia\alerts\tests\TestCase;
use Throwable;
use yii\base\InvalidConfigException;
use yii\db\Exception;

/**
 * Class DeleteUserSiteAlertTest
 * @package sorokinmedia\alert\tests\handlers\UserSiteAlert\actions
 */
class DeleteUserSiteAlertTest extends TestCase
{
    /**
     * @group user-site-alert-handler
     * @throws Throwable
     * @throws InvalidConfigException
     * @throws Exception
     */
    public function testHandler(): void
    {
        $this->initDb();
        $this->initDbAdditional();
        $model = UserSiteAlert::findOne(1);
        $handler = new UserSiteAlertHandler($model);
        $this->assertTrue($handler->delete());
    }
}
