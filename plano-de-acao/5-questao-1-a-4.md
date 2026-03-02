# 💼 Catálogo de Produtos

## 🎓 Exercícios de 1 a 4

### 📌 Exercício 1 - Explique como funciona o ciclo de vida de um componente em Vue.js e como isso influencia na performance de uma aplicação.

#### Resposta Técnica
O ciclo de vida de um componente Vue envolve:
1.  **Criação:** Inicialização de dados e eventos.
2.  **Montagem (`mounted`):** Inserção no DOM.
3.  **Atualização (`updated`):** Re-renderização por mudança de estado.
4.  **Desmontagem (`unmounted`):** Limpeza de timers e listeners.

**Hooks importantes:**
* `onMounted()`
* `onUpdated()`
* `onUnmounted()`

**Impacto na performance:**
* Evitar chamadas desnecessárias no `mounted`.
* Evitar *watchers* excessivos.
* Controlar reatividade.



#### Discussão – Pensamento de Pleno
Você destacou:
* **Dividir componentes:** Componentes menores re-renderizam menos, são mais testáveis e reutilizáveis.
* **Evitar estado global desnecessário:** Estado global mal usado gera re-renderizações amplas e complexidade.
* **Controlar reatividade:** Evitar objetos gigantes reativos, *computed* mal estruturados e *watchers* excessivos.

#### Pergunta Adicional Levantada
**Quando usar Composition API ao invés de Options API?**
* **Resposta:** Composition API oferece melhor organização de lógica complexa, melhor reutilização e escalabilidade.

---

### 📌 Exercício 2 - Em aplicações Laravel + Vue.js, qual é a melhor abordagem para lidar com autenticação entre o frontend e o backend?

#### Resposta no Contexto do Projeto
**Fluxo seguro:**
1.  Login via API.
2.  Backend valida credenciais.
3.  Gera token (JWT ou Sanctum).
4.  Front armazena token (`httpOnly cookie` preferencialmente).
5.  Token enviado em requisições autenticadas.
6.  Backend valida middleware `auth`.

**Boas práticas:**
* Não usar `localStorage` para token sensível.
* Usar HTTPS.
* Middleware protegido.

#### Fundamentação
Demonstra segurança, conhecimento de arquitetura SPA + API e separação clara de camadas.

---

### 📌 Exercício 3 - Um endpoint da API está demorando muito para responder. Quais técnicas você usaria para identificar e resolver esse problema no backend?

#### Resposta Técnica
**Diagnóstico:**
* Logs.
* Query Log.
* `EXPLAIN` no MySQL.
* Monitoramento (APM).
* Análise de índices.

**Soluções:**
* Indexação.
* Eager Loading.
* Cache.
* Paginação.
* Read Replica.

#### Perguntas Estratégicas que Definimos
* Qual o tempo médio?
* P95 está aceitável?
* CPU do banco?
* Quantas queries por request?
* Há N+1?
* Existe index?

#### Pensamento Pleno
* **Júnior:** "Otimizar query."
* **Pleno:** "Reduzir dependência do banco."



---

### 📌 Exercício 4 - Como a utilização de CDN melhora a performance de uma aplicação web?

#### Resposta
**CDN (Content Delivery Network):** Rede distribuída de servidores.

**Benefícios:**
* Reduz latência (proximidade geográfica).
* Distribui carga.
* Cache de assets estáticos.
* Protege servidor principal.

**Impacto:**
* Melhora tempo de carregamento (`Time to First Byte`).
* Escalabilidade global.