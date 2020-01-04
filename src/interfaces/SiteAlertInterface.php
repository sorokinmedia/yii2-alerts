<?php

namespace sorokinmedia\alerts\interfaces;

use yii\db\ActiveQuery;
use yii\rbac\Role;

/**
 * Interface SiteAlertInterface
 * @package sorokinmedia\alerts\interfaces
 */
interface SiteAlertInterface
{
    /**
     * @return Role|null
     */
    public function getRoleObject(): ?Role;

    /**
     * @return ActiveQuery
     */
    public function getGroup(): ActiveQuery;

    /**
     * @return ActiveQuery
     */
    public function getUserAlerts(): ActiveQuery;

    /**
     * перенос данных из формы в модель
     * @return void
     */
    public function getFromForm(): void;

    /**
     * добавление модели
     * @return bool
     */
    public function insertModel(): bool;

    /**
     * обновление модели
     * @return bool
     */
    public function updateModel(): bool;

    /**
     * вызывает перед удаление алерта
     * @return bool
     */
    public function beforeSiteAlertDelete(): bool;

    /**
     * удаление модели
     * @return bool
     */
    public function deleteModel(): bool;

    /**
     * сброс группы (при удалении группы)
     * @return bool
     */
    public function resetGroup(): bool;

    /**
     * запуск показа определенного алерта
     * @return bool
     */
    public function startShowing(): bool;
}
