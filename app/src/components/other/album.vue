<template>
	<div >
		<div class="album-header">
			<yd-flexbox class="app-music-header">
				<router-link :to="{ path : '/' }">
		            <div class="back">
		            	<i class="fa fa-angle-left"></i>
		            </div>
		        </router-link>
	        	<yd-flexbox-item><span class="album-name">歌单</span></yd-flexbox-item>
	        </yd-flexbox>
		</div>
		<!-- 封面 -->
		<div class="album-pic">
			<yd-flexbox v-for="album in ContentsList">
	            <yd-flexbox-item class="pic">
	            	<img :src="AlbumIcon" />
	        	</yd-flexbox-item>
	            <yd-flexbox-item class="info">
	            	<p class="content">{{ album.content }}</p>
	            	<div class="author">
	            		<img :src="Album_Ouath_pic"></img>
	            		<p class="oauth">{{ Album_Ouath }}</p>
	            		<p class="icon"><i class="fa fa-angle-right"></i></p>
	            	</div>
	            </yd-flexbox-item>
	        </yd-flexbox>
		</div>
		<!-- 评论 -->
		<div class="music-nav">
			<div class="nav-tab-list">
	        	<div class="tabar-nav" v-for="tabs in NavTabList">
	        		<div class="pic">
	        			<i :class="tabs.style"></i>
	        		</div>
	        		<p class="nav-label">{{ tabs.name }}</p>
	        	</div>
	        </div>
		</div>
		<!-- 歌曲 -->
		<album-list :AlbumNumber="AlbumId" @Album-ouath="Album_Author" @Album-avatar="Album_Avatar"></album-list>
	</div>
</template>

<script>
import AlbumList from '../song/albumlist'

export default {
	components : {
		AlbumList
	},
	data() {
		return {
			AlbumId : '',		  	//歌单ID
			ContentsList : [],	  	//内容
			AlbumIcon : '',   	  	//歌单封面

			Album_Ouath : '', 	  	//歌单作者
			Album_Ouath_pic : '', 	//作者头像
			// 图片映射
	      	imgBounce : {
	        	//意思就是如果当前地址是/al_list/xxxx就引入对应的图片
	        	'/al_list/605578986' : require('../../assets/song/list1.jpg'),  
	        	'/al_list/1991893513' : require('../../assets/song/list2.jpg'),
	        	'/al_list/1997060674' : require('../../assets/song/list3.jpg'),
	        	'/al_list/2011457202' : require('../../assets/song/list4.jpg'),
	        	'/al_list/2009145567' : require('../../assets/song/list5.jpg'),
	        	'/al_list/1994370897' : require('../../assets/song/list6.jpg'),
	      	},
	      	NavTabList : [
                {
                	style : 'fa fa-star-o',
                    name : '21885'
                },
                {
                	style : 'fa fa-commenting-o',
                    name : '4897'
                },
                {
                	style : 'fa fa-share-alt',
                    name : '198'
                },
                {
                	style : 'fa fa-thumbs-o-up',
                    name : '365'
                },
            ]
		}
	},
	methods : {
		_GetAlbumInfo : function(al_id)
		{
			let _this = this
			switch(al_id)
			{
				case '605578986' :
					_this.ContentsList.push({ 'content' : '民谣 | 我把我整个的灵魂都给你'})
					break
				case '1991893513' :
					_this.ContentsList.push({ 'content' : '我恰好途经你的盛放'})
					break
				case '1997060674' :
					_this.ContentsList.push({ 'content' : '『 Dream Pop』如梦般的流行曲'})
					break
				case '2011457202' :
					_this.ContentsList.push({ 'content' : '圣诞树我准备好了，礼物在哪里呀?'})
					break
				case '2009145567' :
					_this.ContentsList.push({ 'content' : '梦回旧景 | 多想回到最初遇见你的时光'})
					break
				case '1994370897' :
					_this.ContentsList.push({ 'content' : '百首老歌：再续当年情'})
					break
				default : 
					_this.$dialog.alert({ mes : '歌单信息错误' })
			}
		},
		Album_Author : function(author)
		{
			this.$nextTick(function(){
				this.Album_Ouath = author
			})
		},
		Album_Avatar : function(img)
		{
			this.$nextTick(function(){
				this.Album_Ouath_pic = img
			})
		}
	},
	watch : {
		
	},
	created() {
		// 获得路由的路径图片
		this.AlbumIcon = this.imgBounce[this.$route.path]
		// 获得传过来的歌单id
		this.AlbumId = this.$route.params.al_id
		this._GetAlbumInfo(this.$route.params.al_id)
	}
}
</script>

<style scoped>
.album-header {
	height:4em;
	background-color: #f44e39;
}
.album-header .back{
	font-size: 2rem;
	color:white;
	margin-left: .8rem;
	margin-right: .5rem;
}
.album-header .album-name{
	font-size: 1.2rem;
	color:white;
}
.album-pic{
	height: 10.5rem;
	background-color: #f44e39;
}
.album-pic .pic, .info{
	width: 50%;
	padding: .6rem .8rem;
}
.pic img{
	width: 100%;
	height: 9.3rem;
}
.info p.content{
	font-size: 1rem;
	margin-bottom: 25px;
	color:white;
	color:white;
}
.author img{
	height: 2rem;
	width: 2rem;
	border-radius: 50%;
	float: left
}
.author p.oauth{
	font-size: .9rem;
	margin-top: .5rem;
	margin-left: .4rem;
	float: left;
	width: 5rem;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    color:white;
}
.author p.icon{
	float: left;
	font-size: 1.33rem;
	margin-top: .4rem;
	margin-left: .4rem;
	color:white;
}

.music-nav{
	height:4.6rem;
	background-color: #f44e39;
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
.tabar-nav i{
	font-size: 1.4rem;
	width: 100%;
	color:white;
	margin-bottom: .4rem;
}
.nav-label{
	text-align: center;
    /*color:#999;*/
    color:white;
    font-size: .9rem;
}

</style>