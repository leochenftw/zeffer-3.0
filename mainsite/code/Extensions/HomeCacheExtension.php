<?php
use SaltedHerring\SaltedCache;
/**
 * Description
 *
 * @package silverstripe
 * @subpackage mysite
 */
class HomeCacheExtension extends DataExtension
{
    /**
     * Event handler called after writing to the database.
     */
    public function onAfterWrite()
    {
        parent::onAfterWrite();
        SaltedCache::delete('HomeData');
    }

    /**
     * Event handler called after deleting from the database.
     */
    public function onAfterDelete()
    {
        parent::onAfterDelete();
        SaltedCache::delete('HomeData');
    }
}
