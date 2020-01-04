<?php

namespace sorokinmedia\alert\tests\handlers\SiteAlert\actions;

use sorokinmedia\alerts\forms\SiteAlertForm;
use sorokinmedia\alerts\handlers\SiteAlert\SiteAlertHandler;
use sorokinmedia\alerts\tests\entities\SiteAlert\SiteAlert;
use sorokinmedia\alerts\tests\TestCase;
use Throwable;
use yii\base\InvalidConfigException;
use yii\db\Exception;

/**
 * Class CreateSiteAlertGroupTest
 * @package sorokinmedia\alert\tests\handlers\SiteAlertGroup\actions
 */
class CreateSiteAlertTest extends TestCase
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
        $model = new SiteAlert();
        $form = new SiteAlertForm([
            'name' => 'тестовый алерт с ссылкой',
            'text' => '<p>тестовый алерт с ссылкой <a href="https://workhard.online">workhard.online</a></p>',
            'image' => 'https://workhard.online/img/ico_who.png',
            'role' => 'roleUser',
            'view_count_to_close' => 2,
            'finish_date' => 1575158400, // 01.12.2019
            'group_id' => 1,
            'order_id' => 1
        ], $model);
        $model->form = $form;
        $handler = new SiteAlertHandler($model);
        $this->assertTrue($handler->create());
    }
}
