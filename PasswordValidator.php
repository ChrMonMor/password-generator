<?php 

class PasswordValidator {
	/**
	 * @return array<string> 
	 */
    public static function validate(string $password):array {
        $errors = array();

        // Validate password strength
        if(!preg_match('#[A-Z]#', $password)){
            $errors[] = 'Must contain at least one uppercase letter';
        }
        if(!preg_match('#[a-z]#', $password)){
            $errors[] = 'Must contain at least one lowercase letter';
        }
        if(!preg_match('#[0-9]#', $password)){
            $errors[] = 'Must contain at least one number';
        }
        if(!preg_match('/[#$%^&*()+=\-\[\]\';,.\/{}|":<>?~\\\\]/', $password)){
            $errors[] = 'Must contain at least one special character';
        }
        if(strlen($password) < 8){
            $errors[] = 'Must be more then 8 characters long';
        }

        if (count($errors) == 0) {
            return array('strong password');
        } else {
            return $errors;
        }
        
    }
}
    
