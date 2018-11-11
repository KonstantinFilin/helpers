<?php

namespace Helpers\Calendar;

/**
 * Month object
 */
class Month 
{
    /**
     * Year part 
     * @var int
     */
    protected $year;
    
    /**
     * Month number part
     * @var int
     */
    protected $monthNum;

    /**
     * Month attribites checker
     * @var Month\Is
     */
    protected $is;

    /**
     * Dates checker
     * @var Month\Dt
     */
    protected $dt;

    /**
     * Creates class instance
     * @param int $year Year 
     * @param int $monthNum Month number 
     * @throws \InvalidArgumentException
     */
    function __construct(int $year = 0, int $monthNum = 0) {

        $this->year = $year ? intval($year) : date("Y");
        $this->monthNum = $monthNum ? intval($monthNum) : date("m");
        $this->is = null;
        $this->dt = null;

        if ($this->monthNum > 12 || $this->monthNum < 1) {
            throw new \InvalidArgumentException("Month must be between 1 and 12 [argument value: " . $monthNum . "]");
        }
    }
    
    /**
     * Returns month name in format YYYYMM
     * @return string Month name in format YYYYMM
     */
    public function __toString(): string
    {
        return $this->getYear() . $this->getMonthNumStr();
    }
    
    /**
     * Returns year of the month
     * @return int Year part
     */
    public function getYear(): int {
        return $this->year;
    }

    /**
     * Returns month number as two digits string
     * @return string Month number from "01" to "12"
     */
    public function getMonthNumStr(): string {
        return sprintf("%02u", $this->monthNum);
    }
    
    /**
     * Returns month number as integer
     * @return int Month number from 1 to 12
     */
    public function getMonthNum(): int {
        return $this->monthNum;
    }
        
    /**
     * Returns month attributes checker object
     * @return \Helpers\Calendar\Month\Is
     */
    public function is(): Month\Is {
        
        if (!$this->is) {
            $this->is = new Month\Is($this);
        }
        
        return $this->is;
    }
    
    /**
     * Return month dates checker object
     * @return \Helpers\Calendar\Month\Dt
     */
    public function dt(): Month\Dt {
        
        if (!$this->dt) {
            $this->dt = new Month\Dt($this);
        }
        
        return $this->dt;
    }
 }
