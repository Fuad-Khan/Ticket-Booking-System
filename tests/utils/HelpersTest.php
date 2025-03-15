<?php

require_once __DIR__ . '/../../src/utils/Helpers.php';

class HelpersTest {

    public function testSanitize() {
        $dirtyInput = "<script>alert('XSS');</script>";
        $cleanInput = Helpers::sanitize($dirtyInput);

        if ($cleanInput === "&lt;script&gt;alert(&#039;XSS&#039;);&lt;/script&gt;") {
            echo "Sanitize Test Passed\n";
        } else {
            echo "Sanitize Test Failed\n";
        }
    }

    public function testValidateEmail() {
        $validEmail = 'test@example.com';
        $invalidEmail = 'test@com';

        if (Helpers::validateEmail($validEmail) && !Helpers::validateEmail($invalidEmail)) {
            echo "Validate Email Test Passed\n";
        } else {
            echo "Validate Email Test Failed\n";
        }
    }

    public function testValidatePhone() {
        $validPhone = '+1234567890';
        $invalidPhone = '12345';

        if (Helpers::validatePhone($validPhone) && !Helpers::validatePhone($invalidPhone)) {
            echo "Validate Phone Test Passed\n";
        } else {
            echo "Validate Phone Test Failed\n";
        }
    }

    public function testValidatePassword() {
        $validPassword = 'Password@123';
        $invalidPassword = 'pass';

        if (Helpers::validatePassword($validPassword) && !Helpers::validatePassword($invalidPassword)) {
            echo "Validate Password Test Passed\n";
        } else {
            echo "Validate Password Test Failed\n";
        }
    }
}

// Run tests
$test = new HelpersTest();
$test->testSanitize();
$test->testValidateEmail();
$test->testValidatePhone();
$test->testValidatePassword();
?>
