<?php
/**
 * 语言包
 *
 * @author mybsdc <mybsdc@gmail.com>
 * @date 2018/8/10
 * @time 14:39
 */

return [
    'exception_msg' => [
        '34520001' => '检测到你尚未配置freenom账户信息，请修改.env文件中与账户相关的项，否则程序无法正常运作',
        '34520002' => '登录freenom出错，未取得正确的cookie值，请检查账户和密码是否正确',
        '34520003' => '域名数据匹配失败，可能是你暂时没有域名或者页面改版导致正则失效，请及时联系作者',
        '34520004' => 'token匹配失败，可能是页面改版导致正则失效，请及时联系作者',
        '34520005' => 'putenv()函数被禁用，无法写入环境变量导致程序无法正常运作，解决方案参考：https://github.com/luolongfei/freenom/issues/22',
        '34520006' => sprintf('不支持php7以下的版本，当前版本为%s，请升级到php7以上', PHP_VERSION),
        '34520007' => sprintf('已自动在%s目录下生成.env配置文件，请将配置文件中的各项内容修改为你自己的', ROOT_PATH),
        '34520008' => sprintf('请将%s目录下的.env.example文件复制为.env文件，并将.env文件中的各项内容修改为你自己的', ROOT_PATH),
        '34520009' => '登录freenom失败，请检查账户和密码是否正确',
    ],
];