# 💼 Catálogo de Produtos

## 🎓 Exercícios Práticos 10 e 12

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

---

## 🚀 Orientação Profissional para Resolver

### 🔹 Estrutura da Migration

- `string nome`
- `text descricao`
- `decimal preco`
- `string imagem`
- `timestamps`

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