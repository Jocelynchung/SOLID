<?php
/**
 * Created by PhpStorm.
 * User: jocleyn
 * Date: 2018/5/4
 * Time: 1:20 PM
 */

/**
 *
 * Single Responsibility Principle  單一職責原則
 * 一個類別只負責一件事(僅有一個引起類別的變化的原因）
 *
 * 假設一個類別或是介面同時存在兩種職責（稱之為 A，B），
 * 那麼很有可能修改 A 的時候，而卻影響了 B。或是說，因為 B 的關係，卡住 A 讓 A 變得不好修改。
 *
 * 如果有做好 SRP：
 * 單一類別的「複雜度降低」，因為要實現的職責都很清晰明確的定義，這將大幅提升「可讀性」與「可維護性」。
 * 修改只會對同一個介面或類別有影響，這對擴展性和維護性都有很大的幫助。

 *
 * 到底什麼情況應該把兩個以上的職責徹底分開？什麼情況放在一起是 OK 的？
 *
 * If the application changes in ways that affect the signature of the connection functions,
 * then the design will smell of Rigidity... In that case the two responsibilities should be separated.
 * 如果常常需要改變類別或介面裡的的某些方法, 那就需要將職責分開
 *
 * If, on the other hand, the application is not changing in ways that cause the two responsibilities to change at different times,
 * then there is no need to separate them.
 * 如果變化方式總是這些職責同時變化，就不必分離他們。如果沒有改變的可能卻硬要達成SRP 反而會造成不必要的複雜性
 *
 */

//違反單一職責原則
//數據機
interface Modem
{
    // 撥號
    public function Dial($pno);
    // 掛斷
    public function Hangup();
    // 發送資料
    public function Send($c);
    // 接收資料
    public function Receive();
}
// 符合 單一職責原則

/**
 * 今天 ADSL 要升級成 100M ，我們會需要修改 Modem 實作，
 * 這會導致與它連線無關的 Send 與 Receive 也會跟著重新編譯與佈署，
 * 風險範圍也隨之擴增。重構的方法之一，是把這個介面抽離出兩個單一職責的介面：
 */
/**
 * 連線管理
 */
interface Connection
{
    function Dial($pno);
    function Hangup();
}

/**
 * 數據溝通
 */
interface DataChannel
{
    function Send($c);
    function Receive();
}


class NewModem implements Connection, DataChannel
{

    function Send($c)
    {
        // 發送資料
    }

    function Receive()
    {
        // 接收資料
    }

    function Dial($pno)
    {
        // 撥號
    }

    function Hangup()
    {
        // 掛斷
    }
}

/**
 * 判斷是否屬於這個類別?
 *
 * 內容太長 ，如果一個類別有一萬行程式，那應該有些工作是可以分離出來的
 *
 * 依賴太多，如果有太多參數需要傳入，則可能她的工作或許太多。
 *
 * 測試太複雜或無法進行測試，可能功能太多，相依太多，導致無法測試
 */