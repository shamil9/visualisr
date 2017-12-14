<?php

namespace Tests\Unit;

use App\User;
use App\Visual;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class VisualUnitTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function it_checks_if_a_visual_is_private()
    {
        $visual = new Visual(['private' => true, 'user_id' => 1]);

        $this->assertTrue($visual->isPrivate());

        $this->be($user = factory(User::class)->create());

        $this->assertFalse($visual->isPrivate());
    }
}
