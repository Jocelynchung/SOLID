<?php
/**
 * Created by PhpStorm.
 * User: jocleyn
 * Date: 2018/5/4
 * Time: 1:20 PM
 */

/**
 * Open Closed Principle  開放封閉原則
 * 軟體中的對象，例如Class、Module、Method，這些對於擴充是開放的，但是對於修改是封閉的.
 * 對擴充開放，對修改封閉
 *
 * 修改一個已經可以動的系統的某個模組，很容易造成『牽一髮而動全身』的效應。
 * 所以如果能從『設計面』著手從而避免掉這種牽一髮而動全身的漣波效應，則軟體系統將會變得很容易修改，擴充，了解，與維護。
 *
 */
//違反開放封閉原則 原本程式碼
class LoggerFirst
{
    public function ConsoleLog(string $message)
    {
        // 實作顯示 Log 至 Console
    }

    public function FileLog(string $message)
    {
            // 實作儲存 Log 至檔案
    }
}
//假設我們今天多出一個儲存 Log 至資料庫的需求，想必很多朋友們會直覺的先想到再加一個 DatabaseLog 的方法。
class LoggerLater
{
    public function ConsoleLog(string $message)
    {
        // 實作顯示 Log 至 Console
    }

    public function FileLog(string $message)
    {
        // 實作儲存 Log 至檔案
    }

    public function DatabaseLog(string $message)
    {
        // 實作儲存 Log 至資料庫
    }
}

/**
 * 我們可以建立一個抽象的 BaseLogger 類別，裡面有一個抽象的 Log 方法，每一個 Logger 都可以實作自己的 Log 機制。
 * 透過這種方式，不會每次增加一種 Log 方式就需要去更動到原本的 Logger 類別，這樣的作法就會符合前面所描述的 OCP 原則的定義。
 *
 */
abstract class BaseLogger
{
    public abstract function Log(string $message);
}

class ConsoleLogger extends BaseLogger
{
    public function Log(string $message)
    {
        // 實作 Console 的 Log 機制
    }
}

class FileLogger extends BaseLogger
{

    public function Log(string $message)
    {
        // 實作 File 的 Log 機制
    }
}

class DatabaseLogger extends BaseLogger
{

    public function Log(string $message)
    {
        // 實作 Database 的 Log 機制
    }

}

