<?php



use Rinvex\Country\CountryLoader; 

class AbmPais
{

    public function getCountryByCode($code)
    {
        

        $country = country($code); // Usando la libreria rinvex/country

        return [
            'name' => $country->getName(),
            'capital' => $country->getCapital(),
            'currency' => $country->getCurrencies(),
            'languages' => $country->getLanguages(),
            'borders' => $country->getBorders(),
            'flag' => $country->getFlag(),
            'emoji' => $country->getEmoji(),
        ];
    }


    public function getCountryDetails($code)
    {
        $country = country($code);

        return [
            'name' => $country->getName(),
            'native_name' => $country->getNativeName(),
            'borders' => $country->getBorders(),
            'flag' => $country->getFlag(),
            'emoji' => $country->getEmoji(),
        ];
    }

    public function getCountryCodeByName($name)
    {

        $nameLower = strtolower($name);



        $countries = [
            'Afganistán' => 'AF',
            'Albania' => 'AL',
            'Alemania' => 'DE',
            'Andorra' => 'AD',
            'Angola' => 'AO',
            'Antigua y Barbuda' => 'AG',
            'Arabia Saudita' => 'SA',
            'Argelia' => 'DZ',
            'Argentina' => 'AR',
            'Armenia' => 'AM',
            'Australia' => 'AU',
            'Austria' => 'AT',
            'Azerbaiyán' => 'AZ',
            'Bahamas' => 'BS',
            'Bangladés' => 'BD',
            'Barbados' => 'BB',
            'Baréin' => 'BH',
            'Bélgica' => 'BE',
            'Belice' => 'BZ',
            'Benín' => 'BJ',
            'Bielorrusia' => 'BY',
            'Birmania (Myanmar)' => 'MM',
            'Bolivia' => 'BO',
            'Bosnia y Herzegovina' => 'BA',
            'Botsuana' => 'BW',
            'Brasil' => 'BR',
            'Brunéi' => 'BN',
            'Bulgaria' => 'BG',
            'Burkina Faso' => 'BF',
            'Burundi' => 'BI',
            'Cabo Verde' => 'CV',
            'Camboya' => 'KH',
            'Camerún' => 'CM',
            'Canadá' => 'CA',
            'Catar' => 'QA',
            'Chad' => 'TD',
            'Chile' => 'CL',
            'China' => 'CN',
            'Chipre' => 'CY',
            'Colombia' => 'CO',
            'Comoras' => 'KM',
            'Congo (Brazzaville)' => 'CG',
            'Congo (Kinshasa)' => 'CD',
            'Corea del Norte' => 'KP',
            'Corea del Sur' => 'KR',
            'Costa de Marfil' => 'CI',
            'Costa Rica' => 'CR',
            'Croacia' => 'HR',
            'Cuba' => 'CU',
            'Dinamarca' => 'DK',
            'Dominica' => 'DM',
            'Ecuador' => 'EC',
            'Egipto' => 'EG',
            'El Salvador' => 'SV',
            'Emiratos Árabes Unidos' => 'AE',
            'Eritrea' => 'ER',
            'Eslovaquia' => 'SK',
            'Eslovenia' => 'SI',
            'España' => 'ES',
            'Estados Unidos' => 'US',
            'Estonia' => 'EE',
            'Esuatini' => 'SZ',
            'Etiopía' => 'ET',
            'Filipinas' => 'PH',
            'Finlandia' => 'FI',
            'Fiyi' => 'FJ',
            'Francia' => 'FR',
            'Gabón' => 'GA',
            'Gambia' => 'GM',
            'Georgia' => 'GE',
            'Ghana' => 'GH',
            'Granada' => 'GD',
            'Grecia' => 'GR',
            'Guatemala' => 'GT',
            'Guinea' => 'GN',
            'Guinea-Bisáu' => 'GW',
            'Guinea Ecuatorial' => 'GQ',
            'Guyana' => 'GY',
            'Haití' => 'HT',
            'Honduras' => 'HN',
            'Hungría' => 'HU',
            'India' => 'IN',
            'Indonesia' => 'ID',
            'Irak' => 'IQ',
            'Irán' => 'IR',
            'Irlanda' => 'IE',
            'Islandia' => 'IS',
            'Israel' => 'IL',
            'Italia' => 'IT',
            'Jamaica' => 'JM',
            'Japón' => 'JP',
            'Jordania' => 'JO',
            'Kazajistán' => 'KZ',
            'Kenia' => 'KE',
            'Kirguistán' => 'KG',
            'Kiribati' => 'KI',
            'Kosovo' => 'XK',
            'Kuwait' => 'KW',
            'Laos' => 'LA',
            'Lesoto' => 'LS',
            'Letonia' => 'LV',
            'Líbano' => 'LB',
            'Liberia' => 'LR',
            'Libia' => 'LY',
            'Liechtenstein' => 'LI',
            'Lituania' => 'LT',
            'Luxemburgo' => 'LU',
            'Madagascar' => 'MG',
            'Malasia' => 'MY',
            'Malaui' => 'MW',
            'Maldivas' => 'MV',
            'Malí' => 'ML',
            'Malta' => 'MT',
            'Marruecos' => 'MA',
            'Mauricio' => 'MU',
            'Mauritania' => 'MR',
            'México' => 'MX',
            'Micronesia' => 'FM',
            'Moldavia' => 'MD',
            'Mónaco' => 'MC',
            'Mongolia' => 'MN',
            'Montenegro' => 'ME',
            'Mozambique' => 'MZ',
            'Namibia' => 'NA',
            'Nauru' => 'NR',
            'Nepal' => 'NP',
            'Nicaragua' => 'NI',
            'Níger' => 'NE',
            'Nigeria' => 'NG',
            'Noruega' => 'NO',
            'Nueva Zelanda' => 'NZ',
            'Omán' => 'OM',
            'Países Bajos' => 'NL',
            'Pakistán' => 'PK',
            'Palaos' => 'PW',
            'Panamá' => 'PA',
            'Papúa Nueva Guinea' => 'PG',
            'Paraguay' => 'PY',
            'Perú' => 'PE',
            'Polonia' => 'PL',
            'Portugal' => 'PT',
            'Reino Unido' => 'GB',
            'República Centroafricana' => 'CF',
            'República Checa' => 'CZ',
            'República Dominicana' => 'DO',
            'Ruanda' => 'RW',
            'Rumanía' => 'RO',
            'Rusia' => 'RU',
            'Samoa' => 'WS',
            'San Cristóbal y Nieves' => 'KN',
            'San Marino' => 'SM',
            'San Vicente y las Granadinas' => 'VC',
            'Santa Lucía' => 'LC',
            'Santo Tomé y Príncipe' => 'ST',
            'Senegal' => 'SN',
            'Serbia' => 'RS',
            'Seychelles' => 'SC',
            'Sierra Leona' => 'SL',
            'Singapur' => 'SG',
            'Siria' => 'SY',
            'Somalia' => 'SO',
            'Sri Lanka' => 'LK',
            'Suazilandia' => 'SZ',
            'Sudáfrica' => 'ZA',
            'Sudán' => 'SD',
            'Sudán del Sur' => 'SS',
            'Suecia' => 'SE',
            'Suiza' => 'CH',
            'Surinam' => 'SR',
            'Tailandia' => 'TH',
            'Tanzania' => 'TZ',
            'Tayikistán' => 'TJ',
            'Timor Oriental' => 'TL',
            'Togo' => 'TG',
            'Tonga' => 'TO',
            'Trinidad y Tobago' => 'TT',
            'Túnez' => 'TN',
            'Turkmenistán' => 'TM',
            'Turquía' => 'TR',
            'Tuvalu' => 'TV',
            'Ucrania' => 'UA',
            'Uganda' => 'UG',
            'Uruguay' => 'UY',
            'Uzbekistán' => 'UZ',
            'Vanuatu' => 'VU',
            'Vaticano' => 'VA',
            'Venezuela' => 'VE',
            'Vietnam' => 'VN',
            'Yemen' => 'YE',
            'Yibuti' => 'DJ',
            'Zambia' => 'ZM',
            'Zimbabue' => 'ZW',
        ];


      
        $countryNames = array_keys($countries);
        $countryCodes = array_values($countries);

        $i = 0;
        $numCountries = count($countryNames);
      
        $rta = null;
     
        while ($i < $numCountries) {
            if (strtolower($countryNames[$i]) === $nameLower) {
                $rta = $countryCodes[$i];
            }
            $i++;
        }

        return $rta;
    }

    public function getCountryByName($name)
    {

        $countryCode = $this->getCountryCodeByName($name);

        if ($countryCode) {
 
            return $this->getCountryByCode($countryCode);
        }

        return null; 
    }
}
