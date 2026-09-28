<?php

beforeEach(function () {
    config([
        'auth.basic_auth.username' => 'admin',
        'auth.basic_auth.password' => 'secret',
    ]);
});

test('the home page asks for credentials when none are given', function () {
    $this->get('/')
        ->assertStatus(401)
        ->assertHeader('WWW-Authenticate', 'Basic realm="Restricted", charset="UTF-8"');
});

test('the home page rejects wrong credentials', function () {
    $this->withBasicAuth('admin', 'wrong')
        ->get('/')
        ->assertStatus(401);
});

test('the application returns a successful response with valid credentials', function () {
    $this->withBasicAuth('admin', 'secret')
        ->get('/')
        ->assertOk();
});
