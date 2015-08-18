<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(ProjectManager\Entities\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(ProjectManager\Entities\Client::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'responsible' => $faker->name,
        'email' => $faker->email,
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
        'obs' => $faker->sentence,
    ];
});

$factory->define(ProjectManager\Entities\Project::class, function (Faker\Generator $faker) {
    return [
        'owner_id' => rand(1,10),
        'client_id' => rand(1,10),
        'name' => $faker->name,
        'description' => $faker->text,
        'progress' => rand(0, 100),
        'status' => rand(0, 3),
        'due_date' => $faker->dateTime
    ];
});

$factory->define(ProjectManager\Entities\ProjectNote::class, function (Faker\Generator $faker) {
    return [
        'project_id' => rand(1,10),
        'title' => $faker->word,
        'note' => $faker->paragraph,
    ];
});

$factory->define(ProjectManager\Entities\ProjectTask::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
        'project_id' => rand(1,10),
        'start_date' => date('Y-m-d'),
        'due_date' => date('Y-m-d'),
        'status' => rand(1,10)
    ];
});

$factory->define(ProjectManager\Entities\ProjectMember::class, function (Faker\Generator $faker) {
    return [
        'project_id' => rand(1,10),
        'user_id' => rand(1,10)
    ];
});