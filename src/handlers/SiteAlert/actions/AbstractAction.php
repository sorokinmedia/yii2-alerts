<?php

namespace sorokinmedia\alerts\handlers\SiteAlert\actions;

use sorokinmedia\alerts\entities\SiteAlert\AbstractSiteAlert;
use sorokinmedia\alerts\handlers\SiteAlert\interfaces\ActionExecutable;

/**
 * Class AbstractAction
 * @package sorokinmedia\alerts\handlers\SiteAlert\actions
 *
 * @property AbstractSiteAlert $site_alert
 */
abstract class AbstractAction implements ActionExecutable
{
    protected $site_alert;

    /**
     * AbstractAction constructor.
     * @param AbstractSiteAlert $siteAlert
     */
    public function __construct(AbstractSiteAlert $siteAlert)
    {
        $this->site_alert = $siteAlert;
        return $this;
    }
}
