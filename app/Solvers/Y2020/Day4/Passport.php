<?php


namespace App\Solvers\Y2020\Day4;

class Passport
{
    private ?int $birthYear;
    private ?int $issueYear;
    private ?int $expirationYear;
    private ?string $height;
    private ?string $hairColor;
    private ?string $eyeColor;
    private ?string $passportId;
    private ?string $countryId;

    public function __construct(
        ?int $birthYear,
        ?int $issueYear,
        ?int $expirationYear,
        ?string $height,
        ?string $hairColor,
        ?string $eyeColor,
        ?string $passportId,
        ?string $countryId
    ) {
        $this->birthYear = $birthYear;
        $this->issueYear = $issueYear;
        $this->expirationYear = $expirationYear;
        $this->height = $height;
        $this->hairColor = $hairColor;
        $this->eyeColor = $eyeColor;
        $this->passportId = $passportId;
        $this->countryId = $countryId;
    }

    public function getBirthYear(): ?int
    {
        return $this->birthYear;
    }

    public function getIssueYear(): ?int
    {
        return $this->issueYear;
    }

    public function getExpirationYear(): ?int
    {
        return $this->expirationYear;
    }

    public function getHeight(): ?string
    {
        return $this->height;
    }

    public function getHairColor(): ?string
    {
        return $this->hairColor;
    }

    public function getEyeColor(): ?string
    {
        return $this->eyeColor;
    }

    public function getPassportId(): ?string
    {
        return $this->passportId;
    }

    public function getCountryId(): ?string
    {
        return $this->countryId;
    }
}
