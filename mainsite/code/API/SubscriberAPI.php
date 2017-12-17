<?php
use Ntb\RestAPI\BaseRestController;
use SaltedHerring\Debugger;
use GuzzleHttp\Client;
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
            return $csrf        ==  Session::get('SecurityID');
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
            if ($this->NotifyCampaignMonitor($subscription)) {
                Session::set('Subscribed', 1);
                return  [
                            'code'      =>  200,
                            'message'   =>  'Congratulation! you have successfully subscribed to our newsletter!'
                        ];
            }

            return $this->httpError(400, 'Sorry we couldn\'t add you to our newsletter this at this time, but we have had your name and email address saved in our database.');

        }

        return $this->httpError(500, 'internal server error');
    }

    private function NotifyCampaignMonitor(&$subscriber)
    {
        $client                 =   new Client(['base_uri' => 'https://api.createsend.com/api/v3.1/']);

        // list id ?? - Zeffer's (api: ??)
        // a19bb6f016d0b335942b39824d2168fd - the test account (api: 5e20a90c8dea174856b60952e4fbc273)
        $list_id                =   'a19bb6f016d0b335942b39824d2168fd';

        $signup_data            =   [
                                        'auth'  =>  [
                                                        '5e20a90c8dea174856b60952e4fbc273',
                                                        null
                                                    ],
                                        'json'  =>  [

                                                        'EmailAddress'                              =>  $subscriber->Email,
                                                        'Name'                                      =>  $subscriber->FirstName . ' ' . $subscriber->LastName,
                                                        'CustomFields'                              =>  [],
                                                        'Resubscribe'                               =>  true,
                                                        'RestartSubscriptionBasedAutoresponders'    =>  true
                                                    ]
                                    ];

        try {
            $response           =   $client->request('POST', 'subscribers/' . $list_id . '.json', $signup_data);
            return json_decode($response->getBody());
        } catch (Exception $e) {
            
        }

        return false;
    }
}
