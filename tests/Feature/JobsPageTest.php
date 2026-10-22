<?php

test('the jobs page displays listings and links to its named route', function () {
    $this->get(route('jobs.index'))
        ->assertSuccessful()
        ->assertSee('Daftar Lowongan')
        ->assertSee('Sigma Course')
        ->assertSee(route('jobs.index'), false);
});

test('the jobs page filters listings by keyword and location', function () {
    $this->get(route('jobs.index', ['keyword' => 'teazzi', 'location' => 'Pontianak']))
        ->assertSuccessful()
        ->assertSee('Teazzi Ptk - Part time')
        ->assertDontSee('Sigma Course')
        ->assertDontSee('BCA Jakarta Pusat');
});
