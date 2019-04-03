# Dummie Tummie

## Instalação

Antes de começar a instalácão certifique-se de ter lido e preparado o ambiente conforme documentação do Laravel Homestead:

Antes de começar você deve ter instalado os seguintes pacotes/programas:
 - VirtualBox (recomendado) ou VMWare ou Parallels ou Hyper-V.
 - Vagrant.

Após certificar-se de que os dois itens acima estão instalados, siga o passo a passo abaixo:

1. Clonar o repositório
2. Rodar o instalador do composer (`composer install`)
3. Rodar comando de inicialização do Homestead no projeto `Mac/Linux: php vendor/bin/homestead make` ou `Windows: vendor\\bin\\homestead make`
4. Após isso você deve apontar o ip 192.168.10.10 (padrão do homestead) para o host homestead.test no seu arquivo de hosts (Mac\Linux: /etc/hosts)
5. Rodar o comando de inicialização do vagrant executando `vagrant up`
6. Acessar o SSH da sua maquina virtual através do comando `vagrant ssh` (após isso acessar o diretorio root `cd code`)
7. Copiar o arquivo .env.example para .env
8. Configurar a chave do Laravel rodando `php artisan key:generate`
9. Revisar arquivo de configurações (.env)
10. Acessar homestead.test e certificar-se de visualizar uma página com o titulo "Dummie Tummie"

## Dicas para pedir ajuda

1. Procurar pela solução no Google/Stackoverflow/Comunidades
2. Formular pergunta de maneira que fique claro o contexto do problema, o que já tentou fazer e o que deseja como resultado final (se possível).

## Regras

1. Não é permitido usar templates de terceiros para estilização do frontend (aceitamos a framework bootstrap original ou modificada por vocês)
2. Limite máximo de horário para commits (08/04/2019 às 09:00 horário de Brasilia)
3. Você pode usar pacotes de terceiros para ajudar na implementação de funcionalidades (tenha em mente que você será questionado e avaliado sobre o porque de ter optado pela adoção de cada pacote)

## Alguns itens que valorizamos

1. Qualquer melhoria de segurança (senhas padrões não previsiveis, melhoria no padrão de autenticação da API, etc)
2. Uso e abuso de Vue.js
3. Boas práticas nos commits e pull requests
4. Criatividade e disrupção
5. Apresentação do trabalho feito
6. Questionamentos e sugestões
