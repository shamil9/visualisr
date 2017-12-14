<?php

namespace Tests\Feature;

use App\User;
use App\Visual;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class VisualTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function only_owner_should_be_able_to_see_private_visual()
    {
        $visual = new Visual(['private' => true, 'user_id' => 2]);
        $visual->save();

        // Visitor
        $this->get(route('visuals.show', $visual))
            ->assertSessionHas('errors', 'Private Visual');

        // Other member
        $this->be($user = factory(User::class)->create());

        $this->get(route('visuals.show', $visual))
            ->assertSessionHas('errors', 'Private Visual');

        // Owner
        $this->be($user = factory(User::class)->create());

        $this->get(route('visuals.show', $visual))
            ->assertSessionMissing('errors');
    }
}
