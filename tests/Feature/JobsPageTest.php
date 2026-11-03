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

test('job cards have IDs and link to their matching detail pages', function () {
    $this->get(route('jobs.index'))
        ->assertSuccessful()
        ->assertSee('id="job-1"', false)
        ->assertSee('id="job-2"', false)
        ->assertSee(route('job.detail', ['jobId' => 2]), false);

    $this->get(route('home'))
        ->assertSuccessful()
        ->assertSee('id="job-2"', false)
        ->assertSee(route('job.detail', ['jobId' => 2]), false);
});

test('the lowongan page links each card to its matching job', function () {
    $this->get(route('lowongan.index'))
        ->assertSuccessful()
        ->assertSee('id="job-9"', false)
        ->assertSee('id="job-10"', false)
        ->assertSee(route('job.detail', ['jobId' => 10]), false);
});

test('job detail and application pages use the selected brand and logo', function () {
    $this->get(route('job.detail', ['jobId' => 2]))
        ->assertSuccessful()
        ->assertSee("McDonald's - Kasir")
        ->assertSee(asset('images/mcd.jpg'), false);

    $this->get(route('job.apply', ['jobId' => 2]))
        ->assertSuccessful()
        ->assertSee("McDonald's - Kasir")
        ->assertSee(asset('images/mcd.jpg'), false);
});

test('the legacy job URLs still show Hotway', function () {
    $this->get('/job')
        ->assertSuccessful()
        ->assertSee("Hotway's - Part time");

    $this->get('/job/apply')
        ->assertSuccessful()
        ->assertSee("Hotway's - Part time");
});
