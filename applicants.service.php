<?php
//this file  mocks an applicanst service that is responsible for all methods relating to 
//fetching, filtering, and modifying applicants;

//this is a safety feature.  ABS_PATH is defined in the index.php file.  Once defined a global
//is available everywhere.  If someone gets to this file without having ABS_PATH set, it means
//they tried to access it directly.  Which is a no no.
if(!defined('ABS_PATH')){die;}

require_once('./db.service.php');

function get_users_from_database():array{
	//simply returns an unfiltered list of users from applicants.json
	return get_users();
}

function get_users_by_level(string $level):array{
	$users = get_users_from_database();
	return array_filter($users, function($user)use($level){
		return $user['level'] === $level;
	});
	
}

function get_users_by_experience(int $experienceNeeded):array{
	$users = get_users_from_database();
	return array_filter($users, function($user)use($experienceNeeded){
		return $user['experience'] >= $experienceNeeded;
	});
}

function get_users_by_skills(array $skills):array{
	$users = get_users_from_database();
	$result = [];
		foreach($users as $user){
			for ($i = 0; $i < count($skills); $i++)
			{
				if(in_array($skills[$i],$user['skills']))
				{
					if(!in_array($user,$result))
					{
						$result[] = $user;
						echo "k";
					}
				}
			}
	};
	return $result;
}
function get_selected_users(string $level, int $experience, array $skills):array{
	$users = get_users_from_database();
	return array_filter($users, fn($user)=> $user["level"] == $level 
	&& $user["experience"] == $experience 
	&& count(array_intersect($user['skills'], $skills)) > 0);
}
// function userLevelCallback($user):bool{
// 	return $user['level'] === 'entry';
// }