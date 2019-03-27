<?php
namespace sorokinmedia\alerts\tests\handlers\SiteAlertGroup;

use sorokinmedia\alerts\handlers\SiteAlertGroup\SiteAlertGroupHandler;
use sorokinmedia\alerts\tests\entities\SiteAlertGroup\SiteAlertGroup;
use sorokinmedia\alerts\tests\TestCase;

/**
 * Class SiteAlertGroupHandlerTest
 * @package sorokinmedia\alerts\tests\handlers\SiteAlertGroup
 */
class SiteAlertGroupHandlerTest extends TestCase
{
    /**
     * @group site-alert-group-handler
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     * @throws \yii\web\ServerErrorHttpException
     */
    public function testHandler()
    {
        $this->initDb();
        $model = SiteAlertGroup::findOne(1);
        $handler = new SiteAlertGroupHandler($model);
        $this->assertInstanceOf(SiteAlertGroupHandler::class, $handler);
        $this->assertInstanceOf(SiteAlertGroup::class, $handler->site_alert_group);
    }
}