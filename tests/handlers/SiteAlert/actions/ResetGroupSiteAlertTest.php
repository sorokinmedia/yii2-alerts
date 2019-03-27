<?php
namespace sorokinmedia\alert\tests\handlers\SiteAlert\actions;

use sorokinmedia\alerts\handlers\SiteAlert\SiteAlertHandler;
use sorokinmedia\alerts\tests\entities\SiteAlert\SiteAlert;
use sorokinmedia\alerts\tests\TestCase;

/**
 * Class ResetGroupSiteAlertTest
 * @package sorokinmedia\alert\tests\handlers\SiteAlert\actions
 */
class ResetGroupSiteAlertTest extends TestCase
{
    /**
     * @group site-alert-handler
     * @throws \Throwable
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function testHandler()
    {
        $this->initDb();
        $this->initDbAdditional();
        $model = SiteAlert::findOne(1);
        $handler = new SiteAlertHandler($model);
        $this->assertTrue($handler->resetGroup());
    }
}