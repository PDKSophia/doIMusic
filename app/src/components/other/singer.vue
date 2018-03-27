<template>
	<div >
		<div class="singer-header">
			<yd-flexbox class="app-music-header">
				<router-link :to="{ path : '/' }">
		            <div class="back">
		            	<i class="fa fa-angle-left"></i>
		            </div>
		        </router-link>
	        	<yd-flexbox-item><span class="singer-name">{{ singer_name }}</span></yd-flexbox-item>
	        </yd-flexbox>
		</div>
		<div class="singer-pic">
			<img :src="singer_pic"/>
		</div>
		<div class="app-music-tab">
			<yd-tab>
		        <yd-tab-panel label="热门50" active>
		        	<hot :UserName="singer_name" @Song-pic="Song_pic"></hot>
		    	</yd-tab-panel>
		        <yd-tab-panel label="专辑"></yd-tab-panel>
		        <yd-tab-panel label="MV"></yd-tab-panel>
		    </yd-tab>
		</div>
	</div>
</template>

<script>
import Hot from '../song/hot'

export default {
	components : {
		Hot
	},
	data() {
		return {
			singer_name : '',
			singer_pic : '',
		}
	},
	methods : {
		Song_pic : function(pic)
		{
			this.$nextTick(function(){
				this.singer_pic = pic
			})
		}
	},
	created() {
		this.singer_name = this.$route.params.username
	}
}
</script>

<style scoped>
.singer-header {
	height:4em;
	background-color: #f44e39;
}
.singer-header .back{
	font-size: 2rem;
	color:white;
	margin-left: 1rem;
	margin-right: .5rem;
}
.singer-header .singer-name{
	font-size: 1.2rem;
	color:white;
}
.singer-pic{
	height: 15rem;
}
.singer-pic img{
	height:100%;
	width: 100%;
}
</style>