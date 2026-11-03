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

test('every job card links to its matching detail page', function () {
    $this->get(route('lowongan.index'))
        ->assertSuccessful()
        ->assertSee('id="job-1"', false)
        ->assertSee('href="'.route('job.detail', ['jobId' => 1]).'"', false)
        ->assertSee('id="job-8"', false)
        ->assertSee('href="'.route('job.detail', ['jobId' => 8]).'"', false);
});

test('a job card opens details for the selected job', function () {
    $this->get(route('job.detail', ['jobId' => 2]))
        ->assertSuccessful()
        ->assertSee("McDonald's - Kasir")
        ->assertSee(asset('images/mcd.jpg'), false);

    $this->get(route('job.detail', ['jobId' => 999]))
        ->assertNotFound();

    $this->get(route('job.apply.id', ['jobId' => 2]))
        ->assertSuccessful()
        ->assertSee("McDonald's - Kasir")
        ->assertSee(asset('images/mcd.jpg'), false);
});
