# 💼 Catálogo de Produtos

## 🎓 Exercícios Práticos 10 e 12

### 📌 Exercício 10 - Utilizando a estrutura de tabelas:

🔷 10 - Desenvolvimento Full-Stack (Laravel + Vue.js)
📝 Texto Original

Crie um pequeno CRUD de produtos utilizando Laravel para o backend e Vue.js no frontend.
A aplicação deve permitir criação, leitura, atualização e deleção (CRUD) de produtos.

Cada produto deve conter:
Nome, Descrição, Preço e Imagem

Requisitos:
Backend em Laravel: Criar modelo, migration, controller e rotas REST para cada ação.
Frontend em Vue.js: Criar interface para consumir a API e exibir os produtos.
Autenticação: Apenas usuários autenticados podem modificar produtos.

📌 Análise da Questão

Essa questão avalia:

Capacidade real de construir aplicação full-stack

Estruturação de API REST

Integração frontend + backend

Controle de autenticação

Upload e armazenamento de imagem

Organização de código

Segurança e validação

Maturidade arquitetural

Não é apenas “fazer CRUD”.

É demonstrar domínio da arquitetura.

📌 Pontos Técnicos Importantes

Backend:

Model bem estruturado

Migration correta (tipos adequados)

Validação com FormRequest

Upload via Storage

API Resource para padronizar resposta

Middleware de autenticação (Sanctum)

Paginação

Frontend:

Componentização

Axios configurado

Tratamento de erro

Feedback visual

Separação entre listagem e formulário

📌 Orientação Profissional para Resolver

Criar migration com:

string nome

text descricao

decimal preco

string imagem

timestamps

Criar FormRequest para validação.

Configurar upload de imagem usando storage público.

Criar rotas via:

Route::apiResource('produtos', ProdutoController::class);

Proteger rotas de modificação com:

middleware('auth:sanctum')

No frontend:

Criar tela de listagem

Criar formulário reutilizável

Usar axios com interceptors

Implementar feedback de sucesso/erro

Documentar no README as decisões tomadas.


🔷 12 - Front-end (Checkout)
📝 Texto Original

Desenvolver uma página para a finalização de uma compra.
Os produtos na sacola/carrinho serão hardcoded.

Deve conter as seguintes funcionalidades:

Validação de campos com formatos específicos (cartão, data, cep, e-mail, telefone etc)

Validação de campos vazios

Alteração da quantidade dos produtos

Carregamento do endereço a partir do CEP utilizando cep-promise

Indicadores de carregamento

Mensagem de sucesso ao fechar o pedido

Exibir objeto final no console

📌 Análise da Questão

Avalia:

Manipulação de formulário complexa

Controle de estado

Validações avançadas

Comunicação assíncrona

UX

Organização de componentes

📌 Pontos Técnicos Importantes

Regex para validação

Uso do cep-promise

Controle de loading

Atualização reativa de total

Prevenção de quantidade negativa

Objeto final estruturado

📌 Orientação Profissional para Resolver

Separar componentes:

FormContato

FormEntrega

FormPagamento

ResumoCarrinho

Criar função central de validação.

Implementar loading state com spinner.

Usar try/catch no CEP.

Ao finalizar:

Validar tudo

Mostrar mensagem

console.log do objeto consolidado

Garantir acessibilidade mínima (labels associadas, required, aria).