<?php
use SaltedHerring\Grid;
/**
 * Description
 *
 * @package silverstripe
 * @subpackage mysite
 */
class People extends Page
{
    /**
     * Defines the allowed child page types
     * @var array
     */
    private static $allowed_children = [];

    /**
     * Creating Permissions
     * @return boolean
     */
    public function canCreate($member = null)
    {
        return Versioned::get_by_stage($this->ClassName, 'Stage')->count() == 0;
    }

    /**
     * Has_many relationship
     * @var array
     */
    private static $has_many = [
        'Team'          =>  'Person'
    ];

    /**
     * CMS Fields
     * @return FieldList
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->addFieldToTab(
            'Root.TeamMembers',
            Grid::make('Team', 'Team members', $this->Team())
        );
        $this->extend('updateCMSFields', $fields);
        return $fields;
    }

    public function getSectionTitle()
    {
        if ($this->Team()->exists()) {

            if (Session::get('lang') == 'zh_Hans') {
                return '团队成员';
            }

            $title              =   'Meet ';
            $team_array         =   $this->Team()->column('Title');
            $team               =   '';

            for ($i = 0; $i < count($team_array); $i++)
            {
                $team           .=  $team_array[$i];
                if ($i < count($team_array) - 2) {
                    $team       .=  ', ';
                } elseif ($i == count($team_array) - 2) {
                    $team       .=  ' & ';
                }
            }

            return $title . $team;
        }

        return parent::getSectionTitle();
    }

    public function getData()
    {
        $data                   =   [
                                        'id'        =>  $this->ID,
                                        'title'     =>  $this->getSectionTitle(),
                                        'content'   =>  $this->Content,
                                        'hero'      =>  $this->ImageBreak()->exists() ? $this->ImageBreak()->SetWidth(1980)->URL : null,
                                        'members'   =>  $this->Team()->exists() ? $this->Team()->getData() : null
                                    ];
        return $data;
    }
}

class People_Controller extends Page_Controller
{
    public function init()
    {
        parent::init();
    }
}
