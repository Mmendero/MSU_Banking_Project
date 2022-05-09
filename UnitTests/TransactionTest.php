<?php
require 'lib/transaction_handler.php ';
use PHPUnit\Framework\TestCase;

class WithdrawTest extends TestCase{
    // Valid Tests.
    public function testValidWithdraw() {
        $result = validWithdrawAmount(50, 100);
        $this->assertEquals(true, $result);
    }

    // Invalid Tests.
    public function testLowAmount() {
        $result = validWithdrawAmount(3, 100);
        $this->assertEquals(false, $result);
    }
    public function testLowBalance() {
        $result = validWithdrawAmount(100, 5);
        $this->assertEquals(false, $result);
    }
    public function testHighAmount() {
        $result = validWithdrawAmount(100000000, 100000000);
        $this->assertEquals(false, $result);
    }
}

class DepositTest extends TestCase{
    // Valid Tests.
    public function testValidDeposit() {
        $result = validDepositAmount(50, 100);
        $this->assertEquals(true, $result);
    }

    // Invalid Tests.
    public function testLowAmount() {
        $result = validDepositAmount(3, 100);
        $this->assertEquals(false, $result);
    }
}