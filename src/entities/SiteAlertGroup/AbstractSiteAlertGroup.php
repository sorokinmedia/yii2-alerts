<?php

namespace sorokinmedia\alerts\entities\SiteAlertGroup;

use sorokinmedia\alerts\entities\SiteAlert\AbstractSiteAlert;
use sorokinmedia\alerts\forms\SiteAlertGroupForm;
use sorokinmedia\alerts\handlers\SiteAlert\SiteAlertHandler;
use sorokinmedia\alerts\interfaces\SiteAlertGroupInterface;
use sorokinmedia\ar_relations\RelationInterface;
use yii\db\{ActiveQuery, ActiveRecord, Exception, StaleObjectException};
use Throwable;
use Yii;
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
     * AbstractSiteAlertGroup constructor.
     * @param array $config
     * @param SiteAlertGroupForm|null $form
     */
    public function __construct(array $config = [], SiteAlertGroupForm $form = null)
    {
        if ($form !== null) {
            $this->form = $form;
        }
        parent::__construct($config);
    }

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
    public static function getGroupsArray(): array
    {
        return static::find()
            ->select(['name', 'id'])
            ->indexBy('id')
            ->orderBy(['name' => SORT_ASC])
            ->column();
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['name', 'role', 'priority'], 'required'],
            [['name', 'role'], 'string', 'max' => 255],
            [['role'], 'in', 'range' => array_keys(static::getRoles())],
            [['priority'], 'default', 'value' => 10]
        ];
    }

    /**
     * необходима реализация в дочернем классе
     * @return array
     */
    abstract public static function getRoles(): array;

    /**
     * @return array
     */
    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app-sm-alerts', 'ID'),
            'name' => Yii::t('app-sm-alerts', 'Название'),
            'role' => Yii::t('app-sm-alerts', 'Роль'),
            'priority' => Yii::t('app-sm-alerts', 'Приоритет'),
        ];
    }

    /**
     * @return Role|null
     */
    public function getRoleObject(): ?Role
    {
        return Yii::$app->authManager->getRole($this->role);
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
     * @throws Throwable
     */
    public function insertModel(): bool
    {
        $this->getFromForm();
        if (!$this->insert()) {
            throw new Exception(Yii::t('app-sm-alerts', 'Ошибка при добавлении в БД'));
        }
        return true;
    }

    /**
     * @return void
     */
    public function getFromForm(): void
    {
        if ($this->form !== null) {
            $this->name = $this->form->name;
            $this->role = $this->form->role;
            $this->priority = $this->form->priority;
        }
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function updateModel(): bool
    {
        $this->getFromForm();
        if (!$this->save()) {
            throw new Exception(Yii::t('app-sm-alerts', 'Ошибка при обновлении в БД'));
        }
        return true;
    }

    /**
     * @return bool
     * @throws Exception
     * @throws Throwable
     * @throws StaleObjectException
     */
    public function deleteModel(): bool
    {
        if ($this->alerts) {
            foreach ($this->alerts as $alert) {
                /** @var AbstractSiteAlert $alert */
                (new SiteAlertHandler($alert))->resetGroup();
            }
        }
        if (!$this->delete()) {
            throw new Exception(Yii::t('app-sm-alerts', 'Ошибка при удалении в БД'));
        }
        return true;
    }
}
