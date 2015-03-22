<?php

class UserController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $users = User::all();

        return View::make('users.index')
            ->with('users', $users);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		// load the create form (app/views/users/create.blade.php)
        return View::make('users.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		// validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'name'       => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('users/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $user = new User;
            $user->name       = Input::get('name');
            $user->save();

            $insertedId = $user->id;

		    return Response::json(array(
		        'user_id' => $insertedId),
		        200
		    );

        }
	}


	public function create_user()
	{
		$data = Input::all();
		$name = $data['name']; 

		/*$rules = array(
            'name'       => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('users/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {*/
            // store
        $user = new User;
        $user->name       = $name;
        $user->save();

        $insertedId = $user->id;

	    return Response::json(array(
	        'user_id' => $insertedId),
	        200
	    );
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		// get the nerd
        $user = User::where('user_id', $id)->first();

        // show the view and pass the nerd to it
        //return View::make('users.show')->with('user', $user);
	  
	    return Response::json(array(
	        'error' => false,
	        'user' => $user),
	        200
	    );
	    
	}

	public function get_is_valid_user_by_id($id)
	{
		// get the nerd
        $user = User::where('user_id', $id)->first();

        // show the view and pass the nerd to it
        //return View::make('users.show')->with('user', $user);
	  	$is_valid = ($user != null) ? true : false;
	    return Response::json(array(
	        'is_valid' => $is_valid),
	        200
	    );
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
