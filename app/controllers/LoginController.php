<?php

class LoginController extends BaseController {

	private $ancientPage;
	private $ancientFrontController;
    protected $layout = 'layouts.auth';
	
	public function __construct ()
	{
		$this->ancientPage = new \bmgroup\CloudwalkersClient\Page ();
		
		$frontcontroller = new \Neuron\FrontController ();
		$frontcontroller->setInput (Request::segments ());
		$frontcontroller->setPage ($this->ancientPage);

		$frontcontroller->addController (new \bmgroup\Signin\FrontController ());
		$frontcontroller->addController (new \bmgroup\OAuth2\FrontController ());
		
		$this->ancientFrontController = $frontcontroller;
	}
	
	public function login ()
	{
		$response = $this->ancientFrontController->dispatch ($this->ancientPage);
		if ($response)
		{
			$response->output ();
		}

		exit;

//        $data = Input::all();
//
//        if(isset($data['email']) && isset($data['password'])){
//            $username = $data['email'];
//            $password = $data['password'];
//            // send request to engine via gearman
//            $output = App::make ('cwclient')->login ($username, $password);
//            // if ok redirect
//            if(isset($output['id'])){
//                return Redirect::to('http://devplatform.cloudwalkers.be');
//            } else {
//                return View::make('signin.login', $output);
//            }
//        } else {
//            return View::make('signin.login', $data);
//        }
	}

    public function logout ()
    {
        $response = $this->ancientFrontController->dispatch ($this->ancientPage);
        if ($response)
        {
            $response->output ();
        }

        exit;
    }

    public function recoverpassword ()
    {
	    $data = Input::all();

	    return View::make('signin.recover_password', $data);
    }
	
	public function register ()
	{
		$response = $this->ancientFrontController->dispatch ($this->ancientPage);

		if ($response)
		{
			$response->output ();
		}

		exit;

//        $data = Input::all();
//		$param = Request::segment(2);
//		$invitation = Request::segment(3);

//		return $param . ' - ' . $invitation; exit;
//
//        if( !empty($data) || isset($data['invitation'])){
//            // send request to engine via gearman
//            $output = App::make ('cwclient')->register ($data['email'], $data['password'], $data['firstname'], $data['name']);
//            // if ok redirect
//            if(isset($output['success'])){
//                return Redirect::to('http://devplatform.cloudwalkers.be/login.html');
//            } else {
//                return View::make('signin.register', $output);
//            }
//        } else {
//	        if($data['email']){
//                return View::make('signin.register', $data);
//	        } else {
//		        App::abort(403, 'Unauthorized action.');
//	        }
//        }

	}


}
