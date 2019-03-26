<?php
namespace sorokinmedia\alerts\handlers\UserSiteAlert\actions;

use sorokinmedia\alerts\entities\UserSiteAlert\AbstractUserSiteAlert;
use sorokinmedia\alerts\handlers\UserSiteAlert\interfaces\ActionExecutable;

/**
 * Class AbstractAction
 * @package sorokinmedia\alerts\handlers\UserSiteAlert\actions
 *
 * @property AbstractUserSiteAlert $user_site_alert
 */
abstract class AbstractAction implements ActionExecutable
{
    protected $user_site_alert;

    /**
     * AbstractAction constructor.
     * @param AbstractUserSiteAlert $userSiteAlert
     */
    public function __construct(AbstractUserSiteAlert $userSiteAlert)
    {
        $this->user_site_alert = $userSiteAlert;
        return $this;
    }
}