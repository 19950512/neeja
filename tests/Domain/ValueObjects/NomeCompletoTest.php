<?php

use App\Domain\ValueObjects\NomeCompleto;

test('Deverá lançar exceção ao receber um nome inválido', function () {
    expect(function () {
        new NomeCompleto('joão');
    })->toThrow("O nome completo joão, não está válido.");
})->group('NomeCompleto');

test('Deve aceitar um nome completo com dois sobrenomes', function () {
    $nomeCompleto = new NomeCompleto('Rita de Cássia da Silva Rosa');
    expect($nomeCompleto->get())->toEqual('Rita de Cássia da Silva Rosa');
})->group('NomeCompleto');

test('Deve aceitar um nome completo com iniciais acentuadas', function () {
    $nomeCompleto = new NomeCompleto('Ayrton da Fonseca');
    expect($nomeCompleto->get())->toEqual('Ayrton da Fonseca');
})->group('NomeCompleto');

test('Deve aceitar um nome completo com caracteres especiais', function () {
    $nomeCompleto = new NomeCompleto('A&na@bel(Lima^Gom#es');
    expect($nomeCompleto->get())->toEqual('A&na@bel(Lima^Gom#es');
})->throws('O nome completo A&na@bel(Lima^Gom#es, não está válido')->group('NomeCompleto');

test('Deve aceitar um nome completo com um sobrenome composto', function () {
    $nomeCompleto = new NomeCompleto('Matheus da Silva');
    expect($nomeCompleto->get())->toEqual('Matheus da Silva');
})->group('NomeCompleto');

test('Deve lançar exceção para nome com menos de dois nomes', function () {
    expect(function () {
        new NomeCompleto('Matheus');
    })->toThrow("O nome completo Matheus, não está válido.");
})->group('NomeCompleto');

test('Deve lançar exceção para nome com caracteres numéricos', function () {
    expect(function () {
        new NomeCompleto('Matheus 19950512');
    })->toThrow("O nome completo Matheus 19950512, não está válido.");
})->group('NomeCompleto');

test('Deve lançar exceção para nome com caracteres especiais inválidos', function () {
    expect(function () {
        new NomeCompleto('Rita de U');
    })->toThrow("O nome completo Rita de U, não está válido.");
})->group('NomeCompleto');
