

# Tutorial - Como rodar projeto PHP com Composer

## Pré-requisitos

- PHP 7.4 ou superior instalado
- Composer instalado

## Passo a passo

1. Clone o repositório do projeto

git clone [URL_DO_REPOSITORIO]
cd [NOME_DO_PROJETO]


2. Instale as dependências via Composer

composer install


3. Configure o arquivo de ambiente

cp .env.example .env


4. Atualize as configurações no arquivo .env conforme necessário
- Configure banco de dados
- Configure outras variáveis de ambiente

5. Inicie o servidor de desenvolvimento

php -S localhost:8000 -t src/

O projeto estará disponível em `http://localhost:8000`

## Comandos úteis

- Atualizar dependências:

composer update


- Limpar cache:

composer dump-autoload


## Solução de problemas comuns

1. Erro de permissão:

chmod -R 777 storage bootstrap/cache


2. Dependências não encontradas:

composer dump-autoload


3. Erro de autoload:

composer dump-autoload -o

