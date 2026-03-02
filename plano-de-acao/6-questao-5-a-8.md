# 💼 Catálogo de Produtos

## 🎓 Exercícios de 5 a 8

### 📌 Exercício 5 - Em uma aplicação Laravel utilizando MySQL (RDS), por que seria interessante usar Memcached ou ElasticCache? Como essas tecnologias ajudam na escalabilidade?

#### Definições
* **MySQL RDS:** Banco gerenciado na AWS.
* **Memcached:** Cache em memória simples.
* **ElastiCache:** Serviço gerenciado (Redis ou Memcached).

#### Comparação
* **Memcached:** Simples, volátil, estrutura chave-valor.
* **Redis (via ElastiCache):** Mais recursos, estruturas complexas, persistência opcional.

#### Resposta
Cache reduz:
1.  Carga no banco.
2.  Tempo de resposta.
3.  Custos operacionais.



#### Cenário Avaliado – Pensamento Estratégico
**Pergunta estratégica:** Se cache ainda não resolver?
**Alternativas:**
* Escalar horizontalmente.
* Read Replica.
* Filas.
* Revisão estrutural.

---

### 📌 Exercício 6 - Quais as vantagens e desvantagens em utilizar o Eloquent do Laravel? Existe algum possível problema recorrente (N+1 queries)?

#### Resposta
**Vantagens:**
* Produtividade e velocidade de desenvolvimento.
* Legibilidade do código.
* Facilidade na definição e uso de relacionamentos.

**Desvantagens:**
* **Problema N+1:** Queries geradas automaticamente que podem impactar a performance.
* Menor controle fino sobre a query SQL.
* Pode gerar queries ineficientes se mal utilizado.

**Solução para N+1:**
Resolver com Eager Loading usando o método `with()`.

---

### 📌 Exercício 7 - Explique como implementar um sistema de filas assíncronas no Laravel. Para que tipo de funcionalidades essa abordagem é útil?

#### Resposta
Sistema que executa tarefas fora do fluxo HTTP principal.

**Implementação:**
1.  Criar `Job`.
2.  `Dispatch` do job.
3.  `Worker` rodando em background.

**Uso:**
* Envio de E-mails.
* Processamento pesado de arquivos.
* Integrações externas (APIs de terceiros).

**Impacto:**
* Libera a request HTTP imediatamente para o usuário.
* Melhora performance percebida.



---

### 📌 Exercício 8 - Quando é interessante utilizar transactions?

#### Resposta
**Transaction:** Bloco de operações que devem ocorrer juntas (atomicidade).

**Uso:**
* Criar pedido + itens.
* Transferência financeira.
* Operações críticas onde todas as etapas devem ter sucesso ou nenhuma deve ser aplicada.

**Garante:**
* Integridade dos dados.
* Consistência do banco.

---

### 🔥 Pergunta Estratégica Final
**Se tivesse que escolher apenas uma prática para proteger sistema de alto tráfego?**
**Resposta:** Cache.
**Justificativa:** Maior impacto imediato e reduz dependência do banco.

---

### 📌 Conclusão Geral
Essa consolidação mostra:
* Pensamento arquitetural.
* Visão de escalabilidade.
* Separação de responsabilidades.
* Preocupação com performance.
* Maturidade em versionamento e defesa técnica fundamentada.