<?php

use App\Domain\ValueObjects\Email;

test('deve acetestar um endereço de email válido', function () {
    $email = new Email('email@teste.com');
    expect($email->get())->toBe('email@teste.com');
})->group('Email');

test('exception se o email não tiver o @', function () {
    $email = new Email('emailteste.com');
})->throws("O endereço de email informado emailteste.com não é válido.")->group('Email');

test('deve lançar uma exceção se o endereço de email não tiver o .', function () {
    $email = new Email('email@testecom');
})->throws("O endereço de email informado email@testecom não é válido.")->group('Email');

test('deve lançar uma exceção se o endereço de email não tiver o domínio', function () {
    $email = new Email('email@');
})->throws("O endereço de email informado email@ não é válido.")->group('Email');

test('deve lançar uma exceção se o endereço de email estiver em um formato inválido', function () {
    $email = new Email('email@teste..com');
})->throws("O endereço de email informado email@teste..com não é válido.")->group('Email');