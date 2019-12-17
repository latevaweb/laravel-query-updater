<?php

namespace LaTevaWeb\QueryUpdater\Tests;

use LaTevaWeb\QueryUpdater\Filter\KeepStored;
use LaTevaWeb\QueryUpdater\QueryUpdater;

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
            'name',
        ])
        ->save();

        $this->assertEquals('Anna', $this->user->name);
    }

    public function testUpdateMultipleFields()
    {
        QueryUpdater::for($this->user, [
            'name' => 'Anna',
            'email' => 'marc@latevaweb.com',
        ])
        ->updateFields([
            'name',
            'email',
        ])
        ->save();

        $this->assertEquals('Anna', $this->user->name);
        $this->assertEquals('marc@latevaweb.com', $this->user->email);
    }

    public function testUpdateWithProtectedField()
    {
        QueryUpdater::for($this->user, [
            'name' => 'Anna',
            'email' => 'marc@latevaweb.com',
        ])
        ->updateFields([
            'email',
        ])
        ->save();

        $this->assertEquals('Marc', $this->user->name);
        $this->assertEquals('marc@latevaweb.com', $this->user->email);
    }

    public function testUpdateKeepingStoredValue()
    {
        QueryUpdater::for($this->user, [
            'name' => null,
        ])
        ->updateFields([
            KeepStored::field('name'),
        ])
        ->save();

        $this->assertEquals('Marc', $this->user->name);
    }
}
