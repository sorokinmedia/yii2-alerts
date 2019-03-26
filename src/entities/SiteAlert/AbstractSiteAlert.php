<?php
namespace sorokinmedia\alerts\entities\SiteAlert;

use sorokinmedia\alerts\entities\SiteAlertGroup\AbstractSiteAlertGroup;
use sorokinmedia\ar_relations\RelationInterface;
use yii\db\{ActiveQuery,ActiveRecord};
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
 * @property AbstractSiteAlertGroup $group
 * @property Role $roleObject
 */
abstract class AbstractSiteAlert extends ActiveRecord implements RelationInterface, SiteAlertInterface
{
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
            [['role'], 'in', 'range' => array_keys(AbstractSiteAlertGroup::getRoles())],
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
}