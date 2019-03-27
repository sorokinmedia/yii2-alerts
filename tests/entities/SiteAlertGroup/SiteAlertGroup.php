<?php
namespace sorokinmedia\alerts\tests\entities\SiteAlertGroup;

use sorokinmedia\alerts\entities\SiteAlertGroup\AbstractSiteAlertGroup;
use sorokinmedia\alerts\tests\entities\RelationClassTrait;
use yii\rbac\Role;

/**
 * Class SiteAlertGroup
 * @package sorokinmedia\alerts\tests\entities\SiteAlertGroup
 */
class SiteAlertGroup extends AbstractSiteAlertGroup
{
    use RelationClassTrait;

    /**
     * @return array
     */
    public static function getRoles(): array
    {
        return [
            new Role([
                'name' => 'roleUser',
                'type' => 1,
                'description' => 'Пользователь',
            ])
        ];
    }
}