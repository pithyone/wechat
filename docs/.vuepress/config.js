module.exports = {
    base: '/wechat/',
    locales: {
        '/': {
            lang: 'zh-CN'
        }
    },
    title: 'WeWork',
    description: '最最最简单易用的企业微信SDK',
    serviceWorker: true,
    themeConfig: {
        sidebar: [
            '/quick-start',
            '/token',
            {
                title: '通讯录管理',
                collapsable: false,
                children: [
                    '/user',
                    '/department',
                    '/tag',
                    '/batch'
                ]
            },
            '/crm',
            '/agent',
            '/menu',
            {
                title: '消息推送',
                collapsable: false,
                children: [
                    '/message',
                    '/callback',
                    '/chat'
                ]
            },
            '/media',
            '/auth',
            {
                title: 'JS-SDK',
                collapsable: false,
                children: [
                    '/ticket',
                    '/jsticket',
                    '/jssdk'
                ]
            },
            {
                title: 'OA数据接口',
                collapsable: false,
                children: [
                    '/checkin',
                    '/corp'
                ]
            },
            '/invoice'
        ],
        sidebarDepth: 0,
        lastUpdated: '上次更新',
        repo: 'pithyone/wechat',
        docsDir: 'docs',
        editLinks: true,
        editLinkText: '在 GitHub 上编辑此页'
    }
};
