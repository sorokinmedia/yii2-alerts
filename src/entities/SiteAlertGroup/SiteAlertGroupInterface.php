<?php
namespace sorokinmedia\alerts\entities\SiteAlertGroup;

use yii\rbac\Role;

/**
 * Interface SiteAlertGroupInterface
 * @package sorokinmedia\alerts\entities\SiteAlertGroup
 */
interface SiteAlertGroupInterface
{
    /**
     * @return array
     */
    public static function getRoles(): array;

    /**
     * @return Role|null
     */
    public function getRoleObject();
}