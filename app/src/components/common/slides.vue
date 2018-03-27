<!-- 幻灯片 -->
<template>
    <div class="slides-img">
    	 <yd-slider autoplay="2500">
		    <yd-slider-item v-for="item in slides">
		        <router-link :to="{ path : item.path + '/' + item.name }">
		            <img :src="item.src">
		        </router-link>
		    </yd-slider-item>
		</yd-slider>
    </div>
</template>

<script>

export default {
    data(){
    	return {
    		slides : [
    			{
    				src : require('../../assets/page/1.jpg'),
                    name : '薛之谦',
                    path : '/singer'
    			},
    			{
    				src : require('../../assets/page/2.jpg'),
                    name : '周玥',
                    path : '/singer'
    			},
    			{
    				src : require('../../assets/page/3.jpg'),
                    name : '林俊杰',
                    path : '/singer'
    			},
                {
                    src : require('../../assets/page/4.jpg'),
                    name : '陈粒',
                    path : '/singer'
                },
                {
                    src : require('../../assets/page/5.jpg'),
                    name : '徐佳莹',
                    path : '/singer'
                }
    		]
    	}
    }
}
</script>

<style scoped>
.slides-img{
    height:13rem;
}
img{
	height:13rem;
	width: 100%;
}
</style>