<?php
/**
 * aliyun.php
 * 阿里云配置
 * Created On 2020/6/19 2:44 下午
 * Create by Retr0
 */

return [
    'accessKey' => env('ALIYUN_ACCESS_KEY', ''),
    'secretKey' => env('ALIYUN_SECRET_KEY', ''),

    /**
     * Rocket MQ 配置
     */
    'rocketMQ' => [
        // HTTP 接入域名
        'httpEndpoint' => env('ALIYUN_ROCKET_MQ_HTTP_ENDPOINT', ''),
        // Topic
        'topic' => env('ALIYUN_ROCKET_MQ_TOPIC', ''),
        // 实例 ID
        'instanceId' => env('ALIYUN_ROCKET_MQ_INSTANCE_ID', ''),
        // 分组 ID
        'groupId' => env('ALIYUN_ROCKET_MQ_GROUP_ID', '')
    ]
];
