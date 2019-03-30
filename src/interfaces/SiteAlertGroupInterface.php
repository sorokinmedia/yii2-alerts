<?php
namespace sorokinmedia\alerts\interfaces\SiteAlertGroup;

use yii\db\ActiveQuery;
use yii\rbac\Role;

/**
 * Interface SiteAlertGroupInterface
 * @package sorokinmedia\alerts\interfaces\SiteAlertGroup
 */
interface SiteAlertGroupInterface
{
    /**
     * @return array
     */
    public static function getRoles(): array;

    /**
     * @return array
     */
    public static function getGroupsArray(): array;

    /**
     * @return Role|null
     */
    public function getRoleObject();

    /**
     * @return ActiveQuery
     */
    public function getAlerts(): ActiveQuery;

    /**
     * перенос данных из формы в модель
     * @return void
     */
    public function getFromForm();

    /**
     * добавление модели в БД
     * @return bool
     */
    public function insertModel(): bool;

    /**
     * обновление модели в БД
     * @return bool
     */
    public function updateModel(): bool;

    /**
     * удаление модели из БД
     * @return bool
     */
    public function deleteModel(): bool;
}
