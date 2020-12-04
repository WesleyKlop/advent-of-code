<?php


namespace App\Solvers\Y2020\Day4;


class RequiredFieldsFilledPassportValidator implements PassportValidator
{
    private const PASSPORT_GETTERS = [
        'getBirthYear',
        'getIssueYear',
        'getExpirationYear',
        'getHeight',
        'getHairColor',
        'getEyeColor',
        'getPassportId',
//        'getCountryId',
    ];

    public function validate(Passport $passport): bool
    {
        foreach (self::PASSPORT_GETTERS as $getter) {
            if ($passport->{$getter}() === null) {
                return false;
            }
        }
        return true;
    }
}
