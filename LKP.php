<?php
/**
 * Created by PhpStorm.
 * User: Jocleyn
 * Date: 2018/5/4
 * Time: 1:21 PM
 */

/**
 * Least Knowledge Principle 最小知識原則
 *
 * 高階模組不應該知道低階模組的內部如何運作。
 * 低階模組不應該暴露內部物件，不應該暴露實踐細節，應僅提供方法給高階模組使用。
 * （一個物件應該對其他物件有最少的了解。）
 */

class SMSService
{
    public function getMessage(): string
    {
        return 'Message';
    }
}

class MailService
{
    public function getMailMessage(): string
    {
        return 'Mail Message';
    }
}

class NotificationService
{
    private $smsService;

    public function __construct(SMSService $smsService)
    {
        $this->smsService = $smsService;
    }

    /**
     * 將 SMSService 物件傳出去
     * 違反最小知識原則
     */
    public function getSMSService(): SMSService
    {
        return $this->smsService;
    }

    /**
     * 符合最小知識原則
     * 若抽換 MailService PostController 不需要知道細節也不需要修改
     * 例如： return $this->mailService->getMailMessage();
     */
    public function getMessage(): string
    {
        return $this->smsService->getMessage();
    }
}

/**
 * 符合最小知識原則：
 * Controller 不應該知道 service 的內部如何運作。
 */
class PostController extends Controller
{

    private $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function index()
    {
        /**
         * PostController 與 NotificationService 內部的 SMSService 強烈耦合，若想要換掉 SMSService 物件，
         * 則 PostController 必須跟著修改，也就是暴露內部物件。
         * PostController 為了要顯示 message，竟然還必須知道 NotificationService 內部使用了 SMSService 物件，先使用 getSMSService() 才行，
         * 也就是暴露實踐細節。違反了物件導向的封裝原則，PostController 竟然可以將手伸進去執行 SMSService 的方法。
         */
        $data['messageSMS'] = $this->notificationService->getSMSService()->getMessage();

        /**
         * PostController 完全不需要知道NotificationService的內部物件，若想要換掉 SMSService 物件，則 PostController 完全不用修改。
         * PostController 為了要顯示 message，不必再知道實踐細節， 直接使用 getMessage() 就可以抓到資料。
         * 符合了物件導向的封裝原則，PostController 無法將手伸進去執行 SMSService 的方法
         */
        $data['messageLKP'] = $this->notificationService->getMessage();

        return view('posts.index', $data);
    }
}