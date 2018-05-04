<?php
/**
 * Created by PhpStorm.
 * User: jocleyn
 * Date: 2018/5/4
 * Time: 1:22 PM
 */
/**
 * 高階模組不要依賴（相依）低階模組，兩者都必須要依賴（相依）抽象模組；抽象不能依賴細節，細節必須依賴抽象
 *
 * 高階模組不應該去 new 低階模組，也就是 class，而應該由高階模組定義 interface。

    高階模組只依賴自己定義的 interface，而低階模組也只依賴 (實踐) 高階模組所定義的 interface。
 */
//不符合依賴反轉原則 直接相依無法抽換 若要換銀行則要重寫
class PaymentService
{

    private $bankAccount;

    public function PaymentService(TaiwanBankAccount $bankAccount)
    {
        $this->bankAccount = $bankAccount;
    }

    public function Checkout($fee)
	{
	    $this->bankAccount->RemoveBalance($fee);
    }

	public function Refund($fee)
	{
        $this->bankAccount->AddBalance($fee);
    }
}
class TaiwanBankAccount
{
    private $balance;

    public function AddBalance($value)
    {
        return $this->balance -= $value;
    }
    public function RemoveBalance($value)
    {
        return $this->balance += $value;
    }
}

//--------------------------------------------------------------------------

//符合依賴反轉原則 可以隨時抽換掉，易於修改且方便測試
interface BankAccountInterface
{
    public function AddBalance($value);
    public function RemoveBalance($value);
}

class TaiwanBankAccountDIP implements BankAccountInterface
{
    private $balance;

    public function AddBalance($value)
    {
        return $this->balance -= $value;
    }
    public function RemoveBalance($value)
    {
        return $this->balance += $value;
    }
}

class EsunBankAccountDIP implements BankAccountInterface
{
    private $balance;

    public function AddBalance($value)
    {
        return $this->balance -= $value;
    }
    public function RemoveBalance($value)
    {
        return $this->balance += $value;
    }
}

class PaymentServiceDIP
{

    private $bankAccount;

    public function PaymentService(BankAccountInterface $bankAccount)
    {
        $this->bankAccount = $bankAccount;
    }

    public function Checkout($fee)
    {
        $this->bankAccount->RemoveBalance($fee);
    }

    public function Refund($fee)
    {
        $this->bankAccount->AddBalance($fee);
    }
}
//生成依赖
$taiwanbank = new TaiwanBankAccountDIP();
$esunbank = new EsunBankAccountDIP();

//注入依赖
$payment = new PaymentServiceDIP($taiwanbank); //or $esunbank 可抽換

$payment->Checkout($fee);
$payment->Refund($fee);
