<?php

namespace sorokinmedia\alerts\interfaces;

use sorokinmedia\alerts\entities\SiteAlert\AbstractSiteAlert;
use yii\db\ActiveQuery;
use yii\web\IdentityInterface;

/**
 * Interface UserSiteAlertInterface
 * @package sorokinmedia\alerts\interfaces
 */
interface UserSiteAlertInterface
{
    /**
     * статический конструктор
     * @param IdentityInterface $user
     * @param AbstractSiteAlert $siteAlert
     * @return UserSiteAlertInterface
     */
    public static function create(IdentityInterface $user, AbstractSiteAlert $siteAlert): UserSiteAlertInterface;

    /**
     * @return ActiveQuery
     */
    public function getUser(): ActiveQuery;

    /**
     * @return ActiveQuery
     */
    public function getAlert(): ActiveQuery;

    /**
     * обновление кол-ва показов
     * @return bool
     */
    public function updateViewCount(): bool;

    /**
     * событие: клик по ссылке в алерте
     * @return bool
     */
    public function clickEvent(): bool;

    /**
     * событие: алерт закрыт
     * @return bool
     */
    public function closeEvent(): bool;

    /**
     * проставить метку, что алерт можно закрыть
     * @return void
     */
    public function makeRemovable(): void;

    /**
     * проставить метку, что показ алерта завершен
     * @return bool
     */
    public function makeFinished(): bool;

    /**
     * доп действия после завершения показа алерта
     * @return bool
     */
    public function afterFinish(): bool;

    /**
     * удаление модели из БД
     * @return bool
     */
    public function deleteModel(): bool;

    /**
     * действия до удаления алерта у пользователя
     * @return bool
     */
    public function beforeDeleteUserSiteAlert(): bool;
}
