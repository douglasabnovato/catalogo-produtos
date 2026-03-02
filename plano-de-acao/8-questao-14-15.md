# 💼 Catálogo de Produtos

## 🎓 Exercícios 14 e 15

### 📌 Exercício 14 - Utilizando a estrutura de tabelas:

CREATE TABLE clientes (
 id INT PRIMARY KEY,
 nome VARCHAR(100),
 email VARCHAR(100),
 estado VARCHAR(50)
);

CREATE TABLE pedidos (
 id INT PRIMARY KEY,
 cliente_id INT,
 data_pedido DATE,
 valor_total DECIMAL(10,2),
 FOREIGN KEY (cliente_id) REFERENCES clientes(id)
);

Escreva:

Query para listar estados com maior volume de vendas

Query para listar 5 clientes que mais compraram

Melhor forma de otimizar performance

📌 Análise da Questão

Avalia:

Joins

Group By

Sum

Aggregations

Performance

Índices

Uso correto do Eloquent

📌 Orientação Profissional para Resolver

Estados com maior volume:

Join clientes + pedidos

groupBy estado

sum(valor_total)

orderBy desc

Top 5 clientes:

groupBy cliente

sum(valor_total)

orderBy desc

limit 5

Otimização:

Índice em cliente_id

Índice em estado

Análise via EXPLAIN

Cache de consulta

Read Replica se necessário

🎯 Conclusão Estratégica

As questões 10 a 14 avaliam:

Implementação prática

Arquitetura

Crítica técnica

UX

Performance

Maturidade profissional

Se você executar essas com organização, clareza e fundamentação, você demonstra nível pleno real — não apenas conhecimento técnico isolado.



15

Vou estruturar assim:

📌 Entendimento da modelagem

📌 Estratégia de cada consulta

📌 Query usando Eloquent

📌 Explicação técnica

📌 Observações de performance

🔷 Estrutura das Tabelas (Resumo)
Produtos

id

nome

fornecedor_id

categoria

preco_unit

data_aquisicao

Fornecedores

id

nome

pais

status

Estoque

id

produto_id

quantidade

data_contagem

Relacionamentos esperados no Laravel:

Produto belongsTo Fornecedor
Produto hasOne Estoque
🔷 1️⃣ Produtos com estoque abaixo da média geral
📌 Estratégia

Calcular média geral da coluna quantidade na tabela estoque

Buscar produtos cujo estoque seja menor que essa média

Relacionar produto + estoque

📌 Eloquent
$mediaEstoque = DB::table('estoque')->avg('quantidade');

$produtosAbaixoMedia = Produto::with('estoque')
    ->whereHas('estoque', function ($query) use ($mediaEstoque) {
        $query->where('quantidade', '<', $mediaEstoque);
    })
    ->get();
📌 Explicação

Primeiro calculamos a média

Depois usamos whereHas para filtrar relacionamento

Mantemos consulta performática

Evitamos N+1 usando with()

🔷 2️⃣ Fornecedores com produtos acima da média da própria categoria
📌 Estratégia

Calcular média por categoria

Comparar preço_unit do produto com média da categoria

Exibir:

nome fornecedor

nome produto

categoria

preco_unit

Ordenar por categoria e preço

Essa é uma consulta mais complexa.

📌 Eloquent com subquery
$produtos = Produto::select(
        'fornecedores.nome as fornecedor_nome',
        'produtos.nome as produto_nome',
        'produtos.categoria',
        'produtos.preco_unit'
    )
    ->join('fornecedores', 'produtos.fornecedor_id', '=', 'fornecedores.id')
    ->whereRaw('preco_unit > (
        SELECT AVG(p2.preco_unit)
        FROM produtos p2
        WHERE p2.categoria = produtos.categoria
    )')
    ->orderBy('produtos.categoria')
    ->orderBy('produtos.preco_unit', 'desc')
    ->get();
📌 Explicação

Usamos subquery correlacionada

Comparamos preço com média da própria categoria

Ordenamos conforme solicitado

Join explícito para controle fino

🔷 3️⃣ Produtos mais recentes, de fornecedores do Brasil, com estoque acima da média geral
📌 Estratégia

Média geral do estoque

Filtrar fornecedores do Brasil

Filtrar estoque acima da média

Ordenar por data_aquisicao desc (mais recentes)

📌 Eloquent
$mediaEstoque = DB::table('estoque')->avg('quantidade');

$produtos = Produto::select('produtos.*')
    ->join('fornecedores', 'produtos.fornecedor_id', '=', 'fornecedores.id')
    ->join('estoque', 'produtos.id', '=', 'estoque.produto_id')
    ->where('fornecedores.pais', 'Brasil')
    ->where('estoque.quantidade', '>', $mediaEstoque)
    ->orderBy('produtos.data_aquisicao', 'desc')
    ->get();
📌 Explicação

Join explícito para performance

Filtro por país

Filtro por estoque > média

Ordenação por mais recente

🔷 Observações de Performance (Importante para Pleno)

Recomendado criar índices:

estoque.produto_id

produtos.fornecedor_id

produtos.categoria

fornecedores.pais

Para consultas agregadas frequentes:

Considerar cache

Avaliar EXPLAIN

Usar índice composto se necessário

🔷 Justificativa Técnica das Escolhas

Optei por:

Eloquent quando possível

Join explícito em consultas complexas

Subquery para média por categoria

whereHas para manter legibilidade

Separar cálculo de média para clareza

Isso demonstra:

Entendimento de agregação

Uso de subqueries

Controle de performance

Conhecimento relacional

Organização de código

🔷 Conclusão Final

Essa questão avalia:

Domínio de SQL

Entendimento de agregações

Uso correto de relacionamentos

Capacidade de escrever consultas analíticas

Pensamento orientado a dados

Performance
