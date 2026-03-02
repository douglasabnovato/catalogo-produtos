# 💼 Catálogo de Produtos

## 🎓 Exercícios de 1 a 4 

### 📌 Exercício 1 - Explique como funciona o ciclo de vida de um componente em Vue.js e como isso influencia na performance de uma aplicação.

Resposta Técnica

O ciclo de vida de um componente Vue envolve:

Criação

Montagem (mounted)

Atualização (updated)

Desmontagem (unmounted)

Hooks importantes:

onMounted()

onUpdated()

onUnmounted()

Impacto na performance:

Evitar chamadas desnecessárias no mounted

Evitar watchers excessivos

Controlar reatividade

Discussão – Pensamento de Pleno

Você destacou:

Dividir componentes

Evitar estado global desnecessário

Controlar reatividade

Dividir componentes

Componentes menores:

Re-renderizam menos

São mais testáveis

São mais reutilizáveis

Evitar estado global desnecessário

Estado global mal usado:

Re-renderizações amplas

Complexidade

Controlar reatividade

Evitar:

Objetos gigantes reativos

Computed mal estruturados

Watchers excessivos

Pergunta adicional levantada

Quando usar Composition API ao invés de Options API?

Resposta:
Composition API:

Melhor organização de lógica complexa

Melhor reutilização

Escalabilidade

2 - Laravel + Vue.js
Texto Original

Em aplicações Laravel + Vue.js, qual é a melhor abordagem para lidar com autenticação entre o frontend e o backend?

Resposta no contexto do projeto

Fluxo seguro:

Login via API

Backend valida credenciais

Gera token (JWT ou Sanctum)

Front armazena token (httpOnly cookie preferencialmente)

Token enviado em requisições autenticadas

Backend valida middleware auth

Boas práticas:

Não usar localStorage para token sensível

Usar HTTPS

Middleware protegido

Fundamentação

Demonstra:

Segurança

Conhecimento de arquitetura SPA + API

Separação clara de camadas

3 - APIs
Texto Original

Um endpoint da API está demorando muito para responder. Quais técnicas você usaria para identificar e resolver esse problema no backend?

Resposta Técnica

Diagnóstico:

Logs

Query Log

EXPLAIN no MySQL

Monitoramento (APM)

Análise de índices

Soluções:

Indexação

Eager Loading

Cache

Paginação

Read Replica

Perguntas Estratégicas que definimos

Qual o tempo médio?

P95 está aceitável?

CPU do banco?

Quantas queries por request?

Há N+1?

Existe index?

Pensamento Pleno

Júnior:
“Otimizar query.”

Pleno:
“Reduzir dependência do banco.”

4 - Integrações
Texto Original

Como a utilização de CDN melhora a performance de uma aplicação web?

Resposta

CDN:
Rede distribuída de servidores.

Benefícios:

Reduz latência

Distribui carga

Cache de assets

Protege servidor principal

Impacto:

Melhora tempo de carregamento

Escalabilidade global