<?php
//! Google reCAPTCHA implementation for F3
class ReCaptcha
{
    protected $f3;
    private $secret;

    /**
     *    Class constructor
     *    Defines ReCaptcha secret key required for API call
     */
    function __construct()
    {
        $f3 = Base::instance();
        $this->secret = $f3->get('ReCaptcha.secretkey');
    }

    /**
     * API call to verify the user’s reCAPTCHA response token
     * @param  $response string
     * @param  $remoteip string
     * @return array
     */
    function checkCaptcha($response, $remoteip=NULL)
    {
        $arg['secret'] = $this->secret;
        $arg['response'] = $response;
        if(isset($remoteip)){
            $arg['remoteip']=$remoteip;
        }

        $options = array(
            'method' => 'POST',
            'content' => http_build_query($arg),
        );

        $result = \Web::instance()->request('https://www.google.com/recaptcha/api/siteverify', $options);
        $gresponse=json_decode($result['body'], true);

        $apiresponse['success']=$gresponse['success'];
        $apiresponse['errorcode']=$gresponse['error-codes'];

        return $apiresponse;
    }

}