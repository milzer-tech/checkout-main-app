<?php

beforeEach(function () {
    config([
        'horizon.basic_auth.username' => 'admin',
        'horizon.basic_auth.password' => 'secret',
    ]);
});

test('horizon asks for credentials when none are given', function () {
    $this->get('/horizon')
        ->assertStatus(401)
        ->assertHeader('WWW-Authenticate', 'Basic realm="Horizon", charset="UTF-8"');
});

test('horizon rejects wrong credentials', function () {
    $this->withBasicAuth('admin', 'wrong')
        ->get('/horizon')
        ->assertStatus(401);
});

test('horizon rejects its api without credentials', function () {
    $this->getJson('/horizon/api/stats')->assertStatus(401);
});

test('horizon is accessible with valid credentials', function () {
    $this->withBasicAuth('admin', 'secret')
        ->get('/horizon')
        ->assertOk();
});

test('horizon is forbidden when credentials are not configured', function () {
    config(['horizon.basic_auth.password' => null]);

    $this->withBasicAuth('admin', '')
        ->get('/horizon')
        ->assertForbidden();
});
