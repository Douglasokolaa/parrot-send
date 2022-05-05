<?php


use App\Models\User;

it('can view dashboard', function () {
    $this->actingAs(User::factory()->create())
         ->get(route('dashboard'))
         ->assertOk();
});
