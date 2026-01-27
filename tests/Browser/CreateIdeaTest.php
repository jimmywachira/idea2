<?php

it('allows a user to create an idea', function () {
    // Visit the ideas index page
    $this->browse(function (Browser $browser) {
        $browser->loginAs(User::first())
            ->visit('/ideas')
            ->click('@create-idea-button')
            ->type('title', 'My New Idea')
            ->type('description', 'This is a description of my new idea.')
            ->select('status', 'in_progress')
            ->press('Create Idea')
            ->assertSee('My New Idea');
    });
});