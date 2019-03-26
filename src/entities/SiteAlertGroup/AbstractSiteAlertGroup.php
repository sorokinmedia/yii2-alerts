<?php
namespace sorokinmedia\alerts\entities\SiteAlertGroup;

use sorokinmedia\alerts\entities\SiteAlert\AbstractSiteAlert;
use sorokinmedia\alerts\forms\SiteAlertGroupForm;
use sorokinmedia\alerts\handlers\SiteAlert\SiteAlertHandler;
use sorokinmedia\ar_relations\RelationInterface;
use yii\db\{ActiveQuery,ActiveRecord,Exception};
use yii\rbac\Role;

/**
 * Class AbstractSiteAlertGroup
 * @package sorokinmedia\alerts\entities\SiteAlertGroup
 *
 * @property int $id
 * @property string $name
 * @property string $role
 * @property int $priority
 *
 * @property SiteAlertGroupForm $form
 *
 * @property Role $roleObject
 * @property AbstractSiteAlert[] $alerts
 */
abstract class AbstractSiteAlertGroup extends ActiveRecord implements RelationInterface, SiteAlertGroupInterface
{
    public $form;

    /**
     * @return string
     */
    public static function tableName(): string
    {
        return 'site_alert_group';
    }

    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            [['name', 'role', 'priority'], 'required'],
            [['name', 'role'], 'string', 'max' => 255],
            [['role'], 'in', 'range' => array_keys(static::getRoles())],
            [['priority'], 'default', 'value' => 10]
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
            'role' => \Yii::t('app', 'Роль'),
            'priority' => \Yii::t('app', 'Приоритет'),
        ];
    }

    /**
     * AbstractSiteAlertGroup constructor.
     * @param array $config
     * @param SiteAlertGroupForm|null $form
     */
    public function __construct(array $config = [], SiteAlertGroupForm $form = null)
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
            $this->role = $this->form->role;
            $this->priority = $this->form->priority;
        }
    }

    /**
     * необходима реализация в дочернем классе
     * @return array
     */
    abstract public static function getRoles(): array;

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
    public function getAlerts(): ActiveQuery
    {
        return $this->hasMany($this->__siteAlertClass, ['group_id' => 'id']);
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
            throw new Exception(\Yii::t('app','Ошибка при обновлении в БД'));
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
        if ($this->alerts){
            foreach ($this->alerts as $alert){
                /** @var AbstractSiteAlert $alert */
                (new SiteAlertHandler($alert))->resetGroup();
            }
        }
        if (!$this->delete()){
            throw new Exception(\Yii::t('app', 'Ошибка при удалении в БД'));
        }
        return true;
    }
}