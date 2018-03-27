import * as types from './mutations-types.js'

const mutations = {
	ChangeStatus(state){
		state.IsLogin = true
	},
	ExitStatus(state){
		state.IsLogin = false
	},
	// 播放状态
	PlayMp3(state){
		state.playing = true
	},
	PauseMp3(state){
		state.playing = false
	},

	// 播放点击的歌曲
	SetMp3Id(state, PlayMp3Id){
		state.PlayMp3Id = PlayMp3Id
	},

	// 播放点击的歌名
	SetMp3Name(state, PlayMp3Name){
		state.PlayMp3Name = PlayMp3Name
	},
	
	// 播放点击的图片
	SetMp3Pic(state, PlayMp3pic){
		state.PlayMp3pic = PlayMp3pic
	},
	
	// 播放点击的歌手
	SetMp3Singer(state, PlayMp3Singer){
		state.PlayMp3Singer = PlayMp3Singer
	},

	// 播放点击的歌曲MP3
	SetMp3Music(state, PlayMp3Url){
		state.PlayMp3Url = PlayMp3Url
	}
	// 播放状态
	// [types.SET_PLAYING_STATE](state, flag) {
	// 	state.playing = flag
	// },
	// // 是否全屏
	// [types.SET_FULL_SCREEN](state, flag) {
	// 	state.fullScreen = flag
	// },
	// // 随机播放
	// [types.SET_PLAYLIST](state, list) {
	// 	state.playList = list
	// },
	// // 顺序播放
	// [types.SET_SEQUENCE_LIST](state, list) {
	// 	state.sequenceList = list
	// },
	// // 播放状态
	// [types.SET_PLAY_MODE](state, mode) {
	// 	state.mode = mode
	// },
	// // 当前播放歌曲索引
	// [types.SET_CURRENT_INDEX](state, index) {
	// 	state.currentIndex = index
	// }
}
export default mutations