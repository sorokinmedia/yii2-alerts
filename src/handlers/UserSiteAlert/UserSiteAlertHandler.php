<?php

namespace sorokinmedia\alerts\handlers\UserSiteAlert;

use sorokinmedia\alerts\entities\UserSiteAlert\AbstractUserSiteAlert;
use sorokinmedia\alerts\handlers\UserSiteAlert\interfaces\{Delete, EventClick, EventClose, UpdateViews};
use Throwable;
use yii\db\Exception;
use yii\db\StaleObjectException;

/**
 * Class UserSiteAlertHandler
 * @package sorokinmedia\alerts\handlers\UserSiteAlert
 *
 * @property AbstractUserSiteAlert $user_site_alert
 */
class UserSiteAlertHandler implements UpdateViews, EventClose, EventClick, Delete
{
    public $user_site_alert;

    /**
     * UserSiteAlertHandler constructor.
     * @param AbstractUserSiteAlert $userSiteAlert
     */
    public function __construct(AbstractUserSiteAlert $userSiteAlert)
    {
        $this->user_site_alert = $userSiteAlert;
        return $this;
    }

    /**
     * @return bool
     * @throws Throwable
     * @throws Exception
     */
    public function updateViews(): bool
    {
        return (new actions\UpdateViews($this->user_site_alert))->execute();
    }

    /**
     * @return bool
     * @throws Throwable
     * @throws Exception
     */
    public function eventClose(): bool
    {
        return (new actions\EventClose($this->user_site_alert))->execute();
    }

    /**
     * @return bool
     * @throws Throwable
     * @throws Exception
     */
    public function eventClick(): bool
    {
        return (new actions\EventClick($this->user_site_alert))->execute();
    }

    /**
     * @return bool
     * @throws Throwable
     * @throws Exception
     * @throws StaleObjectException
     */
    public function delete(): bool
    {
        return (new actions\Delete($this->user_site_alert))->execute();
    }
}
