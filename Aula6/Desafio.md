# 🎬 Desafio da Aula 06 — Cine PHP: Bilheteria Inteligente

> **Um único programa que integra tudo** o que vimos até aqui: saída de dados, variáveis, constantes, operadores, tipos, **entrada de dados (`readline`)**, **`if/elseif`**, **`switch`** e **operador ternário**.
>
> Resolva **antes** de abrir o gabarito. Rode no terminal com:
> ```bash
> php desafio.php
> ```

---

## 🎯 Objetivo

Criar o programa de uma **bilheteria de cinema** rodando no **terminal**. O programa deve conversar com o cliente, mostrar o menu de sessões, ler os dados, calcular o valor da compra (com meia-entrada e desconto) e imprimir um **recibo bonito**.

---

## 📋 Requisitos funcionais

### 1️⃣ Boas-vindas e dados do cliente
- Defina uma **constante** `NOME_CINEMA` (ex.: `"Cine PHP"`) e exiba um cabeçalho usando `echo`.
- Peça o **nome do cliente** com `readline()`.

### 2️⃣ Menu de sessões com `switch`
Exiba o menu e leia a opção digitada:

```text
=== Cine PHP ===
1 - Sessão 2D  ........ R$ 30
2 - Sessão 3D  ........ R$ 45
3 - Sessão VIP ........ R$ 70
0 - Sair
Escolha uma sessão:
```

- Use **`switch`** para converter a opção no **preço** e no **nome da sessão**.
- Use **`default`** para tratar opção inválida e **encerrar** o programa com uma mensagem.
- **Importante:** converta a opção com `(int)` antes do `switch`.

### 3️⃣ Leitura e validação (3.4 Entrada de dados)
- Leia a **idade** do cliente com `readline()` e converta com `(int)`.
- Leia a **quantidade** de ingressos com `readline()` e converta com `(int)`.
- **Valide** (com `if/elseif`):
  - idade menor que `0` → `"Idade inválida!"`
  - quantidade menor que `1` → `"Quantidade inválida!"`
  - Em qualquer erro, **encerre** o programa sem calcular.

### 4️⃣ Classificação etária com `if/elseif`
Classifique a idade e exiba a **categoria indicativa**:

| Idade | Categoria |
|:-----:|-----------|
| 0 a 9 | `Livre` |
| 10 a 11 | `10 anos` |
| 12 a 13 | `12 anos` |
| 14 a 15 | `14 anos` |
| 16 a 17 | `16 anos` |
| 18 ou mais | `18 anos` |

> Use `if / elseif / else` na **ordem correta** (do menor intervalo para o maior).

### 5️⃣ Meia-entrada com operador ternário
- **Idade menor que 18 OU maior/igual a 60** paga **meia-entrada (50%)**.
- Guarde o multiplicador em uma variável usando **ternário**:
  ```php
  $fator = ($idade < 18 || $idade >= 60) ? 0.5 : 1.0;
  ```

### 6️⃣ Cálculo com operadores
- `subtotal = preço × quantidade × fator`
- **Desconto combo:** se a **quantidade for 4 ou mais**, aplique **10% de desconto** no subtotal (use `if/else` ou ternário).
- `total = subtotal − desconto`

### 7️⃣ Recibo final
Monte uma saída organizada com `echo`, contendo:

```text
=======================
   RECIBO — Cine PHP
=======================
Cliente: Ana
Sessão: 3D
Categoria: 18 anos
Ingressos: 2
Meia-entrada: Sim
Subtotal: R$ 45,00
Desconto combo: R$ 0,00
-----------------------
TOTAL: R$ 45,00
=======================
```

> Formate o valor com `number_format($valor, 2, ',', '.')` ou, se preferir, mostre com 2 casas decimais.

### 8️⃣ Mensagem final com ternário
- Se a pessoa tiver **18 anos ou mais**, exiba `"Bom filme! 🍿"`.
- Caso contrário, exiba `"Aproveite com responsabilidade 😉"`.
- Use o **operador ternário**.

---

## 🧠 Conceitos obrigatórios (use todos!)

| Conceito | Onde aparece no desafio |
|----------|-------------------------|
| `echo` (3.1) | cabeçalho e recibo |
| Variáveis (3.2) | nome, idade, quantidade, preço… |
| Constantes `define()` (3.2) | `NOME_CINEMA` |
| Operadores aritméticos (3.2) | `subtotal`, `desconto`, `total` |
| Operadores relacionais (3.2) | validações e classificação |
| Operadores lógicos (3.2) | `&&` / `\|\|` na meia-entrada e validação |
| Casting (3.3) | `(int)` na opção, idade e quantidade |
| **Entrada de dados (3.4)** | `readline()` |
| **`if / elseif / else` (3.5.1)** | validação + classificação etária |
| **`switch` (3.5.2)** | menu de sessões |
| **Ternário (3.5.3)** | fator de meia-entrada + mensagem final |

---

## 🏁 Como testar (exemplo de execução)

```text
=== Cine PHP ===
1 - Sessão 2D  ........ R$ 30
2 - Sessão 3D  ........ R$ 45
3 - Sessão VIP ........ R$ 70
0 - Sair
Escolha uma sessão: 2
Digite seu nome: Ana
Digite sua idade: 17
Quantidade de ingressos: 2

=======================
   RECIBO — Cine PHP
=======================
Cliente: Ana
Sessão: 3D
Categoria: 16 anos
Ingressos: 2
Meia-entrada: Sim
Subtotal: R$ 45,00
Desconto combo: R$ 0,00
-----------------------
TOTAL: R$ 45,00
=======================
Aproveite com responsabilidade 😉
```

> Dica: teste também uma opção **inválida** (ex.: `9`) e uma **quantidade 0** — o programa deve tratar os dois casos.

---

## ✅ Critérios de avaliação

- [ ] Usa `readline()` para **todas** as entradas
- [ ] Faz **casting** de opção, idade e quantidade
- [ ] Usa `switch` com `default` no menu
- [ ] Usa `if / elseif / else` para validar e classificar
- [ ] Usa **ternário** pelo menos **2 vezes**
- [ ] Calcula meia-entrada e desconto combo corretamente
- [ ] Imprime um recibo organizado
- [ ] Não quebra com entrada inválida

---

## ⭐ Bônus (para ir além)

1. Permita **várias compras em sequência** usando um laço `while` (você viu o conceito na Aula 05!) até o usuário escolher **0 - Sair**.
2. Use **`match`** (PHP 8) em vez de `switch` no menu.
3. Valide a idade com `filter_var($idade, FILTER_VALIDATE_INT)`.
4. Adicione um **modo debug**: se o cliente digitar `debug`, use `var_dump()` para mostrar os tipos de todas as variáveis.
5. Guarde cada compra em um **array** e mostre o total arrecadado no final.

---

## 🧩 Dicas

- **Entrada é sempre string:** `(int)` na opção, idade e quantidade.
- **Ordem do `if/elseif` importa:** comece pelas faixas menores.
- **`break` no `switch`** para não escorregar para o próximo `case`.
- **Meia-entrada** usa `||` (OU): idoso **ou** menor de idade.
- Quebre o problema em partes pequenas e teste cada uma antes de juntar.

---

<details>
<summary>🔓 Gabarito de referência (tente sozinho primeiro!)</summary>

```php
<?php

const NOME_CINEMA = "Cine PHP";

echo "=== " . NOME_CINEMA . " ===\n";
echo "1 - Sessão 2D  ........ R$ 30\n";
echo "2 - Sessão 3D  ........ R$ 45\n";
echo "3 - Sessão VIP ........ R$ 70\n";
echo "0 - Sair\n";

$opcao = (int) readline("Escolha uma sessão: ");

switch ($opcao) {
    case 1:
        $sessao = "2D";
        $preco  = 30.0;
        break;
    case 2:
        $sessao = "3D";
        $preco  = 45.0;
        break;
    case 3:
        $sessao = "VIP";
        $preco  = 70.0;
        break;
    case 0:
        echo "Até a próxima!\n";
        exit;
    default:
        echo "Opção inválida!\n";
        exit;
}

$nome       = readline("Digite seu nome: ");
$idade      = (int) readline("Digite sua idade: ");
$quantidade = (int) readline("Quantidade de ingressos: ");

if ($idade < 0) {
    echo "Idade inválida!\n";
    exit;
} elseif ($quantidade < 1) {
    echo "Quantidade inválida!\n";
    exit;
}

// Classificação etária (if/elseif)
if ($idade <= 9) {
    $categoria = "Livre";
} elseif ($idade <= 11) {
    $categoria = "10 anos";
} elseif ($idade <= 13) {
    $categoria = "12 anos";
} elseif ($idade <= 15) {
    $categoria = "14 anos";
} elseif ($idade <= 17) {
    $categoria = "16 anos";
} else {
    $categoria = "18 anos";
}

// Meia-entrada com ternário
$fator       = ($idade < 18 || $idade >= 60) ? 0.5 : 1.0;
$meiaEntrada = ($fator === 0.5) ? "Sim" : "Não";

$subtotal = $preco * $quantidade * $fator;

// Desconto combo (10% a partir de 4 ingressos)
$desconto = ($quantidade >= 4) ? $subtotal * 0.10 : 0.0;

$total = $subtotal - $desconto;

echo "\n=======================\n";
echo "   RECIBO — " . NOME_CINEMA . "\n";
echo "=======================\n";
echo "Cliente: $nome\n";
echo "Sessão: $sessao\n";
echo "Categoria: $categoria\n";
echo "Ingressos: $quantidade\n";
echo "Meia-entrada: $meiaEntrada\n";
echo "Subtotal: R$ " . number_format($subtotal, 2, ',', '.') . "\n";
echo "Desconto combo: R$ " . number_format($desconto, 2, ',', '.') . "\n";
echo "-----------------------\n";
echo "TOTAL: R$ " . number_format($total, 2, ',', '.') . "\n";
echo "=======================\n";

echo ($idade >= 18) ? "Bom filme! 🍿\n" : "Aproveite com responsabilidade 😉\n";
```

</details>

---

*Desafio da Aula 06 — Módulo 3 · Fundamentos PHP.*
*Professor: Luis Felipe Araujo Lima*
