<?php
namespace sorokinmedia\alerts\tests\entities\UserSiteAlert;

use sorokinmedia\alerts\entities\UserSiteAlert\AbstractUserSiteAlert;
use sorokinmedia\alerts\tests\entities\RelationClassTrait;

/**
 * Class UserSiteAlert
 * @package sorokinmedia\alerts\tests\entities\UserSiteAlert
 */
class UserSiteAlert extends AbstractUserSiteAlert
{
    use RelationClassTrait;

    /**
     * @return bool
     */
    public function afterFinish(): bool
    {
        return true;
    }

    /**
     * @return bool
     */
    public function beforeDeleteUserSiteAlert(): bool
    {
        return true;
    }
}
