<?php 
class PasswordGenerator {
    private static string $filename  = 'symbols.txt';
	/**
	 * @param int $length
	 * @param array<int> $wantedSymbols
	 * @return string 
	 */
    public static function generate(int $length = 12, array $wantedSymbols = array(3,3,4,2)): string {

        $password = '';
        $wantedSum = 0;
        $pools = PasswordGenerator::get_pools();
        $poolsCount = count($pools);
        $wantedArrayCount = count($wantedSymbols);

        for ($i=0; $i < $poolsCount; $i++) { 
            if($i >= $wantedArrayCount){
                break;
            }
            $wantedSum += $wantedSymbols[$i];
            $password .= PasswordGenerator::get_rand_string($wantedSymbols[$i], array($pools[$i]));
        }

        if($wantedSum < $length) {
            $password .= PasswordGenerator::get_rand_string($length-$wantedSum ,$pools);
        }

        $password = str_shuffle($password);

        return substr($password, 0, $length);
    }
    
	/**
	 * @param int $length
	 * @param array<string> $pools
	 * @return string 
	 */
    protected static function get_rand_string(int $length, array $pools): string {
        $password = '';
        for ($i=0; $i < $length; $i++) { 
            $password .= PasswordGenerator::get_rand_char($pools[rand(0, count($pools) -1)]);
        }
        return $password;
    }
	
	/**
	 * @return array<string> 
	 */
    private static function get_pools(): array {
        $myfile = fopen(PasswordGenerator::$filename, 'r') or die('Unable to open file!');
        $array = array();
        if ($myfile) {
            $array = explode('\n', fread($myfile, filesize(PasswordGenerator::$filename)));
        }
        $myfile = @fclose($myfile);
        return $array;
    }

    private static function get_rand_char(string $pool): string
    {
        return $pool[rand(0, strlen($pool) - 1)];
    }
}
