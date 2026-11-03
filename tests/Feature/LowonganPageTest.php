<?php

test('the lowongan page displays listings without undefined search variables', function () {
    $this->get(route('lowongan.index'))
        ->assertSuccessful()
        ->assertSee('Daftar Lowongan')
        ->assertSee('Sigma Course')
        ->assertSee('Kata Kunci Pekerjaan');
});

test('the lowongan page filters listings by keyword and location', function () {
    $this->get(route('lowongan.index', ['keyword' => 'teazzi', 'location' => 'Pontianak']))
        ->assertSuccessful()
        ->assertSee('Teazzi Ptk - Part time')
        ->assertDontSee('Sigma Course')
        ->assertDontSee('BCA Jakarta Pusat');
});
