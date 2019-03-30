<?php
namespace sorokinmedia\alerts\entities\UserSiteAlert;

use sorokinmedia\alerts\entities\SiteAlert\AbstractSiteAlert;
use sorokinmedia\ar_relations\RelationInterface;
use yii\db\{ActiveQuery, ActiveRecord, Exception};
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

    /**
     * статический конструктор
     * @param IdentityInterface $user
     * @param AbstractSiteAlert $siteAlert
     * @return null|AbstractUserSiteAlert
     * @throws Exception
     */
    public static function create(IdentityInterface $user, AbstractSiteAlert $siteAlert): UserSiteAlertInterface
    {
        $user_alert = static::findOne(['user_id' => $user->getId(), 'alert_id' => $siteAlert->id]);
        if ($user_alert instanceof self){
            return $user_alert;
        }
        $user_alert = new static([
            'user_id' => $user->getId(),
            'alert_id' => $siteAlert->id,
        ]);
        if (!$user_alert->insert()){
            throw new Exception(\Yii::t('app', 'Ошибка при добавлении в БД'));
        }
        return $user_alert;
    }

    /**
     * обновление кол-ва показов
     * @return bool
     * @throws Exception
     */
    public function updateViewCount(): bool
    {
        $this->view_count++;
        // если кол-во показов достигло порога для закрытия - проставить метку, что алерт можно закрыть
        if ($this->view_count === $this->alert->view_count_to_close){
            $this->makeRemovable();
        }
        if (!$this->save()){
            throw new Exception(\Yii::t('app', 'Ошибка при сохранении счетчика'));
        }
        return true;
    }

    /**
     * событие: клик по ссылке в алерте
     * @return bool
     * @throws Exception
     */
    public function clickEvent(): bool
    {
        $this->is_clicked = 1;
        $this->makeFinished();
        if (!$this->save()){
            throw new Exception(\Yii::t('app', 'Ошибка при сохранении события клик'));
        }
        return true;
    }

    /**
     * событие: алерт закрыт
     * @return bool
     * @throws Exception
     */
    public function closeEvent(): bool
    {
        $this->is_closed = 1;
        $this->makeFinished();
        if (!$this->save()){
            throw new Exception(\Yii::t('app', 'Ошибка при сохранении события закрытие'));
        }
        return true;
    }

    /**
     * проставить метку, что алерт можно закрыть
     * @return void
     */
    public function makeRemovable()
    {
        $this->is_removable = 1;
    }

    /**
     * проставить метку, что показ алерта завершен
     * @return bool
     */
    public function makeFinished(): bool
    {
        $this->is_finished = 1;
        return $this->afterFinish();
    }

    /**
     * доп действия после завершения показа алерта
     * @return bool
     */
    abstract public function afterFinish(): bool;

    /**
     * @return bool
     * @throws Exception
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function deleteModel(): bool
    {
        if (!$this->delete()){
            throw new Exception(\Yii::t('app', 'Ошибка при удалении из БД'));
        }
        return true;
    }

    /**
     * доп действия до удаления алерта у пользователя
     * @return bool
     */
    abstract public function beforeDeleteUserSiteAlert(): bool;
}
