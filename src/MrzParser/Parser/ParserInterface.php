<?php

namespace MrzParser\Parser;

use MrzParser\Exception\ParseException;
use MrzParser\TravelDocumentInterface;

interface ParserInterface
{
    /**
     * Extracts all the information from a MRZ string and returns a populated instance of TravelDocumentInterface
     *
     * @param $string
     * @return TravelDocumentInterface
     * @throws ParseException
     */
    public function parse($string);
}
