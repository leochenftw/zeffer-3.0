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
            return  $this->httpError(500, Session::get('lang') == 'zh_Hans' ? '您已经订阅过啦!' : 'You\'ve signed up already.');
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
                            'message'   =>  Session::get('lang') == 'zh_Hans' ? '谢谢您的订阅! 您已经成功加入我们的订阅列表!' : 'Congratulation! you have successfully subscribed to our newsletter!'
                        ];
            }

            return $this->httpError(400, Session::get('lang') == 'zh_Hans' ? '抱歉, 我们未能将您录入我们的订阅列表, 但您的订阅申请已经被存入我们的服务器.' : 'Sorry we couldn\'t add you to our newsletter this at this time, but we have had your name and email address saved in our database.');

        }

        return $this->httpError(500, Session::get('lang') == 'zh_Hans' ? '服务器出错啦!' : 'internal server error');
    }

    private function NotifyCampaignMonitor(&$subscriber)
    {
        $client                 =   new Client(['base_uri' => 'https://api.createsend.com/api/v3.1/']);

        // fc34006c665ef47033fdcb1fa01a07d1 - Zeffer's (api: cd9f8ba8cf21150bb852a5e5e2fd8efeb740924a44843e07)
        // a19bb6f016d0b335942b39824d2168fd - the test account (api: 5e20a90c8dea174856b60952e4fbc273)
        $list_id                =   'fc34006c665ef47033fdcb1fa01a07d1';

        $signup_data            =   [
                                        'auth'  =>  [
                                                        'cd9f8ba8cf21150bb852a5e5e2fd8efeb740924a44843e07',
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
