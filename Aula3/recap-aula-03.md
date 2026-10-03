# 📋 Recap da Aula 03 — Módulo de Prática

## Fundamentos PHP: Saída de Dados, Variáveis, Constantes e Operadores

**Público-alvo:** Para Leigos & Iniciantes  
**Objetivo:** Dar os primeiros passos práticos na sintaxe do PHP — exibir dados, guardar valores em memória, operar números e tomar decisões no código.

---

## 1.5 Recapitulação Rápida da Aula 02

Antes de mergulhar no código, vale revisar o essencial da aula anterior:

| Item | Revisão |
|---|---|
| **VS Code + Intelephense** | Editor configurado com autocompletar e detecção de erros |
| **Terminal** | `pwd`, `ls`, `cd`, `cd ..` para navegar |
| **Executar via CLI** | `php index.php` roda o arquivo direto no terminal |
| **Servidor local** | `php -S localhost:8000` abre o projeto no navegador |

> Everything conectado: o terminal é o painel do piloto, a IDE é a oficina e o PHP é o motor.

---

## 3.1 Saída de Dados — Exibindo informações na tela

Quatro formas de escrever informação na tela, cada uma com seu propósito:

| Comando | Quando usar | Comportamento |
|---|---|---|
| `echo` | Caso padrão (90% dos casos) | Imprime texto e variáveis. Não retorna valor |
| `print` | Quando precisa de um `1` de retorno | Idêntico ao `echo`, mas **sempre retorna 1** (útil em expressões) |
| `print_r()` | Depuração rápida de arrays | Mostra a estrutura de forma legível |
| `var_dump()` | Debug detalhado | Mostra **tipo e valor**, ideal para caçar bugs |

```php
echo "Olá, Mundo!";
$nome = "Maria";
print "Bem-vinda, $nome!";
```

### Três Formas de Concatenar

```php
echo "Olá" . " " . "Mundo";    // Com o ponto (.)
echo "Olá, $nome";              // Dentro de aspas duplas
echo "Olá, {$nome}";            // Com chaves (necessário em expressões)
```

### O Truque do `var_export()`

Quando você usa `var_export($x, true)`, ele retorna o valor como texto em vez de imprimir. Perfeito para exibir `true`/`false` de forma legível dentro de uma concatenação:

```php
echo "Resultado: " . var_export($a > $b, true);  // Resultado: true
```

---

## 3.2 Variáveis e Constantes — Guardando Valores em Memória

### Variáveis

- Iniciam **sempre** com o cifrão `$`
- São **case-sensitive** (`$idade` e `$Idade` são variáveis diferentes)
- Guardam qualquer tipo de valor

```php
$idade = 25;
$Idade = 30;  // <- variável DIFERENTE da anterior
```

### Constantes

- Valores **imutáveis** durante a execução (não podem ser reatribuídos)
- Definidas de duas formas: `define()` ou `const`

```php
define("PI", 3.14159);
const URL_SITE = "meusite.com";
```

> ⚠️ **Cuidado:** use constantes no **topo** do arquivo, antes de usá-las. O PHP executa o arquivo de cima para baixo — usar uma constante antes da definição gera *Fatal error*.

### 3.3 Tipos de Dados — Visão Geral

> 📖 Este tópico foi aprofundado na **Aula 04** (coerção automática, casting, valores *falsy* e a armadilha do `==`). Aqui está só a visão geral.

`gettype()` revela o tipo de uma variável:

```php
echo gettype($idade);   // integer
echo gettype($nome);    // string
echo gettype(10.5);     // double
echo gettype(true);     // boolean
echo gettype([1,2,3]);  // array
```

| Tipo | Exemplo | `gettype()` |
|---|---|---|
| `string` | `"Maria"` | string |
| `integer` | `25` | integer |
| `double` (float) | `7.5` | double |
| `boolean` | `true` / `false` | boolean |
| `array` | `[1, 2, 3]` | array |

---

## Operadores (continuação do 3.2) — Cálculos e Comparações

### Aritméticos

| Operador | Operação | Exemplo | Resultado |
|---|---|---|---|
| `+` | Soma | `10 + 20` | `30` |
| `-` | Subtração | `20 - 10` | `10` |
| `*` | Multiplicação | `10 * 20` | `200` |
| `/` | Divisão | `20 / 10` | `2` |
| `%` | Módulo (resto) | `21 % 10` | `1` |
| `**` | Exponenciação | `10 ** 2` | `100` |

### Relacionais (Comparações)

| Operador | Significado |
|---|---|
| `==` | Igual (compara **valor**) |
| `===` | Idêntico (compara **valor e tipo**) |
| `!=` / `<>` | Diferente |
| `>` / `<` | Maior / Menor |
| `>=` / `<=` | Maior ou igual / Menor ou igual |

> ⚠️ **Pegadinha clássica:** `10 == "10"` retorna `true` (mesmo valor, tipos diferentes). `10 === "10"` retorna `false`. **Use sempre `===`** para comparações estritas.

### Lógicos

| Operador | Nome | Exemplo |
|---|---|---|
| `&&` | E (AND) | `$idade > 18 && $temCNH` |
| `\|\|` | OU (OR) | `$idade > 30 \|\| $temCNH` |
| `!` | NÃO (NOT) | `!$temCNH` |

```php
$maiorDeIdade = ($idade > 18 && $temCNH === true);
```

---

## 3.5 Estruturas Condicionais

> 📖 Este tópico foi aprofundado na **Aula 04** (`if/elseif/else`, `switch` e a armadilha de comparar faixas com `switch`).

### `if` / `elseif` / `else`

```php
if ($nota >= 7) {
    echo "Aprovado com louvor!";
} elseif ($nota >= 5) {
    echo "Aprovado.";
} else {
    echo "Reprovado.";
}
```

### Operador Ternário — Condição em Uma Linha

```php
$status = ($nota >= 5) ? "Aprovado" : "Reprovado";
```

Equivale exatamente ao `if/else`, mas ocupa uma linha só.

### `match` — Alternativa Moderna ao `switch` (PHP 8.0+)

```php
$status = match ($diaSemana) {
    "segunda", "terca", "quarta", "quinta" => "Início da semana.",
    "sexta"    => "Sextou!",
    "sabado", "domingo" => "Fin de semana.",
    default    => "Dia inválido.",
};
```

Vantagens sobre o `switch`: retorna um **valor** (não apenas executa blocos), compara com **igualdade estrita** e não sofre *fall-through*.

### Operador Null Coalescing `??`

Evita erro ao usar variável que pode não existir:

```php
$usuario = null;
$nomePadrao = $usuario ?? "Visitante";  // Visitante
```

Sem o `??`, o PHP geraria *Warning: Undefined variable*.

---

## 👁️ Visualizando Boolenos Sem Confusão

Como `echo true` imprime `1` e `echo false` imprime nada (string vazia), o jeito mais legível de exibir booleanos é com `var_export()`:

```php
echo var_export($a > $b, true);   // true
echo var_export($a === $b, true); // false
```

---

## 📌 Resumo dos Tópicos Cobertos

1. Recapitulação da Aula 02 (ambiente, terminal, servidor)
2. **3.1 Saída de dados** — `echo`, `print`, `print_r()`, `var_dump()`
3. **3.2 Variáveis, constantes e operadores** — `$`, `define()`/`const`, aritméticos, relacionais e lógicos
4. **3.3 Tipos de dados** (visão geral) — `gettype()`: string, integer, double, boolean, array
5. **3.5 Estruturas condicionais** (introdução) — `if/elseif/else`, ternário, `match`, `??`

> **Continua na Aula 04:** `3.3` tipos e coerção · `3.4` entrada de dados · `3.5.1` if/else · `3.5.2` switch

---

## 🛠️ Prática Guiada — Desafios Para Fixar

1. Crie três variáveis (`$produto`, `$preco`, `$quantidade`) e imprima uma frase usando as três com concatenação
2. Troque o valor de `$preco` para string (`"19.90"`) e use `var_dump()` para ver a diferença de tipo
3. Declare a constante `DESCONTO = 0.15` e calcule o preço final de um produto
4. Use `gettype()` para verificar os tipos de `10`, `"10"`, `10.5`, `true`, `[1,2]`
5. Crie uma variável `$nota` e use ternário + `match` para classificar: `>= 7` "Aprovado", `>= 5` "Recuperação", caso contrário "Reprovado"

---

## 🔗 Links Úteis

- [php.net — Manual oficial do PHP](https://www.php.net) — Documentação completa, com referência de todas as funções
- [Operadores no PHP (vídeo)](https://youtu.be/8bjt7zpuJyo?si=ngg_5jF-S-V2d6Gi) — Revisão visual dos operadores
- [Tipos de variáveis no PHP (vídeo)](https://youtu.be/tw7tsV6bQSo?si=Htj_xRA5ul9bBFJD) — Entenda os tipos de dados na prática

### Leitura extra

- [Manual da linguagem PHP — Tipos](https://www.php.net/manual/pt_BR/language.types.php)
- [Manual da linguagem PHP — Operadores](https://www.php.net/manual/pt_BR/language.operators.php)
- [Manual da linguagem PHP — Estruturas de controle](https://www.php.net/manual/pt_BR/control-structures.php)

---

## 🗺️ Roadmap de Estudos — Checklist de Revisão

### 🔴 Imprescindível — Aula 03 (Fundamentos PHP)

- [ ] **Diferença entre `echo`, `print`, `print_r()` e `var_dump()`** — saber quando usar cada um
- [ ] **Variáveis** — sempre com `$`, case-sensitive (`$idade` ≠ `$Idade`)
- [ ] **Constantes** — `define()` e `const`, imutáveis, definidas antes do uso
- [ ] **Tipos de dados** — saber identificar `string`, `integer`, `double`, `boolean`, `array`
- [ ] **Operadores aritméticos** — `+ - * / % **`
- [ ] **Operadores relacionais** — `==` vs `===` (a diferença é crucial)
- [ ] **Operadores lógicos** — `&&`, `||`, `!`
- [ ] **Condicionais** — `if/elseif/else` e operador ternário
- [ ] **Concatenação** — `.` e interpolação `"$variavel"`

### 🟡 Importante — Aulas anteriores

- [ ] **Aula 02:** Rodar `php index.php` no terminal e `php -S localhost:8000` no navegador
- [ ] **Aula 02:** Navegar no terminal (`pwd`, `ls`, `cd`, `cd ..`)
- [ ] **Aula 02:** Configurar VS Code com Intelephense e Auto-Save
- [ ] **Aula 01:** Ciclo Entrada → Processamento → Saída aplicado ao PHP
- [ ] **Aula 01:** Git — `init`, `add`, `commit`, `push`, `pull`

### 🟢 Próximos Passos

- [ ] **Estruturas de repetição** — `for`, `while`, `foreach`
- [ ] **Funções** — criar funções reutilizáveis com parâmetros e retorno
- [ ] **Arrays associativos** — organizar dados com chaves em vez de índices
- [ ] **Formulários** — `$_GET` e `$_POST` (ligando com a entrada de dados da Aula 01)
- [ ] **XAMPP / MySQL** — conectar o PHP a um banco de dados (a "memória" do sistema)
- [ ] **Git na prática** — versionar o projeto PHP que está crescendo

---

## 💡 Dica de Ouro

> **Booleanos não aparecem no `echo`.** Se você usar `echo $x > $y` esperando ver `true`, verá `1` (ou nada, se for `false`). Use `var_export($x > $y, true)` para enxergar o que realmente aconteceu.

---

*Recap produzido para a turma da Aula 03 do Módulo de Prática.*
*Professor: Luis Felipe Araujo Lima*