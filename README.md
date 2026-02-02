## 📝 To Do – Gestão de Tarefas

Aplicação web desenvolvida em Laravel para gestão de tarefas pessoais, permitindo a criação, edição, conclusão e organização de tarefas por estado, prioridade e data.

Este projeto foi desenvolvido no contexto de estágio, com foco em boas práticas, testes automatizados, organização de código e acessibilidade básica.
## 

## 🎯 Visão Geral

A aplicação permite que cada utilizador autenticado faça a gestão das suas próprias tarefas, garantindo isolamento de dados e uma experiência simples e intuitiva.

O sistema inclui:

Autenticação de utilizadores

CRUD completo de tarefas

Filtros avançados

Dashboard com métricas

Testes automatizados

Interface cuidada e acessível
## 

## ✨ Funcionalidades

🔐 Autenticação de utilizadores

✅ Criar, editar, visualizar, concluir e apagar tarefas

👤 Cada utilizador vê apenas as suas tarefas

🔎 Filtros por:

Estado (pendente / concluída)

Prioridade (alta / média / baixa)

Intervalo de datas

📊 Dashboard com métricas simples

🧪 Testes automatizados (Feature tests)

♿ Melhorias de acessibilidade (labels, aria-*, mensagens de erro)
## 

## 🛠️ Stack Tecnológica

Backend: Laravel

Frontend: Blade + Tailwind CSS

Autenticação: Laravel Starter Kit (Fortify)

Base de dados: MySQL / SQLite

Testes: Pest / PHPUnit

Ambiente local: Laravel Herd / PHP Artisan
## 

## ⚙️ Setup Local

1️⃣ Clonar o repositório
git clone https://github.com/FelipeSalesInovcorp/todo-gestao-tarefas.git
cd todo-gestao-tarefas

2️⃣ Instalar dependências
composer install
npm install
npm run build

3️⃣ Configurar ambiente
cp .env.example .env
php artisan key:generate
Configurar a base de dados no .env.

4️⃣ Migrar base de dados
php artisan migrate
## 

## 🧪 Testes Automatizados

Executar todos os testes:

php artisan test

Testes específicos de tarefas:

php artisan test --filter=TaskTest
php artisan test --filter=TaskGuestAccessTest

✔️ Todos os testes passam sem falhas.
## 

## 🧭 Rotas Principais (Tarefas)
Método	Rota	Descrição
GET	/tasks	Listar tarefas
GET	/tasks/create	Criar tarefa
POST	/tasks	Guardar tarefa
GET	/tasks/{task}	Ver tarefa
GET	/tasks/{task}/edit	Editar tarefa
PUT	/tasks/{task}	Atualizar tarefa
PATCH	/tasks/{task}/toggle-complete	Marcar como concluída
DELETE	/tasks/{task}	Apagar tarefa
##

## 📝 Notas Técnicas

Filtros são processados no backend via Action

Paginação mantém query string

Testes garantem:

Isolamento por utilizador

Proteção contra acesso não autenticado
## 

## 👨‍💻 Autor

Projeto desenvolvido por Felipe Sales no âmbito de estágio curricular.

