<?php

namespace sorokinmedia\alerts\handlers\SiteAlertGroup\actions;

use sorokinmedia\alerts\entities\SiteAlertGroup\AbstractSiteAlertGroup;
use sorokinmedia\alerts\handlers\SiteAlertGroup\interfaces\ActionExecutable;

/**
 * Class AbstractAction
 * @package sorokinmedia\alerts\handlers\SiteAlertGroup\actions
 *
 * @property AbstractSiteAlertGroup $site_alert_group
 */
abstract class AbstractAction implements ActionExecutable
{
    protected $site_alert_group;

    /**
     * AbstractAction constructor.
     * @param AbstractSiteAlertGroup $siteAlertGroup
     */
    public function __construct(AbstractSiteAlertGroup $siteAlertGroup)
    {
        $this->site_alert_group = $siteAlertGroup;
        return $this;
    }
}
