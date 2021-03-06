<?php

/**
 *	Accounts Controller
 *	The accounts controller uses the Laravel RESTful Resource Controller method.
 *
 *	[http://laravel.com/docs/4.2/controllers#restful-resource-controllers]
 *
 *	Following routes are supported
 *	GET			/resource				index		resource.index
 *	POST		/resource				store		resource.store
 *	GET			/resource/{resource}	show		resource.show
 *	PUT/PATCH	/resource/{resource}	update		resource.update
 *	DELETE		/resource/{resource}	destroy		resource.destroy
 */
class AccountController extends BaseController {

	/**
	 *	Validation Rules
	 *	Based on Laravel Validation
	 */
	protected static $getRules = array
	(
		'id'=> 'required|integer',
		'type'=> ''
	);
	
	protected static $updateRules = array
	(
		'id'=> 'required|integer',
        'name'=> 'required',
        'planid'=> ''
	);

	protected static $postRules = array
	(	
		'resellerid'=> 'required|integer',
		'name'=> 'required|min:2',
		'planid'=> 'required'
	);
	
	
	/**
	 *	RESTful actions
	 */
	 
	/**
	 *	Get Accounts
	 *
	 *	@return array
	 */
	public function index ($id=null)
	{
		$rules = null;
		$input = null;
		
		if ($id) {
			# /1.1/users/id/accounts GET
			# /1.1/resellers/id/accounts GET
			$input = array('id'=> $id, 'type' => Request::segment(2));
			$rules = self::$getRules;
		}
		
		// Request Foreground Job
		$response = self::restDispatch ('index', 'AccountController', $input, $rules);
		
		return $response;
		
		// Return schema based response
		// return SchemaValidator::validate ($response, 'account')->intersect;
	}
	
	/**
	 *	Post Account
	 *
	 *	@return object
	 */
	public function store ($resellerid = null)
	{
		// Validation parameters
		$input = $resellerid?

			array ('resellerid'=> $resellerid) :
			array ();

        Input::merge((array)json_decode(Input::getContent()));

		// Request Foreground Job
		$response = self::restDispatch ('store', 'AccountController', $input, self::$postRules);
			
		return $response;
		
		// Return schema based response
		// return SchemaValidator::validate ($response, 'account')->intersect;
	}	
	
	/**
	 *	Get Account
	 *
	 *	@return object
	 */
	public function show ($id)
	{
		// Validation parameters
		$input = array ('id'=> $id);

		// Request Foreground Job
		$response = self::restDispatch ('show', 'AccountController', $input, self::$getRules);
			
		return $response;
		
		// Return schema based response
		// return SchemaValidator::validate ($response, 'account')->intersect;
	}
	
	/**
	 *	Update Account
	 *
	 *	@return object
	 */
	public function update ($id)
	{
		// Validation parameters
        $input = array ('id'=> $id);

        Input::merge((array)json_decode(Input::getContent()));

		// Request Foreground Job
		$response = self::restDispatch ('update', 'AccountController', $input, self::$updateRules);
		
		return $response;
		
		// Return schema based response
		// return SchemaValidator::validate ($response, 'account')->intersect;
	}
	
	/**
	 *	Delete Accounts
	 *
	 *	@return boolean
	 */
	public function destroy ($id)
	{
		// Validation parameters
		$input = array ('id'=> $id);
	
		// Request Foreground Job
		$response = self::restDispatch ('destroy', 'AccountController', $input, self::$getRules);
		
		return $response;
	}

}
