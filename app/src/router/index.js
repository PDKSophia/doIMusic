import Vue from 'vue'
import Router from 'vue-router'

import Home from '@/components/pages/home'
import LoginPage from '@/components/pages/login'
import RegisterPage from '@/components/pages/register'
import SearchPage from '@/components/pages/search'
// import DetailPage from '@/components/pages/song_detail'

import SettingPage from '@/components/common/setting'
import SingerPage from '@/components/other/singer'
import AlbumPage from '@/components/other/album'

Vue.use(Router)

export default new Router({
    // mode : 'history',
    routes : [
        {
        	path : '/',
        	component : Home
        },
        {
        	path : '/login',
        	component : LoginPage
        },
        {
        	path : '/register',
        	component : RegisterPage
        },
        {
            path : '/setting',
            component : SettingPage
        },
        {
            path : '/singer/:username',
            component : SingerPage
        },
        {
            path : '/al_list/:al_id',
            component : AlbumPage
        },
        {
            path : '/search',
            component : SearchPage
        },
        // {
        //     path : '/detail',
        //     component : DetailPage
        // }
    ]
})
