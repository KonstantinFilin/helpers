<?php

namespace Helpers\Calendar;


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
     *
     * @var Month\Is
     */
    protected $is;

    /**
     *
     * @var Month\Dt
     */
    protected $dt;

    /**
     * Creates class instance
     * @param int $year Year part
     * @param int $monthNum Month number part
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
     * 
     * @return string
     */
    public function __toString(): string
    {
        return $this->getYear() . $this->getMonthNum();
    }
    
    /**
     * 
     * @return int
     */
    public function getYear(): int {
        return $this->year;
    }

    /**
     * 
     * @return string
     */
    public function getMonthNum(): string {
        return sprintf("%02u", $this->monthNum);
    }
    
    /**
     * 
     * @return \Helpers\Calendar\Month\Is
     */
    public function is(): Month\Is {
        
        if (!$this->is) {
            $this->is = new Month\Is($this);
        }
        
        return $this->is;
    }
    
    public function dt(): Month\Dt {
        
        if (!$this->dt) {
            $this->dt = new Month\Dt($this);
        }
        
        return $this->dt;
    }
 }
