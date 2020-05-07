<?php
return [
	'/api/user/get/:num' => ['App\Controller\Api\UserController/getUser/$1', ['GET']],
	'/api/users/get' => ['App\Controller\Api\UserController/getUsers', ['GET']],
	'/api/user/edit/:num' => ['App\Controller\Api\UserController/editUser/$1', ['PATCH', 'PUT']],
	'/api/user/create' => ['App\Controller\Api\UserController/createUser', ['POST']],
	'/api/user/delete/:num' => ['App\Controller\Api\UserController/deleteUser/$1', ['DELETE']],

	'/auth/check' => ['App\Controller\Authorization/checkAuthorization', ['GET']],
	'/auth/login' => ['App\Controller\Authorization/login', ['POST']],
	'/auth/logout' => ['App\Controller\Authorization/logout', ['POST']],
	
	'/' => ['App\Controller\Web\WebController/index', ['GET']],
];