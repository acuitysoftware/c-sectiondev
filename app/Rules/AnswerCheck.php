<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AnswerCheck implements Rule
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
        if(isset($data[1]))
        {
            
            if($this->questions[$data[1]]['correct_answer'] == $this->questions[$data[1]]['option_a'] || $this->questions[$data[1]]['correct_answer'] == $this->questions[$data[1]]['option_b'] || $this->questions[$data[1]]['correct_answer'] == $this->questions[$data[1]]['option_c'] || $this->questions[$data[1]]['correct_answer'] == $this->questions[$data[1]]['option_d'])
            {
                return true;
            }
            else{
                return false;
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
        return 'Answer not matched';
    }
}
