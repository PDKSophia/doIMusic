<!-- 根组件 -->
<template>
	<div>
		<!-- 通过router-view去渲染组件 -->
		<router-view></router-view>
		<music-play></music-play>
	</div>
</template>

<script >
import MusicPlay from './common/play'
import store from '@/store'

export default {

	components : {
		MusicPlay
	},
	store,
	created() {
		// console.log(this.$store.state.currentPlayMp3)
	}
}

</script>

<style>
*{	margin:0;
	padding: 0;
}
body{
	background: white;
	font-family:"Microsoft YaHei";
}
/*选项卡*/
.yd-tab-nav-item>a {
    display: inherit;
    color: inherit;
    font-size: .9rem;
    height: 2.5rem;
    padding-top: .8rem;
}
</style>