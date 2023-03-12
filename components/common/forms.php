<?php 

class Form {
    public $nameForm;
    public $formSchemar;
    public $action;
    public $formError = [];
    public $formData = [];
    
    function __construct($nameForm , $formSchemar , $action , $formError = [], $formData = []) {
        $this->nameForm = $nameForm;
        $this->formSchemar = $formSchemar;
        $this->action = $action;
        $this->formData = $formData;
        $this->formError = $formError;
    }

    public function renderForm ($customClass = '') {
        $nameForm = $this->nameForm;
        $errors = $this->formError;
        $data = $this->formData;
        $form = "<form 
                    name='{$this->nameForm}' 
                    id='{$this->nameForm}' 
                    class='row g-3 {$this->nameForm} customForm'
                    action='{$this->action}'
                    method='post' 
                    enctype='multipart/form-data'
                >"; 
        foreach ($this->formSchemar as $row) {
            $form .= "<div class ='col-12'>
                        <div class='row'>";
                            foreach ($row as $key => $input ) {
                                $type = $input['field']['type'];
                                // CALL CUSTOM FUNCTION BY KEY
                                $e = isset($errors[$key]) ? $errors[$key] : [];
                                $value = isset($data[$key]) ? $data[$key] : '';
                                $form .= $this->$type($key , $input ,$nameForm, $e, $value);
                            }
            $form .=    "</div>
                    </div>";
        }
        $form .= "</form> ";

        return $form;
    }

    function text($key , $input , $nameForm , $error = [] , $value = ''){
        $isInValid = count($error) ? 'is-invalid' : '';
        $e = count($error) ? $error[0] : '';
        $return =  "<div class='col {$input['bind']['class']}'>
            <div class='row ps-3 pe-3' >
                <label for='{$key}' class='form-label {$input['label']['class']}'>{$input['label']['text']}</label>
                <input value='{$value}' name='{$key}' type='text' class='form-control col {$isInValid}' id='".$key.$nameForm."' placeholder='{$input['field']['placeholder']}'>
                <div id='".$key.$nameForm." Feedback' class='invalid-feedback'>
                    {$e}
                </div>
            </div>
        </div>";
        return $return;
    }
    
    function email($key , $input, $nameForm, $error = [], $value = '') {
        $isInValid = count($error) ? 'is-invalid' : '';
        $e = count($error) ? $error[0] : '';
        return "<div class='col {$input['bind']['class']}'>
        <div class='row ps-3 pe-3'>
            <label for='{$key}' class='form-label {$input['label']['class']}'>{$input['label']['text']}</label>
            <input value='{$value}' name='{$key}' type='email' class='form-control col {$isInValid}' id='".$key.$nameForm." placeholder='{$input['field']['placeholder']}''>
            <div id='".$key.$nameForm." Feedback' class='invalid-feedback'>
                {$e}
            </div>
            </div>
        </div>
        </div>";    
    }

    function textarea($key , $input , $nameForm, $error = [], $value = '') {
        $isInValid = count($error) ? 'is-invalid' : '';
        $e = count($error) ? $error[0] : '';
        return "<div class='col {$input['bind']['class']}'>
            <div class='row ps-3 pe-3'>
                <label for='{$key}' class='form-label {$input['label']['class']}'>{$input['label']['text']}</label>
                <textarea name='{$key}' class='form-control col {$isInValid}' id='".$key.$nameForm."' placeholder='{$input['field']['placeholder']}' row='3'>$value</textarea>
                <div id='".$key.$nameForm." Feedback' class='invalid-feedback'>
                    {$e}
                </div>
            </div>
        </div>";
    }

    function file($key , $input,  $nameForm, $error = [], $value = []) {
        $isInValid = count($error) ? 'is-invalid' : '';
        $namefile = isset($value['name']) ? $value['name'] : $value;
        $e = count($error) ? $error[0] : '';
        return "<div class='col {$input['bind']['class']}'>
            <div class='row ps-3 pe-3'>
                <label for='{$key}' class='form-label {$input['label']['class']}'>{$input['label']['text']}</label>
                <input name='{$key}' type='file' class='form-control col {$isInValid}' id='".$key.$nameForm." '>
                <img class='mt-3' src='".$input['bind']['root_image'].$namefile."' />
                <div id='".$key.$nameForm." Feedback' class='invalid-feedback'>
                    {$e}
                </div>
            </div>
        </div>";    
    }

    function checkbox($key , $input,  $nameForm, $error = [], $value = '') {
        $isInValid = count($error) ? 'is-invalid' : '';
        $e = count($error) ? $error[0] : '';
        return "<div class='col {$input['bind']['class']}'>
            <div class='row ps-3 pe-3 form-check ms-3'>
                <label class='form-check-label {$input['label']['class']} p-0' for='{$key}'>
                    {$input['label']['text']}
                </label>
                <input  name='{$key}' class='form-check-input p-1 {$isInValid}' type='checkbox' value='{$input['field']['value']}' id='".$key.'-'.$nameForm."' />
                <div id='".$key.$nameForm." Feedback' class='invalid-feedback'>
                    {$e}
                </div>
            </div>
        </div>";    
    }

    function button($key , $input,  $nameForm, $e = [], $value = '') {
        return "<div class='col {$input['bind']['class']}'>
            <input type='submit' class='{$input['field']['class']}' value='{$input['label']['text']}' />
        </div>";    
    }
}