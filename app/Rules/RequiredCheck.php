<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class RequiredCheck implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public $questions;
    public function __construct($question)
    {
        $this->questions = $question;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $data = explode(".",$attribute);
        /*dump($data);
        dump($this->questions[$data[1]]['deleted']);*/
        if(isset($data[1]))
        {
            
            if($this->questions[$data[1]]['deleted'] == false)
            {
                if(isset($this->questions[$data[1]][$data[2]]))
                {
                    return true;
                }
                else{
               
                    return false;
                }
            }
            else{
                return true;
            }
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
