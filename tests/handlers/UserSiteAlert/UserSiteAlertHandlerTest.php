<?php

namespace sorokinmedia\alerts\tests\handlers\UserSiteAlert;

use sorokinmedia\alerts\handlers\UserSiteAlert\UserSiteAlertHandler;
use sorokinmedia\alerts\tests\entities\UserSiteAlert\UserSiteAlert;
use sorokinmedia\alerts\tests\TestCase;
use yii\base\InvalidConfigException;
use yii\db\Exception;

/**
 * Class UserSiteAlertHandlerTest
 * @package sorokinmedia\alerts\tests\handlers\UserSiteAlert
 */
class UserSiteAlertHandlerTest extends TestCase
{
    /**
     * @group user-site-alert-handler
     * @throws InvalidConfigException
     * @throws Exception
     */
    public function testHandler(): void
    {
        $this->initDb();
        $model = UserSiteAlert::findOne(1);
        $handler = new UserSiteAlertHandler($model);
        $this->assertInstanceOf(UserSiteAlertHandler::class, $handler);
        $this->assertInstanceOf(UserSiteAlert::class, $handler->user_site_alert);
    }
}
