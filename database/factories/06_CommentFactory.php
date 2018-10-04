<?php

use Faker\Generator as Faker;
use Lava\Model\Comment;
use Lava\Model\Post;
use Lava\Model\User;

$factory->define(Comment::class, function( Faker $faker )
{
	$post = Post::all()->shuffle()->first();
	$user = User::where('role','user')->get()->shuffle()->first();
	return [
		'content' => $faker->paragraph(3, true),
		'post_id' => $post->id,
		'user_id'  => $user->id,
		'parent_id' => null,
	];
});
