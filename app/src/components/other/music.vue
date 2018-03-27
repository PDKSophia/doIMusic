<template>
	<div>
		<!-- 幻灯片 -->
		<slides-pic></slides-pic>
		<!-- 嘟嘟 -->
		<div class="music-nav">
			<div class="nav-tab-list">
        		<div class="tabar-nav" v-for="tabs in NavTabList">
        			<div class="pic">
        				<img :src="tabs.pic" />
        			</div>
        			<p class="nav-label">{{ tabs.name }}</p>
        		</div>
        	</div>
		</div>
		<!-- 推荐 -->
		<div class="commodity list-song">
			<div class="detail-conduct">
				<p class="title" style="padding-left:.4rem">推荐歌单</p>
			    <p class="more">更多<i class="fa fa-angle-right"></i></p>
			</div>
	    	<show-list :DataArray="SongSheet"></show-list>
		</div>
		<!-- 歌手 -->
		<div class="commodity singer">
			<div class="detail-conduct">
				<p class="title" style="padding-left:.4rem">歌手</p>
			    <p class="more">更多<i class="fa fa-angle-right"></i></p>
			</div>
	    	<show-list :DataArray="singer"></show-list>
		</div>
	</div>
</template>

<script>
import SlidesPic from '../common/slides'
import ShowList from '../common/show'

export default{
	components : {
		SlidesPic,
		ShowList
	},
	data() {
		return {
			SongSheet : [
				{
					pic : require('../../assets/song/list1.jpg'),
					name : '民谣 | 我把我整个的灵魂都给你',
					path : '/al_list',
					al_id : '605578986',
					flag : false,
					author : '会玩的一号'
				},
				{
					pic : require('../../assets/song/list2.jpg'),
					name : '我恰好途经你的盛放',
					path : '/al_list',
					al_id : '1991893513',
					flag : false,
					author : '彭道宽'
				},
				{
					pic : require('../../assets/song/list3.jpg'),
					name : '『 Dream Pop』如梦般的流行曲',
					path : '/al_list',
					al_id : '1997060674',
					flag : false,
					author : '会玩的一号'
				},
				{
					pic : require('../../assets/song/list4.jpg'),
					name : '圣诞树我准备好了，礼物在哪里呀?',
					path : '/al_list',
					al_id : '2011457202',
					flag : false,
					author : 'Sophia'
				},
				{
					pic : require('../../assets/song/list5.jpg'),
					name : '梦回旧景 | 多想回到最初遇见你的时光',
					path : '/al_list',
					al_id : '2009145567',
					flag : false,
					author : '会玩的一号'
				},
				{
					pic : require('../../assets/song/list6.jpg'),
					name : '百首老歌：再续当年情',
					path : '/al_list',
					al_id : '1994370897',
					flag : false,
					author : 'QQ小冰'
				}
			],
			singer : [
				{
					pic : require('../../assets/song/song1.jpg'),
					name : '周杰伦',
					flag : 'true',
					path : '/singer'
				},
				{
					pic : require('../../assets/song/song2.jpg'),
					name : '五月天',
					flag : 'true',
					path : '/singer'
				},
				{
					pic : require('../../assets/song/song4.jpg'),
					name : '陈奕迅',
					flag : 'true',
					path : '/singer'
				},
			],
			NavTabList : [
                {
                    pic : require('../../assets/icon/time.png'),
                    name : '时间'
                },
                {
                    pic : require('../../assets/icon/hot.png'),
                    name : '日推'
                },
                {
                    pic : require('../../assets/icon/calendars.png'),
                    name : '歌单'
                },
                {
                    pic : require('../../assets/icon/ranking.png'),
                    name : '打榜'
                },
            ]
		}
	}
}	
</script>

<style scoped>
.music-nav{
	border-bottom: .5px #ccc solid;
}

/*icon布局*/
.nav-tab-list{
    padding: 1rem 1rem .4rem 1rem;
	position: relative;
	width: 100%;
	display: flex;  /*弹性布局*/
	display: -webkit-flex; /* Safari */
}
.tabar-nav{
	text-align: center;
	display: block;
	/*四个居中的代码*/
	-webkit-box-flex: 1;
    flex: 1;
}
.tabar-nav img{
	width: 2rem;
	height: 2rem;
}
.nav-label{
	text-align: center;
    color:#999;
    font-size: .9rem;
}
/*滚动框样式*/
.scroll-wrap .yd-rollnotice{
    position: relative;
    width: 94%;
    margin-left:3%;
    height: 30px; 
    border-radius:5px;
    background: #F5F5F5;
    border:1px solid #aaa;
    font-size:11px;
    opacity:0.9;
    margin-bottom: 1rem;
}
.hot{
    color:red;
    margin-right:6px;
    padding-left:10px;
    font-size: 12px;
}
/*推荐歌单*/
.commodity{
	padding-top: .3rem;
}
.list-song{
	height: 24.6rem;
	border-bottom: .5px #ccc solid;
}
.singer{
	height: 16rem;
}
.detail-conduct, .always-conduct{
	height: 2.2rem;
	width: 100%;
	margin-bottom: .6rem;
}

.always-list{
	border-top: 1px solid #999;
	margin-top: .6rem;
	height: 32rem;
}
p{
	font-size: 1rem;
	letter-spacing: 1px;
	padding:.6rem 1rem; 
}
p.title{
	float:left;
}
p.more{
	float: right;
	color:#999;
}
</style>