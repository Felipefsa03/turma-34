<?php

/**
 * Exemplo de ENCAPSULAMENTO com getters e setters.
 *
 * As propriedades são "private": ninguém de fora acessa direto.
 * O acesso acontece pelos métodos públicos get/set, que validam os dados.
 */
class Wagner
{
    private float $nota = 0;
    private float $presenca = 0;

    public function __construct(float $nota = 0, float $presenca = 0)
    {
        $this->setNota($nota);
        $this->setPresenca($presenca);
    }

    // ---------- GETTERS ----------
    // Devolvem o valor atual da propriedade.

    public function getNota(): float
    {
        return $this->nota;
    }

    public function getPresenca(): float
    {
        // devolve a presença como fração (0.75)
        return $this->presenca;
    }

    public function getPresencaFormatada(): string
    {
        // devolve a presença em porcentagem ("75%")
        return number_format($this->presenca * 100, 0) . "%";
    }

    // ---------- SETTERS ----------
    // Alteram a propriedade com validação.

    public function setNota(float $nota): void
    {
        if ($nota < 0 || $nota > 10) {
            throw new InvalidArgumentException("A nota deve estar entre 0 e 10.");
        }

        $this->nota = $nota;
    }

    public function setPresenca(float $presenca): void
    {
        // Aceita 0.75 ou 75 (porcentagem)
        if ($presenca > 1) {
            $presenca = $presenca / 100;
        }

        if ($presenca < 0 || $presenca > 1) {
            throw new InvalidArgumentException("A presença deve estar entre 0 e 1 (ou 0% e 100%).");
        }

        $this->presenca = $presenca;
    }

    // ---------- REGRA DE NEGÓCIO ----------

    public function condicao(): string
    {
        return ($this->nota >= 7 && $this->presenca >= 0.75)
            ? "Aprovado"
            : "Reprovado";
    }
}
