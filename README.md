# Learning Forge

> Projeto Laravel voltado para aprendizado dos princípios de **Clean Code**, **Programação Orientada a Objetos (POO)** e **SOLID**.

## Objetivo

Este projeto tem como foco o desenvolvimento de um sistema simples utilizando **Laravel** e boas práticas de **POO**, com ênfase nos seguintes conceitos:

- Herança
- Encapsulamento
- Polimorfismo
- Abstração
- Princípios SOLID

## Estrutura de Classes

O domínio principal do sistema gira em torno do conceito de **Pessoa**, dividido em:

- `Pessoa` (classe pai)
  - `PessoaFisica` (classe filha)
  - `PessoaJuridica` (classe filha)

Essa estrutura é usada para aplicar na prática os conceitos de herança, polimorfismo e encapsulamento, em conjunto com boas práticas de organização de código.

## Tecnologias e Ferramentas

- PHP 8+
- Laravel 10+
- Composer
- Git
- MySQL ou SQLite (para testes)

## Como rodar o projeto

```bash
git clone https://github.com/Henderson07/learning-forge.git
cd learning-forge
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
