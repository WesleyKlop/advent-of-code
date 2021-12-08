<?php

namespace App\Common;

class Permutations
{
   public static function permuteUnique(array $items, array $perms = [], array &$return = []): array
   {
        if (empty($items)) {
            $return[] = $perms;
            return $return;
        }

       sort($items);
       $prev = false;
       for ($i = count($items) - 1; $i >= 0; --$i) {
           $newItems = $items;
           $tmp = array_splice($newItems, $i, 1)[0];
           if ($tmp !== $prev) {
               $prev = $tmp;
               $newperms = $perms;
               array_unshift($newperms, $tmp);
               static::permuteUnique($newItems, $newperms, $return);
           }
       }
       return $return;
   }

}
