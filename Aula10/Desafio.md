# 🏆 Desafio do Módulo 3 — Fundamentos PHP

> **Módulo:** 3 · Fundamentos PHP (fecha os tópicos **3.1 a 3.12**, trabalhados nas Aulas 01 a 08)
> **Entrega:** repositório próprio no GitHub, versionado com Git
> **Formato:** dois desafios independentes — resolva os dois

Este documento explica **exclusivamente** o desafio de fechamento do módulo. Não há
teoria nova aqui: se precisar revisar algum conceito, volte aos recaps das
[Aula 01](../Aula1/recap-aula-01.md) a [Aula 08](../Aula8/recap-aula-08.md).

---

## 📜 Regras (valem para os dois desafios)

### 1. Utilização do que foi ensinado até hoje

Só podem ser usados os recursos já vistos em aula (3.1 a 3.12):

- Saída de dados (`echo`), variáveis, constantes e operadores
- Tipos de dados e coerção de tipos
- Entrada de dados (`readline()`, `$_GET`/`$_POST` se optar por rodar no navegador)
- Condicionais (`if/elseif/else`, `switch`, ternário)
- Laços de repetição (`while`, `do-while`, `for`, `foreach`)
- Arrays indexados, associativos e multidimensionais
- Funções (parâmetros, argumentos, retorno, escopo, anônimas/closures)
- Manipulação de strings e funções nativas do PHP
- Debugging (`var_dump`, `print_r`)
- Getters e setters (a introdução a POO vista na Aula 08)

> [!WARNING]
> Nada de Programação Orientada a Objetos avançada, banco de dados, HTML/CSS/JS ou
> frameworks — isso vem nos módulos seguintes. Se a solução não sai só com a lista
> acima, está fugindo do desafio.

### 2. Criatividade

O tema de cada desafio abaixo é só um **ponto de partida**. Mude nomes, catálogo,
personagens, regras de negócio, mensagens — desde que a estrutura e os conceitos
obrigatórios continuem lá. Soluções idênticas às dos colegas serão devolvidas.

### 3. Versionado no GitHub

- Cada desafio deve estar em um repositório **seu** no GitHub (pode ser o mesmo
  repositório para os dois, em pastas separadas).
- **Histórico de commits real**: no mínimo um commit por etapa relevante (ex.: estrutura
  inicial, menu, cálculo, refino), nunca um único commit gigante no final.
- O repositório precisa ter um `README.md` curto explicando o que o programa faz e
  como executar (`php nome-do-arquivo.php`).

---

## 1️⃣ Desafio 1 — Loja de Bairro: carrinho de compras no terminal

**Objetivo:** simular o caixa de uma loja. O programa mostra um catálogo, o cliente
escolhe produtos e quantidades em um loop, e no final sai um recibo com total e
descontos.

**Requisitos mínimos:**

- Catálogo de produtos em **array multidimensional** (nome, preço, categoria — os
  itens e preços são livres, parte da criatividade).
- **Menu em loop** (`while`/`do-while`) que deixa o cliente adicionar produtos até
  escolher "finalizar".
- **Função** para calcular o subtotal de um item (`preço × quantidade`) e **função**
  para calcular o total do carrinho.
- **Condicional** aplicando desconto a partir de alguma regra sua (ex.: total acima de
  um valor, ou quantidade de itens).
- Carrinho guardado em **array associativo/indexado** durante a execução.
- **String formatada** para o recibo final (pode usar `number_format`).
- Tratar pelo menos **uma entrada inválida** (produto inexistente, quantidade ≤ 0) sem
  quebrar o programa.

---

## 2️⃣ Desafio 2 — RPG de texto: batalha por turnos

**Objetivo:** simular uma batalha entre dois personagens (jogador × inimigo, ou dois
jogadores) que trocam ataques por turnos até um deles ficar sem vida.

**Requisitos mínimos:**

- Cada personagem representado como **array associativo** ou **classe simples com
  getters/setters** (nome, vida, ataque, defesa — valores livres).
- **Função** de ataque que calcula o dano (`ataque − defesa`, por exemplo) e aplica na
  vida do oponente.
- **Laço** que repete os turnos **até a vida de um dos personagens chegar a zero**.
- **Condicional** para golpe especial/crítico com alguma chance ou regra sua
  (ex.: `rand()` combinado com `if`).
- **Função anônima/closure** para pelo menos uma habilidade especial (ex.: cura,
  ataque duplo).
- **Log de batalha** impresso a cada turno (string montada com os dados do turno).
- Mensagem final clara de quem venceu.

---

## ✅ Critérios de avaliação (os dois desafios)

- [ ] Usa **pelo menos 6** dos 10 conceitos listados na regra 1
- [ ] Programa roda do início ao fim sem erro fatal com entradas válidas
- [ ] Trata pelo menos um caso de entrada inválida sem quebrar
- [ ] Código organizado em **funções** (nada de tudo solto no escopo global)
- [ ] Tema/nomes/regras de negócio são **próprios**, não copiados do material de aula
- [ ] Repositório no GitHub com **README** e **mais de um commit**

---

## 🚀 Entrega (Git & GitHub)

```bash
git init                                   # se ainda não existir repositório
git add .
git commit -m "feat: estrutura inicial do desafio"
# ... siga commitando em etapas conforme avança ...
git branch -M main
git remote add origin <url-do-seu-repositorio>
git push -u origin main
```

Envie o link do repositório (ou do commit final) para o professor até a data combinada
em aula.

---

*Desafio de encerramento do Módulo 3 · Fundamentos PHP — Aula 10.*
*Professor: Luis Felipe Araujo Lima*
