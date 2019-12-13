<?php

namespace Mguinea\QueryUpdater\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Illuminate\Database\Schema\Blueprint;

abstract class TestCase extends Orchestra
{
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->setUpDatabase($this->app);
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            \Mguinea\QueryUpdater\QueryUpdaterServiceProvider::class,
        ];
    }

    /**
     * Set up the database.
     *
     * @param \Illuminate\Foundation\Application $app
     */
    protected function setUpDatabase($app)
    {
        // Fake users migration
        $app['db']->connection()->getSchemaBuilder()->create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('password')->nullable();
        });

        // Create user to manage updates
        $this->user = User::create([
           'name' => 'Marc',
           'email' => 'develop.marcguinea@gmail.com',
           'password' => bcrypt('secret')
        ]);
    }
}
