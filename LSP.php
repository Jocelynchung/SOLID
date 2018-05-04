<?php
/**
 * Created by PhpStorm.
 * User: Jocleyn
 * Date: 2018/5/4
 * Time: 1:21 PM
 */

/**
 * Liskov Substitution Principle 里氏替換原則
 *
 * 若是使用繼承，子類別實作的行為必須要與父類別或是介面所定義的行為一致
 *
 * 若子類別沒有遵守LSP的情況下，使用者呼叫某個功能時可能會出現與「預期」的功能不相符合的問題。
 *
 */
//火箭類別
interface RocketBase
{
    public function launch();
}

//獵鷹號
class Falcon implements RocketBase
{

    public function launch()
    {
        echo "發射！";
    }
}

//安爾塔號
class Antares implements RocketBase
{

    public function launch()
    {
        echo "發射！";
    }
}

//破壞者號
class Destroyer implements RocketBase
{

    /**
     * 違反里氏替換原則, 發射的method 執行自爆的功能
     */
    public function launch()
    {
        echo "自爆！";
    }
}

/**
 * 過了一陣子，老闆問工程師，說客戶想知道破壞者號有沒有發射功能
 * 工程師看到繼承火箭類別，所以回答有吧(?)
 * 開始試射（launch）破壞者號，【5.....4......3.....2......1】就出現不如預期的結果
 */


/**
 * 範例二
 * Vehicle 類別 裡有一個接送的method
 *
 */
interface Vehicle
{
    public function pickup();
}

//計程車
class Taxi implements Vehicle
{

    public function pickup()
    {
        return '計程車接你回家';
    }
}
//UBER
class Uber implements Vehicle
{

    public function pickup()
    {
        return 'Uber接你回家';
    }
}

/**
 * 違反里氏替換原則 樂高車不能載妳回家
 */
//樂高車
class LegoCar implements Vehicle
{

    public function pickup()
    {
        return '在原地...';
    }
}

//回家的方法
class GoHome {

    private $car;

    public function __construct(Vehicle $car)
    {
        $this->car = $car;
    }

    /**
     * @param Vehicle $car
     */
    public function setCar(Vehicle $car): void
    {
        $this->car = $car;
    }

    public function pickup()
    {
        echo $this->car->pickup();
    }

}


$car = new Taxi();//可替換Uber LegoCar
/**
 *  若換成樂高車 也有pickup method 但是無法實作載你回家的方法 那就會出現不如預期的問題
 */
$goHome = new GoHome($car);

$goHome->pickup();





