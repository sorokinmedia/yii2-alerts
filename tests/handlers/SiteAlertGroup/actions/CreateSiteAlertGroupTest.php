<?php

namespace sorokinmedia\alert\tests\handlers\SiteAlertGroup\actions;

use sorokinmedia\alerts\forms\SiteAlertGroupForm;
use sorokinmedia\alerts\handlers\SiteAlertGroup\SiteAlertGroupHandler;
use sorokinmedia\alerts\tests\entities\SiteAlertGroup\SiteAlertGroup;
use sorokinmedia\alerts\tests\TestCase;
use Throwable;
use yii\base\InvalidConfigException;
use yii\db\Exception;

/**
 * Class CreateSiteAlertGroupTest
 * @package sorokinmedia\alert\tests\handlers\SiteAlertGroup\actions
 */
class CreateSiteAlertGroupTest extends TestCase
{
    /**
     * @group site-alert-group-handler
     * @throws Throwable
     * @throws InvalidConfigException
     * @throws Exception
     */
    public function testHandler(): void
    {
        $this->initDb();
        $this->initDbAdditional();
        $model = new SiteAlertGroup();
        $form = new SiteAlertGroupForm([
            'name' => 'test_group',
            'role' => 'roleUser',
            'priority' => 10,
        ], $model);
        $model->form = $form;
        $handler = new SiteAlertGroupHandler($model);
        $this->assertTrue($handler->create());
    }
}
