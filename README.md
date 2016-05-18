## F3-reCAPTCHA
F3-reCAPTCHA is a Fat Free Framework plugin that helps quickly implement the latest version of Google reCAPTCHA.

![](https://developers.google.com/recaptcha/images/newCaptchaAnchor.gif)

### Config
Add the following custom section to your project config.

```
[ReCaptcha]
secretkey=your_secret_key
```

- `secretkey` - The shared key between your site and reCAPTCHA.

Your keys are available under your site properties in the reCAPTCHA admin area. See the reCAPTCHA [Getting Started Guide](https://developers.google.com/recaptcha/docs/start) for more info.

Add the javascript library to your templates <HEAD> section and include the `g-recaptcha` DIV element in your form. Please refer to the [Displaying the widget](https://developers.google.com/recaptcha/docs/display) documentation for further information.

Add the `ReCaptcha.php` file to your lib.

### Usage
After setting up your widget as described on the reCAPTCHA website an additional field is added to your form POST called g-recaptcha-response. To check that the reCAPTCHA status we simply instantiate the class and pass the g-recaptcha-response as an argument to the `checkCaptcha()` method which will return the result as an array. See the [reCAPTCHA API Response & Error code reference](https://developers.google.com/recaptcha/docs/verify#api-response) for futher details. 

```php
// $remoteip is an optional argument
checkCaptcha($g-recaptcha-response, $remoteip)
```

### Example
```php
//Instantiate the Class
$captcha=new ReCaptcha;

// Get reCAPTCHA result from form
$response=$f3->get('POST.g-recaptcha-response');

// Check reCAPTCHA response against API
$botcheck=$captcha->checkCaptcha($response);

if ($botcheck['success']==1) {
	// Captcha passed - process form as normal
} else {
	// Captcha failed - handle as required
	// Retrieve error code from the array() eg. $botcheck['errorcode'][0];
}
```
