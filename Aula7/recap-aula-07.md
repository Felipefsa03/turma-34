# 📘 Recap da Aula 07 — Laços de Repetição na Prática

> **Tema da aula:** *Estruturas de repetição (3.6) — `while`, `do-while`, `for` e `foreach`*
> **Base:** continuação do tópico **3.6** apresentado na Aula 05
> **Módulo:** 3 · Fundamentos PHP
> **Público-alvo:** iniciantes, quem faltou e quem quer fixar o assunto antes do próximo encontro.

**Objetivo:** sair da teoria e **dominar os quatro laços do PHP**. Aqui não basta saber que os laços existem: você precisa escolher o laço certo para cada problema, controlar sua parada e evitar o temido **loop infinito**.

> [!TIP]
> A introdução a este tema ficou na [`Aula 05`](../Aula5/recap-aula-05.md) (slide 10). Nesta aula colocamos **3.6 na prática**, como indicado no [`index.php`](index.php) executável.

---

## 🗺️ Mapa da Aula

Use este guia para navegar. Cada bloco traz explicação curta, código e a **saída esperada**.

| # | Tópico | O que você aprende | Laço principal |
|:-:|--------|-------------------|:--------------:|
| 3.6.1 | 🔄 [while](#-361-while) | repete **enquanto** a condição for verdadeira | `while` |
| 3.6.2 | 🔁 [do-while](#-362-do-while) | executa **ao menos uma vez** antes de testar | `do-while` |
| 3.6.3 | 🔢 [for](#-363-for) | contagem controlada com início, condição e incremento | `for` |
| 3.6.4 | 📦 [foreach](#-364-foreach) | percorre arrays item por item | `foreach` |
| ➕ | 🛑 [`break` e `continue`](#-break-e-continue) | interromper ou pular repetições | todos |
| ➕ | 🧮 [Acumuladores](#-acumuladores-e-contadores) | somar/contar valores dentro do laço | todos |
| ➕ | 🧱 [Laços aninhados](#-laços-aninhados) | um laço dentro do outro | `for` |
| ➕ | 🐞 [Loop infinito](#-o-perigo-do-loop-infinito) | o erro mais comum de quem começa | todos |

> [!IMPORTANT]
> O código completo e executável de tudo que foi visto está em **[`index.php`](index.php)** desta pasta.
> Rode com `php index.php` (terminal) ou `php -S localhost:8000` (navegador).
> O exemplo interativo roda com `php index.php input`.

---

## 💡 Por que usar laços?

Repetir o mesmo comando "na mão" é trabalhoso e propenso a erro:

```php
echo "1 ";
echo "2 ";
echo "3 ";
// ... e se fossem 1000 números?
```

Com um laço, escrevemos a **regra uma única vez** e o computador repete:

```php
for ($i = 1; $i <= 1000; $i++) {
    echo "$i ";
}
```

> [!NOTE]
> Laço = **repetição controlada**. A grande pergunta é sempre: **quando parar?** Todo laço precisa de uma condição que, em algum momento, se torne **falsa**.

---

## 🔄 3.6.1 `while`

**Testa a condição ANTES** de executar. Se a condição já for falsa, o bloco **não roda nenhuma vez**.

```php
$i = 1;
while ($i <= 5) {
    echo "Contando: $i\n";
    $i++;              // ⚠️ sem isso, o laço nunca termina
}
```

**Saída:**

```text
Contando: 1
Contando: 2
Contando: 3
Contando: 4
Contando: 5
```

| Parte | Papel |
|-------|-------|
| `$i = 1` | **Inicialização** (antes do laço) |
| `$i <= 5` | **Condição** (testada a cada volta) |
| `$i++` | **Atualização** (dentro do bloco) |

> [!WARNING]
> **A atualização tem que estar dentro do bloco.** Esquecer o `$i++` é a causa nº 1 de loop infinito.

---

## 🔁 3.6.2 `do-while`

**Executa o bloco ANTES** de testar. Por isso, roda **ao menos uma vez**, mesmo que a condição já seja falsa.

```php
$tentativa = 1;
do {
    echo "Tentativa $tentativa\n";
    $tentativa++;
} while ($tentativa <= 3);
```

**Saída:**

```text
Tentativa 1
Tentativa 2
Tentativa 3
```

**Diferença crucial** — repare neste caso:

```php
$numero = 10;
do {
    echo "Roda uma vez mesmo com $numero > 5\n";
} while ($numero <= 5);
```

**Saída:**

```text
Roda uma vez mesmo com 10 > 5
```

A condição `10 <= 5` já era falsa, mas o bloco **executou uma vez**.

### 🔍 `while` × `do-while`

```text
   while ($i <= 5)          do { ... } while ($i <= 5)
   ┌──────────────┐         ┌──────────────┐
   │ testa ANTES  │         │ executa 1x   │
   └──────┬───────┘         └──────┬───────┘
          │ true                     │
   ┌──────▼───────┐         ┌──────▼───────┐
   │   bloco      │         │   testa      │
   └──────┬───────┘         └──────┬───────┘
          │                        │ true volta
          └── volta ◄──────────────┘
```

| Laço | Testa… | Pode executar 0 vezes? |
|------|--------|:----------------------:|
| `while` | **antes** | ✅ Sim |
| `do-while` | **depois** | ❌ Não — sempre ≥ 1 |

> [!TIP]
> Use `do-while` quando o bloco **precisa** rodar pelo menos uma vez (ex.: mostrar um menu, pedir um dado e só então validar).

---

## 🔢 3.6.3 `for`

Ideal quando se **sabe quantas vezes** repetir. Junta as três partes em uma linha:

```text
for ( inicialização ; condição ; incremento )
          │              │           │
      $i = 1        $i <= 5        $i++
```

```php
for ($i = 1; $i <= 5; $i++) {
    echo "Volta $i\n";
}
```

**Contagem regressiva:**

```php
for ($i = 5; $i >= 1; $i--) {
    echo "$i...\n";
}
echo "Fim!\n";
```

**Tabuada do 7:**

```php
for ($i = 1; $i <= 10; $i++) {
    echo "7 x $i = " . (7 * $i) . "\n";
}
```

**Saída (trecho):**

```text
7 x 1 = 7
7 x 2 = 14
...
7 x 10 = 70
```

> [!NOTE]
> As três partes são **opcionais** e podem ficar vazias (`for (;;)` vira loop infinito de propósito), mas **a condição de parada** deve estar sempre clara.

---

## 📦 3.6.4 `foreach`

Percorre **cada item de um array**. Não controlamos índice nem contador — o PHP faz isso sozinho.

```php
$frutas = ["Maçã", "Banana", "Uva", "Laranja"];

foreach ($frutas as $fruta) {
    echo "Fruta: $fruta\n";
}
```

**Saída:**

```text
Fruta: Maçã
Fruta: Banana
Fruta: Uva
Fruta: Laranja
```

**Com a chave (posição) do array:**

```php
foreach ($frutas as $indice => $fruta) {
    echo "$indice: $fruta\n";
}
```

**Saída:**

```text
0: Maçã
1: Banana
2: Uva
3: Laranja
```

> [!IMPORTANT]
> `foreach` é o laço **mais usado no dia a dia** — toda vez que você tiver uma lista (produtos, usuários, notas), ele é a escolha natural. Ele será essencial quando chegarmos em **arrays (3.7)**.

---

## 🛑 `break` e `continue`

Duas palavras que mudam o fluxo **de dentro** do laço:

| Palavra | Efeito |
|---------|--------|
| `break` | **Interrompe** o laço por completo |
| `continue` | **Pula** a volta atual e vai para a próxima |

```php
for ($i = 1; $i <= 10; $i++) {
    if ($i == 5) {
        break;              // para tudo ao chegar no 5
    }
    echo "break -> $i\n";   // imprime 1, 2, 3, 4
}

for ($i = 1; $i <= 5; $i++) {
    if ($i == 2 || $i == 4) {
        continue;           // "pula" o 2 e o 4
    }
    echo "continue -> $i\n"; // imprime 1, 3, 5
}
```

> [!TIP]
> Use `break` para **parar quando encontrou** o que queria (ex.: achou o usuário na lista → não precisa continuar procurando). Use `continue` para **ignorar casos** e seguir com o resto.

---

## 🧮 Acumuladores e contadores

Dois padrões que aparecem em quase todo programa:

```php
$notas = [7.5, 8.0, 6.5, 9.0];
$soma  = 0;

foreach ($notas as $nota) {
    $soma += $nota;        // acumulador: soma = soma + nota
}

$media = $soma / count($notas);
echo "Soma:  $soma\n";                       // 31
echo "Média: " . number_format($media, 2);   // 7.75
```

| Padrão | Ideia | Exemplo |
|--------|-------|---------|
| **Contador** | conto quantos itens | `$total++` |
| **Acumulador** | somo os valores | `$soma += $valor` |
| **Maior/menor** | guardo o extremo | `if ($n > $maior) $maior = $n;` |

> [!NOTE]
> Sempre **inicie** contadores e acumuladores antes do laço (`$soma = 0;`). Esquecer isso gera valores errados ou avisos.

---

## 🧱 Laços aninhados

Um laço **dentro** de outro. Para cada volta do externo, o interno percorre tudo:

```php
for ($linha = 1; $linha <= 3; $linha++) {
    for ($coluna = 1; $coluna <= 3; $coluna++) {
        echo "($linha,$coluna) ";
    }
    echo "\n";
}
```

**Saída:**

```text
(1,1) (1,2) (1,3)
(2,1) (2,2) (2,3)
(3,1) (3,2) (3,3)
```

> [!WARNING]
> Laços aninhados crescem **muito rápido** (o interno roda N × M vezes). Use com cuidado para não travar o programa.

---

## 🎯 Laço + condição: FizzBuzz

Combinando repetição (`for`) com decisão (`if/elseif`):

```php
for ($i = 1; $i <= 15; $i++) {
    if ($i % 3 == 0 && $i % 5 == 0) {
        echo "FizzBuzz\n";
    } elseif ($i % 3 == 0) {
        echo "Fizz\n";
    } elseif ($i % 5 == 0) {
        echo "Buzz\n";
    } else {
        echo "$i\n";
    }
}
```

**Saída:**

```text
1
2
Fizz
4
Buzz
Fizz
7
8
Fizz
Buzz
11
Fizz
13
14
FizzBuzz
```

---

## 🐞 O perigo do loop infinito

Acontece quando a condição **nunca fica falsa**. O programa trava consumindo CPU.

```php
// ❌ NUNCA TERMINA — esqueceu o incremento
$i = 1;
while ($i <= 5) {
    echo $i;
}
```

```php
// ❌ NUNCA TERMINA — o incremento não afeta a condição
$i = 1;
while ($i <= 5) {
    $j = $i + 1;   // $i continua 1 para sempre
}
```

```php
// ✅ CERTO
$i = 1;
while ($i <= 5) {
    echo $i;
    $i++;          // atualização correta
}
```

### 🧭 Checklist contra loop infinito

1. Existe uma **variável de controle** (`$i`)?
2. Ela é **alterada** dentro do laço?
3. A alteração aproxima a condição de **falso**?
4. A condição está bem escrita (`<=`, `!=`, `>`, …)?

> [!WARNING]
> Se o terminal "travar" mostrando números sem parar, use **`Ctrl + C`** para interromper. No navegador, pare o servidor PHP.

---

## 🧾 Visão geral: quando usar cada laço?

| Situação | Melhor laço |
|----------|-------------|
| Não sei quantas vezes — repito **enquanto** algo acontece | `while` |
| Preciso rodar **ao menos uma vez** (menu, validação) | `do-while` |
| Sei **quantas** vezes repetir (contagem, tabuada) | `for` |
| Preciso **percorrer um array** | `foreach` |
| Quero **parar** ao achar o que procura | `break` em qualquer um |
| Quero **ignorar** alguns casos | `continue` em qualquer um |

```text
┌───────────────────────────────────────────────────────────────┐
│  Não sei o número exato de repetições?                        │
│        └── Testa antes?  →  while                             │
│        └── Roda sempre 1x?  →  do-while                       │
│  Sei quantas vezes?  →  for                                   │
│  Tenho uma lista/array?  →  foreach                           │
└───────────────────────────────────────────────────────────────┘
```

---

## ✅ O que avançamos hoje

```text
┌─────────────────────────────────┐
│            APRENDEMOS            │
├─────────────────────────────────┤
│ • while      (testa antes)       │
│ • do-while   (executa 1x)        │
│ • for        (contagem)          │
│ • foreach    (percorre arrays)   │
│ • break / continue               │
│ • Acumuladores e contadores      │
│ • Laços aninhados                │
│ • Evitar loops infinitos         │
└─────────────────────────────────┘
```

---

## 🧠 Teste seu conhecimento

1. Qual a diferença entre `while` e `do-while`?
2. Quantas vezes o corpo de um `while` executa se a condição começar falsa?
3. O que acontece se você esquecer o `$i++` dentro do `while`?
4. Em que situação o `for` é melhor que o `while`?
5. Para que serve o `foreach`? Ele controla índice?
6. Qual a diferença entre `break` e `continue`?
7. O que o `$soma += $nota` faz? Como se chama esse padrão?
8. Quantas vezes o bloco interno roda em dois `for` de 1 a 3 (aninhados)?
9. Escreva um `for` que some os números de 1 a 100.
10. Como parar um programa que entrou em loop infinito no terminal?

<details>
<summary>🔎 Clique para ver as respostas</summary>

1. `while` testa a condição **antes** de executar; `do-while` testa **depois**, por isso executa ao menos uma vez.
2. **Nenhuma** — o `while` pode executar 0 vezes.
3. A condição nunca fica falsa → **loop infinito**.
4. Quando você **sabe quantas vezes** repetir (contagem controlada).
5. Percorrer **cada item de um array**. Ele **não** exige índice — o PHP controla isso sozinho.
6. `break` **interrompe** o laço; `continue` **pula** a volta atual e vai para a próxima.
7. Soma `$nota` ao valor atual de `$soma` (equivale a `$soma = $soma + $nota`). É um **acumulador**.
8. **9 vezes** (3 × 3) — o interno roda por completo para cada volta do externo.
9. ```php
   $soma = 0;
   for ($i = 1; $i <= 100; $i++) {
       $soma += $i;
   }
   echo $soma;   // 5050
   ```
10. Pressione **`Ctrl + C`** no terminal para interromper a execução.

</details>

---

## 🗺️ Checklist de Estudos

### 🔴 Imprescindível — Aula 07

- [ ] Escrever um `while` com variável de controle e incremento
- [ ] Explicar quando o `do-while` executa ao menos uma vez
- [ ] Escrever um `for` com início, condição e incremento
- [ ] Percorrer um array com `foreach` (com e sem chave)
- [ ] Usar `break` para interromper e `continue` para pular
- [ ] Criar acumuladores (`+=`) e contadores (`++`)
- [ ] Escrever laços aninhados (linha × coluna)
- [ ] Reconhecer e **evitar** um loop infinito
- [ ] Escolher o laço certo para cada situação

### 🟡 Revisão — Aulas anteriores

- [ ] **Aula 05:** introdução aos laços (slide 10) + revisão 3.1–3.5
- [ ] **Aula 04:** tipos, coerção, `$_POST`/`$_GET` e condicionais
- [ ] **Aula 03:** saída de dados, variáveis, constantes e operadores
- [ ] **Aula 01:** ciclo **Entrada → Processamento → Saída**

### 🟢 Próximos passos

- [ ] **3.7 Arrays** — indexados, associativos e multidimensionais
- [ ] **3.8 Funções** — parâmetros, retorno e escopo
- [ ] **3.12 Projeto** — calculadora + sistema de notas com menu
- [ ] **Aula extra** — [Antes de codar: processo de desenvolvimento](recap-extra-processo-desenvolvimento.md)

---

## 🔗 Links úteis

**Documentação oficial (php.net):**
- [`while`](https://www.php.net/manual/pt_BR/control-structures.while.php) · [`do-while`](https://www.php.net/manual/pt_BR/control-structures.do.while.php)
- [`for`](https://www.php.net/manual/pt_BR/control-structures.for.php) · [`foreach`](https://www.php.net/manual/pt_BR/control-structures.foreach.php)
- [`break`](https://www.php.net/manual/pt_BR/control-structures.break.php) · [`continue`](https://www.php.net/manual/pt_BR/control-structures.continue.php)
- [Estruturas de controle](https://www.php.net/manual/pt_BR/language.control-structures.php)

**Vídeos no YouTube:**
- [**Laços de repetição em PHP (while, do-while, for, foreach)**](https://www.youtube.com/watch?v=Mm82grBHVPo) — panorama dos quatro laços
- [**Curso de PHP — Estruturas de repetição**](https://www.youtube.com/watch?v=0X6f4m6cR1E) — na prática com exemplos simples
- [**foreach no PHP**](https://www.youtube.com/watch?v=6dQ4l4Z5pNQ) — percorrendo arrays do jeito certo

---

## 💡 Dicas de ouro

> **Todo laço precisa de uma saída.** Pergunte sempre: *"o que faz essa condição ficar falsa?"*

> **`foreach` é rei das listas.** Se você tem um array, comece por ele.

> **`for` para contagem, `while` para condição.** Se sabe quantas vezes, use `for`.

> **`do-while` é para menu.** Quando o bloco precisa rodar pelo menos uma vez.

> **`Ctrl + C` é seu amigo.** Loop infinito no terminal? Interrompa sem medo.

---

*Recap produzido para a turma da Aula 07 — Módulo 3 · Fundamentos PHP.*
*Professor: Luis Felipe Araujo Lima*
