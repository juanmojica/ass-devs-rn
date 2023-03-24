# Software de Gerenciamento de Associados e Anuidades

Este software foi desenvolvido para facilitar a gerência dos associados e suas anuidades da associação "Devs do RN". Abaixo estão listadas as funcionalidades que o software oferece.

## Funcionalidades

- Cadastro de associados: Nome, E-mail, CPF e Data de filiação.
- Cadastro de anuidades: Ano e Valor. (Esta opção é disponível apenas para o perfil de Gerente)
- Gestão do pagamento das anuidades dos associados.
- Relatório dos associados que estão adimplentes e inadimplentes.

## Requisitos

- PHP 7.4.x
- Composer
- NPM
- MySQL

## Instalação

Para instalar e utilizar o software, siga as instruções abaixo:

1. Clone o repositório: `git clone https://github.com/juanmojica/ass-devs-rn.git`
2. Acesse o diretório do projeto: `cd ass-devs-rn`
3. Instale as dependências: `composer install`
4. Instale as dependências: `npm install` e em seguida execute `npm run dev`
5. Crie um banco de dados MySQL para o software.
6. Configure as variáveis de ambiente do Laravel, utilizando o arquivo `.env.example` como modelo.
    - Crie uma cópia do .env.example e mude o nome para .env
    - No arquivo .env configure as seguintes variáveis de acordo com o banco de dados criado:
        - DB_CONNECTION=mysql
        - DB_HOST=127.0.0.1
        - DB_PORT=3306
        - DB_DATABASE=
        - DB_USERNAME=root
        - DB_PASSWORD=
7. Rode as migrações do banco de dados: `php artisan migrate --seed`
    - Após rodar as migrações serão criadas as tabelas e alguns dados fake para teste da aplicação.
    - Serão criados dois usuários, um com o perfil de gerente e outro com o perfil usuário:
        - Usuário com perfil de gerente:
            - login: jp@devsrn.com
            - senha: 123
        - Usuário com perfil básico:
            - login: pa@devsrn.com
            - senha: 456
8. Inicie o servidor: `php artisan serve`.
9. Em seguida pode logar com o usuário desejado.

## Informações sobre o funcionamento do sistema

1. Na aba Dashboard é exibido um gráfico com os associados adimplentes e os inadimplentes
2. Na aba Associados é exibida a lista de associados com seus devidos botões:
    - Esta aba ofere o CRUD de associados, porém na aba visualizar detalhes é listados, além dos dados pessoais 
    do associado, a lista de pagamentos deste, informando as anuidades pagas e as devidas.
3. Nas abas associados adimplentes e na associados inadimplentes também é possível manter os dados do associado,
    no entanto,  como os próprios nomes sugerem, elas listam os associados de acordo com a sua situação de pagamento.
4. Já a aba anuidades, prover o CRUD de anuidades e esse é disponível apenas para o gerente.

- OBS: Ao inserir uma anuidade, essa anuidade será atribuída para todos os usuários, porém o usuário só é considerado
inadimplente se ele não pagou a anuidade do ano vigente ou alguma anterior a este. 


