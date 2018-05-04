<?php
/**
 * Created by PhpStorm.
 * User: jocleyn
 * Date: 2018/5/4
 * Time: 10:58 PM
 */
/**Adapter pattern 轉接器模式
 *
 * 將一個類別的介面，轉接成另一個介面以供客戶使用。轉接器讓原本介面不相容的類別可以合作無間。
 *
 * 如果我們有一個類別，它的某些行為跟我們在使用中的類別很相似，但介面卻不相容。
 * 我們想讓這個類別加入我們的系統，就必須讓它有一個相容的介面。
 * 這時候我們可以使用轉接器模式 Adapter，轉接器模式的功能是將一個類別的介面轉接成另一個介面。
*/

//鴨子介面的類別：
interface Duck
{
    public function quack();
    public function fly();

}
//綠頭鴨
class MallardDuck implements Duck
{

    public function quack()
    {
        echo 'Quack';
    }

    public function fly()
    {
        echo 'flying';
    }
}
//有一個火雞類別：
interface Turkey
{
    public function gobble();
    public function fly();
}
//野火雞
class WildTurkey implements Turkey
{

    public function gobble()
    {
        echo 'gobble!';
    }

    public function fly()
    {
        echo 'flying a short distance';
    }
}


/**現在我們想把一隻火雞喬裝成鴨子來個魚目混珠，要怎麼做呢？
首先，我們得先定義一個類別，實踐鴨子介面，如此一來這個類別就可以當作鴨子使用。
有了鴨子介面以後，得讓這個類別像鴨子一樣工作。
把鴨子的行為轉接到火雞上：我們合成一個火雞物件，然後在實踐鴨子介面的方法裡，呼叫火雞物件對應的方法。*/


//火雞轉接器，實踐鴨子介面
class TurkeyAdapter implements Duck
{

    private $turkey;

    public function __construct(Turkey $turkey)
    {
        $this->turkey = $turkey;
    }

    public function quack()
    {
        $this->turkey->gobble();
    }

    public function fly()
    {
        //火雞飛比較短，讓牠飛五次
        for($i = 0 ; $i < 5 ; $i++) {
            $this->turkey->fly();
        }
    }
}



