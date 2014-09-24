<?php

class CommunicationController extends BaseController {
	
	public function __construct ()
	{

	}

	public function login ()
	{
        $data = Input::all();

        if(isset($data['email']) && isset($data['password'])){
            $username = $data['email'];
            $password = $data['password'];
            // send request to engine via gearman
            $output = App::make ('cwclient')->login ($username, $password);
            // if ok redirect
            if(isset($output['id'])){
                dd($output);
                return Redirect::to('http://devplatform.cloudwalkers.be');
            } else {
                return View::make('signin.login', $output);
            }
        } else {
            return View::make('signin.login', $data);
        }

	}

	public function logout ()
	{
        // method not defined in CwGearmanClient
        $data = array();
        // send request to engine via gearman
        $output = App::make ('cwclient')->logout ();
        return View::make('signin.logout', $output);
	}

	public function register ()
	{
        $data = Input::all();

        if( !empty($data) ){
            // send request to engine via gearman
            $output = App::make ('cwclient')->register ($data['email'], $data['password'], $data['firstname'], $data['name']);
            // if ok redirect
            if(isset($output['success'])){
                return Redirect::to('login');
            } else {
                return View::make('signin.register', $output);
            }
        } else {
            return View::make('signin.register', $data);
        }
	}

	public function lostPassword ()
	{
        $data = array();
		return View::make('signin.lost_password', $data);
	}

	public function email ()
	{
        $data = array();
        Mail::send('emails.welcome', $data, function($message)
        {
            $message->to('pedrodee@gmail.com', 'John Smith')->subject('Welcome!');
        });

		return 'email sent!';
	}

	public function sms ()
	{
        $data = array();
        $message = new Clickatell;

        $status = $message->to(32476858168)
            ->message('CW is watching you!')
            ->send();

		return print_r($status, true);
	}

}
