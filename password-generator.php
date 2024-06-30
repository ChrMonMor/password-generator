<?php 
class PasswordGenerator {
    private static $filename;
    function __construct(string $filename = "symbols.txt") {
        $this->filename = $filename;
    }
    public function generate(int $length = 12, $wantedSymbols = array(6,0,4,2)): string {

        $password = '';
        $wantedSum = 0;
        $pools = $this->get_pools();
        $poolsCount = count($pools);
        $wantedArrayCount = count($wantedSymbols);

        for ($i=0; $i < $poolsCount; $i++) { 
            if($i >= $wantedArrayCount){
                break;
            }
            $wantedSum += $wantedSymbols[$i];
            $password .= $this->get_rand_string($wantedSymbols[$i], array($pools[$i]));
        }

        if($wantedSum < $length) {
            $password .= $this->get_rand_string($length-$wantedSum ,$pools);
        }

        $password = str_shuffle($password);

        return substr($password, 0, $length);
    }
    protected function get_rand_string(int $length, array $pools): string {
        $password = "";
        for ($i=0; $i < $length; $i++) { 
            $password .= $this->get_rand_char($pools[rand(0, count($pools) -1)]);
        }
        return $password;
    }
    private function get_pools(): array {
        $myfile = fopen($this->filename, "r") or die("Unable to open file!");
        $array = array();
        if ($myfile) {
            $array = explode("\n", fread($myfile, filesize($this->filename)));
        }
        $myfile = @fclose($myfile);
        return $array;
    }

    protected function get_rand_char(string $pool): string
    {
        return $pool[rand(0, strlen($pool) - 1)];
    }
}
