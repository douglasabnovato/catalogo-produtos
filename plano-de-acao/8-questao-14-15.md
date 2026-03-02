# 💼 Catálogo de Produtos

## 🎓 Exercícios 14 e 15

### 📌 Exercício 14 - Utilizando a estrutura de tabelas:

````sql
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
````

#### 📌 Análise da Questão
Avalia conhecimento em Joins, Group By, Funções de Agregação (SUM), Performance, Índices e uso correto do Eloquent.

#### 📌 Orientação Profissional para Resolver

1. Query para listar estados com maior volume de vendas:

````sql
SELECT 
    c.estado, 
    SUM(p.valor_total) AS total_vendas
FROM clientes c
JOIN pedidos p ON c.id = p.cliente_id
GROUP BY c.estado
ORDER BY total_vendas DESC;
````

2. Query para listar 5 clientes que mais compraram:

````sql
SELECT 
    c.nome, 
    SUM(p.valor_total) AS total_comprado
FROM clientes c
JOIN pedidos p ON c.id = p.cliente_id
GROUP BY c.id
ORDER BY total_comprado DESC
LIMIT 5;
````

3. Melhor forma de otimizar performance:

   - Criar índice em pedidos.cliente_id
   - Criar índice em clientes.estado
   - Utilizar EXPLAIN para validar uso de índices
   - Cache de consultas para dados pouco voláteis
   - Read Replica para cenários de alto tráfego

### 📌 Exercício 15 - Consultas Analíticas (Eloquent)

#### 🔷 Estrutura das Tabelas (Resumo)

**Produtos**
    - id
    - nome
    - fornecedor_id
    - categoria
    - preco_unit
    - data_aquisicao

**Fornecedores**
   - id
   - nome
   - pais
   - status

**Estoque**
  - id
  - produto_id
  - quantidade
  - data_contagem

##### 🔗 Relacionamentos Esperados no Laravel

    - Produto → belongsTo Fornecedor
    - Produto → hasOne Estoque

#### 🔷 1️⃣ Produtos com estoque abaixo da média geral

##### 📌 Estratégia

    - Calcular média geral da coluna quantidade na tabela estoque
    - Buscar produtos cujo estoque seja menor que essa média
    - Relacionar produto + estoque
    - Evitar N+1 queries

##### 📌 Eloquent

````php
    $mediaEstoque = DB::table('estoque')->avg('quantidade');

    $produtosAbaixoMedia = Produto::with('estoque')
        ->whereHas('estoque', function ($query) use ($mediaEstoque) {
            $query->where('quantidade', '<', $mediaEstoque);
        })
        ->get();   
````

##### 📌 Explicação

- Primeiro calculamos a média geral.
- Depois utilizamos whereHas para filtrar pelo relacionamento.
- O uso de with() evita problema de N+1 query e mantém performance adequada.

#### 🔷 2️⃣ Fornecedores com produtos acima da média da própria categoria

##### 📌 Estratégia

Calcular média por categoria.

Comparar preco_unit do produto com média da categoria.

Exibir: nome fornecedor, nome produto, categoria, preco_unit.

Ordenar por categoria e preço.

##### 📌 Eloquent com subquery

````php
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
````

##### 📌 Explicação

Usamos subquery correlacionada para comparar preço com média da própria categoria e join explícito para controle fino.

#### 🔷 3️⃣ Produtos mais recentes, de fornecedores do Brasil, com estoque acima da média geral

##### 📌 Estratégia
  - Média geral do estoque.
  - Filtrar fornecedores do Brasil.
  - Filtrar estoque acima da média.
  - Ordenar por data_aquisicao desc (mais recentes).

##### 📌 Eloquent

````php
    $mediaEstoque = DB::table('estoque')->avg('quantidade');

    $produtos = Produto::select('produtos.*')
        ->join('fornecedores', 'produtos.fornecedor_id', '=', 'fornecedores.id')
        ->join('estoque', 'produtos.id', '=', 'estoque.produto_id')
        ->where('fornecedores.pais', 'Brasil')
        ->where('estoque.quantidade', '>', $mediaEstoque)
        ->orderBy('produtos.data_aquisicao', 'desc')
        ->get();
````
##### 📌 Explicação

Join explícito para performance, filtros por país/estoque e ordenação por mais recente.

#### 🔷 Observações de Performance (Importante para Pleno)
Índices recomendados: estoque.produto_id, produtos.fornecedor_id, produtos.categoria, fornecedores.pais.

Consultas agregadas frequentes: Considerar cache, avaliar EXPLAIN e usar índice composto se necessário.

#### 🔷 Justificativa Técnica das Escolhas
Optei por Eloquent quando possível, join explícito em consultas complexas, subquery para média por categoria e whereHas para manter legibilidade. Isso demonstra entendimento de agregação, uso de subqueries e controle de performance.

#### 🔷 Conclusão Final
Essa questão avalia domínio de SQL, entendimento de agregações, uso correto de relacionamentos, capacidade de escrever consultas analíticas e pensamento orientado a dados.

#### 🎯 Conclusão Estratégica
As questões 10 a 14 avaliam: Implementação prática, Arquitetura, Crítica técnica, UX, Performance e Maturidade profissional. Se você executar essas com organização, clareza e fundamentação, você demonstra nível pleno real — não apenas conhecimento técnico isolado.