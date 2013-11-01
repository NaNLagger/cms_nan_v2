<?
class Timer
{
    var $startTime;
    var $endTime;
    function start()
    {
        $this->startTime = gettimeofday();
    }
    function stop()
    {
        $this->endTime = gettimeofday();
    }
    function elapsed()
    {
        return (($this->endTime["sec"] - $this->startTime["sec"]) * 1000000 + ($this->endTime["usec"] - $this->startTime["usec"])) / 1000000;
    }
}

?>