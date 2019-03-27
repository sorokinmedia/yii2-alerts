<?php
namespace sorokinmedia\alerts\tests\forms;

use sorokinmedia\alerts\forms\SiteAlertForm;
use sorokinmedia\alerts\tests\entities\SiteAlert\SiteAlert;
use sorokinmedia\alerts\tests\TestCase;

/**
 * Class SiteAlertGroupFormTest
 * @package sorokinmedia\alerts\tests\forms
 *
 * тест формы группы алертов
 */
class SiteAlertFormTest extends TestCase
{
    /**
     * @group forms
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function testConstruct()
    {
        $this->initDb();
        $alert = new SiteAlert();
        $form = new SiteAlertForm([
            'name' => 'test_alert',
            'text' => '<p>test text <a href="https://workhard.online">workhard.online</a></p>',
            'image' => 'https://workhard.online/img/ico_who.png',
            'role' => 'roleUser',
            'view_count_to_close' => 2,
            'finish_date' => 1575158400,
            'group_id' => 1,
            'order_id' => 1
        ], $alert);
        $this->assertInstanceOf(SiteAlertForm::class, $form);
        $this->assertEquals('test_alert', $form->name);
        $this->assertEquals('<p>test text <a href="https://workhard.online">workhard.online</a></p>', $form->text);
        $this->assertEquals('https://workhard.online/img/ico_who.png', $form->image);
        $this->assertEquals('roleUser', $form->role);
        $this->assertEquals(2, $form->view_count_to_close);
        $this->assertEquals(1575158400, $form->finish_date);
        $this->assertEquals(1, $form->group_id);
        $this->assertEquals(1, $form->order_id);
        $this->assertTrue($form->validate());
    }

    /**
     * @group forms
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function testConstructWithModel()
    {
        $this->initDb();
        $alert = SiteAlert::findOne(1);
        $form = new SiteAlertForm([
            'name' => 'test_alert',
        ], $alert);
        $this->assertInstanceOf(SiteAlertForm::class, $form);
        $this->assertEquals($form->name, 'test_alert');
        $this->assertEquals('<p>тестовый алерт с ссылкой <a href="https://workhard.online">workhard.online</a></p>', $form->text);
        $this->assertEquals('https://workhard.online/img/ico_who.png', $form->image);
        $this->assertEquals('roleUser', $form->role);
        $this->assertEquals(2, $form->view_count_to_close);
        $this->assertEquals(1575158400, $form->finish_date);
        $this->assertEquals(1, $form->group_id);
        $this->assertEquals(1, $form->order_id);
        $this->assertTrue($form->validate());
    }
}