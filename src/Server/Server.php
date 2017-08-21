<?php

namespace pithyone\wechat\Server;

use Arrayy\Arrayy;
use pithyone\wechat\Core\Log;
use pithyone\wechat\Core\XML;
use pithyone\wechat\Exceptions\ServerException;
use pithyone\wechat\Exceptions\RuntimeException;
use pithyone\wechat\Message\NewsArticle;

/**
 * Class Server
 *
 * @property string $msg_signature         企业微信加密签名
 * @property string $timestamp             时间戳
 * @property string $nonce                 随机数
 * @property string $echostr               加密的随机字符串，以msg_encrypt格式提供
 * @property string $ToUserName            企业微信CorpID
 * @property string $FromUserName          成员UserID
 * @property int    $CreateTime            消息创建时间
 * @property string $MsgType               消息类型
 * @property int    $MsgId                 消息id
 * @property int    $AgentID               企业应用的id
 * @property string $Content               文本消息内容
 * @property string $PicUrl                图片链接
 * @property string $MediaId               图片媒体文件id
 * @property string $Format                语音格式，如amr，speex等
 * @property string $ThumbMediaId          视频消息缩略图的媒体id
 * @property string $Location_X            地理位置纬度／X坐标信息
 * @property string $Location_Y            地理位置经度／Y坐标信息
 * @property string $Scale                 地图缩放大小／精度
 * @property string $Label                 地理位置信息
 * @property string $Title                 标题
 * @property string $Description           描述
 * @property string $Event                 事件类型
 * @property string $EventKey              事件KEY值
 * @property string $Latitude              上报地理位置纬度
 * @property string $Longitude             上报地理位置经度
 * @property string $Precision             上报地理位置精度
 * @property Arrayy $BatchJob              异步任务
 * @property string $ChangeType            通讯录变更事件
 * @property string $UserID                通讯录变更事件成员UserID
 * @property string $Name                  通讯录变更事件成员名称/部门名称
 * @property string $Department            通讯录变更事件成员部门列表
 * @property string $Mobile                通讯录变更事件手机号码
 * @property string $Position              通讯录变更事件职位信息
 * @property string $Gender                通讯录变更事件性别，1表示男性，2表示女性
 * @property string $Email                 通讯录变更事件邮箱
 * @property string $Status                通讯录变更事件激活状态：1=已激活 2=已禁用
 * @property string $EnglishName           通讯录变更事件英文名
 * @property string $IsLeader              通讯录变更事件上级字段，标识是否为上级。0表示普通成员，1表示上级
 * @property string $Telephone             通讯录变更事件座机
 * @property Arrayy $ExtAttr               通讯录变更事件扩展属性
 * @property string $Id                    通讯录变更事件部门Id
 * @property string $ParentId              通讯录变更事件父部门id
 * @property string $Order                 通讯录变更事件部门排序
 * @property string $TagId                 通讯录变更事件标签Id
 * @property string $AddUserItems          通讯录变更事件标签中新增的成员userid列表，用逗号分隔
 * @property string $DelUserItems          通讯录变更事件标签中删除的成员userid列表，用逗号分隔
 * @property string $AddPartyItems         通讯录变更事件标签中新增的部门id列表，用逗号分隔
 * @property string $DelPartyItems         通讯录变更事件标签中删除的部门id列表，用逗号分隔
 * @property Arrayy $ScanCodeInfo          扫描信息
 * @property Arrayy $SendPicsInfo          发送的图片信息
 * @property Arrayy $SendLocationInfo      发送的位置信息
 */
class Server
{
    /**
     * @var string
     */
    protected $token;

    /**
     * @var string
     */
    protected $corpId;

    /**
     * @var PrpCrypt
     */
    protected $prpCrypt;

    /**
     * @var SHA1
     */
    protected $sha1;

    /**
     * @var Arrayy
     */
    protected $data;

    /**
     * @var array
     */
    protected $package = [];

    /**
     * Server constructor.
     *
     * @param string $corpId 企业的 CorpId
     * @param string $token 企业微信后台，开发者设置的token
     * @param string $encodingAesKey 企业微信后台，开发者设置的EncodingAESKey
     *
     * @throws ServerException
     */
    public function __construct($corpId, $token, $encodingAesKey)
    {
        $this->initializeParam();

        $this->token = $token;
        $this->corpId = $corpId;

        if (strlen($encodingAesKey) != 43) {
            throw new ServerException('IllegalAesKey');
        }
        $this->prpCrypt = $this->prpCrypt ?: new PrpCrypt($encodingAesKey);
        $this->sha1 = $this->sha1 ?: new SHA1();

        $this->initialize();
    }

    protected function initializeParam()
    {
        foreach ($_GET as &$value) {
            $value = rawurldecode($value);
        }

        $this->data = new Arrayy($_GET);
    }

    protected function initialize()
    {
        if (!$this->echostr) {
            $object = simplexml_load_string($this->decrypt(), "SimpleXMLElement", LIBXML_NOCDATA);

            if ($object !== false) {
                $json = json_encode($object);
                $data = json_decode($json, true);

                Log::debug("Receive message:", $data);

                $data = array_merge($this->data->toArray(), $data);
                $this->data = new Arrayy($data);
            }
        }
    }

    /**
     * @return bool|string
     */
    public function reply()
    {
        if ($this->echostr) {
            return $this->verify();
        }

        $this->package = array_merge($this->package, [
            'ToUserName'   => $this->FromUserName,
            'FromUserName' => $this->ToUserName,
            'CreateTime'   => $this->timestamp,
        ]);

        $xml = XML::build($this->package);

        Log::debug("Reply message:", $this->package);

        return $this->encrypt($xml);
    }

    /**
     * @param string $content 文本消息内容
     */
    public function setText($content)
    {
        $this->package = array_merge($this->package, [
            'MsgType' => 'text',
            'Content' => $content,
        ]);
    }

    /**
     * @param string $mediaId 图片媒体文件id，可以调用获取媒体文件接口拉取
     */
    public function setImage($mediaId)
    {
        $this->package = array_merge($this->package, [
            'MsgType' => 'image',
            'Image'   => [
                'MediaId' => $mediaId,
            ],
        ]);
    }

    /**
     * @param string $mediaId 语音文件id，可以调用获取媒体文件接口拉取
     */
    public function setVoice($mediaId)
    {
        $this->package = array_merge($this->package, [
            'MsgType' => 'voice',
            'Voice'   => [
                'MediaId' => $mediaId,
            ],
        ]);
    }

    /**
     * @param string $mediaId 视频文件id，可以调用获取媒体文件接口拉取
     * @param string $title 视频消息的标题
     * @param string $description 视频消息的描述
     */
    public function setVideo($mediaId, $title, $description)
    {
        $this->package = array_merge($this->package, [
            'MsgType' => 'video',
            'Video'   => [
                'MediaId'     => $mediaId,
                'Title'       => $title,
                'Description' => $description,
            ],
        ]);
    }

    /**
     * @param array|NewsArticle $news
     */
    public function setNews($news)
    {
        $news = is_array($news) ? $news : [$news];

        $articles = [];
        foreach ($news as $article) {
            $articles[] = [
                'Title'       => $article->title,
                'Description' => $article->description,
                'PicUrl'      => $article->picurl,
                'Url'         => $article->url,
            ];
        }

        $this->package = array_merge($this->package, [
            'MsgType'      => 'news',
            'ArticleCount' => count($articles),
            'Articles'     => $articles,
        ]);
    }

    /**
     * 验证URL
     *
     * @return bool|string
     * @throws ServerException
     */
    protected function verify()
    {
        $signature = $this->sha1->get($this->token, $this->timestamp, $this->nonce, $this->echostr);

        if ($signature != $this->msg_signature) {
            throw new ServerException('ValidateSignatureError');
        }

        return $this->prpCrypt->decrypt($this->echostr, $this->corpId);
    }

    /**
     * 检验消息的真实性，并且获取解密后的明文
     *
     * @param string $message
     *
     * @return bool|string
     * @throws ServerException
     */
    protected function decrypt($message = null)
    {
        if (is_null($message)) {
            $message = file_get_contents("php://input");
        }

        //提取密文
        $xmlparse = new XMLParse();
        $encrypt = $xmlparse->extract($message);

        //验证安全签名
        $signature = $this->sha1->get($this->token, $this->timestamp, $this->nonce, $encrypt);
        if ($signature != $this->msg_signature) {
            throw new ServerException('ValidateSignatureError');
        }

        return $this->prpCrypt->decrypt($encrypt, $this->corpId);
    }

    /**
     * 将企业微信回复用户的消息加密打包
     *
     * @param string $message 企业微信待回复用户的消息，xml格式的字符串
     *
     * @return string
     */
    protected function encrypt($message)
    {
        //加密
        $encrypt = $this->prpCrypt->encrypt($message, $this->corpId);

        $timestamp = time();
        $nonce = $this->prpCrypt->getRandomStr();

        //生成安全签名
        $signature = $this->sha1->get($this->token, $timestamp, $nonce, $encrypt);

        //生成发送的xml
        $xmlparse = new XMLParse();

        return $xmlparse->generate($encrypt, $signature, $timestamp, $nonce);
    }

    /**
     * @param $name
     *
     * @return mixed
     * @throws RuntimeException
     */
    public function __get($name)
    {
        return $this->data->$name;
    }

    /**
     * @return Arrayy
     */
    public function getData()
    {
        return $this->data;
    }
}

