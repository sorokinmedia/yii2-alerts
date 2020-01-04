<?php

namespace sorokinmedia\alerts\forms;

use sorokinmedia\alerts\entities\SiteAlertGroup\AbstractSiteAlertGroup;
use sorokinmedia\alerts\entities\SiteAlertGroup\SiteAlertGroupInterface;
use Yii;
use yii\base\Model;

/**
 * Class SiteAlertGroupForm
 * @package sorokinmedia\alerts\forms
 *
 * @property string $name
 * @property string $role
 * @property int $priority
 */
class SiteAlertGroupForm extends Model
{
    public $name;
    public $role;
    public $priority;

    /**
     * SiteAlertGroupForm constructor.
     * @param array $config
     * @param AbstractSiteAlertGroup|null $group
     */
    public function __construct(array $config = [], AbstractSiteAlertGroup $group = null)
    {
        if ($group !== null) {
            $this->name = $group->name;
            $this->role = $group->role;
            $this->priority = $group->priority;
        }
        parent::__construct($config);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['name', 'role', 'priority'], 'required'],
            [['name', 'role'], 'string', 'max' => 255],
            [['priority'], 'default', 'value' => 10]
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels(): array
    {
        return [
            'name' => Yii::t('app', 'Название'),
            'role' => Yii::t('app', 'Роль'),
            'priority' => Yii::t('app', 'Приоритет'),
        ];
    }
}
