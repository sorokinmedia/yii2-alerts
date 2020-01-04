<?php

namespace sorokinmedia\alerts\tests\handlers\SiteAlertGroup;

use sorokinmedia\alerts\handlers\SiteAlertGroup\SiteAlertGroupHandler;
use sorokinmedia\alerts\tests\entities\SiteAlertGroup\SiteAlertGroup;
use sorokinmedia\alerts\tests\TestCase;
use yii\base\InvalidConfigException;
use yii\db\Exception;
use yii\web\ServerErrorHttpException;

/**
 * Class SiteAlertGroupHandlerTest
 * @package sorokinmedia\alerts\tests\handlers\SiteAlertGroup
 */
class SiteAlertGroupHandlerTest extends TestCase
{
    /**
     * @group site-alert-group-handler
     * @throws InvalidConfigException
     * @throws Exception
     * @throws ServerErrorHttpException
     */
    public function testHandler(): void
    {
        $this->initDb();
        $model = SiteAlertGroup::findOne(1);
        $handler = new SiteAlertGroupHandler($model);
        $this->assertInstanceOf(SiteAlertGroupHandler::class, $handler);
        $this->assertInstanceOf(SiteAlertGroup::class, $handler->site_alert_group);
    }
}
