<?php
namespace sorokinmedia\alerts\entities\SiteAlertGroup;

use sorokinmedia\ar_relations\RelationInterface;
use yii\db\ActiveRecord;
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
 * @property Role $roleObject
 */
abstract class AbstractSiteAlertGroup extends ActiveRecord implements RelationInterface, SiteAlertGroupInterface
{
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
}