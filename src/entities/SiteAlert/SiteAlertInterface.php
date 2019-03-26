<?php
namespace sorokinmedia\alerts\entities\SiteAlert;

use yii\db\ActiveQuery;
use yii\rbac\Role;

/**
 * Interface SiteAlertInterface
 * @package sorokinmedia\alerts\entities\SiteAlert
 */
interface SiteAlertInterface
{
    /**
     * @return Role|null
     */
    public function getRoleObject();

    /**
     * @return ActiveQuery
     */
    public function getGroup(): ActiveQuery;
}