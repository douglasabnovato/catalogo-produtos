# 💼 Catálogo de Produtos

## 🎓 Exercícios de 5 a 8

### 📌 Exercício 5 - Em uma aplicação Laravel utilizando MySQL (RDS), por que seria interessante usar Memcached ou ElasticCache? Como essas tecnologias ajudam na escalabilidade?

Definições

MySQL RDS:
Banco gerenciado na AWS.

Memcached:
Cache em memória simples.

ElastiCache:
Serviço gerenciado (Redis ou Memcached).

Comparação

Memcached:

Simples

Volátil

Estrutura chave-valor

Redis (via ElastiCache):

Mais recursos

Estruturas complexas

Persistência opcional

Resposta

Cache reduz:

Carga no banco

Tempo de resposta

Custos

Cenário Avaliado

Pergunta estratégica:
Se cache ainda não resolver?

Alternativas:

Escalar horizontalmente

Read Replica

Filas

Revisão estrutural

6 - Eloquent
Texto Original

Quais as vantagens e desvantagens em utilizar o Eloquent do Laravel? Existe algum possível problema recorrente (N+1 queries)?

Resposta

Vantagens:

Produtividade

Legibilidade

Relacionamentos fáceis

Desvantagens:

N+1

Menor controle fino

Pode gerar queries ineficientes

N+1:
Resolver com eager loading:

with()

7 - Filas Assíncronas
Texto Original

Explique como implementar um sistema de filas assíncronas no Laravel. Para que tipo de funcionalidades essa abordagem é útil?

Resposta

Sistema que executa tarefas fora do fluxo HTTP.

Implementação:

Criar Job

Dispatch

Worker rodando

Uso:

Emails

Processamento pesado

Integrações externas

Impacto:

Libera request

Melhora performance percebida

8 - Transactions
Texto Original

Quando é interessante utilizar transactions?

Resposta

Transaction:
Bloco de operações que devem ocorrer juntas.

Uso:

Criar pedido + itens

Transferência financeira

Operações críticas

Garante:

Integridade

Consistência

🔥 Pergunta Estratégica Final

Se tivesse que escolher apenas uma prática para proteger sistema de alto tráfego?

Resposta:
Cache.

Maior impacto imediato.
Reduz dependência do banco.

📌 Conclusão Geral

Essa consolidação mostra:

Pensamento arquitetural

Visão de escalabilidade

Separação de responsabilidades

Preocupação com performance

Maturidade em versionamento

Defesa técnica fundamentada