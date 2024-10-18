<?php
use Rinvex\Country\CountryLoader; 

class AbmPais
{
    public function paisInformacion($param){
        $pais = country($param);
    
        $array = [
            "nombre" => $pais->getName(),  
            "nombreOficial" => $pais->getOfficialName(), 
            "capital" => $pais->getCapital(),
            "gentilicio" => $pais->getDemonym(),
            "idioma" => $pais ->getLanguages(),
            "codigoPostal" => $pais ->usesPostalCode(),
            "numeroIso" => $pais->getIsoNumeric(),
            "continente" => $pais->getContinent(),
            "limitrofes" => $pais->getBorders(),
            "maxLatitud" => $pais->getMaxLatitude(),
            "minLatitud" => $pais->getMinLatitude(), 
            "area" => $pais->getArea(),
            "region" => $pais->getRegion(),
            "sinLitoral" => $pais->isLandlocked(),
            "emoji" => $pais->getEmoji(),
            "bandera" => $pais->getFlag()
            
        ];
        
        return $array;
    }
}
