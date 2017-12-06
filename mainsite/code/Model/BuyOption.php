<?php

/**
 * Description
 *
 * @package silverstripe
 * @subpackage mysite
 */
class BuyOption extends Link
{
    /**
     * Has_one relationship
     * @var array
     */
    private static $has_one = [
        'OptionLogo'            =>  'Image',
        'Page'                  =>  'BuynowPage'
    ];

    /**
     * Defines extension names and parameters to be applied
     * to this object upon construction.
     * @var array
     */
    private static $extensions = [
        'SortOrderExtension'
    ];

    public function getData()
    {
        $data                   =   parent::getData();
        $data['image']          =   !empty($this->OptionLogoID) ? $this->OptionLogo()->SetHeight(96)->URL : null;
        return $data;
    }

}
