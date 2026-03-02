# 💼 Catálogo de Produtos - Planejamento e Estratégia

## 🎓 Análise e Preparação para o Desafio

### 📌 Objetivo

Este projeto foi desenvolvido como resposta a um desafio técnico Full Stack com foco em:

* Organização arquitetural.
* Boas práticas de desenvolvimento.
* Clareza na separação de responsabilidades.
* Performance e escalabilidade.
* Segurança.
* Qualidade de código.
* Capacidade analítica (SQL e arquitetura).

> **Premisa:** Mais do que implementar funcionalidades, o objetivo foi estruturar decisões técnicas de forma consciente e justificável.

---

## 🏗️ Arquitetura Geral

### Backend

* **Framework:** Laravel.
* **Tipo:** API RESTful.
* **Segurança:** Autenticação protegendo rotas sensíveis.
* **ORM:** Eloquent.
* **Estrutura:** Baseada em responsabilidades claras (MVC + Services).

### Frontend

* **Framework:** Vue.js.
* **Tipo:** SPA (Single Page Application) com consumo de API REST.
* **Organização:** Componentização e controle de estado local.
* **UX:** Validações robustas e feedback visual para o usuário.

---

## 🔐 Segurança Aplicada

Foram consideradas as seguintes práticas:

1.  **Autenticação obrigatória** para operações de modificação (create, update, delete).
2.  **Middleware de proteção** de rotas (Sanctum).
3.  **Validação server-side** rigorosa.
4.  **Controle de permissões** e prevenção contra acesso indevido a recursos.
5.  **Tratamento seguro** de upload de imagem.

> **Evolução Arquitetural:** O sistema foi desenhado para evoluir para Rate limiting, Cache estruturado e monitoramento.

---

## ⚡ Performance e Escalabilidade

Durante a análise técnica, foram considerados:

* Uso de **Eager Loading** (`with()`) para evitar o problema de N+1.
* Uso de **agregações no banco** ao invés de processamento em memória.
* Uso de **índices** para consultas agregadas e ordenação adequada em consultas analíticas.
* Subqueries otimizadas para média e comparação.

> **Cenário de Alta Carga:** Identificação de bottlenecks (CPU, I/O, banco), uso de filas assíncronas e eventual decomposição em serviços.

---

## 📦 Funcionalidades Implementadas

### 1️⃣ CRUD de Produtos

* **Campos:** Nome, Descrição, Preço, Imagem.
* **Regras:** Apenas usuários autenticados podem modificar dados.
* **Técnico:** Validação completa no backend e interface reativa no frontend.

### 2️⃣ Página de Finalização de Compra (Checkout)

* Produtos *hardcoded* no carrinho.
* Alteração dinâmica de quantidade.
* **Validações:** Formatos de E-mail, Telefone, Cartão, Data, CVC e CEP.
* **UX:** Busca automática de endereço via CEP (`cep-promise`), indicadores de carregamento e mensagem de sucesso.
* **Debug:** Exibição do objeto final no console ao finalizar pedido.

---

## 🗄️ Análises SQL (Eloquent)

Queries desenvolvidas com foco em eficiência, clareza e redução de processamento:

1.  Estados com maior volume de vendas.
2.  Top 5 clientes com maior valor total.
3.  Produtos com estoque abaixo da média.
4.  Fornecedores com produtos acima da média da categoria.
5.  Produtos recentes de fornecedores do Brasil com estoque acima da média.

---

## 🧩 Análise Crítica de Código

Análise de um transformer que acessava múltiplas relações, identificando:
* Risco de N+1 e acoplamento excessivo.
* Ausência de *null safety* e separação de responsabilidade.

> **Melhorias Sugeridas:** Eager loading, uso de Resource classes, padrão defensive programming e implementação de DTOs.

---

## 🎯 Decisões Arquiteturais e Lições Aprendidas

As decisões priorizaram manutenibilidade e escalabilidade futura:

* **MVP:** Implementar o MVP corretamente garantindo uma base sólida.
* **Modelagem:** Performance começa na modelagem do banco.
* **UX:** UX faz parte da qualidade técnica.

---

## 🚀 Conclusão

Este projeto foi conduzido como exercício de arquitetura, focando na demonstração de pensamento pleno e estruturação profissional de soluções.

> **Visão de Futuro:** A base construída permite evolução para cache estruturado, filas, escalabilidade horizontal e monitoramento.

---

## 📌 Discussão Estratégica Sobre os Requisitos

### 1️⃣ Repositório Git

#### 📌 Estratégia de Branches (o Meu Git Flow )

Definições:

- main → Produção
- develop → Integração
- feature/* → Desenvolvimento de funcionalidades
- release/* → Preparação de versão
- hotfix/* → Correções urgentes

Isso é fluxo profissional real.

* **Justificativa:** Demonstra maturidade de versionamento e fluxo colaborativo.

### 2️⃣ Boas Práticas

* **Backend:** Controllers enxutos, Services, Validações via FormRequest, Eager Loading.
* **Frontend:** Componentização clara, reatividade controlada.

### 3️⃣ README

* Estrutura contendo: Como rodar, variáveis de ambiente, decisões arquiteturais, justificativa da stack e melhorias futuras.

### 4️⃣ Personalização (Tailwind + LESS)

* **Decisão:** Usar Tailwind para Layout/Responsividade e LESS para variáveis globais e customizações estruturais.
* **Justificativa:** Maior controle visual e alinhamento com Vue moderno, atendendo à personalização exigida pelo requisito de LESS.