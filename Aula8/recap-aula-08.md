# 📘 Recap da Aula 08 — Arrays, Funções, Strings & Projeto

> **Tema da aula:** *Fundamentos do PHP — estruturas compostas, modularização e projeto real*
> **Slides trabalhados:** tópicos **3.7 a 3.12** (Arrays, Funções, Strings, Nativas, Debugging e Projeto)
> **Módulo:** 3 · Fundamentos PHP
> **Público-alvo:** iniciantes, quem faltou e quem quer revisar antes do próximo encontro.

**Objetivo:** sair das variáveis soltas e passar a organizar dados **em coleções**, encapsular lógica **em funções** e juntar tudo em um **projeto real** (calculadora + sistema de notas). No caminho, tratamos textos, usamos funções nativas, aprendemos a depurar e conhecemos **getters e setters**.

> [!TIP]
> O código completo e executável está em **[`index.php`](index.php)** e a classe de exemplo em **[`wagner.php`](wagner.php)**.
> Rode com `php index.php` (terminal) ou `php -S localhost:8000` (navegador).
> O menu interativo roda com `php index.php input`.

---

## 🗺️ Mapa da Aula

| # | Tópico | O que você aprende |
|:-:|--------|--------------------|
| 3.7.1 | 📁 [Arrays indexados](#-371-arrays-indexados) | lista com índice numérico a partir de `0` |
| 3.7.2 | 🗂️ [Arrays associativos](#-372-arrays-associativos) | pares **chave → valor** |
| 3.7.3 | 🧱 [Arrays multidimensionais](#-373-arrays-multidimensionais-matrizes) | matrizes e tabelas (`$m[linha][coluna]`) |
| 3.8.1–3.8.3 | 🧩 [Funções: declaração, parâmetros e argumentos](#-381-a-383-funções-parâmetros-e-argumentos) | reutilizar lógica |
| 3.8.4–3.8.5 | 🔁 [Retorno e escopo](#-384-a-385-retorno-e-escopo) | `return` e variáveis locais × globais |
| 3.8.6 | 🎭 [Funções anônimas e closures](#-386-funções-anônimas-e-closures) | funções em variáveis e `use` |
| 3.9 | 🔤 [Manipulação de texto](#-39-manipulação-de-texto-strings) | `strlen`, `str_replace`, `explode`/`implode` |
| 3.10 | 🧰 [Funções nativas úteis](#-310-funções-nativas-úteis) | `count`, `array_sum`, `sort`, `array_map` |
| 3.11 | 🐞 [Debugging](#-311-debugging) | `var_dump`, `print_r` e leitura de erros |
| 3.12 | 🧮 [Projeto: calculadora e notas](#-312-projeto-calculadora-e-sistema-de-notas) | juntar tudo em um sistema |
| ➕ | 🔐 [Getters e setters](#-getters-e-setters-encapsulamento) | encapsulamento e validação |
| 📚 | [Links para estudar getters e setters](#-links-úteis-para-estudar-getters-e-setters) | material de aprofundamento |

---

## 📁 3.7.1 Arrays indexados

Um **array indexado** é uma coleção ordenada em que cada item é acessado por um **índice numérico** que **começa em `0`**.

```php
// Criando um array indexado
$linguagens = ["PHP", "JS", "Python"];

// Acessando por índice
echo $linguagens[0];   // PHP
echo $linguagens[2];   // Python

// Adicionando ao final
$linguagens[] = "SQL"; // [PHP, JS, Python, SQL]
```

| Índice | Valor |
|:------:|-------|
| `0` | PHP |
| `1` | JS |
| `2` | Python |
| `3` | SQL |

**Percorrendo com `foreach` (revisão da Aula 07):**

```php
foreach ($linguagens as $indice => $linguagem) {
    echo "$indice => $linguagem\n";
}
```

> [!WARNING]
> O primeiro índice é **`0`**, não `1`. Errar isso é a causa nº 1 de *"Undefined array key"* em PHP.

> [!TIP]
> Dá para consultar o tamanho com `count($linguagens)`. Use `$array[] = ...` para adicionar sem se preocupar com o próximo índice.

---

## 🗂️ 3.7.2 Arrays associativos

Nos **arrays associativos**, usamos **chaves nomeadas** (strings) em vez de índices numéricos. A sintaxe é **`chave => valor`**.

```php
$aluno = [
    "nome"        => "Ana Silva",
    "curso"       => "Sistemas",
    "coeficiente" => 8.9,
];

echo $aluno["nome"];         // Ana Silva
echo $aluno["coeficiente"];  // 8.9
```

**Percorrendo chave e valor:**

```php
foreach ($aluno as $chave => $valor) {
    echo "$chave: $valor\n";
}
```

**Saída:**

```text
nome: Ana Silva
curso: Sistemas
coeficiente: 8.9
```

| Vantagem | Por quê |
|----------|---------|
| **Semântica clara** | `$aluno["nome"]` diz mais que `$aluno[0]` |
| **Ideal para registros** | representa um "objeto simples" |
| **Chaves estáveis** | não dependem da ordem de inserção |

> [!IMPORTANT]
> Use **associativo** quando cada valor tem um **significado** (nome, preço, nota). Use **indexado** quando a **posição** já basta (lista de números, nomes).

---

## 🧱 3.7.3 Arrays multidimensionais (matrizes)

Um **array multidimensional** contém **outros arrays** dentro. É a forma de representar **matrizes e tabelas**.

```php
$turma = [
    ["nome" => "Lucas", "nota" => 9.5],
    ["nome" => "Carla", "nota" => 7.0],
];

// Regra de acesso: $matriz[linha][coluna]
echo $turma[1]["nota"];   // 7.0 (linha 1, chave "nota")
```

**Desenhando a matriz:**

```text
              ["nome"]     ["nota"]
             ┌───────────┬─────────┐
$turma[0]    │  "Lucas"  │   9.5   │
$turma[1]    │  "Carla"  │   7.0   │
             └───────────┴─────────┘
                    ▲
          $turma[1]["nota"] = 7.0
```

**Percorrendo com `foreach`:**

```php
foreach ($turma as $estudante) {
    echo $estudante["nome"] . ": " . $estudante["nota"] . "\n";
}
```

> [!TIP]
> Pense em **`$turma`** como uma **tabela**: cada linha é um array associativo com as colunas.

---

## 🧩 3.8.1 a 3.8.3: Funções, parâmetros e argumentos

**Função** é um bloco de código com nome que você pode **reutilizar**. Ela recebe dados, processa e pode devolver um resultado.

```php
function saudar($nome, $titulo = "Sr(a)") {
    return "Olá, $titulo $nome!";
}

// Chamadas com argumentos
echo saudar("Carlos");          // Olá, Sr(a) Carlos!
echo saudar("Elena", "Dra.");   // Olá, Dra. Elena!
```

### 🔍 Parâmetro × Argumento

| Conceito | O que é | Onde aparece |
|----------|---------|--------------|
| **Parâmetro** | variável declarada na **assinatura** da função | `function saudar($nome, $titulo)` |
| **Argumento** | valor **real** passado na **chamada** | `saudar("Elena", "Dra.")` |

```text
function saudar($nome, $titulo = "Sr(a)")
                 ▲       ▲
             parâmetro  parâmetro (com valor padrão)

saudar("Elena", "Dra.")
        ▲        ▲
     argumento  argumento
```

> [!NOTE]
> **Valor padrão** (`$titulo = "Sr(a)"`) é usado quando o argumento **não é passado**. Por isso `saudar("Carlos")` funciona.
> Funções modernas podem declarar tipos: `function saudar(string $nome): string`.

---

## 🔁 3.8.4 a 3.8.5: Retorno e escopo

### `return`

**Encerra a função** e **devolve o valor** para quem a chamou.

```php
function calcularTotal($preco) {
    $imposto = 5.0;
    return $preco + $imposto;   // devolve o resultado
}

$total = calcularTotal(100);    // $total = 105
```

### Escopo

Variáveis criadas **dentro** da função são **locais** — não existem fora dela.

```php
$taxa = 1.1;   // escopo GLOBAL

function calcularTotal($preco) {
    $imposto = 5.0;   // escopo LOCAL
    return $preco + $imposto;
}

$res = calcularTotal(100);

echo $taxa;      // ✅ 1.1 (global)
echo $imposto;   // ❌ erro: $imposto não existe aqui
```

```text
┌───────────────────── ESCOPO GLOBAL ─────────────────────┐
│  $taxa = 1.1                                            │
│                                                         │
│   ┌──────────────── ESCOPO DA FUNÇÃO ────────────────┐  │
│   │  $imposto = 5.0   (só existe aqui dentro)        │  │
│   └──────────────────────────────────────────────────┘  │
└─────────────────────────────────────────────────────────┘
```

> [!WARNING]
> Não confunda os escopos. Se precisar usar uma variável global dentro da função, o ideal é **passá-la por parâmetro** — evitar `global $x` deixa o código mais previsível.

---

## 🎭 3.8.6 Funções anônimas e closures

**Função anônima** é uma função **sem nome**, que pode ser guardada em uma variável ou passada como argumento (**callback**).

```php
$desconto = 10;

$aplicarDesconto = function ($valor) use ($desconto) {
    return $valor - $desconto;
};

echo $aplicarDesconto(100);   // 90
```

| Conceito | Papel |
|----------|-------|
| **Função anônima** | `function (...) { ... }` sem nome |
| **Closure** | função anônima que "captura" variáveis do escopo pai |
| **`use (...)`** | cláusula que traz variáveis de fora para dentro |

**Bônus:** as **arrow functions** (`fn`) são a forma curta:

```php
$dobrar = fn($n) => $n * 2;
echo $dobrar(5);   // 10
```

> [!NOTE]
> Sem o `use ($desconto)`, a variável `$desconto` **não** estaria disponível dentro da função anônima.

---

## 🔤 3.9 Manipulação de texto (strings)

| Função | O que faz | Exemplo |
|--------|-----------|---------|
| `strlen()` | tamanho da string | `strlen("PHP")` → `3` |
| `strtoupper()` | deixa em MAIÚSCULAS | `"php"` → `"PHP"` |
| `strtolower()` | deixa em minúsculas | `"PHP"` → `"php"` |
| `substr()` | extrai um trecho | `substr("PHP", 0, 3)` → `"PHP"` |
| `str_replace()` | substitui ocorrências | troca `"simples"` por `"poderoso"` |
| `explode()` | string → array | `"a,b,c"` → `["a","b","c"]` |
| `implode()` | array → string | `["a","b"]` → `"a,b"` |
| `trim()` | remove espaços nas pontas | `"  Ana  "` → `"Ana"` |

```php
$texto = "PHP e simples";

echo strlen($texto);                            // 13
echo strtoupper($texto);                        // PHP E SIMPLES
echo substr($texto, 0, 3);                      // PHP
echo str_replace("simples", "poderoso", $texto); // PHP e poderoso

$csv = "maçã,banana,uva";
$frutas = explode(",", $csv);      // string → array
echo implode(" | ", $frutas);       // array → string
```

**Saída de `implode`:**

```text
maçã | banana | uva
```

> [!WARNING]
> **`strlen()` conta bytes**, não caracteres. Em textos com acento (`"é"`), a contagem pode ser maior que o esperado. Para contar **caracteres** com acentuação, use **`mb_strlen()`** (extensão `mbstring`).

---

## 🧰 3.10 Funções nativas úteis

O PHP já traz centenas de funções prontas. Algumas do dia a dia:

| Função | Para que serve |
|--------|----------------|
| `count($array)` | quantos itens há no array |
| `array_sum($array)` | soma dos valores |
| `max()` / `min()` | maior / menor valor |
| `sort($array)` | ordena o array |
| `in_array($valor, $array)` | o valor existe no array? |
| `array_map($fn, $array)` | aplica uma função a cada item |
| `array_filter($array, $fn)` | filtra itens por condição |
| `number_format($n, 2)` | formata números decimais |
| `isset()` / `empty()` | existe? está vazio? |

```php
$numeros = [4, 8, 2, 10];

echo array_sum($numeros);   // 24
echo max($numeros);         // 10
echo min($numeros);         // 2

sort($numeros);             // [2, 4, 8, 10]

var_dump(in_array(8, $numeros));   // bool(true)

$dobrados = array_map(fn($n) => $n * 2, $numeros);   // [4, 8, 16, 20]
```

> [!TIP]
> Antes de escrever um laço "na mão", **procure uma função nativa**. `array_sum`, `array_map` e `array_filter` economizam bastante código.

---

## 🐞 3.11 Debugging

**Depurar** é descobrir **por que** o programa não faz o que você espera. As duas ferramentas principais:

| Ferramenta | O que mostra | Quando usar |
|------------|--------------|-------------|
| `var_dump($x)` | **valor + tipo + tamanho** | investigar o tipo de um dado |
| `print_r($x)` | estrutura legível de arrays | visualizar arrays grandes |

```php
$dados = ["PHP", 8, true];

var_dump($dados);
print_r($dados);
```

**Saída do `var_dump`:**

```text
array(3) {
  [0]=> string(3) "PHP"
  [1]=> int(8)
  [2]=> bool(true)
}
```

**Saída do `print_r`:**

```text
Array
(
    [0] => PHP
    [1] => 8
    [2] => 1
)
```

> [!IMPORTANT]
> **`var_dump()` é o detetive.** Quando algo "não faz sentido", imprima o valor **e o tipo**. Muitos bugs são só um `"25"` (string) sendo comparado com `25` (int).

> [!TIP]
> Erros comuns de leitura: *"Undefined array key"* → a chave não existe (use `??`); *"Trying to access array offset on null"* → a variável não é um array; *"Division by zero"* → trate o divisor antes de dividir.

---

## 🧮 3.12 Projeto: calculadora e sistema de notas

A união de tudo: **funções** para a calculadora, **arrays** para as notas e **regras de negócio** para a situação do aluno.

### 🧮 Calculadora

```php
function somar(float $a, float $b): float
{
    return $a + $b;
}

function dividir(float $a, float $b): float
{
    if ($b == 0) {
        throw new InvalidArgumentException("Não é possível dividir por zero.");
    }
    return $a / $b;
}

echo somar(10, 5);     // 15
echo dividir(10, 5);   // 2
```

### 🎓 Sistema de notas

```php
function media(array $notas): float
{
    return array_sum($notas) / count($notas);
}

function situacao(float $media, float $presenca): string
{
    if ($media >= 7 && $presenca >= 0.75) {
        return "Aprovado";
    }

    if ($media >= 5 && $presenca >= 0.75) {
        return "Recuperação";
    }

    return "Reprovado";
}

$notas = [8.5, 7.0, 9.0];
$mediaFinal = media($notas);

echo number_format($mediaFinal, 2);          // 8.17
echo situacao($mediaFinal, 0.80);            // Aprovado
```

### 🖥️ Menu interativo no terminal

O projeto ganha um **menu** com `while` + `switch` + `readline()`:

```text
1 - Somar
2 - Subtrair
3 - Média de notas
4 - Sair
Escolha: 3
Notas separadas por vírgula: 8.5,7,9
Média: 8.17
```

> [!NOTE]
> No [`index.php`](index.php), o menu só roda quando chamado com `php index.php input` — assim o script não "trava" esperando entrada em outras execuções.

---

## 🔐 Getters e setters (encapsulamento)

Esta foi a **primeira aproximação** com **Programação Orientada a Objetos (POO)**, que será aprofundada no **módulo 9**.

A ideia central é o **encapsulamento**: as propriedades do objeto ficam **privadas** (`private`) e só podem ser lidas/alteradas por **métodos públicos** — os **getters** e **setters**.

```php
class Aluno
{
    private float $nota = 0;

    // GETTER: lê o valor
    public function getNota(): float
    {
        return $this->nota;
    }

    // SETTER: altera com validação
    public function setNota(float $nota): void
    {
        if ($nota < 0 || $nota > 10) {
            throw new InvalidArgumentException("Nota entre 0 e 10.");
        }
        $this->nota = $nota;
    }
}
```

**Usando a classe:**

```php
$aluno = new Aluno();
$aluno->setNota(8.5);        // passa pelo setter (valida)
echo $aluno->getNota();      // 8.5 (passa pelo getter)

// echo $aluno->nota;        // ❌ erro: propriedade privada
```

```text
        ┌───────────────────┐
        │      Aluno        │
        ├───────────────────┤
        │ - nota: float     │  ← private (ninguém acessa direto)
        ├───────────────────┤
        │ + getNota()       │  ← getter (leitura)
        │ + setNota($nota)  │  ← setter (escrita com validação)
        └───────────────────┘
```

| Método | Prefixo | Papel |
|--------|---------|-------|
| **Getter** | `get...()` | **lê** o valor da propriedade |
| **Setter** | `set...()` | **altera** o valor, com validação |

### Por que não deixar tudo público?

| Tudo público (`public $nota`) | Com getters/setters |
|-------------------------------|---------------------|
| qualquer um altera sem controle | o setter **valida** (`0` a `10`) |
| valores inválidos entram fácil | dados ficam **consistentes** |
| a regra fica espalhada | a regra fica **num só lugar** |
| difícil mudar no futuro | pode mudar o "por dentro" sem quebrar o uso |

**No exemplo da aula**, a classe **[`Wagner`](wagner.php)** guarda `nota` e `presenca`, expõe `getNota()`, `setNota()`, `getPresenca()`, `setPresenca()` e o método de negócio `condicao()`:

```php
$estudante = new Wagner();
$estudante->setNota(8.5);
$estudante->setPresenca(80);        // aceita 80 = 80%

echo $estudante->getNota();              // 8.5
echo $estudante->getPresencaFormatada(); // 80%
echo $estudante->condicao();             // Aprovado
```

> [!IMPORTANT]
> **Convenção:** `get` para **ler**, `set` para **gravar**. Sempre que um setter receber um valor, **valide antes de guardar**.
> **Não** crie getters/setters "de enfeite" para tudo: use quando há **regra** ou quando quer proteger o estado.

---

## 📚 Links úteis para estudar getters e setters

**Documentação oficial do PHP (pt-BR):**
- [Classes e Objetos — visão geral](https://www.php.net/manual/pt_BR/language.oop5.php)
- [Visibilidade (`public`, `protected`, `private`)](https://www.php.net/manual/pt_BR/language.oop5.visibility.php)
- [Propriedades](https://www.php.net/manual/pt_BR/language.oop5.properties.php)
- [O básico de classes e objetos](https://www.php.net/manual/pt_BR/language.oop5.basic.php)
- [Métodos mágicos (`__get`, `__set`)](https://www.php.net/manual/pt_BR/language.oop5.magic.php)

**Tutoriais e material complementar:**
- [W3Schools — PHP OOP: Classes e Objetos](https://www.w3schools.com/php/php_oop_classes_objects.asp)
- [W3Schools — Modificadores de acesso](https://www.w3schools.com/php/php_oop_access_modifiers.asp)
- [PHP: The Right Way](https://phptherightway.com/) — boas práticas gerais da linguagem

**Para praticar:**
- Reescreva a classe `Wagner` adicionando um **setter** para `nome` que rejeite texto vazio.
- Crie uma classe `Produto` com `preco` privado e um setter que **impeça preço negativo**.
- Leia a página de **visibilidade** e explique, com suas palavras, a diferença entre `public`, `protected` e `private`.

> [!TIP]
> Getters e setters são a **porta de entrada** para encapsulamento, herança e polimorfismo — temas do **módulo 9 (POO + MVC)**. Vale dominar a base agora.

---

## ✅ O que aprendemos hoje

```text
┌─────────────────────────────────────────────────────────┐
│                        APRENDEMOS                        │
├─────────────────────────────────────────────────────────┤
│ • Arrays indexados, associativos e multidimensionais     │
│ • Funções: parâmetros, argumentos, retorno e escopo      │
│ • Funções anônimas, closures e arrow functions           │
│ • Strings: strlen, str_replace, explode/implode, substr  │
│ • Funções nativas: count, array_sum, sort, array_map     │
│ • Debugging com var_dump e print_r                       │
│ • Projeto: calculadora + sistema de notas com menu       │
│ • Getters e setters (encapsulamento)                     │
└─────────────────────────────────────────────────────────┘
```

---

## 🧠 Teste seu conhecimento

1. Qual é o **primeiro índice** de um array indexado em PHP?
2. Qual a diferença entre array **indexado** e **associativo**?
3. Escreva o acesso à nota do **segundo** aluno de `$turma` (matriz).
4. Qual a diferença entre **parâmetro** e **argumento**?
5. O que o `return` faz dentro de uma função?
6. Por que `$imposto` (criada dentro da função) não existe fora dela?
7. Para que serve a cláusula **`use`** em uma função anônima?
8. Qual função converte **string em array**? E **array em string**?
9. Qual a diferença entre `var_dump()` e `print_r()`?
10. O que é **encapsulamento** e qual o papel dos **getters/setters**?
11. Por que validar dentro do **setter** é melhor que deixar a propriedade pública?
12. O que acontece se você acessar `$aluno->nota` com a propriedade `private`?

<details>
<summary>🔎 Clique para ver as respostas</summary>

1. **`0`** — os índices numéricos começam em zero.
2. **Indexado** usa índice numérico automático (`0, 1, 2...`); **associativo** usa chaves nomeadas (`"nome"`, `"nota"`).
3. `$turma[1]["nota"]` (linha `1`, chave `"nota"`).
4. **Parâmetro** é a variável na assinatura da função; **argumento** é o valor real passado na chamada.
5. Encerra a função e **devolve um valor** para quem a chamou.
6. Porque foi criada no **escopo local** da função — cada função tem seu próprio espaço de variáveis.
7. Para **herdar variáveis do escopo pai** dentro da função anônima (closure).
8. `explode()` (string → array) e `implode()` (array → string).
9. `var_dump()` mostra **valor + tipo + tamanho** (ideal para debug); `print_r()` mostra só a estrutura legível (bom para arrays).
10. **Encapsulamento** protege o estado do objeto. **Getters** leem e **setters** alteram (com validação).
11. Porque centraliza a **regra de validação** e impede valores inválidos — mantém o objeto **consistente**.
12. Um **erro fatal**: a propriedade é privada e não pode ser acessada de fora da classe.

</details>

---

## 🗺️ Checklist de Estudos

### 🔴 Imprescindível — Aula 08

- [ ] Criar e acessar arrays **indexados** (lembrando do índice `0`)
- [ ] Criar e percorrer arrays **associativos** com `chave => valor`
- [ ] Montar e acessar **matrizes** (`$m[linha][coluna]`)
- [ ] Declarar funções com **parâmetros** e **valor padrão**
- [ ] Diferenciar **parâmetro** de **argumento**
- [ ] Usar `return` e entender **escopo** local × global
- [ ] Escrever função **anônima** com `use`
- [ ] Usar `strlen`, `str_replace`, `explode`, `implode`, `substr`
- [ ] Aplicar funções nativas (`count`, `array_sum`, `sort`, `array_map`)
- [ ] Depurar com `var_dump()` e `print_r()`
- [ ] Construir a **calculadora** e o **sistema de notas**
- [ ] Explicar e usar **getters e setters**

### 🟡 Revisão — Aulas anteriores

- [ ] **Aula 07:** laços `while`, `do-while`, `for` e `foreach`
- [ ] **Aula 06:** entrada de dados e condicionais na prática
- [ ] **Aula 05:** revisão 3.1–3.5 + introdução aos laços
- [ ] **Aula 04:** tipos, coerção, `$_POST`/`$_GET` e condicionais
- [ ] **Aula 03:** saída, variáveis, constantes e operadores

### 🟢 Próximos passos

- [ ] **Módulo 4 — Banco de Dados:** MySQL, modelagem e CRUD
- [ ] **Módulo 9 — POO + MVC:** aprofundar classes, herança e encapsulamento
- [ ] Refazer o [projeto da aula](index.php) adicionando **validação de entrada**

---

## 🔗 Links úteis (geral)

**Documentação oficial (php.net):**
- [Arrays](https://www.php.net/manual/pt_BR/language.types.array.php)
- [Funções definidas pelo usuário](https://www.php.net/manual/pt_BR/functions.user-defined.php)
- [Funções anônimas](https://www.php.net/manual/pt_BR/functions.anonymous.php)
- [Strings](https://www.php.net/manual/pt_BR/language.types.string.php)
- [Referência de funções de array](https://www.php.net/manual/pt_BR/ref.array.php)
- [Referência de funções de string](https://www.php.net/manual/pt_BR/ref.strings.php)

**Getters e setters:**
- [Visibilidade](https://www.php.net/manual/pt_BR/language.oop5.visibility.php) · [Propriedades](https://www.php.net/manual/pt_BR/language.oop5.properties.php) · [Classes e objetos](https://www.php.net/manual/pt_BR/language.oop5.basic.php)

**Para praticar:**
- Refaça os exemplos do [`index.php`](index.php) sem olhar o código.
- Transforme o array `$turma` em um **relatório** com média da turma e melhor nota.
- Crie uma função `resumir(string $texto, int $limite)` que use `strlen` e `substr`.

---

## 💡 Dicas de ouro

> **Array indexado começa em `0`.** Sempre.

> **Associativo para registros.** Se o dado tem "nome", use chave `"nome"`.

> **Função é para reaproveitar.** Se você copiou e colou o mesmo bloco, provavelmente era uma função.

> **Escopo é local por padrão.** O que nasce na função morre na função.

> **`var_dump()` antes de reclamar.** Veja o **valor e o tipo** antes de "chutar".

> **Get é leitura, set é escrita.** E todo setter sério **valida**.

> **Procure a função nativa.** O PHP já resolve muita coisa; não reinvente a roda.

---

*Recap produzido para a turma da Aula 08 — Módulo 3 · Fundamentos PHP.*
*Professor: Luis Felipe Araujo Lima*
