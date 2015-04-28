<?php

class GameController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/
	public function create_game()
	{
		$data = Input::all();
		$host_player_id = $data['host_player_id']; 
		$game_mode_id = $data['game_mode_id'];
		$map_id = $data['map_id'];

		
        $game = new Game;
        $game->host_player_id = $host_player_id;
        $game->game_mode_id = $game_mode_id;
        $game->map_id = $map_id;
        $game->is_active = 1;
        $game->save();

        $insertedId = $game->id;

	    return Response::json(array(
	        'game_id' => $insertedId),
	        200
	    );
	}

	public function join()
	{
		$data = Input::all();
		$client_player_id = $data['client_player_id']; 
		$game_id = $data['game_id'];
		$password = isset($data['password']) ? $data['password'] : NULL;

		
		$game = Game::find($game_id);

		$join_successful;
		if($game->client_player_id != null)
			$join_successful = false;

        $game->client_player_id = $client_player_id;
        $game->password = $password;
        $join_successful = $game->save();

        $insertedId = $game->id;

	    return Response::json(array(
	        'success' => $join_successful),
	        200
	    );
	}

	public function get_game() 
	{
		$data = Input::all();

		$game_id = $data['game_id'];

		$game = Game::find($game_id);

		return Response::json(array(
	        'game' => $game),
	        200
	    );
	}

	public function get_open_games()
	{
		$games = Game::where('is_active', '=', 1)
    					->where('client_player_id', '=', 0)->get();

    	$success = (count($games) != 0) ? true : false;

		return Response::json(array(
	        'success' => $success,
	        'games' => $games),
	        200
	    );
	}

	public function set_is_active() 
	{
		$data = Input::all();
		$is_active = $data['is_active']; 
		$game_id = $data['game_id'];

		$game = Game::find($game_id);

		$game->is_active = $is_active;
		$join_successful = $game->save();

		return Response::json(array(
	        'success' => $join_successful),
	        200
	    );
	}


	public function set_turn() {
		$data = Input::all();
		
		$turn_input = $data['turn'];
		
		$game_id = $turn_input['game_id'];
		$game = Game::find($game_id);
		

		$host_user_id = $game['host_player_id'];
		$client_user_id = $game['client_player_id'];

		$turn = new Turn;
		
        $turn->is_host_turn = $turn_input['is_host_turn'];
        $turn->turn_number = $turn_input['turn_number'];
        $turn->host_user_id = $host_user_id;
        $turn->client_user_id = $client_user_id;
        $turn->save();
        $turn_id = $turn->id;

        $host_user = $turn_input['host_user'];
        $client_user = $turn_input['client_user'];
        $host_units = $host_user['units'];
        $client_units = $client_user['units'];
        $host_hit_indicators = (isset($host_user['hit_indicators'])) ? $host_user['hit_indicators'] : null;
        $client_hit_indicators = (isset($client_user['hit_indicators'])) ? $client_user['hit_indicators'] : null;

        foreach( $host_units as $unit) {
        	$newunit = new Unit;
        	$newunit->row = $unit['row'];
        	$newunit->col = $unit['col'];
        	$newunit->hp = $unit['hp'];
        	$newunit->armor = $unit['armor'];
        	$newunit->is_dead = $unit['is_dead'];
        	$newunit->direction_facing = $unit['direction_facing'];
        	$newunit->name = $unit['name'];
        	$newunit->save();

        	$newunit_id = $newunit->id;

			$userunit = new UserUnit;
        	$userunit->user_id = $client_user_id;
        	$userunit->turn_id = $turn_id;
        	$userunit->unit_id = $newunit_id;
        	$userunit->save();
        }
        foreach( $client_units as $unit) {
        	$newunit = new Unit;
        	$newunit->row = $unit['row'];
        	$newunit->col = $unit['col'];
        	$newunit->hp = $unit['hp'];
        	$newunit->armor = $unit['armor'];
        	$newunit->is_dead = $unit['is_dead'];
        	$newunit->direction_facing = $unit['direction_facing'];
        	$newunit->name = $unit['name'];
        	$newunit->save();

        	$newunit_id = $newunit->id;

        	$userunit = new UserUnit;
        	$userunit->user_id = $client_user_id;
        	$userunit->turn_id = $turn_id;
        	$userunit->unit_id = $newunit_id;
        	$userunit->save();
        }

        if(isset($host_hit_indicators)){
	        foreach( $host_hit_indicators as $hit_indicator) {
	        	$newhitindicator = new HitIndicator;
	        	$newhitindicator->row = $hit_indicator['row'];
	        	$newhitindicator->col = $hit_indicator['col'];
	        	$newhitindicator->direction = $hit_indicator['direction'];
	        	$newhitindicator->save();

	        	$newhitindicator_id = $newhitindicator->id;

	        	$userhitindicator = new UserHitIndicator;
	        	$userhitindicator->user_id = $client_user_id;
	        	$userhitindicator->hit_indicator_id = $newhitindicator_id;
	        	$userhitindicator->turn_id = $turn_id;
	        }
    	}
    	if(isset($client_hit_indicators)){
			foreach( $client_hit_indicators as $hit_indicator) {
	        	$newhitindicator = new HitIndicator;
	        	$newhitindicator->row = $hit_indicator['row'];
	        	$newhitindicator->col = $hit_indicator['col'];
	        	$newhitindicator->direction = $hit_indicator['direction'];
	        	$newhitindicator->save();

	        	$newhitindicator_id = $newhitindicator->id;

	        	$userhitindicator = new UserHitIndicator;
	        	$userhitindicator->user_id = $client_user_id;
	        	$userhitindicator->hit_indicator_id = $newhitindicator_id;
	        	$userhitindicator->turn_id = $turn_id;
	        }
		}
		$game->turns()->attach($turn_id); //this executes the insert-query

	}

	public function get_turn() 
	{
		$data = Input::all();

		$game_id = $data['game_id'];

		$game = Game::find($game_id);

		$turn = $game->turns->first();

		$turn->load(["client_units" => function($query) use ($turn) {
			$query->wherePivot('user_id',$turn->client_user_id);
		}]);

		$turn->load(["host_units" => function($query) use ($turn) {
			$query->wherePivot('user_id',$turn->host_user_id);
		}]);

		$turn->load(["client_hit_indicators" => function($query) use ($turn) {
			$query->wherePivot('user_id',$turn->client_user_id);
		}]);

		$turn->load(["host_hit_indicators" => function($query) use ($turn) {
			$query->wherePivot('user_id',$turn->host_user_id);
		}]);

		return $turn;

		// $turn_id = $turn->id;
		// $host_user_id = $turn['host_user_id'];
		// $client_user_id = $turn['client_user_id'];


		// //get units 
		// $host_units = $turn->host_units;
		// $client_units = $turn->client_units;


		//get hit indicators

		/*$fake_data = array(
						"game_id" => "1",
						"turn_number" => "1",
						"host_user" => array(
												"units" => array(
																	array("row"=> "1", "col" => "1", "hp" => "100", "armor" => "100", "is_dead" => "0", "direction_facing" => "1", "name" => "AssaultAlpha"),
																	array("row"=> "1", "col" => "2", "hp" => "100", "armor" => "100", "is_dead" => "0", "direction_facing" => "1", "name" => "JuggernautAlpha"),
																	array("row"=> "1", "col" => "3", "hp" => "100", "armor" => "100", "is_dead" => "0", "direction_facing" => "1", "name" => "MedicAlpha")

																  ),
												"hit_indicators" => array(
																			array("row"=> "1", "col" => "3", "direction" => "1"),
																			array("row"=> "1", "col" => "2", "direction" => "1")
																	)
										      ),
						"client_user" => array(
												"units" => array(
																	array("row"=> "5", "col" => "1", "hp" => "100", "armor" => "100", "is_dead" => "0", "direction_facing" => "1", "name" => "AssaultAlpha"),
																	array("row"=> "6", "col" => "2", "hp" => "100", "armor" => "100", "is_dead" => "0", "direction_facing" => "1", "name" => "JuggernautAlpha"),
																	array("row"=> "7", "col" => "3", "hp" => "100", "armor" => "100", "is_dead" => "0", "direction_facing" => "1", "name" => "MedicAlpha")

																  ),
												"hit_indicators" => array(
																			array("row"=> "5", "col" => "3", "direction" => "1"),
																			array("row"=> "6", "col" => "2", "direction" => "1")
																	)
										      )
						);*/

		return Response::json(array(
	        'turn' => $turn),
	        200
	    );
	}

	    public function get_turn_fake() {
	    	$fake_data = array(
						"game_id" => "1",
						"turn_number" => "1",
						"host_user" => array(
												"units" => array(
																	array("row"=> "1", "col" => "1", "hp" => "100", "armor" => "100", "is_dead" => "0", "direction_facing" => "1", "name" => "AssaultAlpha"),
																	array("row"=> "1", "col" => "2", "hp" => "100", "armor" => "100", "is_dead" => "0", "direction_facing" => "1", "name" => "JuggernautAlpha"),
																	array("row"=> "1", "col" => "3", "hp" => "100", "armor" => "100", "is_dead" => "0", "direction_facing" => "1", "name" => "MedicAlpha")

																  ),
												"hit_indicators" => array(
																			array("row"=> "1", "col" => "3", "direction" => "1"),
																			array("row"=> "1", "col" => "2", "direction" => "1")
																	)
										      ),
						"client_user" => array(
												"units" => array(
																	array("row"=> "5", "col" => "1", "hp" => "100", "armor" => "100", "is_dead" => "0", "direction_facing" => "1", "name" => "AssaultAlpha"),
																	array("row"=> "6", "col" => "2", "hp" => "100", "armor" => "100", "is_dead" => "0", "direction_facing" => "1", "name" => "JuggernautAlpha"),
																	array("row"=> "7", "col" => "3", "hp" => "100", "armor" => "100", "is_dead" => "0", "direction_facing" => "1", "name" => "MedicAlpha")

																  ),
												"hit_indicators" => array(
																			array("row"=> "5", "col" => "3", "direction" => "1"),
																			array("row"=> "6", "col" => "2", "direction" => "1")
																	)
										      )
						);
		return Response::json(array(
			        'turn' => $fake_data),
			        200
	    );
	}

}
