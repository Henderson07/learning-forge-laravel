<?php

namespace App\Http\Services;

use App\Models\Person;
use Exception;
use Illuminate\Http\Request;

const PERSON_FISIC_DOCUMENT_LENGTH = 11; //Constante que armazena o tamanho exato do documento para pessoa física.
const PERSON_JURIC_DOCUMENT_LENGTH = 14; //Constante que armazena o tamanho exato do documento para pessoa jurídica.

class PersonService
{
    /**
     * Método para retornar uma coleção de pessoas
     */
    public static function getAllPersons()
    {
        //Retorna o eloquent com todos os itens filtrados de acordo com a expressão
        return Person::getAllPersons();
    }
    /**
     * Método store -> resource laravel para criar uma nova pessoa
     *
     * @param  mixed $data
     * @return void
     */
    public function storePerson(Request $request)
    {
        //Valida os campos de entrada do frontend
        $validated = $this->validate($request);
        //Validar documento de entrada - (CPF para pessoa física) ou (CNPJ para pessoa jurídica)
        //Caso validação falhe, lançar exceção
        $doc_validated = self::validateDocument($validated['document'], $validated['type']);

        //Validação adicional para o retorna de ambos os tipos -> Pessoa Física ou Jurídica
        if (!$doc_validated) {
            throw new Exception("O documento estava no formato incorreto!");
        }

        Person::create($validated); //Criar objeto pessoa no banco de dados
    }

    /**
     * validatePerson
     *
     * @param  mixed $data
     */
    private function validate(Request $request)
    {
        return $request->validate([
            'name' => 'required|string|max:100',
            'document' => 'required',
            'type' => 'required|in:0,1',
        ], [
            'name.required' => 'O nome é obrigatório.',
            'document.required' => 'O documento é obrigatório.',
            'type.required' => 'O tipo é obrigatório.',
            'type.in' => 'O tipo deve ser 0 (Pessoa Física) ou 1 (Pessoa Jurídica).',
        ]);
    }

    /**
     * Função para validar CPF ou CNPJ de acordo com um documento especificado e de acordo com o tipo da pessoa
     * O documento deve ser do tipo string
     *
     * @param  string $document - Documento contendo CPF ou CNPJ
     * @param  int $type - Tipo de pessoa - (Física ou Jurídica)
     * @return bool
     */
    private static function validateDocument(string $document, int $type): bool
    {
        $document = preg_replace('/[^0-9]/', '', $document);

        //Caso type for igual a zero, retorna a validação de acordo com pessoa física, senão '' jurídica
        return !empty($document) && $type == 0
            ? self::validateDocumentFisicPerson($document)
            : self::validateDocumentJuridicPerson($document);
    }

    /**
     * Função auxiliar para validar o documento CPF correspondente
     *
     * @param  mixed $document
     * @return bool
     */
    private static function validateDocumentFisicPerson(string $document): bool
    {
        if (strlen($document) !== PERSON_FISIC_DOCUMENT_LENGTH || preg_match('/(\d)\1{10}/', $document)) {
            return false;
        }

        for ($t = 9; $t < PERSON_FISIC_DOCUMENT_LENGTH; $t++) {
            $sum = 0;

            for ($i = 0; $i < $t; $i++) {
                $sum += $document[$i] * (($t + 1) - $i);
            }

            $digit = ((10 * $sum) % PERSON_FISIC_DOCUMENT_LENGTH) % 10;

            if ((int) $document[$t] !== $digit) {
                return false;
            }
        }

        return true;
    }

    /**
     * Função auxiliar para validar o documento CNPJ correspondente
     *
     * @param  mixed $document
     * @return bool
     */
    private static function validateDocumentJuridicPerson(string $document): bool
    {
        if (strlen($document) != PERSON_JURIC_DOCUMENT_LENGTH || preg_match('/(\d)\1{13}/', $document)) {
            return false;
        }
        $multipliers1 = [5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
        $multipliers2 = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];

        $baseDocument = substr($document, 0, 12);
        $sum = 0;

        // Calculate first verification digit
        for ($i = 0; $i < 12; $i++) {
            $sum += intval($baseDocument[$i]) * $multipliers1[$i];
        }

        $remainder = $sum % 11;
        $digit1 = ($remainder < 2) ? 0 : 11 - $remainder;

        $baseDocument .= $digit1;
        $sum = 0;

        // Calculate second verification digit
        for ($i = 0; $i < 13; $i++) {
            $sum += intval($baseDocument[$i]) * $multipliers2[$i];
        }

        $remainder = $sum % 11;
        $digit2 = ($remainder < 2) ? 0 : 11 - $remainder;

        $calculatedDigits = $digit1 . $digit2;

        // Compare the calculated digits with the actual last 2 digits of the CNPJ
        return substr($document, -2) === $calculatedDigits;
    }
}
