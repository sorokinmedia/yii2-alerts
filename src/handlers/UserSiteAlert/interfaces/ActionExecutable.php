<?php
namespace sorokinmedia\alerts\handlers\UserSiteAlert\interfaces;

/**
 * Interface ActionExecutable
 * @package sorokinmedia\alerts\handlers\UserSiteAlert\interfaces
 */
interface ActionExecutable
{
    /**
     * @return mixed
     */
    public function execute() : bool;
}