<?php

namespace Mguinea\QueryUpdater\Tests;

use Mguinea\QueryUpdater\KeepDefault;
use Mguinea\QueryUpdater\QueryUpdater;

class TestUpdateFields extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function testUpdateSingleField()
    {
        QueryUpdater::for($this->user, ['name' => 'Anna'])
            ->updateFields([
                'name'
            ])
            ->save();

        $this->assertEquals('Anna', $this->user->name);
    }

    public function testUpdateFieldsAndKeepDefault()
    {
        QueryUpdater::for($this->user, ['name' => 'Anna', 'email' => null])
            ->updateFields([
                'name',
                KeepDefault::keep('email')
            ])
            ->save();

        $this->assertEquals('Anna', $this->user->name);
    }
}