<?php

namespace sorokinmedia\alert\tests\handlers\SiteAlert\actions;

use sorokinmedia\alerts\handlers\SiteAlert\SiteAlertHandler;
use sorokinmedia\alerts\tests\entities\SiteAlert\SiteAlert;
use sorokinmedia\alerts\tests\TestCase;
use Throwable;
use yii\base\InvalidConfigException;
use yii\db\Exception;

/**
 * Class ResetGroupSiteAlertTest
 * @package sorokinmedia\alert\tests\handlers\SiteAlert\actions
 */
class ResetGroupSiteAlertTest extends TestCase
{
    /**
     * @group site-alert-handler
     * @throws Throwable
     * @throws InvalidConfigException
     * @throws Exception
     */
    public function testHandler(): void
    {
        $this->initDb();
        $this->initDbAdditional();
        $model = SiteAlert::findOne(1);
        $handler = new SiteAlertHandler($model);
        $this->assertTrue($handler->resetGroup());
    }
}
