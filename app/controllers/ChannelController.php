<?php

class ChannelController extends BaseController {

    /**
     *	Channels Controller
     *	The channels controller uses the Laravel RESTful Resource Controller method.
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

    /**
     *	Validation Rules
     *	Based on Laravel Validation
     */
    protected static $getRules = array
    (
        'id'=> 'integer',
        'ids'=> '',
        'type'=> '',
        'display'=> ''
    );

    protected static $postRules = array
    (
        'name'=> 'required|min:2',
        'settings'=> 'required'
    );

    protected static $updateRules = array
    (
        'id'=> 'required|integer',
        'name'=> 'required|min:2',
        'settings'=> 'required'
    );


    /**
     *	RESTful actions
     */

	/**
	 * Display a listing of the resource.
	 *
     * @param null $id
     * @return Job
     * @throws InvalidParameterException
     * @throws WorkerException
     */
	public function index ($id = null)
	{
        $input = null;
        $rules = null;


        if (!$id && !Input::get('ids') && Request::segment(2) != 'channelids')

            throw new InvalidParameterException ('A parent ID or ids list should be provided.');

        if ($id)
        {
            // case of requesting child channels of a parent channel
            $input['type'] = (Request::segment(2) == 'channels')? 'channel' : 'account' ;

            $input['id'] = $id;
        }

        if (Request::segment(2) == 'channelids') $input['display'] = 'id';

        $input['type'] = (Request::segment(2) == 'accounts')? 'account' : 'channel';

        // Request Foreground Job
        $response = self::restDispatch ('index', 'ChannelController', $input, self::$getRules);

        return $response;
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store ($id)
	{
        // Validation parameters
        $input = array ('id' => $id);

        Input::merge((array)json_decode(Input::getContent()));

        // Request Foreground Job
        $response = self::restDispatch ('store', 'ChannelController', $input, self::$postRules);

        return $response;
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show ($id)
	{
        // Validation parameters
        $input = array ('id' => $id);


        // Request Foreground Job
        $response = self::restDispatch ('show', 'ChannelController', $input, self::$getRules);

        return $response;
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update ($id)
	{
        // Validation parameters
        $input = array ('id' => $id);

        Input::merge((array)json_decode(Input::getContent()));

        // Request Foreground Job
        $response = self::restDispatch ('update', 'ChannelController', $input, self::$updateRules);

        return $response;
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy ($id)
	{
        // Validation parameters
        $input = array ('id'=> $id);

        // Request Foreground Job
        $response = self::restDispatch ('destroy', 'ChannelController', $input, self::$getRules);

        return $response;
	}

    /**
     * Get ids of the account channels
     */
    public function channelids ()
    {
        # STANDBY: not making sense
        # how can we relate to account
    }


}
