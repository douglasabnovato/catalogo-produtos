# 💼 Catálogo de Produtos

## 🎓 Exercícios 9, 11 e 13

### 📌 Exercício 9 - O que você entende do log abaixo?

#### 📌 Análise do Erro
O log apresenta um erro em ambiente de produção:
`production.ERROR: Call to a member function getImage() on null`

Trata-se de uma exceção fatal gerada ao tentar executar o método `getImage()` em uma variável cujo valor é `null`.

* **Arquivo:** `/admin/app/Models/Imagem.php:147`
* **Exception:** `Symfony\Component\Debug\Exception\FatalThrowableError`



#### 📌 Interpretação Técnica do Stack Trace
A análise do stack trace revela o seguinte fluxo:
1.  A requisição chega ao `ProdutoController->info()`.
2.  A resposta é processada pelo `ResponseFactory`.
3.  O `ProdutoTransformer` é executado.
4.  O `ImagemTransformer` é acionado.
5.  O método `getThumbs()` do Model Imagem é chamado.
6.  Dentro dele ocorre a chamada de `getImage()`.
7.  O objeto esperado é null.

#### 📌 Envolvimento do Cache
O log mostra chamadas para `Illuminate\Cache\Repository->rememberForever()`, indicando que a transformação estava sendo armazenada em cache. O erro ocorre durante a tentativa de gerar e armazenar o resultado em cache.

#### 📌 Causa Raiz
Ausência de programação defensiva ao lidar com relacionamentos opcionais. O código assume que o relacionamento sempre existe.

#### 📌 Correções Técnicas Recomendadas
1.  **Validação defensiva:** `if ($imagem) { return $imagem->getImage(); }`
2.  **Abordagem segura:** `optional($imagem)->getImage();`
3.  **Transformer:** Ajustar para lidar com ausência de imagem.
4.  **Banco de Dados:** Verificar integridade dos dados e foreign keys obrigatórias.
5.  **Testes:** Criar teste automatizado para cenário de produto sem imagem.

#### 📌 Prevenção Arquitetural Futura
* **Programação Defensiva:** Estabelecer como padrão para relacionamentos opcionais.
* **Padronização de Transformers:** Validar antes de acessar métodos.
* **Monitoramento:** Integrar Sentry ou Bugsnag.
* **Cache Resiliente:** Evitar armazenar dados inconsistentes e usar TTL adequado.

---

### 📌 Exercício 11 - Crítica de Código

```php
public function transform(InterfaceItemPedido $orderItem)
{
    return [
        'item_pedido_id' => $orderItem->getId(),
        'product_id' => $orderItem->getProductId(),
        'quantity' => $orderItem->getQuantity(),
        'price' => $orderItem->getPrice(),
        'total_price' => $orderItem->getTotalPrice(),
        'discount' => $orderItem->getDiscount(),
        'product_name' => $orderItem->getProduct()->getName(),
        'link_rewrite' => $orderItem->getProduct()->getLinkRewrite(),
        'size_name' => $orderItem->getSize()->getName(),
        'gender' => $orderItem->getSize()->getGender(),
        'gender_name' => $orderItem->getSize()->getLongGender(),
        'active' => $orderItem->getProduct()->isActive(),
        'type' => $orderItem->getProduct()->getType()
    ];
}
```

### 📌 Problemas Identificados
* Alto acoplamento a objetos internos.
* Múltiplas chamadas repetidas a `getProduct()`.
* Nenhuma validação defensiva (`null check`).
* Risco de N+1 se não houver eager loading no controller/repository.

### 📌 Orientação Profissional para Resolver
1.  **Utilizar variáveis intermediárias:**
    ```php
    $product = $orderItem->getProduct();
    $size = $orderItem->getSize();
    ```
2.  **Validar null** antes de acessar métodos.
3.  **Garantir eager loading**.
4.  **Considerar uso de API Resources** do Laravel para melhor estrutura.

---

### 📌 Exercício 13 - Experiência Profissional
Descreva um projeto desafiador em que você trabalhou recentemente como desenvolvedor full-stack.

### 📌 Orientação Profissional para Estruturar
* **Contexto:** Qual problema o projeto resolvia e qual era o objetivo?
* **Desafios:** Técnicos (arquiteturais, escalabilidade) ou de prazo?
* **Soluções:** Quais decisões técnicas foram tomadas (ex: por que Laravel/Vue) e trade-offs?
* **Impacto:** Métricas reais (redução de tempo, aumento de performance, satisfação do cliente).
* **Lições:** O que melhorou como profissional e o que faria diferente?