<?php

class UserController extends BaseController {

    /**
     *	Validation Rules
     *	Based on Laravel Validation
     */
    protected static $getRules = array
    (
        'id'    => 'required|integer'
    );
    protected static $storeRules = array
    (
        'email' => 'required|email',
        'id'    => 'required|integer',
        'url'   => 'required|url'
    );


	/**
	 * Invite to account
	 *
     * @param   integer $id
	 * @return  Response
	 */
	public function store($id)
	{
        $url = URL::to('invitation');

        // Validation parameters
        $input = array ('id' => $id, 'url' => $url);

        Input::merge((array)json_decode(Input::getContent()));

        // Request Foreground Job
        $response = self::restDispatch ('invite', 'AccountController', $input, self::$storeRules);

        return $response;

    }

	/**
	 * User accounts
	 *
     * @param   integer $id
	 * @return  Response
	 */
	public function accounts($id)
	{
        // Validation parameters
        $input = array ('id' => $id);

        // Request Foreground Job
        $response = self::restDispatch ('accounts', 'UserController', $input, self::$getRules);

        return $response;

    }



}
