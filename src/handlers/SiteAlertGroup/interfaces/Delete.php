<?php
namespace sorokinmedia\alerts\handlers\SiteAlertGroup\interfaces;

/**
 * Interface Delete
 * @package sorokinmedia\alerts\handlers\SiteAlertGroup\interfaces
 */
interface Delete
{
    /**
     * @return bool
     */
    public function delete() : bool;
}