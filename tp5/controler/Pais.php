<?php

// namespace ABM\control;

// use ABM\model\CountryModel;

class Pais
{
    private $countryModel;

    public function __construct()
    {
        $this->countryModel = new CountryModel();
    }

    // Método para obtener la información de un país y pasarla a la vista
    public function showCountry($code)
    {

        $country = $this->countryModel->getCountryByCode($code);

        // Pasar la información a la vista
        return $country;
    }
    public function showCountryDetails($code)
    {
        $country = $this->countryModel->getCountryDetails($code);

        return $country;
    }
    public function showCountryByName($name)
    {
        $country = $this->countryModel->getCountryByName($name);
        // Usamos el método actualizado que primero busca el código
        // Pasar la información a la vista
        return $country;
    }
}
