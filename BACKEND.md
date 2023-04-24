# Backend
O backend do projeto Neeja é desenvolvido seguindo as boas práticas de desenvolvimento de software, como clean code e S.O.L.I.D, além de utilizar arquiteturas como Clean Architecture e Domain Driven Design.

## Arquitetura
O projeto é um monolito com contextos bem delimitados, o que facilitará a migração para microserviços no futuro, caso seja necessário. A arquitetura do projeto é composta pelas seguintes camadas:

- **Domínio**: contém as regras de negócio, validações, objetos de valor e interfaces de contratos.
- **Application**: camada que utiliza um pouco de CQRS, com comandos e queries. Os comandos orquestram as regras de negócio do domínio, enquanto as queries são usadas exclusivamente para relatórios e outras consultas.
- **Infraestrutura**: camada onde ficam as implementações das tecnologias utilizadas, como o repositório de banco de dados para comandos e leituras, implementações de mensageria (RabbitMQ), logs, etc. Além disso, é nesta camada que está a API que o frontend utiliza para se comunicar com o projeto. Os controllers dessa API utilizam a camada de Application para executar os comandos e queries.

## Técnologias
O backend do projeto é desenvolvido utilizando a linguagem PHP 8.2 e as seguintes tecnologias:

- **Pest PHP 2.0**: Framework de teste utilizado para cobrir o projeto com testes de unidade e integração.
- **PostgreSQL**: Banco de dados relacional utilizado como fonte de informação.
- **Firebase**: Banco de dados NoSQL utilizado para leitura e relatórios.
- **RabbitMQ**: Sistema de mensageria utilizado para comunicação assíncrona entre as camadas do projeto.

## Padrões de projeto
O backend do projeto utiliza os seguintes padrões de projeto:

- **Clean Code**: práticas de programação que visam a criação de código claro, conciso e legível.
- **S.O.L.I.D**: conjunto de princípios de design orientado a objetos que visam a criação de sistemas mais fáceis de manter e estender.
- **Clean Architecture**: arquitetura de software que enfatiza a separação de responsabilidades e a dependência das camadas de dentro para fora.
- **Domain Driven Design**: abordagem de design de software que busca a criação de um modelo de domínio rico, onde as classes representam entidades de negócio.

## Tomadas de decisão
Algumas das principais decisões tomadas durante o desenvolvimento do backend do projeto foram:

- Utilização de uma arquitetura **monolítica**: o projeto foi iniciado como um monolito, com contextos bem delimitados, o que facilitará a migração para microserviços no futuro, caso seja necessário.
- Utilização do **PostgreSQL** e **Firebase**: o PostgreSQL foi escolhido como banco de dados relacional para fonte de informação e o Firebase como banco de dados NoSQL para leitura e relatórios.
- Utilização do **RabbitMQ** para mensageria: foi escolhido o RabbitMQ para a implementação da comunicação assíncrona entre as camadas do projeto.




