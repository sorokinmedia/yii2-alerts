<?php

namespace sorokinmedia\alerts\handlers\SiteAlertGroup\interfaces;

/**
 * Interface ActionExecutable
 * @package sorokinmedia\alerts\handlers\SiteAlertGroup\interfaces
 */
interface ActionExecutable
{
    /**
     * @return mixed
     */
    public function execute(): bool;
}
