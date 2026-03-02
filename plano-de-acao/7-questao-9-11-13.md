# 💼 Catálogo de Produtos

## 🎓 Exercícios 9, 11 e 13

### 📌 Exercício 9 - O que você entende do log abaixo?
📌 Análise do Erro

O log apresenta um erro em ambiente de produção:

production.ERROR: Call to a member function getImage() on null

Trata-se de uma exceção fatal gerada ao tentar executar o método getImage() em uma variável cujo valor é null.

O erro ocorre no arquivo:

/admin/app/Models/Imagem.php:147

A exception registrada é do tipo:

Symfony\Component\Debug\Exception\FatalThrowableError

Isso indica que a aplicação não tratou adequadamente a situação antes da chamada do método, resultando na interrupção da execução.

📌 Interpretação Técnica do Stack Trace

A análise do stack trace revela o seguinte fluxo:

A requisição chega ao ProdutoController->info()

A resposta é processada pelo ResponseFactory

O ProdutoTransformer é executado

O ImagemTransformer é acionado

O método getThumbs() do Model Imagem é chamado

Dentro dele ocorre a chamada de getImage()

O objeto esperado é null

O erro fatal é disparado

Ou seja, o problema ocorre durante a transformação dos dados antes do retorno da resposta da API.

📌 Envolvimento do Cache

O log mostra chamadas para:

Illuminate\Cache\Repository->rememberForever()

Isso indica que a transformação estava sendo armazenada em cache.

Possível cenário:

O produto não possui imagem associada.

O código assume que o relacionamento sempre existe.

O método é chamado sem validação prévia.

O erro ocorre durante a tentativa de gerar e armazenar o resultado em cache.

Como o erro ocorre em produção e dentro de uma operação de cache persistente, o impacto pode afetar múltiplas requisições.

📌 Causa Raiz

A causa mais provável é ausência de programação defensiva ao lidar com relacionamentos opcionais.

Exemplo do problema:

$imagem->getImage();

Sem verificar se $imagem é um objeto válido.

📌 Correções Técnicas Recomendadas

Implementar validação antes da chamada:

if ($imagem) {
    return $imagem->getImage();
}

Ou utilizar abordagem mais segura:

optional($imagem)->getImage();

Ajustar o Transformer para lidar com ausência de imagem.

Verificar integridade dos dados no banco.

Avaliar necessidade de foreign keys obrigatórias.

Criar teste automatizado para cenário de produto sem imagem.

📌 Impacto Arquitetural

Esse erro evidencia alguns pontos importantes:

Suposição incorreta de integridade de dados

Falta de tratamento para cenários alternativos

Ausência de resiliência na camada de transformação

Risco ampliado devido ao uso de cache persistente

Em sistemas reais, é fundamental assumir que dados podem estar ausentes e que APIs devem responder de forma segura mesmo em cenários inesperados.

📌 Prevenção Arquitetural Futura

Além da correção pontual, é importante evoluir a arquitetura para evitar recorrência desse tipo de falha.

Algumas medidas estruturais recomendadas:

🔹 1. Programação Defensiva como Padrão

Estabelecer como regra de projeto que relacionamentos opcionais sempre devem ser tratados explicitamente.

🔹 2. Padronização de Transformers

Criar convenções claras para Transformers:

Nunca assumir que relacionamentos existem.

Sempre validar antes de acessar métodos.

🔹 3. Monitoramento de Produção

Integrar ferramentas como Sentry ou Bugsnag para:

Detectar rapidamente falhas

Mapear recorrência

Priorizar correções

🔹 4. Testes Automatizados para Cenários Limite

Criar testes que validem:

Produto sem imagem

Dados inconsistentes

Respostas da API em cenários incompletos

🔹 5. Estratégia de Cache Resiliente

Evitar armazenar em cache respostas geradas a partir de dados inconsistentes.
Avaliar uso de:

TTL adequado

Invalidação controlada

Fallback seguro

📌 Conclusão

O log indica uma falha causada por chamada de método em objeto nulo durante a transformação da resposta da API, envolvendo camada de cache.

A solução envolve:

Tratamento defensivo de null

Revisão de integridade de dados

Ajustes na camada de transformação

Implementação de testes preventivos

Evolução arquitetural para maior resiliência

Essa análise demonstra capacidade de leitura de stack trace, entendimento do fluxo completo da aplicação, visão arquitetural e preocupação com estabilidade em produção.



🔷 11 - Crítica de Código
📝 Texto Original

Critique o código abaixo e como poderia ser melhorado:

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
📌 Análise da Questão

Avalia:

Leitura crítica de código

Identificação de acoplamento

Prevenção de erros null

Performance (N+1)

Organização e boas práticas

📌 Problemas Identificados

Alto acoplamento a objetos internos

Múltiplas chamadas repetidas a getProduct()

Nenhuma validação defensiva

Risco de erro se relacionamento for null

Possível N+1 se não houver eager loading

Responsabilidade excessiva no transformer

📌 Orientação Profissional para Resolver

Utilizar variáveis intermediárias:

$product = $orderItem->getProduct();
$size = $orderItem->getSize();

Validar null antes de acessar métodos.

Garantir eager loading no repository ou controller.

Considerar uso de API Resources.

Manter transformer focado apenas em transformação, não em lógica complexa.


🔷 13 - Experiência Profissional
📝 Texto Original

Descreva um projeto desafiador em que você trabalhou recentemente como desenvolvedor full-stack.
Inclua: Contexto, Desafios, Soluções, Impacto, Lições Aprendidas.

📌 Análise da Questão

Avalia:

Comunicação técnica

Capacidade de liderança

Pensamento estratégico

Resolução de problemas

Impacto mensurável

📌 Orientação Profissional para Resolver

Estruture assim:

Contexto:

Qual problema o projeto resolvia

Qual era o objetivo

Desafios:

Técnicos

Arquiteturais

Prazo

Escalabilidade

Soluções:

Quais decisões técnicas

Por que escolheu Laravel/Vue

Quais trade-offs

Impacto:

Métricas reais

Redução de tempo

Aumento de performance

Satisfação do cliente

Lições:

O que aplicaria diferente

O que melhorou como profissional