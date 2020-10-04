# Recrutamento & Seleção E-goi
  Igor Marques

## API com manipulação de arquivo & Front

### Criar uma API para gestão de categorias.

A API deve implementar 5 endpoints para que seja possível executar todas as funções básicas (CRUD).
No endpoint para listagem de todos os registros deverá ser possível fazer uma busca pelo nome da categoria.

Tecnologias:
 - Zend Framework 2
 - Angular 9

Observações: 
 - Ao invés de utilizar um banco de dados, os registros deverão ser manipulados dentro de um arquivo .json;
 - As requests deverão manipular o arquivo .json para adicionar, editar e remover registros.
 - Enviar as rotas do front para adicionar, listar e editar os registros.

ESTRUTURA:

| Field         | Type          |
| ------------- |---------------|
| id            | int           |
| name          | string        |
| created       | datetime      |
| modified      | datetime      |


## Sobre o código

1 - Instalar as bibliotecas do zend
```bash
compose install
```

2 - Executar o docker para levar o servidor web
```bash
docker-compose up -d
```

3 - Instalar as bibliotecas do Angular
```bash
cd angular
npm install
npm run build 
```