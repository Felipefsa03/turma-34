# 📘 Recap da Aula 06 — Prática de Fundamentos PHP

> **Tema da aula:** *Desafios guiados — da saída de dados às condicionais*
> **Base:** slides 03 a 09 (tópicos **3.1 a 3.5.3**)
> **Módulo:** 3 · Fundamentos PHP
> **Formato:** aula 100% prática — **8 desafios** resolvidos no `index.php`

**Objetivo:** fixar a base do PHP colocando a mão no código. Nesta aula transformamos teoria em prática: cada tópico virou um desafio, do `echo` até o operador ternário.

> [!IMPORTANT]
> Esta aula deu **ênfase** em dois blocos que costumam derrubar iniciante:
> **3.4 Entrada de dados** e **3.5 Estruturas condicionais**. Eles aparecem em destaque aqui embaixo.

---

## 🗺️ Trilha dos 8 desafios

Cada desafio treina um tópico. Use a tabela como mapa de revisão.

| Desafio | Tópico | O que foi praticado |
|:-------:|--------|---------------------|
| 1 | 3.1 Saída de dados | cartão de perfil com `echo` |
| 2 | 3.2 Variáveis e constantes | produto da loja com `define()` |
| 3 | 3.2 Operadores | cálculo de compra com desconto |
| 4 | 3.3 Tipos e coerção | `var_dump()` + casting + `===` |
| **5** | **3.4 Entrada de dados** | **cadastro interativo com `readline()`** |
| **6** | **3.5.1 `if/else`** | **sistema de aprovação** |
| **7** | **3.5.2 `switch`** | **cardápio digital** |
| **8** | **3.5.3 ternário** | **controle de acesso** |

---

## ⚡ Revisão rápida (3.1, 3.2 e 3.3)

### 3.1 Saída de dados

| Recurso | Uso | Mostra tipo? |
|---------|-----|:------------:|
| `echo` | saída comum | ❌ |
| `print` | igual ao `echo`, retorna `1` | ❌ |
| `print_r()` | arrays legíveis | ❌ |
| `var_dump()` | valor **+ tipo** (debug) | ✅ |

```php
$nome = "Wagner";
echo "Nome: " . $nome . "\n";   // Nome: Wagner
```

### 3.2 Variáveis, constantes e operadores

```php
$preco = 80;                          // variável (pode mudar)
define("NOME_LOJA", "Tech Store");    // constante (não muda)

$subtotal = $preco * 2;               // aritmético
$total    = $subtotal - 10;           // subtotal - desconto
$acima    = $total > 100;             // relacional → bool
```

- **Aritméticos:** `+ - * / %`
- **Relacionais:** `== === != > < >= <=`
- **Lógicos:** `&&` (E), `||` (OU), `!` (NÃO)

> [!TIP]
> Constantes **não** usam `$`: escreva `NOME_LOJA`, nunca `$NOME_LOJA`.

### 3.3 Tipos e coerção

```php
$a = "25";   // string
$b = 25;     // int

var_dump($a === $b);      // false — "25" (string) !== 25 (int)
$a = (int) $a;            // casting: "25" → 25
var_dump($a === $b);      // true
```

> [!WARNING]
> **`"25" === 25` é `false`.** O `===` compara **valor e tipo**. Sempre converta a entrada antes de comparar com segurança.

---

## ⭐ 3.4 Entrada de dados — em destaque

Até aqui o programa só **mostrava** coisas. Agora ele **recebe** dados. É o momento em que o ciclo **Entrada → Processamento → Saída** se fecha de verdade.

### Dois ambientes, duas formas de ler

```text
┌──────────────────────────────┐        ┌──────────────────────────────┐
│        🌐 NAVEGADOR          │        │        🖥️ TERMINAL (CLI)      │
│  $_GET  → dados na URL       │        │  readline() → lê o digitado  │
│  $_POST → corpo da requisição│        │  (só funciona no terminal)   │
└──────────────────────────────┘        └──────────────────────────────┘
```

### 🌐 No navegador — superglobais

Dados chegam por **variáveis superglobais**: estão disponíveis em qualquer parte do script.

```php
// URL: index.php?nome=Maria   →  $_GET["nome"] = "Maria"
$nome  = $_GET["nome"]  ?? "Visitante";
$email = $_POST["email"] ?? "";
```

| | `$_GET` | `$_POST` |
|---|---------|----------|
| Onde fica o dado | Na **URL** (visível) | No **corpo** da requisição |
| Aparece no histórico | Sim | Não |
| Limite de tamanho | ~2 KB | até ~8 MB |
| Indicado para | buscas, filtros, paginação | senhas, uploads, dados longos |

> [!WARNING]
> **POST não é criptografia!** Ele só **não aparece na URL**. Para proteger o tráfego de verdade, use **HTTPS**.

### 🖥️ No terminal — `readline()` (o que usamos nos desafios)

```php
$nome  = readline("Digite seu nome: ");
$idade = readline("Digite sua idade: ");
$lang  = readline("Linguagem favorita: ");

echo "Olá, $nome! Você tem $idade anos\n";
echo "e gosta de programar em $lang!\n";
```

**Execução no terminal:**

```text
Digite seu nome: Ana
Digite sua idade: 20
Linguagem favorita: PHP

Olá, Ana! Você tem 20 anos
e gosta de programar em PHP!
```

> [!IMPORTANT]
> **`readline()` SEMPRE devolve string.** Mesmo que o usuário digite `20`, o PHP recebe `"20"`. Converta antes de calcular ou comparar com `===`:
> ```php
> $idade = (int) readline("Digite sua idade: ");   // agora é int
> $nota  = (float) readline("Digite a nota: ");     // agora é float
> ```

### 🛡️ Validando o que o usuário digita

Nunca confie no que chega. Proteja e limpe:

| Função | Para que serve |
|--------|----------------|
| `isset($x)` | o dado existe? (evita *Undefined index*) |
| `empty($x)` | o dado está vazio? |
| `trim($x)` | remove espaços nas pontas |
| `is_numeric($x)` | é um número válido? |
| `filter_var($x, FILTER_VALIDATE_INT)` | valida inteiro |
| `htmlspecialchars($x)` | escapa HTML (evita injeção) |
| `(int)` / `(float)` | converte para número |

```php
$idade = trim($_POST['idade'] ?? "");

if ($idade === "" || !is_numeric($idade)) {
    echo "Idade inválida!";
} else {
    $idade = (int) $idade;
}
```

> [!NOTE]
> **`??` (null coalescing)** devolve o valor da direita quando o da esquerda **não existe ou é `null`**. É o jeito curto de evitar o aviso *"Undefined array key"*.

---

## ⭐ 3.5.1 `if / elseif / else` — em destaque

O programa **decide qual bloco executar** de acordo com uma condição.

```php
$nota = 6.5;
$frequencia = 80;

if ($nota >= 7 && $frequencia >= 75) {
    echo "Aprovado";
} elseif ($nota >= 5 && $nota < 7) {
    echo "Recuperação";
} elseif ($nota >= 0 && $nota < 5) {
    echo "Reprovado";
} else {
    echo "Nota inválida";
}
```

**Fluxo da decisão:**

```text
   ┌────────────────────────────┐
   │ nota >= 7  E  freq >= 75 ? │
   └──────────────┬─────────────┘
            true  │  false
      ┌───────────▼───────────┐
      │      "Aprovado"       │
      └───────────────────────┘
                  │ (falso)
      ┌───────────▼───────────┐
      │ nota >= 5 E nota < 7 ?│
      └───────────┬───────────┘
            true  │  false
      ┌───────────▼───────────┐
      │    "Recuperação"      │
      └───────────────────────┘
                  │ (falso)
      ┌───────────▼───────────┐
      │ nota >= 0 E nota < 5 ?│
      └───────────┬───────────┘
            true  │  false
      ┌───────────▼───────────┐     ┌──────────────────┐
      │     "Reprovado"       │     │ "Nota inválida"  │
      └───────────────────────┘     └──────────────────┘
```

| Bloco | Quando executa |
|-------|----------------|
| `if` | a condição é **verdadeira** |
| `elseif` | a anterior falhou, mas esta é verdadeira |
| `else` | **todas** falharam (não tem condição) |

> [!IMPORTANT]
> O PHP testa **de cima para baixo** e executa **apenas o primeiro bloco verdadeiro**. **A ordem importa!** Se você testar `$nota >= 5` antes de `$nota >= 7`, o aprovado nunca será alcançado.

### 🐞 Erros comuns no `if`

```php
// ❌ CONFUNDE ATRIBUIÇÃO COM COMPARAÇÃO
if ($nota = 7) { ... }   // atribui 7 (sempre verdadeiro!) → use == ou ===

// ❌ ESQUECER AS CHAVES quando há mais de um comando
if ($nota >= 7)
    echo "Aprovado";
    echo "Parabéns";       // roda SEMPRE, fora do if!

// ✅ CERTO
if ($nota >= 7) {
    echo "Aprovado";
    echo "Parabéns";
}
```

---

## ⭐ 3.5.2 `switch` — em destaque

O `switch` compara **uma expressão** com vários valores **fixos**. É perfeito para **menus**.

```php
$opcao = (int) readline("Escolha uma opção: ");

switch ($opcao) {
    case 1:
        echo "Hambúrguer - R$ 15";
        break;
    case 2:
        echo "Pizza - R$ 25";
        break;
    case 3:
        echo "Refrigerante - R$ 6";
        break;
    case 4:
        echo "Suco - R$ 8";
        break;
    default:
        echo "Opção inválida!";
}
```

| Palavra | Papel |
|---------|-------|
| `case` | um valor a comparar |
| `break` | **interrompe** — sem ele, os próximos `case` também rodam |
| `default` | roda quando nenhum `case` corresponde |

### 🔥 O `break` e o *fall-through*

```php
$mes = "fevereiro";

switch ($mes) {
    case "janeiro":
    case "fevereiro":      // ← casos agrupados (sem corpo)
    case "março":
        echo "1º trimestre";
        break;             // ← só aqui interrompe
    default:
        echo "Outro trimestre";
}
```

Sem o `break`, o fluxo "escorrega" para o `case` seguinte. **Casos sem corpo agrupados são propositais** (é o "se for um destes").

> [!WARNING]
> **`switch` NÃO compara faixas!** Isto está **errado**:
> ```php
> case ($idade >= 0 && $idade <= 3):   // ❌ compara (bool)$idade == true
> ```
> Para faixas (`>=`, `<=`), use **`if / elseif`**. `switch` é para **igualdade com valores fixos**.

> [!TIP]
> **Bônus PHP 8:** o `match` é um `switch` mais moderno, que compara **estrito** e **exige** que todos os casos sejam cobertos:
> ```php
> $preco = match($opcao) {
>     1 => 15,
>     2 => 25,
>     default => 0,
> };
> ```

---

## ⭐ 3.5.3 Operador ternário — em destaque

Uma decisão **em uma única linha**.

```php
$idade = (int) readline("Digite sua idade: ");
$mensagem = ($idade >= 18) ? "Acesso permitido" : "Acesso negado";
echo $mensagem;
```

**Anatomia:**

```text
      condição        ?    se verdadeiro   :    se falso
         │            │          │              │
   ($idade >= 18)     ?  "Acesso permitido"  : "Acesso negado"
```

| Forma | Quando usar |
|-------|-------------|
| `if / else` | há **vários comandos** em cada caminho |
| Ternário `? :` | o resultado é **simples** e cabe em uma linha |

### Ternário encadeado (com moderação)

```php
$situacao = ($nota >= 7) ? "Aprovado"
          : (($nota >= 5) ? "Recuperação" : "Reprovado");
```

> [!WARNING]
> Ternário dentro de ternário **sacrifica a legibilidade**. Se precisar de 3+ casos, volte para `if / elseif` ou `switch`.

### Formas curtas úteis

```php
// Ternário curto (?:) — usa o próprio valor se ele for "verdadeiro"
$nome = $nome ?: "Sem nome";

// Null coalescing (??) — usa o valor se a variável existir e não for null
$usuario = $logado ?? "Visitante";
```

---

## 🧾 Visão geral: quando usar cada condicional?

| Situação | Melhor ferramenta |
|----------|-------------------|
| Duas opções simples | **ternário** `? :` |
| Várias faixas de valores | **`if / elseif / else`** |
| Menu / opções fixas de igualdade | **`switch`** |
| Condição dentro de uma atribuição | **ternário** |
| Lógica complexa com `&&` / `\|\|` | **`if / elseif`** |

---

## 🧠 Teste seu conhecimento

1. Por que `readline()` precisa de `(int)` antes de um cálculo?
2. Qual a diferença de visibilidade entre `$_GET` e `$_POST`?
3. `POST` criptografa os dados? Justifique.
4. Por que `"25" === 25` é `false`?
5. O que acontece se esquecer o `break` em um `case`?
6. Por que `switch` não serve para faixas como `>= 0 && <= 3`?
7. Qual a diferença entre `?:` (ternário curto) e `??` (null coalescing)?
8. Em um `if/elseif`, quantos blocos podem executar? Por quê?

<details>
<summary>🔎 Clique para ver as respostas</summary>

1. Porque `readline()` **sempre devolve string**. Sem o cast, o cálculo pode até funcionar por coerção, mas comparações com `===` falham.
2. `$_GET` fica **visível na URL**; `$_POST` vai no **corpo** da requisição e não aparece na URL.
3. **Não.** `POST` apenas não expõe o dado na URL. Para segurança real, use **HTTPS**.
4. Porque `===` compara **valor e tipo**: `"25"` é `string` e `25` é `int`.
5. O fluxo continua para os `case` seguintes (*fall-through*), executando código indevido.
6. Porque o `switch` compara **igualdade**, e `($x >= 0 && $x <= 3)` resulta em `bool` — ele acaba comparando `(bool)$x == true`.
7. `?:` usa o **próprio valor** da esquerda se ele for verdadeiro; `??` retorna a direita quando a esquerda **não existe ou é `null`**.
8. **Apenas um** — o **primeiro** bloco cuja condição for verdadeira. Os demais são ignorados.

</details>

---

## 🔗 Links úteis

### 📖 Manual oficial do PHP (pt-BR)

**Entrada de dados (3.4):**
- [`$_GET` — variáveis da URL](https://www.php.net/manual/pt_BR/reserved.variables.get.php)
- [`$_POST` — dados de formulário](https://www.php.net/manual/pt_BR/reserved.variables.post.php)
- [`readline()` — lê uma linha do terminal](https://www.php.net/manual/pt_BR/function.readline.php)
- [Uso da linha de comando (CLI)](https://www.php.net/manual/pt_BR/features.commandline.php)

**Estruturas condicionais (3.5):**
- [Estruturas de controle](https://www.php.net/manual/pt_BR/language.control-structures.php)
- [`if`](https://www.php.net/manual/pt_BR/control-structures.if.php) · [`else`](https://www.php.net/manual/pt_BR/control-structures.else.php) · [`elseif/else if`](https://www.php.net/manual/pt_BR/control-structures.elseif.php)
- [`switch`](https://www.php.net/manual/pt_BR/control-structures.switch.php)
- [Operadores (inclui o ternário)](https://www.php.net/manual/pt_BR/language.operators.php)
- [Operadores de comparação](https://www.php.net/manual/pt_BR/language.operators.comparison.php)

**Validação e segurança:**
- [`filter_var()`](https://www.php.net/manual/pt_BR/function.filter-var.php) · [`htmlspecialchars()`](https://www.php.net/manual/pt_BR/function.htmlspecialchars.php)

### 🎥 Vídeos no YouTube

- [**Condicionais (if, else, switch, operadores) — Aprenda PHP de vez!**](https://www.youtube.com/watch?v=XokMeyowKNA) — resumo direto de todas as condicionais
- [**Curso de PHP 7 — Aula 06: if/else, switch case, if ternário**](https://www.youtube.com/watch?v=mBZ4tHsgMH0) — estruturas de controle na prática
- [**Domine GET e POST no PHP!**](https://www.youtube.com/watch?v=voqqpG1E4S0) — entrada de dados no navegador
- [**Curso PHP Básico — GET e POST (Aula 13)**](https://www.youtube.com/watch?v=Z1EVlz94hQI) — formulários e superglobais
- [**PHP `$_GET` and `$_POST` explained**](https://www.youtube.com/watch?v=6AzAYU8AOhQ) — (em inglês) explicacão detalhada das superglobais

---

## ✅ Checklist de Estudos

### 🔴 Imprescindível — Aula 06

- [ ] Usar `echo` para montar saídas com variáveis
- [ ] Declarar variáveis (`$`) e constantes (`define()` / `const`)
- [ ] Aplicar operadores aritméticos, relacionais e lógicos
- [ ] Diferenciar coerção automática de **casting**
- [ ] Ler entrada com `readline()` **e converter** com `(int)` / `(float)`
- [ ] Diferenciar `$_GET` de `$_POST`
- [ ] Validar entrada com `isset()`, `trim()` e `is_numeric()`
- [ ] Escrever `if / elseif / else` na **ordem correta**
- [ ] Escrever `switch` com `break` e `default`
- [ ] Escrever o operador **ternário** `condição ? a : b`
- [ ] Saber **quando** usar `if`, `switch` ou ternário

### 🟡 Revisão — Aulas anteriores

- [ ] **Aula 05:** revisão de 3.1–3.5 + introdução aos laços
- [ ] **Aula 04:** tipos, coerção, `$_POST`/`$_GET` e condicionais
- [ ] **Aula 03:** saída de dados, variáveis, constantes e operadores
- [ ] **Aula 02:** `php index.php` e `php -S localhost:8000`

### 🟢 Próximos passos

- [ ] **3.6 Laços na prática** — `while`, `do-while`, `for`, `foreach`
- [ ] **3.7 Arrays** — indexados, associativos e multidimensionais
- [ ] **3.8 Funções** — parâmetros, retorno e escopo
- [ ] **Desafio da Aula 06** — resolva o [`Desafio.md`](Desafio.md) 😉

---

## 💡 Dicas de ouro

> **Entrada é sempre string.** Converta com `(int)` / `(float)` antes de calcular ou comparar com `===`.

> **`switch` é igualdade; `if` é lógica.** Faixas (`>=`, `<=`) são sempre com `if / elseif`.

> **`break` no `switch` não é opcional.** Sem ele, o fluxo escorrega para os casos seguintes.

> **Valide antes de usar.** `isset()` + `trim()` + `is_numeric()` evitam erros e surpresas.

> **Ternário é para o simples.** Se ficou difícil de ler, use `if / elseif`.

---

*Recap produzido para a turma da Aula 06 — Módulo 3 · Fundamentos PHP.*
*Professor: Luis Felipe Araujo Lima*
