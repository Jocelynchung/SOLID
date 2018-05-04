<?php
/**
 * Created by PhpStorm.
 * User: jocleyn
 * Date: 2018/5/4
 * Time: 1:21 PM
 */

/**
 * Interface Segregation Principle 介面隔離原則
 *
 * 一個類別不應該被強迫實作一個它不需要的方法.
 *
 * 在設計介面時，不應該放入不相關的method，例如在一個叫
 * Worker的Interface class內含有work()和sleep()的method，
 * 由人類和機器人繼承，但是機器人會工作卻不會睡覺，這樣sleep()的method卻能被機器人使用不就很奇怪嗎？（空實作）
 * 所以這個原則主要用途是在降低耦合度，減少不當的設計
 */

//違反介面隔離原則
interface WorkerInterface
{
    public function work();

    public function sleep();
}

class HumanWorker implements WorkerInterface
{
    public function work()
    {
        return 'human working';
    }

    public function sleep()
    {
        return 'human sleeping';
    }
}

class RobotWorker implements WorkerInterface
{
    public function work()
    {
        return 'Robot working';
    }

    public function sleep()
    {
        return null;
    }
}


//符合介面隔離原則
interface WorkableInterface
{
    public function work();
}

interface SleepableInterface
{
    public function sleep();
}

class HumanWorkerISP implements WorkableInterface, SleepableInterface
{
    public function work()
    {
        return 'human working';
    }

    public function sleep()
    {
        return 'human sleeping';
    }
}

class RobotWorkerISP implements WorkableInterface
{
    public function work()
    {
        return 'Robot working';
    }
}

/**
 * 在設計界面時，要注意不要想塞什麼東西進去就塞什麼東西進去，讓整個介面定義的接口過多，要負責的事情如果太多，
 *未來在修改程式時如果發現子類別實作太多沒有必要實作的方法，就會要改很多的程式碼，建議在實作時若能夠早點發現這樣的狀況及早邊做重構。
 */
//不符合介面隔離原則
//鳥類介面
interface IBird
{
    public function Eat();
    public function Walk();
    public function Chirp();
    public function fly();
}

/**
 * 拆成兩個不同的interface 鴕鳥類別就不會被強迫實作一個它不需要的方法
 * 防止fat interface
 */
//符合介面隔離原則
interface BirdInterface
{
    public function Eat();
    public function Walk();
    public function Chirp();
}

interface FlyingBirdInterface extends BirdInterface
{
    public function fly();

}

//鴕鳥 不會飛
class Ostrich implements BirdInterface
{

    public function Eat()
    {
        // TODO: Implement Eat() method.
    }

    public function Walk()
    {
        // TODO: Implement Walk() method.
    }

    public function Chirp()
    {
        // TODO: Implement Chirp() method.
    }
}

//翠鳥 會飛
class KingFisher implements FlyingBirdInterface
{

    public function Eat()
    {
        // TODO: Implement Eat() method.
    }

    public function Walk()
    {
        // TODO: Implement Walk() method.
    }

    public function Chirp()
    {
        // TODO: Implement Chirp() method.
    }

    public function fly()
    {
        // TODO: Implement fly() method.
    }
}