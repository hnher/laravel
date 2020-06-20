<?php
/**
 * Client.php
 * Created On 2020/6/19 2:38 下午
 * Create by Retr0
 */

namespace App\Modules\Scheduler;

use MQ\MQClient;
use MQ\MQConsumer;
use MQ\MQProducer;

class Client
{
    protected $client;

    static $instanceId = '';
    static $groupId = '';
    static $topic = '';

    public function __construct()
    {
        $this->client = new MQClient(config('aliyun.rocketMQ.httpEndpoint'), config('aliyun.accessKey'), config('aliyun.secretKey'));
        self::$instanceId = config('aliyun.rocketMQ.instanceId');
        self::$groupId = config('aliyun.rocketMQ.groupId');
        self::$topic = config('aliyun.rocketMQ.topic');
    }

    /**
     * 获得一个消费者实例
     * @param string $topic
     * @param string $groupId
     * @param string $instanceId
     * @return MQConsumer
     */
    public function getConsumer(string $topic = '', string $groupId = '', string $instanceId = '')
    {
        list($topic, $groupId, $instanceId) = $this->getClientConfig($topic, $groupId, $instanceId);

        return $this->client->getConsumer($instanceId, $topic, $groupId);
    }

    /**
     * 获取一个生产者实例
     * @param string $topic
     * @param string $instanceId
     * @return MQProducer
     */
    public function getProducer(string $topic = '', string $instanceId = '')
    {
        list($topic, ,$instanceId) = $this->getClientConfig($topic, '', $instanceId);

        return $this->client->getProducer($instanceId, $topic);
    }

    /**
     * 获取配置
     * @param string $topic
     * @param string $groupId
     * @param string $instanceId
     * @return array
     */
    private function getClientConfig(string $topic, string $groupId, string $instanceId)
    {
        return [
            empty($topic) ? self::$topic : $topic,
            empty($groupId) ? self::$groupId : $groupId,
            empty($instanceId) ? self::$instanceId : $instanceId
        ];
    }
}
