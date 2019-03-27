<?php
namespace sorokinmedia\alerts\tests\handlers\SiteAlert;

use sorokinmedia\alerts\handlers\SiteAlert\SiteAlertHandler;
use sorokinmedia\alerts\tests\entities\SiteAlert\SiteAlert;
use sorokinmedia\alerts\tests\TestCase;

/**
 * Class SiteAlertHandlerTest
 * @package sorokinmedia\alerts\tests\handlers\SiteAlert
 */
class SiteAlertHandlerTest extends TestCase
{
    /**
     * @group site-alert-handler
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     * @throws \yii\web\ServerErrorHttpException
     */
    public function testHandler()
    {
        $this->initDb();
        $model = SiteAlert::findOne(1);
        $handler = new SiteAlertHandler($model);
        $this->assertInstanceOf(SiteAlertHandler::class, $handler);
        $this->assertInstanceOf(SiteAlert::class, $handler->site_alert);
    }
}