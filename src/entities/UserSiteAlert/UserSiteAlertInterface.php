<?php
namespace sorokinmedia\alerts\entities\UserSiteAlert;

use yii\db\ActiveQuery;

/**
 * Interface UserSiteAlertInterface
 * @package sorokinmedia\alerts\entities\UserSiteAlert
 */
interface UserSiteAlertInterface
{
    /**
     * @return ActiveQuery
     */
    public function getUser(): ActiveQuery;

    /**
     * @return ActiveQuery
     */
    public function getAlert(): ActiveQuery;
}