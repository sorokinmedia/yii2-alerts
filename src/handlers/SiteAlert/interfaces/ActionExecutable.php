<?php

namespace sorokinmedia\alerts\handlers\SiteAlert\interfaces;

/**
 * Interface ActionExecutable
 * @package sorokinmedia\alerts\handlers\SiteAlert\interfaces
 */
interface ActionExecutable
{
    /**
     * @return mixed
     */
    public function execute(): bool;
}
