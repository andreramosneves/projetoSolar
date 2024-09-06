<?php
namespace App\Helpers;


class Utils
{

  
    /*Parameter $order is this a list, work all others list, and $request is parameters query in GET mode

        Date_end , Date_start , Page must be reserved in query

        Reserverd Words:
        - Date_end  
        - Date_start
        - Page
        - sum_field
        - group_by
        - w_null
        - w_null_not
        - i_join
        - l_join

    */

 public static function buildOrderBy($order, $request){
        $obj = $request->all();
        $par_keys = [];

        foreach($obj as $key => $value) 
        {
            if (str_contains($key, 'order_by')) {
                $fields = explode(',', $value);
                if(count($fields) > 1){
                    foreach($fields as $key => $v) 
                    {
                        $asc_desc = explode(' ', $v);
                        if(count($asc_desc) > 1){
                            $order = $order->orderBy($asc_desc[0],$asc_desc[1]);
                        }else{
                            $order = $order->orderBy($v);
                        }
                        break;
                    }
                    

                }else{
                    $asc_desc = explode(' ', $value);
                    if(count($asc_desc) > 1){
                        $order = $order->orderBy($asc_desc[0],$asc_desc[1]);
                    }else{
                        $order = $order->orderBy($value);
                    }
          
                }

            }
        }


    return $order;
 }

 public static function buildWhere($order, $request){
        $obj = $request->all();
        $par_keys = [];

        foreach($obj as $key => $value) 
        {   
            if (!str_contains($key, 'date_start') && !str_contains($key, 'date_end') && !str_contains($key, 'payment') && !str_contains($key, 'page')  && !str_contains($key, 'sum_field')  && !str_contains($key, 'group_by') && !str_contains($key, 'order_by') && !str_contains($key, 'i_join') && !str_contains($key, 'l_join')) {
                    
                    if(str_contains($key, 'w_null_not')){
                        $order = $order->whereNotNull($value);
                    }else if(str_contains($key, 'w_null')){
                        $order = $order->whereNull($value);
                    }else{
                        $order = $order->where($key,'=', $value);
                    }

            }else if(str_contains($key, 'date_start') || str_contains($key, 'date_end')){
                $part_start = explode('date_start_', $key);
                $property_start = array_pop($part_start);

                $part_end = explode('date_end_', $key);
                $property_end = array_pop($part_end);

                if(count($part_start) > 0){
                    if(!isset($par_keys[$property_start])){
                        $par_keys[$property_start] = [];
                    }
                    array_push($par_keys[$property_start], ['date_start' => $value]);
                }
                if(count($part_end) > 0){
                    if(!isset($par_keys[$property_end])){
                        $par_keys[$property_end] = [];
                    }
                    array_push($par_keys[$property_end], ['date_end' => $value]);
                }           
            }
        }

            foreach($par_keys as $k1 =>$v1){
                if(count($par_keys[$k1]) == 2){
                    if(isset($par_keys[$k1][0]['date_start'])){ 
                       $order = $order->whereBetween($k1, [$par_keys[$k1][0]['date_start'],$par_keys[$k1][1]['date_end']]);
                    }else{

                       $order = $order->whereBetween($k1, [$par_keys[$k1][1]['date_start'],$par_keys[$k1][0]['date_end']]);
                    }
                }

            }

        return $order;
    }

}
