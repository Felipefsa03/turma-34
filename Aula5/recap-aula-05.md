# 📘 Recap da Aula 05 — Fundamentos PHP: Revisão + Laços

> **Tema da aula:** *Da revisão aos laços de repetição*
> **Slides trabalhados:** 01 a 10 → revisão de **3.1 a 3.5** + introdução a **3.6**
> **Módulo:** 3 · Fundamentos PHP
> **Público-alvo:** iniciantes, quem faltou e quem quer revisar antes do próximo encontro.

**Objetivo:** revisar a base do PHP (saída, variáveis, operadores, tipos, entrada e condicionais) e abrir a porta das **estruturas de repetição**, entendendo *por que* e *quando* usá-las.

---

## 🗺️ Mapa da Aula

Use este guia para navegar. Cada bloco tem explicação curta, código e a **saída esperada**.

| # | Tópico | O que você aprende | Slide |
|:-:|--------|-------------------|:-----:|
| 3.1 | 💬 [Saída de dados](#-31-saída-de-dados) | `echo`, `print`, `print_r()`, `var_dump()` | 03 |
| 3.2 | 📦 [Variáveis e constantes](#-32-variáveis-e-constantes) | `$var`, `define()`, `const` | 04 |
| 3.2 | ➕ [Operadores](#-32-operadores) | aritméticos, comparação e lógicos | 05 |
| 3.3 | 🧮 [Tipos e coerção](#-33-tipos-de-dados-e-coerção) | `string`, `int`, `float`, `bool`, array, object, casting | 06 |
| 3.4 | ⌨️ [Entrada de dados](#-34-entrada-de-dados) | `$_GET`, `$_POST`, `readline()` | 07 |
| 3.5.1 | 🔀 [`if / elseif / else`](#-351-if--elseif--else) | decisões no código | 08 |
| 3.5.2 | 🎛️ [`switch`](#-352-switch) | várias opções fixas | 09 |
| 3.5.3 | ❓ [Ternário](#-353-operador-ternário) | decisão em uma linha | 09 |
| 3.6 | 🔁 [Laços (introdução)](#-36-estruturas-de-repetição--introdução) | `while`, `do-while`, `for`, `foreach` | 10 |

> [!TIP]
> O código completo e executável de tudo que foi visto está em **[`index.php`](index.php)** desta pasta.
> Rode com `php index.php` (terminal) ou `php -S localhost:8000` (navegador).

---

## 💬 3.1 Saída de dados

**Saída de dados** é a forma de apresentar informação. No PHP existem quatro recursos principais:

| Recurso | Para que serve | Mostra o tipo? |
|---------|----------------|:--------------:|
| `echo` | Saída comum, a mais usada | ❌ |
| `print` | Igual ao `echo`, mas **retorna 1** | ❌ |
| `print_r()` | Ver arrays de forma legível | ❌ |
| `var_dump()` | Mostra **valor + tipo + tamanho** (debug) | ✅ |

```php
echo "Olá, mundo!";
print "Bem-vindo!";

$dados = ["PHP", 8];
print_r($dados);
var_dump($dados);
```

**Saída no terminal:**

```text
Olá, mundo!
Bem-vindo!
Array
(
    [0] => PHP
    [1] => 8
)
array(2) {
  [0]=> string(3) "PHP"
  [1]=> int(8)
}
```

> [!NOTE]
> **Qual usar na dúvida?** `echo` para mostrar mensagens ao usuário e `var_dump()` para investigar problemas. O `var_dump()` é o melhor amigo do programador iniciante — ele não esconde nada.

---

## 📦 3.2 Variáveis e constantes

### Variáveis

- Começam sempre com **`$`**
- **Diferenciam maiúsculas de minúsculas** → `$nome` ≠ `$Nome`
- Guardam um valor que **pode mudar** durante o programa

```php
$nome = "Maria";
$idade = 20;

echo $nome;          // Maria
echo $idade + 1;     // 21
```

### Constantes

- Definidas **uma única vez** e **nunca** podem ser reatribuídas
- Duas formas: `define()` e `const`

```php
define("PI", 3.14159);       // forma clássica
const URL = "meusite.com";   // forma moderna (execução/tempo de compilação)

echo PI;    // 3.14159
echo URL;   // meusite.com
```

| | Variável | Constante |
|---|----------|-----------|
| Símbolo | `$nome` | `PI`, `URL` (sem `$`) |
| Pode mudar? | ✅ Sim | ❌ Nunca |
| Escopo | Onde foi criada | Global por padrão |
| Uso típico | Dados do dia a dia | Valores fixos (PI, versão, URL) |

> [!WARNING]
> Tentar reatribuir uma constante gera **erro**. Use constantes para o que **não deve mudar**: taxas, versões, configurações.

---

## ➕ 3.2 Operadores

Os operadores se dividem em **três famílias**. Memorize os exemplos:

### 🔢 Aritméticos — calculam

| Operador | Operação | Exemplo | Resultado |
|:--------:|----------|---------|:---------:|
| `+` | Soma | `10 + 3` | `13` |
| `-` | Subtração | `10 - 3` | `7` |
| `*` | Multiplicação | `10 * 3` | `30` |
| `/` | Divisão | `10 / 3` | `3.333…` |
| `%` | Resto da divisão | `10 % 3` | `1` |

### ⚖️ Comparação — perguntam

| Operador | Pergunta | Exemplo | Resultado |
|:--------:|----------|---------|:---------:|
| `==` | Mesmo **valor**? | `10 == "10"` | `true` ⚠️ |
| `===` | Mesmo valor **e tipo**? | `10 === "10"` | `false` ✅ |
| `!=` | Diferente? | `10 != 3` | `true` |
| `>` / `<` | Maior / menor? | `10 > 3` | `true` |
| `>=` / `<=` | Maior/menor ou igual? | `10 >= 10` | `true` |

### 🧠 Lógicos — combinam condições

| Operador | Leitura | Só é `true` quando… |
|:--------:|:-------:|---------------------|
| `&&` ou `and` | **E** | as **duas** condições são verdadeiras |
| `\|\|` ou `or` | **OU** | **pelo menos uma** é verdadeira |
| `!` | **NÃO** | inverte o resultado |

```php
$a = 10;
$b = 3;

var_dump($a > 5 && $b < 5);   // bool(true)  → as duas são verdadeiras
var_dump($a < 5 || $b < 5);   // bool(true)  → a segunda é verdadeira
var_dump(!($a > 5));          // bool(false) → inverteu o true
```

> [!IMPORTANT]
> **Regra de ouro:** use **`===`** (e `!==`) para comparar. O `==` faz coerção e é a origem de metade dos bugs em PHP — `"10" == 10` é `true`, mas `"10" === 10` é `false`.

---

## 🧮 3.3 Tipos de dados e coerção

### Tipos principais

| Tipo | Exemplo | `var_dump()` |
|------|---------|--------------|
| `string` | `"Maria"` | `string(5) "Maria"` |
| `int` | `20` | `int(20)` |
| `float` | `12.5` | `float(12.5)` |
| `bool` | `true` / `false` | `bool(true)` |
| `array` | `["PHP", 8]` | `array(2)` |
| `object` | `new stdClass()` | `object(stdClass)` |

**Tipagem dinâmica:** o PHP identifica o tipo **durante a execução** — você não declara o tipo da variável.

```php
$nome  = "Maria";   // string
$idade = 20;        // int
$preco = 12.5;      // float
$ativo = true;      // bool
```

### Coerção automática (o PHP converte sozinho)

```php
$soma = "10" + 5;   // "10" vira 10 → 15
var_dump($soma);    // int(15)
```

### Coerção forçada / casting (você manda converter)

```php
$numero = (int) "10";
var_dump($numero);          // int(10)

var_dump((float) "12.5");   // float(12.5)
var_dump((string) 123);     // string(3) "123"
```

> [!WARNING]
> **Casting trunca, não arredonda.** `(int) 7.9` vale **`7`**, não `8`. E `(int) "abc"` vira `0`.

> [!NOTE]
> **Entrada vem sempre como string.** Por isso usamos `(int)` e `(float)` antes de calcular. Voltaremos nisso no próximo tópico.

---

## ⌨️ 3.4 Entrada de dados

Agora o PHP **recebe** dados. Existem dois ambientes:

### 🌐 No navegador — superglobais

```php
$nome  = $_GET["nome"]  ?? "Visitante";
$email = $_POST["email"] ?? "";
```

| | `$_GET` | `$_POST` |
|---|---------|----------|
| Onde fica o dado | Na **URL** (visível) | No **corpo** da requisição |
| Uso típico | Buscas, filtros, paginação | Senhas, uploads, dados longos |

```text
http://localhost:8000/index.php?nome=Maria
                                    └── $_GET["nome"] = "Maria"
```

> [!WARNING]
> **POST não é criptografia!** Ele apenas *não aparece na URL*. Para proteger o tráfego de verdade, use **HTTPS**.

### 🖥️ No terminal (CLI) — `readline()`

```php
$nome = readline("Digite seu nome: ");
echo "Olá, $nome!";
```

`readline()` **sempre devolve string** e **só funciona no terminal**. Se abrir no navegador, gera erro — proteja com uma verificação:

```php
if (PHP_SAPI === 'cli') {
    $nome = readline("Digite seu nome: ");
}
```

> [!TIP]
> O operador **`??`** (null coalescing) evita o aviso *"Undefined index"* quando o dado ainda não foi enviado. Ele devolve o valor da direita caso o da esquerda não exista ou seja `null`.

---

## 🔀 3.5.1 `if / elseif / else`

O programa escolhe **qual bloco executar** de acordo com uma condição.

```php
$idade = 17;

if ($idade >= 18) {
    echo "Maior de idade";
} elseif ($idade == 17) {
    echo "Quase lá!";
} else {
    echo "Menor de idade";
}
```

**Fluxo da decisão:**

```text
        ┌────────────────────┐
        │  if ($idade >= 18) │
        └─────────┬──────────┘
             true │ false
        ┌─────────▼──────────┐
        │  "Maior de idade"  │
        └────────────────────┘
                  │
                  ▼ (falso)
        ┌────────────────────┐
        │ elseif ($idade==17)│
        └─────────┬──────────┘
             true │ false
        ┌─────────▼──────────┐        ┌────────────────────┐
        │    "Quase lá!"     │        │       else         │
        └────────────────────┘        │ "Menor de idade"   │
                                      └────────────────────┘
```

| Bloco | Quando executa |
|-------|----------------|
| `if` | Quando a condição é **verdadeira** |
| `elseif` | Quando a principal é **falsa**, mas esta é verdadeira |
| `else` | Quando **todas** falharam (não tem condição) |

> [!NOTE]
> O PHP testa **de cima para baixo** e executa **apenas o primeiro** bloco verdadeiro. A ordem importa!

---

## 🎛️ 3.5.2 `switch`

Compara **uma expressão** com vários casos fixos. Ideal para **menus**.

```php
$opcao = 2;

switch ($opcao) {
    case 1:
        echo "Opção 1";
        break;
    case 2:
        echo "Opção 2";
        break;
    default:
        echo "Inválido";
}
```

| Palavra | Papel |
|---------|-------|
| `case` | Um valor a comparar |
| `break` | **Interrompe** o fluxo — sem ele, o próximo `case` também roda |
| `default` | Executado quando nenhum `case` corresponde |

> [!WARNING]
> **Esqueceu o `break`?** O fluxo "escorrega" para os casos seguintes (*fall-through*) e o resultado sai errado. Use o `break` em todos os casos.

> [!IMPORTANT]
> **`switch` é para igualdade com valores fixos** (`case 1:`, `case "segunda":`).
> Para **faixas** (`>= 0 && <= 3`) use **`if / elseif`**. `case ($x >= 0 && $x <= 3)` **não** funciona como você espera.

---

## ❓ 3.5.3 Operador ternário

Uma decisão **em uma única linha**.

```php
$nota   = 8;
$status = ($nota >= 7) ? "Aprovado" : "Reprovado";

echo $status;   // Aprovado
```

**Anatomia:**

```text
     condição        ?   se verdadeiro   :   se falso
        │            │        │               │
 ($nota >= 7)       ?   "Aprovado"          : "Reprovado"
```

| Forma | Quando usar |
|-------|-------------|
| `if / else` | Vários comandos dentro de cada caminho |
| Ternário `? :` | Resultado **simples**, caber em uma linha |

> [!TIP]
> Ternário aninhado (`? : ? :`) fica difícil de ler. Se precisar de muitos casos, volte para `if / elseif` ou `switch`.

---

## 🔁 3.6 Estruturas de repetição — introdução

> **Por que escrever o mesmo comando dez vezes?**
> Laços permitem **repetir um bloco de instruções de forma controlada**.

Esta foi a **introdução** ao tema (slide 10). Os exemplos práticos de cada laço ficam para o **próximo encontro** — mas já vale conhecer os quatro:

| Laço | Ideia central | Característica |
|------|---------------|----------------|
| `while` | **Condição antes** | Pode **não executar** nenhuma vez |
| `do-while` | **Execução antes** | Executa **ao menos uma vez** |
| `for` | **Contagem controlada** | Ideal quando se sabe *quantas* vezes repetir |
| `foreach` | **Percorre coleções** | Passa por cada item de um array |

**Comparação `while` × `do-while` (prévia do que vem a seguir):**

```php
$i = 1;

while ($i <= 5) {   // testa ANTES
    echo $i;        // pode não rodar se a condição já for falsa
    $i++;
}

do {                // testa DEPOIS
    echo $i;        // roda pelo menos 1 vez, sempre
    $i++;
} while ($i <= 5);
```

> [!NOTE]
> Slide 10 apresentou o **conceito**. Os slides 11 a 13 detalham `while`/`do-while`, `for` e `foreach` com exemplos — esses ficam registrados no próximo material.

---

## ✅ O que revisamos hoje

```text
┌─────────────────────────────┐   ┌──────────────────────────────┐
│          REVISAMOS          │   │          AVANÇAMOS           │
├─────────────────────────────┤   ├──────────────────────────────┤
│ • Saída de dados            │   │ • Conceito de laços          │
│ • Variáveis e constantes    │   │ • while / do-while           │
│ • Operadores                │   │ • for / foreach              │
│ • Tipos e coerção           │   │ • Automação de tarefas       │
│ • Entrada de dados          │   │   repetitivas                │
│ • Condicionais              │   │                              │
└─────────────────────────────┘   └──────────────────────────────┘
```

---

## 🧠 Teste seu conhecimento

1. Qual a diferença prática entre `echo` e `var_dump()`?
2. Por que `$nome` e `$Nome` são variáveis diferentes?
3. O que o operador `%` devolve em `10 % 3`?
4. Qual a diferença entre `==` e `===`? Dê um exemplo.
5. O que `(int) 7.9` devolve: `7` ou `8`? Por quê?
6. `$_GET` e `$_POST` ficam onde? Qual usar para senha?
7. Quando usar `switch` em vez de `if / elseif`?
8. O que acontece se esquecer o `break` no `switch`?
9. Qual laço executa **ao menos uma vez**, mesmo com a condição falsa?

<details>
<summary>🔎 Clique para ver as respostas</summary>

1. `echo` só mostra o valor; `var_dump()` mostra **valor + tipo + tamanho** (ideal para debug).
2. Variáveis em PHP são **case-sensitive** — maiúsculas e minúsculas diferem.
3. `1` (o resto da divisão de 10 por 3).
4. `==` compara só o **valor** (com coerção); `===` compara **valor e tipo**. `"10" == 10` → `true`, `"10" === 10` → `false`.
5. `7`. O casting **trunca** a parte decimal, **não arredonda**.
6. `$_GET` na **URL**; `$_POST` no **corpo** da requisição. Para senha, `$_POST` (e sempre com **HTTPS**).
7. Quando há **opções fixas** comparadas por **igualdade** (menus). Para faixas/condições lógicas, `if / elseif`.
8. O fluxo continua para os próximos `case` (*fall-through*) e o resultado sai errado.
9. `do-while` — ele testa a condição **depois** de executar.

</details>

---

## 🗺️ Checklist de Estudos

### 🔴 Imprescindível — Aula 05

- [ ] Usar `echo`, `print`, `print_r()` e `var_dump()`
- [ ] Declarar variáveis com `$` (e lembrar do case-sensitive)
- [ ] Criar constantes com `define()` e `const`
- [ ] Diferir `==` de `===` (e sempre preferir `===`)
- [ ] Aplicar operadores aritméticos, de comparação e lógicos
- [ ] Reconhecer os tipos `string`, `int`, `float`, `bool`, `array`, `object`
- [ ] Explicar coerção automática × casting
- [ ] Ler `$_GET`, `$_POST` e `readline()`
- [ ] Escrever `if / elseif / else`
- [ ] Escrever `switch` com `break` e `default`
- [ ] Escrever ternário `condição ? a : b`
- [ ] Explicar a diferença entre `while` e `do-while`

### 🟡 Revisão — Aulas anteriores

- [ ] **Aula 04:** tipos, coerção, `$_POST`/`$_GET`, `readline()` e condicionais
- [ ] **Aula 03:** saída de dados, variáveis, constantes e operadores
- [ ] **Aula 02:** `php index.php` e `php -S localhost:8000`
- [ ] **Aula 01:** ciclo **Entrada → Processamento → Saída**

### 🟢 Próximos passos

- [ ] **3.6** na prática — `while`, `do-while`, `for` e `foreach` (slides 11–13)
- [ ] **3.7 Arrays** — indexados, associativos e multidimensionais
- [ ] **3.8 Funções** — parâmetros, retorno e escopo
- [ ] **3.12 Projeto** — calculadora + sistema de notas com menu

---

## 🔗 Links úteis

**Documentação oficial (php.net):**
- [Saída e echo](https://www.php.net/manual/pt_BR/function.echo.php)
- [Variáveis](https://www.php.net/manual/pt_BR/language.variables.php) · [Constantes](https://www.php.net/manual/pt_BR/language.constants.php)
- [Operadores](https://www.php.net/manual/pt_BR/language.operators.php)
- [Tipos](https://www.php.net/manual/pt_BR/language.types.php) · [Casting](https://www.php.net/manual/pt_BR/language.types.casting.php)
- [`$_GET`](https://www.php.net/manual/pt_BR/reserved.variables.get.php) · [`$_POST`](https://www.php.net/manual/pt_BR/reserved.variables.post.php) · [`readline()`](https://www.php.net/manual/pt_BR/function.readline.php)
- [Estruturas de controle](https://www.php.net/manual/pt_BR/control-structures.php)

---

## 💡 Dicas de ouro

> **`===` é lei.** Comparar tipos diferentes com `==` é a origem de metade dos bugs em PHP.

> **`var_dump()` é o seu detetive.** Quando algo não faz sentido, imprima o valor *e* o tipo.

> **Entrada é sempre string.** Converta com `(int)` / `(float)` antes de calcular.

> **`switch` é igualdade; `if` é lógica.** Se você escreveu `case ($x >= 10 && $x <= 20)`, o problema é no código — use `if`.

> **POST não é criptografia.** O dado só não aparece na URL. Para segurança de verdade, use HTTPS.

---

*Recap produzido para a turma da Aula 05 — Módulo 3 · Fundamentos PHP.*
*Professor: Luis Felipe Araujo Lima*
