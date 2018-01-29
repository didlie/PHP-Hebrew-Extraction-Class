<?php
/***********************************************************/
/********************* didlie.com **************************/
/********** static hebrew manipulation class ***************/
/*auth:*** isaac krishna deilson jacobs christopher ********/
/*************** all rights reserved according to:**********/
/*********** GNU General Public License v3.0 ***************/
/***********************************************************/

class static_hebrew
{
    /*************************** static **** hebrew functions **************************************************/
                public static $hebrewLetters = "/[\x{05D0}-\x{05F4}\x]/u";
                public static $hebrewPunctuation = "/[\x{05B0}-\x{05C7}\x]/u";
                public static $hebrewCantilation = "/[\x{0591}-\x{05AF}\x]/u";



                public static function superTrim($string){
                  while(strpos($string,"  ")){
                    $string = str_replace("  ", " ", $string);
                  }
                  return trim($string);
                }
/////////////////////////////////////////////////////////////////////////
                public static function extractHebrewLine($string){
                  $string = explode(" ",$string);
                  $words=[];
                  foreach($string as $word){
                      $words[] = self::extractHebrewFromWord($word);
                  }
                  return self::superTrim(implode(" ",$words));
                }
/////////////////////////////////////////////////////////////////////
                public static function removeSymbols($string){
                  	$string = urldecode($string);
                  	$a=preg_split('/(?<!^)(?!$)/u',$string);
                  			$regex[]="/[\x{0000}-\x{001F}\x]/u";
                  			$regex[]="/[\x{0021}-\x{002F}\x]/u";
                  			$regex[]="/[\x{003B}-\x{0040}\x]/u";
                  			$regex[]="/[\x{005B}-\x{0060}\x]/u";
                  		   $regex[]="/[\x{007B}-\x{00BF}\x]/u";
                  		   $regex[]="/[\x{00D7}]/u";
                  		   $regex[]="/[\x{00F7}]/u";
                  //		   $regex[]="/[\x{0300}-\x{036F}\x]/u";
                  		foreach($a as $x => $v){
                  			foreach($regex as $exp){
                  				$q=preg_match($exp,$v);
                  				if($q==1){
                  						unset($a[$x]);
                  					}
                  				}
                  			}
                  		return implode($a);
                }
//////////////////////////////////////////////////////////////////////////
                public static function extractHebrewFromWord($string){
                  $a=preg_split('/(?<!^)(?!$)/u', $string);
                  $b=[];
                  $regex[]= self::$hebrewLetters;
                    foreach($a as $x => $v){
                      foreach($regex as $exp){
                        $q=preg_match($exp,$v);
                        if($q==1){
                            $b[]=$v;
                          }
                        }
                      }
                    return implode($b);
                }

}
