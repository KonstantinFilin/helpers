<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Helpers\Str;

/**
 * Description of RuPluralizer
 *
 * @author ksf
 */
class RuPluralizer 
{
    /**
     *
     * @var string
     */
    private $form1;
    
    /**
     *
     * @var string
     */
    private $form2;
    
    /**
     *
     * @var string
     */
    private $form3;
    
    /**
     *
     * @var int
     */
    private $rest10;
    
    /**
     *
     * @var int
     */
    private $rest100;
            
    function __construct(string $form1, string $form2, string $form3) {
        $this->form1 = $form1;
        $this->form2 = $form2;
        $this->form3 = $form3;
        $this->rest10 = 0;
        $this->rest100 = 0;
    }

    public function run(int $num): string
    {
        $this->fillRest($num);
        
        if ($this->isForm1()) {
            return $this->form1;
        } elseif ($this->isForm2()) {
            return $this->form2;
        }

        return $this->form3;
    }
    
    private function fillRest(int $num)
    {
        $numAbs = abs($num);
        $this->rest10 = $numAbs % 10;
        $this->rest100 = $numAbs % 100;        
    }
    
    private function isForm1()
    {
        return $this->rest10 == 1 && $this->rest100 != 11;
    }
    
    private function isForm2()
    {
        return $this->rest10 >= 2 && $this->rest10 <= 4 && ($this->rest100 < 10 || $this->rest100 >= 20);
    }
}
