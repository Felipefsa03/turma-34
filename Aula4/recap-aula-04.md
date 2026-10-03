# 📋 Recap da Aula 04 — Módulo de Prática

## Fundamentos PHP: Tipos, Coerção, Entrada de Dados e Condicionais

**Público-alvo:** Para Leigos & Iniciantes
**Objetivo:** Entender os tipos de dados do PHP, como o PHP converte valores sozinho, como receber dados do usuário (formulário e terminal) e como tomar decisões no código.

---

## 1.5 Recapitulação Rápida da Aula 03

| Item | Revisão |
|---|---|
| **Saída de dados** | `echo`, `print`, `print_r()`, `var_dump()` |
| **Variáveis** | Sempre com `$`, case-sensitive (`$idade` ≠ `$Idade`) |
| **Constantes** | `define()` e `const`, imutáveis, definidas antes do uso |
| **Operadores** | Aritméticos (`+ - * / % **`), relacionais (`== === != > < >= <=`), lógicos (`&& \|\| !`) |
| **Condicionais** | `if/elseif/else` e operador ternário |

> Essa aula deepened tudo isso: agora vamos **controlar o tipo** dos dados, **receber entrada** do usuário e **decidir** o que fazer com esses dados.

---

## 3.3 Tipos e Conversões — Dados e Coerção

### Os Tipos do PHP

O PHP tem **4 tipos escalares** (um valor único) e **2 tipos compostos** (vários valores).

**Escalares:**

| Tipo | Exemplo | `gettype()` | `get_debug_type()` |
|---|---|---|---|
| `int` (inteiro) | `42` | `integer` | `int` |
| `float` (decimal) | `7.5` | `double` | `float` |
| `string` (texto) | `"Maria"` | `string` | `string` |
| `bool` (V ou F) | `true` / `false` | `boolean` | `bool` |

**Compostos:**

| Tipo | Exemplo |
|---|---|
| `array` | `[1, 2, 3]` |
| `object` | `new stdClass()` |

> ⚠️ `gettype()` é a função antiga e usa nomes diferentes (`integer` em vez de `int`, `double` em vez de `float`). Em código novo, prefira **`get_debug_type()`**, que devolve o nome canônico.

### Verificando Tipos

```php
is_int(42);        // true
is_string("42");   // true
is_float(7.5);     // true
is_bool(true);     // true
is_array([]);      // true
```

`var_dump()` é a ferramenta de debugging mais completa: mostra **o valor E o tipo**.

---

### Coerção (Type Juggling)

**Coerção** é a conversão de um tipo para outro. O PHP faz isso de duas formas.

#### 1. Conversão Automática (implícita)

O PHP converte **sozinho** quando a operação faz sentido:

```php
$numero_string = "10";   // string
$soma = $numero_string + 5;

var_dump($soma);         // int(15) — converteu "10" para 10 e somou
var_dump($numero_string); // string(2) "10" — a variável NÃO muda!
```

Note que a coerção **não altera a variável original** — só o resultado da operação é convertido.

#### 2. Conversão Forçada (Casting)

Você converte escrevendo o tipo entre parênteses **antes** do valor:

```php
$valor = (int) "100.5";    // 100     (perde os decimais)
$valor = (float) "100.5";  // 100.5
$valor = (int) 7.9;        // 7       (trunca, não arredonda!)
$valor = (string) 123;     // "123"
$valor = (array) "abc";    // ["abc"]
```

**Todos os casts disponíveis:** `(int)` `(bool)` `(float)` `(string)` `(array)` `(object)` `(unset)`

> ⚠️ `(int) 7.9` resulta em **7**, não 8. O casting **trunca**, não arredonda.

---

### ⚠️ Mudança do PHP 8: string não numérica causa TypeError

Esse é um comportamento que mudou e causa muita dor de cabeça:

```php
"abc" + 5;    // PHP 7: Warning + int(5)  |  PHP 8: TypeError FATAL
"10abc" + 5;  // PHP 8: Warning + int(15) (lê o 10, ignora o resto)
```

Como o erro é **fatal**, o script inteiro para. **Antes de calcular, valide:**

```php
$texto = "abc";

if (is_numeric($texto)) {
    echo $texto + 5;
} else {
    echo "Valor inválido para soma";
}
```

---

### Valores "Falsy" — A Armadilha Clássica

Estes valores são considerados **`false`** em qualquer condição:

| Valor | Tipo |
|---|---|
| `0` | int |
| `0.0` | float |
| `""` | string vazia |
| `"0"` | string com o caractere zero |
| `null` | nulo |
| `[]` | array vazio |
| `false` | bool |

**E estes são `true` (contra-intuitivo!):**

```php
var_dump((bool) "false");  // bool(true)  — string "false" é texto, não o booleano
var_dump((bool) " ");     // bool(true)  — espaço em branco
var_dump((bool) "0abc");  // bool(true)  — "0abc" não é "0"
```

> 💡 Se você quiser transformar a string `"false"` em `false`, use `filter_var($x, FILTER_VALIDATE_BOOLEAN)`.

---

### ⚠️ A Armadilha do `==`

```php
var_dump("10" == 10);      // true  — mesmo valor, coerção faz o resto
var_dump("10" === 10);     // false — tipos diferentes
var_dump("abc" == 0);      // PHP 7: true | PHP 8: false
var_dump(null == false);   // true
var_dump(null === false);  // false
```

**Regra de ouro: sempre use `===` e `!==`.** Você evita surpresas e o PHP te avisa sobre tipos incompatíveis.

---

## 3.4 Interatividade — Entrada de Dados

Até agora o PHP só **mostrava** dados. Agora vamos **receber** dados do usuário. Existem dois ambientes:

### 1. Ambiente Web — Variáveis Superglobais

Dados chegam via **variáveis superglobais**: ficam disponíveis em qualquer parte do script, sem precisar declarar.

#### `$_POST` — Dados pelo corpo da requisição

```html
<form action="index.php" method="POST">
    <input type="text" name="nome">
    <button type="submit">Enviar</button>
</form>
```

```php
$nomeUsuario = $_POST['nome'];
```

#### `$_GET` — Dados pela URL

```
http://localhost:8000/index.php?nome=Maria&idade=25
```

```php
$idade = $_GET['idade'];
```

#### Comparação direta

| | `$_GET` | `$_POST` |
|---|---|---|
| Onde os dados ficam | Na URL (visível!) | No corpo da requisição |
| Aparece no histórico | Sim | Não |
| Limite de tamanho | ~2 KB (URL curta) | Até 8 MB por padrão |
| Indicado para | Buscas, filtros, paginação | Senhas, uploads, dados longos |

> 📌 Ambos **sempre chegam como string**, mesmo quando parecem número. Sempre converta com casting.

#### ⚠️ Use `isset()` para evitar erros

Se o usuário ainda não enviou o formulário, `$_POST['nome']` **não existe** e o PHP gera um *Warning: Undefined array key*. O `isset()` protege o código:

```php
if (isset($_POST['nome'])) {
    $nomeUsuario = trim($_POST['nome']);

    if ($nomeUsuario === "") {
        echo "Você não digitou nenhum nome!";
    } else {
        echo "Bem-vindo, $nomeUsuario!";
    }
}
```

> 🔒 Dados vindos do usuário **sempre** precisam de validação e limpeza (`trim()`, `htmlspecialchars()`). Nunca confie no que chega.

---

### 2. Ambiente CLI (Terminal) — `readline()`

No terminal, não existe `$_POST`. A função é **`readline()`**:

```php
$nome = readline("Digite seu nome: ");
$idade = (int) readline("Digite sua idade: ");

echo "Olá, $nome! Você tem $idade anos.";
```

`readline()` **sempre retorna string** — por isso o casting para `int` é obrigatório ao fazer contas.

#### ⚠️ `readline()` só funciona no terminal

Se você abrir o arquivo pelo navegador, `readline()` gera **Fatal error**. Sempre verifique o ambiente antes:

```php
if (PHP_SAPI === 'cli' && function_exists('readline')) {
    $nome = readline("Digite seu nome: ");
} else {
    echo "Esta parte só funciona no terminal.";
}
```

| Verificação | Retorna |
|---|---|
| `PHP_SAPI === 'cli'` | `true` no terminal, `false` no navegador |
| `php_sapi_name()` | Nome da interface: `cli`, `apache2handler`, `fpm-fcgi` |

---

## 3.5.1 Condicionais — `if / elseif / else`

Tomada de decisão baseada em **condições lógicas**.

```php
$nota = 7;

if ($nota > 7) {
    echo "Aprovado!";
} elseif ($nota > 5) {
    echo "Recuperação!";
} else {
    echo "Reprovado!";
}
```

| Bloco | Quando executa |
|---|---|
| `if` | Quando a condição é **verdadeira** |
| `elseif` | Quando a principal é **falsa**, mas esta é verdadeira |
| `else` | Quando **todas** falharam (não tem condição) |

O PHP testa de cima para baixo e executa **apenas o primeiro bloco** verdadeiro.

### Combinando condições

```php
if ($idade >= 18 && $temCNH) {
    echo "Pode dirigir.";
} elseif ($idade >= 18) {
    echo "Maior de idade, mas ainda sem CNH.";
} else {
    echo "Menor de idade.";
}
```

### Aninhamento

```php
if ($logado) {
    if ($assinatura) {
        echo "Conteúdo premium.";
    } else {
        echo "Conteúdo gratuito.";
    }
} else {
    echo "Faça login para continuar.";
}
```

> 💡 Use `elseif` encadeado em vez de `if` aninhado — o código fica mais plano e legível.

---

## 3.5.2 Condicionais — `switch`

Ideal para **menus** ou quando a variável tem **opções fixas** (comparação por igualdade).

```php
$dia = 2;

switch ($dia) {
    case 1:
        echo "Domingo";
        break;
    case 2:
        echo "Segunda";
        break;
    case 3:
        echo "Terça";
        break;
    default:
        echo "Inválido";
}
```

### O papel do `break`

O `switch` **não para** ao encontrar um `case` — ele continua executando os próximos (chamado de *fall-through*). O `break` interrompe o fluxo:

```php
// SEM break: imprime "Trimestre 1" E "Trimestre 2" E "Outros meses"
switch ($mes) {
    case "janeiro": case "fevereiro": case "março":
        echo "Trimestre 1";
        break;
    case "abril": case "maio": case "junho":
        echo "Trimestre 2";
        break;
    default:
        echo "Outros meses";
}
```

Sem o `break`, o agrupamento de `case` **sem corpo** é a forma correta de dizer "se for um destes". É um padrão idiomático do PHP.

### `default` — O Caso Omissso

O `default` é executado quando **nenhum** `case` correspondeu. Use sempre, para tratar entradas inesperadas.

### ⚠️ ERRO COMUM: `switch` NÃO compara faixas de valores

Este código **parece** funcionar, mas está errado:

```php
$pessoa = 15;

switch ($pessoa) {
    case ($pessoa >= 0 && $pessoa <= 3):   // ← ERRADO
        echo "Bebê";
        break;
    case ($pessoa >= 4 && $pessoa <= 12):
        echo "Criança";
        break;
    case ($pessoa >= 13 && $pessoa <= 17):
        echo "Adolescente";
        break;
}
```

**Por que falha?** O `switch` avalia a expressão do `case` e compara o resultado com `$pessoa` usando `==`. Como `($pessoa >= 0 && $pessoa <= 3)` retorna um **booleano**, o PHP está comparando na prática `(bool)$pessoa == true`.

O resultado real:

| `$pessoa` | Resultado do código errado | Resultado correto |
|---|---|---|
| `0` | Criança ❌ | Bebê |
| `7` | Criança ✔️ | Criança |
| `15` | Adolescente ✔️ | Adolescente |
| `25` | Idade inválida ❌ | Adulto |
| `30` | Idade inválida ❌ | Adulto |

> 🎯 **Regra:** `switch` é para **igualdade com valores fixos** (`case 1:`, `case "segunda":`). Para **faixas e condições lógicas**, use **`if / elseif`**.

---

## 3.5.3 Operador Ternário

Condicional em **uma única linha**. Equivale exatamente a um `if/else` simples:

```php
echo $nota >= 7 ? "Aprovado" : "Reprovado";
```

Formato: `condição ? valor_se_verdadeiro : valor_se_falso`

### Operador Null Coalescing `??`

Evita erro ao usar uma variável que pode não existir:

```php
$usuario = null;
echo $usuario ?? "Visitante";   // Visitante
```

Sem o `??`, o PHP geraria *Warning: Undefined variable*.

---

## 🔗 Links Úteis

### Videos
- [Estruturas condicionais no PHP (vídeo)](https://youtu.be/XokMeyowKNA?si=2YtbeMEB9_SYazWy) — Condicionais na prática
- [Operadores no PHP (vídeo)](https://youtu.be/8bjt7zpuJyo?si=ngg_5jF-S-V2d6Gi) — Revisão dos operadores
- [Tipos de variáveis no PHP (vídeo)](https://youtu.be/tw7tsV6bQSo?si=Htj_xRA5ul9bBFJD) — Entenda os tipos de dados

### Artigos
- [Estruturas condicionais em PHP — Rocketseat](https://rocketseat.com.br/blog/artigos/post/estruturas-condicionais-php-guia-para-iniciantes) — Guia completo de if, switch e ternário
- [O manual do PHP — freeCodeCamp](https://www.freecodecamp.org/portuguese/news/o-manual-do-php-guia-para-iniciantes-em-php) — Como usar `$_GET`, `$_POST` e `$_REQUEST`

### Documentação oficial
- [Tipos de dados — php.net](https://www.php.net/manual/pt_BR/language.types.php)
- [Conversão automática de tipos — php.net](https://www.php.net/manual/pt_BR/language.types.type-juggling.php)
- [Conversão de tipo (casting) — php.net](https://www.php.net/manual/pt_BR/language.types.casting.php)
- [$_POST — php.net](https://www.php.net/manual/pt_BR/reserved.variables.post.php)
- [$_GET — php.net](https://www.php.net/manual/pt_BR/reserved.variables.get.php)
- [`readline()` — php.net](https://www.php.net/manual/pt_BR/function.readline.php)
- [Estruturas de controle — php.net](https://www.php.net/manual/pt_BR/control-structures.php)
- [Tabelas de comparação de tipos — php.net](https://www.php.net/manual/pt_BR/types.comparisons.php)

---

## 🏆 Desafio da Aula — Sistema de Gestão de Notas

Este desafio consolida **tudo** das Aulas 03 e 04. Tente fazer **antes** de abrir a solução de referência em `desafio.php`.

### 🎯 Objetivo

Criar um sistema de console que cadastra alunos, recebe notas, valida os dados e mostra um relatório final com classificação e situação.

### 📋 Requisitos Funcionais

**1. Menu principal (use `switch`)**
- Opções: `1` Cadastrar aluno · `2` Registrar notas · `3` Ver relatório · `4` Sair
- Usar `default` para tratar opção inválida

**2. Cadastro de aluno**
- Solicitar `nome` e `idade` via `readline()`
- Validar com `if/elseif`: idade abaixo de 16 gera "Idade inválida para o sistema"
- Ao cadastrar, informar o **índice** do aluno no array (ex.: `var_dump($alunos)`)

**3. Registro de notas**
- Solicitar 2 notas por aluno (`$nota1`, `$nota2`)
- **Cast ambas para `float`**: `readline()` sempre devolve string
- Validar se a nota está entre `0` e `10` (use `if/elseif`)
- Guardar no array `$notas`

**4. Cálculo da média**
- Usar **constantes** para os pesos: `const PESO1 = 4.0; const PESO2 = 6.0;`
- Média ponderada: `($nota1 * PESO1 + $nota2 * PESO2) / (PESO1 + PESO2)`
- Exibir com 2 casas decimais usando `number_format()` ou `round()`

**5. Classificação (use ternário ou `if/elseif`)**

| Média | Situação |
|---|---|
| `>= 7.0` | Aprovado |
| `>= 5.0` e `< 7.0` | Recuperação |
| `< 5.0` | Reprovado |

**6. Relatório final**
- Liste todos os alunos com `print_r()` ou `var_dump()`
- Mostre média e situação de cada um
- Exiba a média geral da turma

### 🧠 Conceitos obrigatórios (todos já estudados)

| Conceito | Onde usar |
|---|---|
| `echo` / `print` / `var_dump()` / `print_r()` | Toda a saída de dados |
| Variáveis com `$` | Todo o código |
| Constantes `const` | Pesos da média ponderada |
| Operadores aritméticos | Cálculo da média |
| Operadores relacionais `===` e `>=` | Todas as validações |
| Operadores lógicos `&&` | Validação de nota e idade |
| **Coerção / casting** | `(int)` na idade e `(float)` nas notas |
| **Entrada de dados** | `readline()` no terminal |
| **`if / elseif / else`** | Validações e classificação |
| **`switch`** | Menu principal |

### ⭐ Bônus (para quem chegar atrasado nas próximas aulas)

| Desafio | Conceito |
|---|---|
| Usar `match` em vez de `switch` no menu | PHP 8+ |
| Cadastrar N alunos e usar `foreach` para o relatório | Laços de repetição |
| Criar uma **função** `classificar($media)` | Funções |
| Validar com `filter_input()` ou `filter_var()` | Validação nativa |
| Proteger contra `readline()` fora do terminal com `PHP_SAPI` | Robustez |

### 🧪 Teste seu conhecimento

Responda antes de rodar o código:

1. Qual a diferença entre `$a == $b` e `$a === $b`? Dê um exemplo que muda o resultado.
2. Por que `(int) 7.9` retorna `7` e não `8`?
3. Por que `$_POST['idade']` precisa de `(int)` antes de um cálculo?
4. Quando usar `switch` em vez de `if/elseif`?
5. O que acontece se você esquecer o `break` no `switch`?
6. Quais valores são considered `false` em um `if`?

<details>
<summary>🔎 Clique para ver as respostas</summary>

1. `==` compara só o valor (com coerção de tipos); `===` compara valor **e** tipo. `"10" == 10` é `true`, mas `"10" === 10` é `false`.
2. Casting **trunca** a parte decimal, não arredonda. Para arredondar use `round(7.9)` ou `(int) round(7.9)`.
3. `$_POST` e `$_GET` sempre entregam **string**. Sem o cast, `"10" + 5` até funciona por coerção, mas comparações com `===` falhariam e strings não numéricas causam TypeError.
4. Use `switch` quando a variável tem **opções fixas** e você compara **igualdade** (menus, dias da semana, status). Use `if/elseif` para faixas de valores ou condições lógicas.
5. O fluxo **não para** — os `case` seguintes também executam (*fall-through*). Isso causa resultados duplicados e errados.
6. `0`, `0.0`, `""`, `"0"`, `null`, `[]` e `false`. Cuidado: `"false"` e `" "` são `true`.

</details>

---

## 📌 Resumo dos Tópicos Cobertos

1. **3.3 Tipos e conversões** — Escalares (`int`, `float`, `string`, `bool`) e compostos (`array`, `object`); `gettype()`, `get_debug_type()`, `is_int()`/`is_string()`; coerção automática vs casting; valores *falsy*; `==` vs `===`
2. **3.4 Interatividade** — `$_POST` e `$_GET` (com `isset()`), `trim()`, `htmlspecialchars()`; `readline()` no terminal com guarda `PHP_SAPI`
3. **3.5.1 Condicionais** — `if / elseif / else`, condições combinadas, aninhamento
4. **3.5.2 Condicionais** — `switch`, `break`, *fall-through*, agrupamento de `case`, `default`, e por que **não** usar `switch` para faixas
5. **3.5.3** — Operador ternário e null coalescing `??`

---

## 🗺️ Roadmap de Estudos — Checklist de Revisão

### 🔴 Imprescindível — Aula 04

- [ ] **Saber os tipos do PHP** — `int`, `float`, `string`, `bool`, `array`, `object`
- [ ] **Diferença entre coerção automática e casting** — quando o PHP converte sozinho vs `(int)`, `(float)`, `(string)`
- [ ] **Castings disponíveis** — `(int)` `(bool)` `(float)` `(string)` `(array)` `(object)`
- [ ] **Valores *falsy*** — `0`, `0.0`, `""`, `"0"`, `null`, `[]`, `false`
- [ ] **`is_numeric()`** — validar antes de calcular (evita TypeError no PHP 8)
- [ ] **`$_POST` vs `$_GET`** — quando usar cada um e a diferença de visibilidade na URL
- [ ] **`isset()`** — proteger o acesso a dados que podem não existir
- [ ] **`trim()`** — limpar espaços do input
- [ ] **`readline()`** — entrada de dados no terminal, e que só funciona no CLI
- [ ] **`PHP_SAPI === 'cli'`** — como o PHP descobre em que ambiente está rodando
- [ ] **`if / elseif / else`** — ordem de avaliação e primeiro bloco verdadeiro
- [ ] **`switch`** — `break`, `default`, agrupamento de `case` sem corpo
- [ ] **Saber que `switch` NÃO serve para faixas** — isso é `if/elseif`
- [ ] **Ternário** — condicional em uma linha

### 🟡 Revisão — Aulas anteriores

- [ ] **Aula 03:** `echo`, `print`, `print_r()`, `var_dump()` e as 3 formas de concatenar
- [ ] **Aula 03:** Variáveis case-sensitive e constantes (`define()` / `const`)
- [ ] **Aula 03:** Operadores aritméticos, relacionais (`===`!) e lógicos
- [ ] **Aula 02:** `php index.php` no terminal e `php -S localhost:8000` no navegador
- [ ] **Aula 02:** Formulário HTML com `action` e `method`
- [ ] **Aula 01:** Ciclo Entrada → Processamento → Saída — **a aula de hoje fechou esse ciclo**, já que o PHP agora recebe dados de verdade

### 🟢 Próximos Passos

- [ ] **3.6 Laços de repetição** — `while`, `for`, `foreach`, `do-while`
- [ ] **3.7 Arrays** — indexados, associativos e multidimensionais
- [ ] **3.8 Funções** — declaração, parâmetros, argumentos, retorno, escopo e funções anônimas
- [ ] **3.9 / 3.10** — Manipulação de strings e funções nativas
- [ ] **3.11 Debugging** — ler mensagens de erro e usar o `var_dump()` a seu favor
- [ ] **3.12 Projeto da unidade** — Calculadora + sistema de notas com regras reais + menu simples

---

## 💡 Dicas de Ouro

> **`switch` é para igualdade, `if` é para lógica.** Se você escreveu `case ($x >= 10 && $x <= 20)`, o problema é seu código — use `if`.

> **Sempre valide entrada.** Um `is_numeric()` antes do cálculo evita um TypeError fatal que derruba a página inteira.

> **Use `===` sempre.** Comparar tipos diferentes com `==` é a origem de metade dos bugs em PHP.

> **Falta o `name` no input, o `$_POST` não acha.** O `name` é o que o PHP usa como chave; o `id` é só para o CSS e o JavaScript.

---

*Recap produzido para a turma da Aula 04 do Módulo de Prática.*
*Professor: Luis Felipe Araujo Lima*