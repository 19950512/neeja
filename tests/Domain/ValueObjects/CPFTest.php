<?php

use App\Domain\ValueObjects\CPF;

test('Deve lançar exceção ao receber um CPF inválido', function () {
    new CPF('123.456.789-01');
})->throws("O CPF informado 123.456.789-01, não está válido.")->group('CPF');

test('Deve aceitar um CPF válido sem máscara', function () {
    $cpf = new CPF('52998224725');
    expect($cpf->get())->toBe('529.982.247-25');
})->group('CPF');

test('Deve aceitar um CPF válido com máscara', function () {
    $cpf = new CPF('529.982.247-25');
    expect($cpf->get())->toBe('529.982.247-25');
})->group('CPF');

test('Deve aceitar um CPF válido com zero a esquerda', function () {
    $cpf = new CPF('061.366.510-41');
    expect($cpf->get())->toBe('061.366.510-41');
})->group('CPF');

test('Deve lançar uma exception por conter mais de um zero a esquerda', function () {
    $cpf = new CPF('00008825236');
})->throws('O CPF informado 00008825236, não está válido.')->group('CPF');

test('Deve lançar uma exception pelo cpf 0123456789', function () {
    new CPF('0123456789');
})->throws("O CPF informado 0123456789, não está válido.")->group('CPF');