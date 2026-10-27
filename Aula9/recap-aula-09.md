# 📘 Recap da Aula 09 — Arrays, Funções e Projeto Prático

> **Tema da aula:** *Fundamentos do PHP — Arrays, Funções, Projeto Prático*
> **Slides trabalhados:** *Fundamentos do PHP: Arrays, Funções e Projeto Prático*
> **Módulo:** 3 · Fundamentos PHP
> **Público-alvo:** iniciantes, quem faltou e quem quer revisar antes do próximo encontro.

**Objetivo:** consolidar o uso de **funções** com parâmetros, tipos, `switch`, entrada de dados via `readline()` e criação de um **menu interativo** no terminal. Também reforçamos a importância da organização, reutilização de código e boas práticas.

> [!TIP]
> O código trabalhado está em **[`index.php`](index.php)**.  
> Rode com `php index.php` no terminal para testar o menu interativo.

---

## 🗺️ Mapa da Aula

| # | Tópico | O que você aprende |
|:-:|--------|--------------------|
| 1 | [Funções com tipagem](#-funções-com-tipagem) | Declaração com tipos para parâmetros e maior segurança |
| 2 | [Parâmetros e argumentos](#-parâmetros-e-argumentos) | Diferença entre parâmetro e argumento |
| 3 | [Estruturas condicionais com `switch`](#-estruturas-condicionais-com-switch) | Organizando múltiplas escolhas |
| 4 | [Entrada de dados com `readline()`](#-entrada-de-dados-com-readline) | Interatividade no terminal |
| 5 | [Projeto prático: Calculadora no terminal](#-projeto-prático-calculadora-no-terminal) | Juntando tudo em um menu funcional |
| 6 | [Boas práticas](#-boas-práticas) | Clareza, legibilidade e reutilização |

---

## 🔤 Funções com tipagem

No PHP moderno, podemos tipar os parâmetros das funções para evitar erros e tornar o código mais claro.

```php
function wagner(int $n1, int $n2, string $clock)
{
    // ...
}
```

- `int $n1` e `int $n2` — esperam números inteiros
- `string $clock` — espera uma string com a operação desejada

> [!NOTE]
> A tipagem ajuda a prever o tipo de dado esperado, facilitando a leitura e manutenção do código.

---

## 🔍 Parâmetros e argumentos

| Conceito | Definição | Exemplo |
|----------|-----------|---------|
| **Parâmetro** | Variável declarada na assinatura da função | `function wagner(int $n1, int $n2, string $clock)` |
| **Argumento** | Valor real passado na hora de chamar a função | `wagner($v1, $v2, $option)` |

---

## 🔀 Estruturas condicionais com `switch`

O `switch` é ideal quando temos **várias opções fixas** para um mesmo valor.

```php
function wagner(int $n1, int $n2, string $clock)
{
    switch ($clock) {
        case 'somar':
            echo "A soma é: " . ($n1 + $n2);
            break;

        case 'subtrair':
            echo "A subtrair é: " . ($n1 - $n2);
            break;

        case 'multiplicar':
            echo "A multiplicar é: " . ($n1 * $n2);
            break;

        case 'dividir':
            if ($n2 != 0) {
                echo "A dividez é: " . ($n1 / $n2) . "\n";
            } else {
                echo "Não é possivel fazer essa dividez \n";
            }
            break;

        default:
            return "parametro clock errado";
            break;
    }
}
```

> [!WARNING]
> Não esqueça do `break` em cada `case`. Sem ele, o PHP pode executar os próximos casos (fall-through).

> [!TIP]
> Sempre trate **casos especiais**, como a divisão por zero, para evitar erros.

---

## ⌨️ Entrada de dados com `readline()`

No ambiente **CLI** (terminal), usamos `readline()` para capturar dados digitados pelo usuário.

```php
(int)$v1 = readline("diga o primeiro valor: \n");
(int)$v2 = readline("diga o segundo valor: \n");
$option  = readline("Qual operação matemática?\n");
```

- `readline()` retorna uma **string**
- Podemos fazer coerção com `(int)` para converter para inteiro

> [!NOTE]
> Em execução via navegador esse formato muda. Por isso, muitos projetos separaram o menu CLI do restante do código.

---

## 🧮 Projeto prático: Calculadora no terminal

Juntando função, `switch`, validação e entrada de dados:

```php
echo "=============================\n";
echo "=           MENU            =\n";
echo "=============================\n";

(int)$v1 = readline("diga o primeiro valor: \n");
(int)$v2 = readline("diga o segundo valor: \n");
$option  = readline("Qual operação matemática?\n");

$wagner = wagner($v1, $v2, $option);

echo $wagner . "\n";
```

**Fluxo:**
1. Exibe o menu
2. Captura dois valores numéricos
3. Captura a operação desejada (`somar`, `subtrair`, `multiplicar`, `dividir`)
4. Chama a função `wagner()` e exibe o resultado
5. Caso a operação não exista, retorna mensagem de erro

---

## ✅ Boas práticas

- **Reutilização:** crie funções para não repetir código
- **Clareza:** dê nomes significativos a funções e variáveis
- **Validação:** sempre trate casos inválidos (ex.: divisão por zero)
- **Tipagem:** use tipos quando fizer sentido para deixar intenções claras
- **Legibilidade:** comente quando necessário, mas prefira código autoexplicativo

---

## 🧠 Teste seu conhecimento

1. Qual a diferença entre parâmetro e argumento?
2. Para que serve o `switch` nessa calculadora?
3. Por que tratamos o caso da divisão por zero?
4. Qual a função do `readline()`?
5. Por que convertemos os valores com `(int)`?
6. O que acontece se o usuário digitar uma operação inválida?

<details>
<summary>🔎 Clique para ver as respostas</summary>

1. **Parâmetro** é a variável na assinatura da função. **Argumento** é o valor passado na chamada.
2. Para direcionar a execução para a operação matemática escolhida (`somar`, `subtrair`, etc.).
3. Para evitar erro de divisão por zero e dar uma mensagem amigável ao usuário.
4. Capturar entrada digitada pelo usuário no terminal (CLI).
5. Porque `readline()` retorna string e precisamos trabalhar com números inteiros nas operações.
6. O `default` do `switch` retorna `"parametro clock errado"` e essa mensagem é exibida.

</details>

---

## 🗺️ Checklist de Estudos

- [ ] Entender a diferença entre parâmetro e argumento
- [ ] Criar funções com tipagem
- [ ] Usar `switch/case/break/default`
- [ ] Tratar divisão por zero
- [ ] Capturar dados com `readline()`
- [ ] Montar um menu interativo no terminal
- [ ] Testar diferentes operações na calculadora
- [ ] Refatorar o código para deixá-lo mais limpo

---

## 🔗 Links Úteis

**Documentação oficial PHP:**
- [Funções definidas pelo usuário](https://www.php.net/manual/pt_BR/functions.user-defined.php)
- [Declarações de tipo](https://www.php.net/manual/pt_BR/language.types.declarations.php)
- [Estrutura de controle `switch`](https://www.php.net/manual/pt_BR/control-structures.switch.php)
- [Função `readline()`](https://www.php.net/manual/pt_BR/function.readline.php)

**Para praticar:**
- [W3Schools - PHP Functions](https://www.w3schools.com/php/php_functions.asp)
- [W3Schools - PHP Switch](https://www.w3schools.com/php/php_switch.asp)

---

*Recap produzido para a turma da Aula 09 — Módulo 3 · Fundamentos PHP.*  
*Professor: Luis Felipe Araujo Lima*
