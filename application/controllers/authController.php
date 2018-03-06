<?php 

class authController extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	function showFormLogin() {
		$fb = load_facebook_jdk();
		$helper = $fb->getRedirectLoginHelper();
		$permissions = ['email', 'user_likes'];
		$redirect_url = 'http://folder.info/CI_vote_fb/login/fb';
		$login_url = $helper->getLoginUrl($redirect_url, $permissions);
		$this->load->view('login',['url_login_fb'=> $login_url]);
	}

	function handleLoginFb() {
		$fb = load_facebook_jdk();
		$helper = $fb->getRedirectLoginHelper();

		try {
  			$accessToken = $helper->getAccessToken();
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
		  	// When Graph returns an error
		  	// echo 'Graph returned an error: ' . $e->getMessage();
			redirect(base_url().'/login');
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
		  // When validation fails or other local issues
		  // echo 'Facebook SDK returned an error: ' . $e->getMessage();
			redirect(base_url().'/login');
		}

		if (!isset($accessToken)) {
		  	if ($helper->getError()) {
		    	// header('HTTP/1.0 401 Unauthorized');
			    // echo "Error: " . $helper->getError() . "\n";
			    // echo "Error Code: " . $helper->getErrorCode() . "\n";
			    // echo "Error Reason: " . $helper->getErrorReason() . "\n";
			    // echo "Error Description: " . $helper->getErrorDescription() . "\n";
			    redirect(base_url().'/login');
		 	} else {
		   		header('HTTP/1.0 400 Bad Request');
		 	}
		 	exit;
		}

		// The OAuth 2.0 client handler helps us manage access tokens
		$oAuth2Client = $fb->getOAuth2Client();

		// Get the access token metadata from /debug_token
		$tokenMetadata = $oAuth2Client->debugToken($accessToken);

		// Validation (these will throw FacebookSDKException's when they fail)
		$tokenMetadata->validateAppId($this->config->item('app_id')); // Replace {app-id} with your app id
		$tokenMetadata->validateExpiration();
		print_r($accessToken->isLongLived());exit;
		if(!$accessToken->isLongLived()) {
		  	try {
			    $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
			} catch (Facebook\Exceptions\FacebookSDKException $e) {
			    // echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
			    redirect(base_url().'/login');
			}
		}
		$_SESSION['fb_access_token'] = (string) $accessToken;
	}

	function showFormRegistration() {
		$this->load->view('registration');
	}
}