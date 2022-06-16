<?php

namespace MrzParser\Parser;

use MrzParser\Document\TravelDocumentType;
use MrzParser\Exception\UnsupportedDocumentException;

class ParserFactory
{
    /**
     * @param $mrzString
     * @return AbstractParser
     * @throws UnsupportedDocumentException
     */
    public function create($mrzString)
    {
        $documentType = $this->determineType($mrzString);

        switch ($documentType) {
            case TravelDocumentType::PASSPORT: return new PassportParser();
            case TravelDocumentType::ID_CARD: return new TravelDocumentType1Parser();
            default: throw new UnsupportedDocumentException("Couldn't determine document type");
        }
    }

    /**
     * @param $mrzString
     * @return string
     */
    private function determineType($mrzString)
    {
        if (preg_match("/(^[A|C|I|1][A-Z0-9<]{1})/", $mrzString)) {
            return TravelDocumentType::ID_CARD;
        } else if (preg_match("/(^P[A-Z0-9<]{1})/", $mrzString)) {
            return TravelDocumentType::PASSPORT;
        } else {
            return TravelDocumentType::NOT_FOUND;
        }
    }
}
