<?php
namespace sorokinmedia\alerts\entities\SiteAlert;

use sorokinmedia\alerts\entities\SiteAlertGroup\AbstractSiteAlertGroup;
use sorokinmedia\alerts\entities\UserSiteAlert\AbstractUserSiteAlert;
use sorokinmedia\alerts\forms\SiteAlertForm;
use sorokinmedia\alerts\handlers\UserSiteAlert\UserSiteAlertHandler;
use sorokinmedia\ar_relations\RelationInterface;
use yii\db\{ActiveQuery, ActiveRecord, Exception};
use yii\rbac\Role;

/**
 * Class AbstractSiteAlert
 * @package sorokinmedia\alerts\entities\SiteAlert
 *
 * @property int $id
 * @property string $name
 * @property string $text
 * @property string $image
 * @property string $role
 * @property int $view_count_to_close
 * @property int $finish_date
 * @property int $group_id
 * @property int $order_id
 *
 * @property SiteAlertForm $form
 *
 * @property AbstractSiteAlertGroup $group
 * @property Role $roleObject
 * @property AbstractUserSiteAlert[] $userAlerts
 */
abstract class AbstractSiteAlert extends ActiveRecord implements RelationInterface, SiteAlertInterface
{
    public $form;

    /**
     * @return string
     */
    public static function tableName(): string
    {
        return 'site_alert';
    }

    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            [['name', 'text', 'role', 'order_id'], 'required'],
            [['name', 'role', 'image'], 'string', 'max' => 255],
            [['text'], 'string'],
            [['role'], 'validateRole'],
            [['group_id'], 'exist', 'targetClass' => AbstractSiteAlertGroup::class, 'targetAttribute' => ['group_id' => 'id']],
            [['view_count_to_close', 'finish_date', 'order_id'], 'integer']
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels() : array
    {
        return [
            'id' => \Yii::t('app', 'ID'),
            'name' => \Yii::t('app', 'Название'),
            'text' => \Yii::t('app', 'Текст'),
            'image' => \Yii::t('app', 'Изображение'),
            'role' => \Yii::t('app', 'Роль'),
            'view_count_to_close' => \Yii::t('app', 'Кол-во просмотров для отображения кнопки закрытия'),
            'finish_date' => \Yii::t('app', 'Дата окончания показов'),
            'group_id' => \Yii::t('app', 'Группа'),
            'order_id' => \Yii::t('app', 'Порядковый номер'),
        ];
    }

    /**
     * @param $attribute
     * @param $params
     * @return bool
     */
    public function validateRole($attribute, $params)
    {
        return array_key_exists($this->role, $this->__siteAlertGroupClass::getRoles());
    }

    /**
     * AbstractSiteAlert constructor.
     * @param array $config
     * @param SiteAlertForm|null $form
     */
    public function __construct(array $config = [], SiteAlertForm $form = null)
    {
        if ($form !== null){
            $this->form = $form;
        }
        parent::__construct($config);
    }

    /**
     * @return void
     */
    public function getFromForm()
    {
        if ($this->form !== null){
            $this->name = $this->form->name;
            $this->text = $this->form->text;
            $this->image = $this->form->image;
            $this->role = $this->form->role;
            $this->view_count_to_close = $this->form->view_count_to_close;
            $this->finish_date = $this->form->finish_date;
            $this->group_id = $this->form->group_id;
            $this->order_id = $this->form->order_id;
        }
    }

    /**
     * @return Role|null
     */
    public function getRoleObject()
    {
        return \Yii::$app->authManager->getRole($this->role);
    }

    /**
     * @return ActiveQuery
     */
    public function getGroup(): ActiveQuery
    {
        return $this->hasOne($this->__siteAlertGroupClass, ['id' => 'group_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getUserAlerts(): ActiveQuery
    {
        return $this->hasMany($this->__userSiteAlertClass, ['alert_id' => 'id']);
    }

    /**
     * @return bool
     * @throws Exception
     * @throws \Throwable
     */
    public function insertModel(): bool
    {
        $this->getFromForm();
        if (!$this->insert()){
            throw new Exception(\Yii::t('app', 'Ошибка при добавлении в БД'));
        }
        return true;
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function updateModel(): bool
    {
        $this->getFromForm();
        if (!$this->save()){
            throw new Exception(\Yii::t('app', 'Ошибка при обновлении в БД'));
        }
        return true;
    }

    /**
     * @return bool
     * @throws Exception
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function deleteModel(): bool
    {
        if ($this->userAlerts){
            foreach ($this->userAlerts as $userAlert){
                /** @var AbstractUserSiteAlert $userAlert */
                (new UserSiteAlertHandler($userAlert))->delete();
            }
        }
        if (!$this->delete()){
            throw new Exception(\Yii::t('app', 'Ошибка при удалении из БД'));
        }
        return true;
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function resetGroup(): bool
    {
        $this->group_id = null;
        if (!$this->save()){
            throw new Exception(\Yii::t('app', 'Ошибка при сбросе группы'));
        }
        return true;
    }
}