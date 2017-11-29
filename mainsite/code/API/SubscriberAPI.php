<?php
use Ntb\RestAPI\BaseRestController as BaseRestController;
use SaltedHerring\Debugger as Debugger;
/**
 * @file SiteAppController.php
 *
 * Controller to present the data from forms.
 * */
class SubscriberAPI extends BaseRestController
{

    private static $allowed_actions = [
        'get'                   =>  false,
        'post'                  =>  "->isAuthenticated"
    ];

    public function isAuthenticated()
    {
        if ($csrf               =   $this->request->postVar('csrf')) {
            return $csrf        == Session::get('SecurityID');
        }

        return false;
    }

    public function post($request)
    {
        $data                   =   $request->postVars();

        if ($test               =   Subscriber::get()->filter(['Email' => $data['Email']])->first()) {
            return  $this->httpError(500, 'You\'ve signed up already.');
        }

        $subscription           =   new Subscriber();
        foreach ($data as $key => $value)
        {
            $subscription->$key =   $value;
        }

        if ($subscription->write()) {
            Session::set('Subscribed', 1);
            return  [
                        'code'      =>  200,
                        'message'   =>  'Congratulation! you have successfully subscribed to our newsletter!'
                    ];
        }

        return $this->httpError(500, 'internal server error');
    }
}
