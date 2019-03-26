<?php
namespace sorokinmedia\alerts\handlers\SiteAlert\actions;

use sorokinmedia\alerts\handlers\SiteAlert\interfaces\ActionExecutable;
use sorokinmedia\alerts\entities\SiteAlert\AbstractSiteAlert;

/**
 * Class AbstractAction
 * @package sorokinmedia\alerts\handlers\SiteAlert\actions
 *
 *  @property AbstractSiteAlert $site_alert
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