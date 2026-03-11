# 💼 Catálogo de Produtos

## 🎓 Exercícios 14 e 15

### 📌 Exercício 14 - Utilizando a estrutura de tabelas:

Utilizando a seguinte estrutura de tabelas no MySQL para um banco de dados de vendas:

```sql
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
```

Utilizando o Eloquent do Laravel:

● Escreva uma query para listar os estados com o maior volume de vendas (soma de valor_total).
● Escreva uma query para listar os 5 clientes que mais compraram (considerando valor_total).
● Qual seria a melhor forma de otimizar a performance dessas consultas?

#### 📌 Análise da Questão

Avalia conhecimento em Joins, Group By, Funções de Agregação (SUM), Performance, Índices e uso correto do Eloquent.

#### Obervações

##### Relacionamento:

- Um cliente pode ter vários pedidos (1:N).
- Cada pedido pertence a um cliente (N:1).

##### Estrutura Eloquent

- Cliente::with('pedidos') → carrega clientes junto com seus pedidos.
- Pedido::with('cliente') → carrega pedidos junto com dados do cliente.

```php
// Model Cliente
class Cliente extends Model {
    public function pedidos() {
        return $this->hasMany(Pedido::class);
    }
}

// Model Pedido
class Pedido extends Model {
    public function cliente() {
        return $this->belongsTo(Cliente::class);
    }
}
```

#### 📌 Orientação Profissional para Resolver

1. Query para listar estados com maior volume de vendas:

Objetivo: 

- somar o valor total dos pedidos agrupados por estado.

SQL: 

- usa JOIN, SUM, GROUP BY.

```sql
SELECT
    c.estado,
    SUM(p.valor_total) AS total_vendas
FROM clientes c
JOIN pedidos p ON c.id = p.cliente_id
GROUP BY c.estado
ORDER BY total_vendas DESC;
```

```php
$estados = Cliente::select('estado', DB::raw('SUM(pedidos.valor_total) as total_vendas'))
    ->join('pedidos', 'clientes.id', '=', 'pedidos.cliente_id')
    ->groupBy('estado')
    ->orderByDesc('total_vendas')
    ->get();
```

Explicação:

- Junta clientes e pedidos.
- Agrupa por estado.
- Soma os valores.
- Ordena do maior para o menor.


2. Query para listar 5 clientes que mais compraram:

Objetivo: 

- identificar os clientes com maior gasto acumulado.

SQL: 

- GROUP BY cliente, SUM, LIMIT 5.

```sql
SELECT
    c.nome,
    SUM(p.valor_total) AS total_comprado
FROM clientes c
JOIN pedidos p ON c.id = p.cliente_id
GROUP BY c.id
ORDER BY total_comprado DESC
LIMIT 5;
```

```php
$topClientes = Cliente::select('clientes.nome', DB::raw('SUM(pedidos.valor_total) as total_comprado'))
    ->join('pedidos', 'clientes.id', '=', 'pedidos.cliente_id')
    ->groupBy('clientes.id', 'clientes.nome')
    ->orderByDesc('total_comprado')
    ->limit(5)
    ->get();
```

Explicação:

- Junta clientes e pedidos.
- Agrupa por cliente.
- Soma os valores.
- Ordena. 
- limita aos 5 primeiros.

3. Melhor forma de otimizar performance:

Objetivo: garantir que consultas sejam rápidas mesmo com muitos dados.

Estratégias:

   - Criar índice em pedidos.cliente_id >> acelera o join.
   - Criar índice em clientes.estado >> acelera agrupamento por estado.
   - Utilizar EXPLAIN para verificar se índices estão sendo usados.
   - Cache de consultas: 
     - guardar o resultado de uma query (consulta ao banco) em memória ou em um sistema de cache (Redis, Memcached). Assim, quando a mesma consulta é feita novamente, o sistema retorna o resultado já armazenado, sem precisar executar a query no banco.
     - Em consultas de relatórios ou dados que não mudam com frequência (ex.: ranking de clientes, volume de vendas por estado). Ideal para dados pouco voláteis, ou seja, que não se alteram a cada segundo.
   - Read Replica: é como ter clones do banco só para leitura, permitindo que relatórios e consultas pesadas não atrapalhem as operações críticas de escrita.
     - É uma cópia do banco de dados principal (master), mas usada apenas para operações de leitura. O banco principal continua recebendo escritas (INSERT, UPDATE, DELETE). As réplicas recebem essas alterações de forma assíncrona e ficam disponíveis para consultas (SELECT).
     - Em cenários de alto tráfego onde muitas consultas de leitura sobrecarregam o banco principal. Em relatórios e dashboards, que fazem muitas queries pesadas de leitura. Para distribuir carga entre múltiplos servidores e aumentar escalabilidade. 

### 📌 Exercício 15 - Consultas Analíticas (Eloquent)

#### 🔷 Estrutura das Tabelas (Resumo)

**Produtos** - id - nome - fornecedor_id - categoria - preco_unit - data_aquisicao

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

```php
    $mediaEstoque = DB::table('estoque')->avg('quantidade');

    $produtosAbaixoMedia = Produto::with('estoque')
        ->whereHas('estoque', function ($query) use ($mediaEstoque) {
            $query->where('quantidade', '<', $mediaEstoque);
        })
        ->get();
```

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

```php
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
```

##### 📌 Explicação

Usamos subquery correlacionada para comparar preço com média da própria categoria e join explícito para controle fino.

#### 🔷 3️⃣ Produtos mais recentes, de fornecedores do Brasil, com estoque acima da média geral

##### 📌 Estratégia

- Média geral do estoque.
- Filtrar fornecedores do Brasil.
- Filtrar estoque acima da média.
- Ordenar por data_aquisicao desc (mais recentes).

##### 📌 Eloquent

```php
    $mediaEstoque = DB::table('estoque')->avg('quantidade');

    $produtos = Produto::select('produtos.*')
        ->join('fornecedores', 'produtos.fornecedor_id', '=', 'fornecedores.id')
        ->join('estoque', 'produtos.id', '=', 'estoque.produto_id')
        ->where('fornecedores.pais', 'Brasil')
        ->where('estoque.quantidade', '>', $mediaEstoque)
        ->orderBy('produtos.data_aquisicao', 'desc')
        ->get();
```

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
