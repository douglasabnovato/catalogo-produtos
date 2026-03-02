📌 Estratégia de Branches (Git Flow Adaptado)

Você definiu:

main → Produção

develop → Integração

feature/* → Desenvolvimento de funcionalidades

release/* → Preparação de versão

hotfix/* → Correções urgentes

Isso é fluxo profissional real.

✅ Passo 1 — Criar branch develop

Se você já está na main:

git checkout main
git pull origin main
git checkout -b develop
git push -u origin develop

Agora você tem:

main
develop

✅ Passo 2 — Criar branch para implementar questões práticas

Exemplo para CRUD:

git checkout develop
git checkout -b feature/crud-produtos

Para checkout:

git checkout develop
git checkout -b feature/checkout-page
📌 Fluxo correto de trabalho

Criar branch feature a partir da develop

Implementar

Commitar incrementalmente

Push

Merge request para develop

Após validar tudo → merge develop → main

📌 Justificativa técnica (coloque no README)

## 🔁 Estratégia de Versionamento

O projeto utiliza um fluxo inspirado em Git Flow:

- `main`: branch estável e pronta para produção.
- `develop`: branch de integração das funcionalidades.
- `feature/*`: desenvolvimento de novas funcionalidades.
- `release/*`: preparação de versões.
- `hotfix/*`: correções emergenciais em produção.

Essa estrutura demonstra organização, controle de versões e preparação para ambientes colaborativos.
🎯 Por que isso é importante para o avaliador?

Porque você demonstra:

Organização

Previsibilidade

Separação de responsabilidades

Segurança antes de mergear

Mentalidade de time

Isso é nível pleno real.

⚠️ Dica estratégica

Para o teste técnico, você pode:

Manter main sempre estável

Desenvolver tudo via feature/*

Fazer commits claros:

Exemplo:

feat: implementa estrutura inicial do CRUD de produtos
feat: adiciona autenticação via sanctum
feat: implementa upload de imagem
fix: corrige validação de preço

Isso impressiona.