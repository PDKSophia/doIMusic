<template>
	<div>
		<div class="list" v-for="item in DataArray">
			<div v-if="item.flag">
				<router-link :to="{ path : item.path + '/' + item.name }">
					<img :src="item.pic">
				    <p class="singer">{{ item.name }}</p>
				</router-link>
			</div>
			<div v-else>
				<router-link :to="{ path : item.path + '/' + item.al_id }">
					<img :src="item.pic">
				    <p >{{ item.name }}</p>
				</router-link>
			</div>
		</div>
	</div>
</template>

<script>

export default {
	// 不能直接使用父组件定义好的DataArray，要用props接收
	props : {
		DataArray : {
			type : Array,
			default : []
		}
	}
}

</script>

<style scoped>
.list{
	float: left;
	margin-left:0.4rem;
	width: 30%;
	margin-right: 1%;
	margin-bottom: .7rem;
}
.list img{
	height:6.6rem;
	width: 100%;
}
.list p{
	font-size: .8rem;
	color:black;
}
p.singer{
	font-size: .8rem;
	color:black;
	text-align: center;
}
</style>