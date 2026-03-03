# 💼 Catálogo de Produtos

## 🎓 Exercícios Práticos 10 e 12 ⏳✅

---

# 📌 Exercício 10 – Desenvolvimento Full-Stack (Laravel + Vue.js)

## 📝 Texto Original

Crie um pequeno CRUD de produtos utilizando Laravel para o backend e Vue.js no frontend.  
A aplicação deve permitir criação, leitura, atualização e deleção (CRUD) de produtos.

Cada produto deve conter:

- Nome  
- Descrição  
- Preço  
- Imagem  

### Requisitos

- **Backend em Laravel:** Criar model, migration, controller e rotas REST para cada ação.  
- **Frontend em Vue.js:** Criar interface para consumir a API e exibir os produtos.  
- **Autenticação:** Apenas usuários autenticados podem modificar produtos.

---

## 📊 Análise da Questão

Essa questão avalia:

- Capacidade real de construir aplicação full-stack  
- Estruturação de API REST  
- Integração frontend + backend  
- Controle de autenticação  
- Upload e armazenamento de imagem  
- Organização de código  
- Segurança e validação  
- Maturidade arquitetural  

Não é apenas “fazer CRUD”.  
É demonstrar domínio da arquitetura.

---

## 🧠 Pontos Técnicos Importantes

### 🔷 Backend

- Model bem estruturado  
- Migration com tipos corretos  
- Validação com **FormRequest**  
- Upload via **Storage**  
- Uso de **API Resource** para padronização de resposta  
- Middleware de autenticação (Sanctum)  
- Paginação na listagem  

### 🔷 Frontend

- Componentização adequada  
- Axios configurado corretamente  
- Tratamento de erro consistente  
- Feedback visual (success/error/loading)  
- Separação entre listagem e formulário  

### 🔹 Estrutura da Migration

- `string nome`
- `text descricao`
- `decimal preco`
- `string imagem`
- `timestamps`

---

## 🚀 Orientação Profissional para Resolver

Vou dividir em 

  - Fase 1 – Preparação do Ambiente e depois 
  - Fase 2 – Implementação Backend  
  - Fase 3 – Frontend
  - Fase 4 - Testar de Integração
  - Fase 5 - Backend: Validação com FormRequest 
  - Fase 6 - Backend: API Resource para Padronização
  - Fase 7 - Autenticação
  - Fase 8 - Paginação

- 🧱 FASE 1 — Configuração do Ambiente de Desenvolvimento
- 1. Verificar PHP: PHP 8.1.12: php -v ✅ 
- 2. Confirmar extensão: openssl, pdo, mbstring, tokenizer, xml, ctype, json: php -m ✅ 
- 3. Verificar Composer ✅ version 2.9.5
- 4. Verificar Node e NPM:  node -v: v18.20.4 e npm -v: 10.7.0 ✅ 
- 5. Verificar MySQL: via XAMPP ✅
- 6. Verificar Git: git --version: 2.46.2 ✅

- 🧱 FASE 2 — Implementação Backend
- 1. Instalação do Framework Laravel (Criação do esqueleto do projeto): composer create-project laravel/laravel backend ✅
- 2. Configuração de Ambiente e Banco de Dados (Arquivo .env): phpMySQLAdmin - db_catalogo ✅
- 3. Criação da Migration e Model Produto (Definição da tabela): php artisan migrate ✅
- 4. Implementação do ProdutoController e Rotas API (Lógica de CRUD).   ✅
- 5. Configuração do Armazenamento de Imagens (Link simbólico do Storage). ✅
- 6. Configuração do Laravel Sanctum (Segurança e Autenticação). ✅

- 🧱 FASE 3 – Frontend
- 1. Criação do Projeto Vue.js (via Vite). upgrade para node-v24.14.0-x64 ✅
- 2. Instalação de Dependências (Axios, Router, etc). ✅
- 3. Configuração da Conexão com a API (Axios e CORS). ✅
- 4. Desenvolvimento das Telas (Components) (CRUD) : ListaProdutos, Formulario. ✅

- 🧪 FASE 4 – Testar de Integração 
- 1. Acessar a Aplicação ✅
- 2. Criar um Produto (Upload de Imagem) ✅
  - Upload de imagem com erro ✅
- 3. Listar Produtos ✅
- 4. Editar um Produto ✅
- 5. Excluir um Produto ✅

- 📂 Fase 5 — Backend: Validação com FormRequest 
- 1. Criar o arquivo de Request via Artisan: php artisan make:request ProdutoRequest
- 2. Configurar as regras de validação para nome, descricao, preco e imagem (verificando tipos e tamanhos).
- 3. Injetar o ProdutoRequest nos métodos store e update do Controller.

- 📂 Fase 6 — Backend: API Resource para Padronização
- 1. Criar o Resource: php artisan make:resource ProdutoResource
- 2. Definir no Resource que o campo imagem deve retornar a URL completa usando Storage::url().
- 3. Atualizar o Controller para retornar new ProdutoResource($produto) em vez do modelo puro.

- 📂 Fase 7 — Autenticação (Laravel Sanctum)
- 1. Configurar o Laravel Sanctum (vem por padrão no Laravel 11).
- 2. Ajustar o api.php para envolver as rotas de modificação (store, update, destroy) no middleware auth:sanctum.
- 3. No Vue, criar a tela de Login e armazenar o token de acesso no localStorage.
- 4. Configurar o Interceptor do Axios para enviar esse Token em todas as requisições automaticamente.

- 📂 Fase 8 — Paginação
- 1. No Controller, trocar Produto::all() por Produto::paginate(10).
- 2. No Vue (ListaProdutos.vue), capturar os dados da paginação (página atual, última página).
- 3. Adicionar botões "Anterior" e "Próximo" que disparam novas chamadas para a API (ex: api/produtos?page=2).

---

### 🔹 Validação

- Criar **FormRequest** específico para Produto
- Validar:
  - nome obrigatório
  - descricao obrigatória
  - preco numérico positivo
  - imagem do tipo válido (jpg, png etc)

---

### 🔹 Upload de Imagem

- Utilizar `Storage`
- Salvar em `storage/app/public`
- Criar link simbólico com `php artisan storage:link`
- Armazenar apenas o caminho no banco

---

### 🔹 Rotas REST

```php
Route::apiResource('produtos', ProdutoController::class);
```

Proteger rotas de modificação:

```php
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('produtos', ProdutoController::class)->except(['index', 'show']);
});
``` 

## 🔹 Frontend Vue

- Criar tela de listagem de produtos  
- Criar formulário reutilizável (create/edit)  
- Configurar Axios com interceptors  
- Implementar feedback visual  
- Tratar loading e erros  

---

## 🔹 Documentação

Registrar no README:

- Decisões arquiteturais  
- Estrutura escolhida  
- Justificativas técnicas  
- Como rodar backend e frontend  

---

# 📌 Exercício 12 – Front-end (Checkout)

## 📝 Texto Original

Desenvolver uma página para finalização de compra.  
Os produtos na sacola/carrinho serão hardcoded.

### Funcionalidades exigidas:

- Validação de campos com formatos específicos (cartão, data, CEP, e-mail, telefone etc)  
- Validação de campos vazios  
- Alteração da quantidade dos produtos  
- Carregamento do endereço a partir do CEP utilizando `cep-promise`  
- Indicadores de carregamento  
- Mensagem de sucesso ao fechar o pedido  
- Exibir objeto final no console  

---

## 📊 Análise da Questão

Avalia:

- Manipulação de formulário complexo  
- Controle de estado  
- Validações avançadas  
- Comunicação assíncrona  
- UX  
- Organização de componentes  

---

## 🧠 Pontos Técnicos Importantes

- Regex para validações específicas  
- Uso correto do `cep-promise`  
- Controle de loading  
- Atualização reativa do total  
- Prevenção de quantidade negativa  
- Estruturação correta do objeto final  
- Separação lógica entre seções do formulário  

---

## 🚀 Orientação Profissional para Resolver

### 🔹 Separação de Componentes

- `FormContato`  
- `FormEntrega`  
- `FormPagamento`  
- `ResumoCarrinho`  

---

### 🔹 Validação

- Criar função central de validação  
- Validar campos obrigatórios  
- Validar formatos com regex  
- Bloquear submissão se inválido  

---

### 🔹 CEP

- Utilizar `cep-promise`  
- Implementar `try/catch`  
- Exibir loading durante requisição  
- Preencher campos automaticamente  

---

### 🔹 Carrinho

- Controlar quantidade via estado reativo  
- Impedir valores negativos  
- Atualizar total automaticamente  

---

### 🔹 Finalização

Ao clicar em **"Fechar Pedido"**:

1. Validar todos os campos  
2. Exibir mensagem de sucesso  
3. Consolidar objeto final  
4. Exibir com `console.log()`  

---

### 🔹 Boas Práticas Adicionais

- Garantir acessibilidade mínima:
  - Labels associadas corretamente  
  - Uso de `required`  
  - Atributos `aria` quando necessário  

- Separar lógica de validação da UI  
- Manter código organizado e legível  

---

# 🎯 Conclusão Estratégica

As questões 10 e 12 avaliam implementação prática real.

Demonstram:

- Capacidade técnica full-stack  
- Organização arquitetural  
- Preocupação com segurança  
- Qualidade de UX  
- Maturidade profissional  

Executando essas tarefas com clareza estrutural e boas práticas, evidencia-se domínio técnico consistente e nível pleno real.