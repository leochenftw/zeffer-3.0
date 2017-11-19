<?php use SaltedHerring\Debugger as Debugger;
/**
 *
 * */
class SigninForm extends MemberLoginForm {

	public function __construct($controller, $name) {
		parent::__construct($controller, $name);

		$fields = parent::Fields();
        $actions = parent::Actions();
        if ($btnSignin = $actions->fieldByName('action_dologin')) {
            $btnSignin->setTitle('Sign in');
        }

		$this->setFormMethod('POST',true);
		$this->setFormAction(Controller::join_links(BASE_URL, "signin", "SigninForm"));
	}

	private static $allowed_actions = array(
		'dologin'
	);

	public function dologin($data) {
        Session::clear('Message');
        /* uncomment below to disallow not-validated users to login */
        $email = $data['Email'];
        if ($member = Member::get()->filter('Email', $email)->first()) {
            if (!empty($member->ValidationKey) && !$member->inGroup('administrators')) {
                $this->sessionMessage('You need to activate your account first.', 'notification is-warning');
                return $this->controller->redirectBack();
            }
        }

         if($this->performLogin($data)) {
             $this->logInUserAndRedirect($data);
         } else {
             if(array_key_exists('Email', $data)){
                 Session::set('SessionForms.MemberLoginForm.Email', $data['Email']);
                 Session::set('SessionForms.MemberLoginForm.Remember', isset($data['Remember']));
             }

			 $this->sessionMessage('Sign in failed. Incorrect email or password. If you forgot your credential, you may <a style="color: white; border-bottom: 1px solid rgba(255,255,255,0.6)" href="/Security/lostpassword">reset your password</a>.', 'notification is-danger', false);

             if(isset($_REQUEST['BackURL'])) $backURL = $_REQUEST['BackURL'];
             else $backURL = null;

             if($backURL) Session::set('BackURL', $backURL);

             // Show the right tab on failed login
             $loginLink = Director::absoluteURL('/signin');
             if($backURL) $loginLink .= '?BackURL=' . urlencode($backURL);
             $this->controller->redirect($loginLink);
         }
	}
}
