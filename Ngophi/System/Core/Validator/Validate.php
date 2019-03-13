<?php
namespace System\Core\Validator;

class Validate 
{
    static function Execute($data, &$validationresult)
    {
        $valid = true;
        foreach ($data as $key => $v) 
        {
            if(self::exist($key, $validationresult))
            {
                continue;
            }

            if(is_array($v))
            {
                foreach ($v as $rule => $message) 
                {
                    if(self::exist($key, $validationresult))
                    {
                        continue;
                    }
                    if(count(explode('::', $rule)) == 2)
                    {
                        self::HandleCustom($rule, $key, $validationresult, $message);
                    }
                    else
                    {
                        if((bool)preg_match('/:/',$rule))
                        {
                            self::HandleAttributed($rule, $key,  $validationresult, $message);
                        }
                        elseif((bool)preg_match('/\//',$rule))
                        {
                            self::HandleOr($rule, $key,  $validationresult, $message);
                        }
                        else
                        {
                            self::HandleDefault($rule, $key, $validationresult);
                        }
                    }
                }
            }
            else
            {
                $validations = explode('|',$v);
                foreach ($validations as $k => $rule) 
                {
                    if((bool)preg_match('/:/',$rule))
                    {
                        self::HandleAttributed($rule, $key,  $validationresult);
                    }
                    elseif((bool)preg_match('/\//',$rule))
                    {
                        self::HandleOr($rule, $key,  $validationresult);
                    }
                    else
                    {
                        self::HandleDefault($rule, $key, $validationresult);
                    }
                }
            }

        } 
        $validationresult = array_filter($validationresult);
        return $valid && count($validationresult) == 0 && HTTP_POST;
    }

    private static function exist($key, &$array)
    {
        if(isset($array[$key]))
        {
            if(is_array($array[$key]))
            {
                return true;
            }
        }

        return false;
    }

    private static function HandleOr($rule, $key, &$validationresult, $custom_message = null)
    {
        if(self::exist($key, $validationresult))  return;

        $rules = explode('/', $rule);
        $temp_result = [];
        $temp_result2 = null;
        foreach ($rules as $k => $value) 
        {
            self::Execute([$key => $value], $temp_result2);
            if(!empty($temp_result2[0]))
            {   
                array_push($temp_result, $temp_result2);
                $temp_result2 = null;
            }
        }

        if(count($temp_result) == count($rules))
        {
            if(!isset($custom_message))
            {
                $custom_message =  implode(' or ', array_map(function ($entry) use($key){
                    return $entry[$key]['message'];
                  }, $temp_result));
            }

            $validationresult[$key] = [
                'valid' => false,
                'message'   => $custom_message
            ];
        }
        unset($temp_result);
        unset($temp_result2);
        
    }

    private static function HandleDefault($rule, $key, &$validationresult)
    {
        if(self::exist($key, $validationresult))  return;
       
        $validationresult[$key] = call_user_func_array(__NAMESPACE__ . "\ValidationRules::" . $rule, [ $key ] );
    }

    private static function HandleAttributed($rule, $key, &$validationresult, $message = null)
    {
        if(self::exist($key, $validationresult)) return;
       
        $rules = explode(':',$rule);
        $validationresult[$key] = call_user_func_array(__NAMESPACE__ . "\ValidationRules::" . $rules[0], [ $key, $rules[1] , $message ] );
    }

    private static function HandleCustom($rule, $key, &$validationresult , $message = null)
    {
        if(self::exist($key, $validationresult)) return;
        
        $metd = explode('::', $rule);
        if (method_exists($metd[0], $metd[1])) 
        {		
            if(!call_user_func_array($rule, [$key]))
            {
                $validationresult[$key] =  [
                    'valid' => false,
                    'message'   => $message
                ];
            }	
        }
    }
}