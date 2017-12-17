<?php
use SaltedHerring\Debugger;
use SaltedHerring\RPC;
use GuzzleHttp\Client;

/**
 * Description
 *
 * @package silverstripe
 * @subpackage mysite
 */
class AwardImporter extends BuildTask
{
    /**
     * @var bool $enabled If set to FALSE, keep it from showing in the list
     * and from being executable through URL or CLI.
     */
    protected $enabled = true;

    /**
     * @var string $title Shown in the overview on the TaskRunner
     * HTML or CLI interface. Should be short and concise, no HTML allowed.
     */
    protected $title = 'Awards Importer';

    /**
     * @var string $description Describe the implications the task has,
     * and the changes it makes. Accepts HTML formatting.
     */
    protected $description = '';

    /**
     * This method called via the TaskRunner
     *
     * @param SS_HTTPRequest $request
     */
    public function run($request)
    {
        if ($request->getHeader('User-Agent') != 'CLI') {
            print '<span style="color: red; font-weight: bold; font-size: 24px;">This task is for CLI use only</span><br />';
            print '<em style="font-size: 14px;"><strong>Usage</strong>: sake dev/tasks/' . get_class($this) . ' {path_to_txt_file} {en_NZ | zh_Hans}</em>';
            return false;
        }

        if (!empty($request->getVar('args'))) {
            $args               =   $request->getVar('args');

            if (count($args) < 2) {
                print 'missing arguments';
                print PHP_EOL;
                print 'Usage: sake dev/tasks/' . get_class($this) . ' {path_to_txt_file} {en_NZ | zh_Hans}';
                print PHP_EOL;
                print PHP_EOL;

                return false;
            }

            $txt_file                       =   $args[0];
            $locale                         =   $args[1];
            $fstream                        =   fopen($txt_file, 'r') or die('Unable to open file');
            $txt                            =   fread($fstream, filesize($txt_file));
            $n                              =   0;

            fclose($fstream);

            if ($awards_page                =   Awards::get()->filter(['Locale' => $locale])->first()) {

                $existing_awards                =   $awards_page->Awards();

                foreach ($existing_awards as $existing)
                {
                    $existing->delete();
                }

                $award_row                      =   explode("\n", trim($txt));

                foreach ($award_row as $award_columns)
                {
                    $award_data                 =   explode(',', $award_columns);
                    $award                      =   new Award();
                    $award->Year                =   $award_data[0];
                    $award->AwardClass          =   $award_data[1];
                    $award->Competition         =   $award_data[2];
                    $award->Cider               =   $award_data[3];
                    $award->PageID              =   $awards_page->ID;
                    $award->write();
                    $n++;
                }


                print 'Done. ' . $n . ' award(s) added.';
                print PHP_EOL;
                print PHP_EOL;
                return true;
            }

            die('Can\'t find the awards page');
        }

        print 'txt URL is not given!';
        print PHP_EOL;
        print 'Usage: sake dev/tasks/' . get_class($this) . ' {path_to_txt_file} {en_NZ | zh_Hans}';
        print PHP_EOL;
        print PHP_EOL;
    }
}
