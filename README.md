# Projeto-VOX
Infelismente devido a maquina utilizada para desenvolvimento do desafio corromper o SO, não foi possivel concluir o desafio por completo.
Porem o back-end feito em Symfony 4 esta concluido. 

O que foi Feito
1. CRUD para as Empresas
2. CRUD para sócios
back-end feito em Symfony
Depois que você clonar o codigo do gitLab para a dentro da pasta htdocs

1-Abra o git bash dentro da pasta "vox" e utilize "composer install" -> para instalar todas as dependencias. 

2. Abra o aquiro .env e coloque as configurações do seu banco. 

2.1. Exemplo:

    DATABASE_NAME=db_empresa
   	DATABASE_HOST=localhost
  	DATABASE_PORT=5432
  	DATABASE_USER=root
  	DATABASE_PASSWORD=""
	
	Obs: O banco deve ser mysql
	
2.2. o drive pdo_pgsql e pgsql devem estar habilitados nas configuracoes do php.ini

2-Logo mais digite "php bin/console doctrine:database:create" ->Para criar o banco de dados

3-Em seguida "php bin/console doctrine:migrations:migrate" -> Para migrar os dados da entity para o banco, assim criando as tabelas

4-Utilize o comando "symfony serve"

5-Abra o postman e faça os seguintes teste das rotas 

5.1- Teste de rotas de empresa 

requisição tipo GET -> http://127.0.0.1:8000/empresa 

requisição tipo GET -> http://127.0.0.1:8000/empresa/{id} 

requisição tipo POST -> http://127.0.0.1:8000/empresa/

requisição tipo DELETE -> http://127.0.0.1:8000/empresa/{id} 

requisição tipo UPDATE -> http://127.0.0.1:8000/empresa/{id} 

5.2- Teste de rotas de Socios 

requisição tipo GET -> http://127.0.0.1:8000/socios/ 

requisição tipo GET -> http://127.0.0.1:8000/socios/{id} 

requisição tipo POST -> http://127.0.0.1:8000/socios/ 

requisição tipo DELETE -> http://127.0.0.1:8000/socios/{id} 

requisição tipo UPDATE -> http://127.0.0.1:8000/socios/{id}
