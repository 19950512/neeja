<?php

use App\Domain\ValueObjects\CNPJ;

test('Deve criar um CNPJ válido', function () {
    $cnpj = new CNPJ('64.694.708/0001-72');
    expect($cnpj)->toBeInstanceOf(CNPJ::class);
    expect($cnpj->get())->toBe('64.694.708/0001-72');
});

test('Deve lançar exceção ao criar um CNPJ inválido', function () {
    $cnpj = new CNPJ('17.401.305/0001-65');
})->throws("O CNPJ informado 17.401.305/0001-65, não está válido.");

test('Deve aceitar um CNPJ válido com zero a esquerda', function () {
    $cnpj = new CNPJ('05256097000111');
    expect($cnpj)->toBeInstanceOf(CNPJ::class);
    expect($cnpj->get())->toBe('05.256.097/0001-11');
});

test('Deve aceitar um CNPJ válido sem separadores', function () {
    $cnpj = new CNPJ('55072018000190');
    expect($cnpj)->toBeInstanceOf(CNPJ::class);
    expect($cnpj->get())->toBe('55.072.018/0001-90');
});

it('deve aceitar um CNPJ válido com separadores diferentes', function () {
    $cnpj = new CNPJ('64.694/708-0001.72');
    expect($cnpj->get())->toBe('64.694.708/0001-72');
});