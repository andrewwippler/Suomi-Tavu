<?php

namespace App\Helpers;

// props to Duukkis http://www.palomaki.info/apps/haiku/
class Tavu
{
    public static function rakkenta(Array $array): String
    {
      $valmis = "";
      if (is_array($array)) {
        foreach($array as $k => $sana)
        {
          $valmis .= " " .implode("-", $sana);
        }
      } else {
        $valmis .= $array;
      }
      return trim($valmis);
    }

    public static function tavuta(String $string): Array
    {
      $p = explode(" ", $string);

      for($k = 0;$k < count($p);$k++){

        // return if there are no letters
        if (preg_replace("/[a-zA-ZöäåÖÄÅ]/", "", $p[$k]) != "" && mb_strlen(preg_replace("/[^a-zA-ZöäåÖÄÅ]/", "", $p[$k])) < 1)
        {
          $result[] = [$p[$k]];
          continue;
        }

        $front = "";
        $end = "";
        // find digits and punctuation
        preg_match_all("/([^a-zA-ZöäåÖÄÅ])/", $p[$k], $matches);
        if (count($matches[0]) > 0) {
          $char_and_pos = [];
          foreach(array_unique($matches[0]) as $m) {
            // error_log(var_dump(array_unique($matches[0])));
            $offset = 0;
            while (($pos = mb_strpos($p[$k], $m, $offset, 'UTF-8')) !== false)
            {
              // error_log(var_dump($m));
              $char_and_pos[] = [
                'char' => $m,
                'pos' => $pos
              ];
              $offset = $pos+1;

              if ($pos == 0) {
                $front = $m;
              }
              if ($offset == mb_strlen($p[$k]) || $offset == mb_strlen($p[$k])-1) {
                $end .= $m;
              }
              // error_log(var_dump($char_and_pos));
              // error_log(var_dump(mb_strlen($p[$k])));
            }
          }
        }

        // first remove unwanted chars
        $sana = trim(preg_replace("/[^a-zA-ZöäåÖÄÅ]/", "", $p[$k]));
        $a = Tavu::tavut($sana);
        $a[0] = trim($front . $a[0]);// add front character
        $count = count($a) -1;
        $a[$count] = trim($a[$count] . $end); // add end character
        $result[] = $a;
      }
      // error_log(var_dump($result));
      return $result;
    }

    /**
    * return array
    */
    public static function tavut(String $sana): Array
    {
      $kons = array("b", "c", "d", "f", "g", "h", "j", "k", "l", "m", "n", "p", "q", "r", "s", "t", "v", "w", "x", "z", "B", "C", "D", "F", "G", "H", "J", "K", "L", "M", "N", "P", "Q", "R", "S", "T", "V", "W", "X", "Z");

      $voka = array("a", "e", "i", "o", "u", "y", "ä", "å", "ö", "A", "E", "I", "O", "U", "Y", "Ä", "Å", "Ö");

      // diftongit
      // / yi, öi, äi, ui, oi, ai, äy, au, yö, öy, uo, ou, ie, ei, eu, iu, ey, iy / (Wiik 1965; Karlsson 1983).
      $dif = array("yi", "öi", "äi", "ui", "oi", "ai", "äy", "au", "yö", "öy", "uo", "ou", "ie", "ei", "eu", "iu", "ey", "iy");

      $sana = trim($sana);
      $loop = mb_strlen($sana, 'UTF-8');

      // split the word
      $w = mb_str_split($sana, 1, 'UTF-8');
      $w[] = " "; // helpers so we dont get notice's
      $w[] = " ";
      $w[] = " ";
      $w[] = " ";

      // put the word here letters and -'s
      $com_word = array();
      for($i = 0;$i < $loop;){
        $d = 1; // how many digits forward
        if(in_array($w[$i], $kons)){
          if(($i+1) >= $loop){ // if last is kons, remove the possible previous -
            $last = array_pop($com_word);
            if($last != "-"){
              $com_word[] = $last;
            }
          }
          $com_word[] = $w[$i];
        } else if(in_array($w[$i], $voka)){
          $com_word[] = $w[$i];
          if(in_array($w[$i].$w[$i+1], $dif) || $w[$i] == $w[$i+1] || $w[$i+1] == "i"){ // next diftongi, same vokaali or "i"
            $com_word[] = $w[$i+1];
            $d = 2;
            if(in_array($w[$i+2], $voka)){
              $com_word[] = "-";
            } else if(in_array($w[$i+2], $kons) && in_array($w[$i+3], $kons) && in_array($w[$i+4], $kons)){
              $com_word[] = $w[$i+2];
              $com_word[] = $w[$i+3];
              $com_word[] = "-";
              $d = 4;
            } else if(in_array($w[$i+2], $kons) && in_array($w[$i+3], $kons)){
              $com_word[] = $w[$i+2];
              $com_word[] = "-";
              $d = 3;
            } else if(in_array($w[$i+2], $kons)){
              $com_word[] = "-";
              $d = 2;
            }
          } else if(in_array($w[$i+1], $voka)){
            $com_word[] = "-";
            $d = 1;
          } else {
            if(in_array($w[$i+1], $kons) && in_array($w[$i+2], $kons) && in_array($w[$i+3], $kons)){
              $com_word[] = $w[$i+1];
              $com_word[] = $w[$i+2];
              $com_word[] = "-";
              $d = 3;
            } else if(in_array($w[$i+1], $kons) && in_array($w[$i+2], $kons)){
              $com_word[] = $w[$i+1];
              $com_word[] = "-";
              $d = 2;
            } else if(in_array($w[$i+1], $kons)){
              $com_word[] = "-";
              $d = 1;
            }
          }
        }
        $i = $i + $d;
      }
      // now build the word back together
      $tavut = array();
      $tindex = 0;
      foreach($com_word AS $in => $kirjain){
        if($kirjain == "-"){
          $tindex++;
        } else if(isset($tavut[$tindex])){
          $tavut[$tindex] .= $kirjain;
        } else {
          $tavut[$tindex] = $kirjain;
        }
      }

      return $tavut;
    }
}
