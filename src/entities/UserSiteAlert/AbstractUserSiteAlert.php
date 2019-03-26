<?php
namespace sorokinmedia\alerts\entities\UserSiteAlert;

use sorokinmedia\alerts\entities\SiteAlert\AbstractSiteAlert;
use sorokinmedia\ar_relations\RelationInterface;
use yii\db\{ActiveQuery,ActiveRecord};
use yii\web\IdentityInterface;

/**
 * Class AbstractUserSiteAlert
 * @package sorokinmedia\alerts\entities\UserSiteAlert
 *
 * @property int $id
 * @property int $user_id
 * @property int $alert_id
 * @property int $view_count
 * @property int $is_removable
 * @property int $is_clicked
 * @property int $is_closed
 * @property int $is_finished
 *
 * @property IdentityInterface $user
 * @property AbstractSiteAlert $alert
 */
abstract class AbstractUserSiteAlert extends ActiveRecord implements RelationInterface, UserSiteAlertInterface
{
    /**
     * @return string
     */
    public static function tableName(): string
    {
        return 'user_site_alert';
    }

    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            [['user_id', 'alert_id'], 'required'],
            [['alert_id'], 'exist', 'targetClass' => AbstractSiteAlert::class, 'targetAttribute' => ['alert_id' => 'id']],
            [['view_count', 'is_removable', 'is_clicked', 'is_closed', 'is_finished'], 'integer'],
            [['view_count', 'is_removable', 'is_clicked', 'is_closed', 'is_finished'], 'default', 'value' => 0],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels() : array
    {
        return [
            'id' => \Yii::t('app', 'ID'),
            'user_id' => \Yii::t('app', 'Пользователь'),
            'alert_id' => \Yii::t('app', 'Алерт'),
            'view_count' => \Yii::t('app', 'Кол-во просмотров'),
            'is_removable' => \Yii::t('app', 'Можно закрыть'),
            'is_clicked' => \Yii::t('app', 'Кликнута ссылка'),
            'is_closed' => \Yii::t('app', 'Закрыт'),
            'is_finished' => \Yii::t('app', 'Завершен'),
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getUser(): ActiveQuery
    {
        return $this->hasOne($this->__userClass, ['id' => 'user_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getAlert(): ActiveQuery
    {
        return $this->hasOne($this->__siteAlertClass, ['id' => 'alert_id']);
    }
}