import {playMode} from '../js/config.js'

const state = {
	IsLogin : false,
	PlayIconIsHide : false,		// 底部播放器是否隐藏

	PlayMp3Id : '',				// 播放的歌曲id
	PlayMp3Name : '',			// 播放的歌曲名
	PlayMp3pic : '',			// 播放的歌曲封面
	PlayMp3Singer : '',			// 播放的歌手
	PlayMp3Url : '',			// 播放的路径
	playing : false,			// 是否在播放

	// 音乐播放器
	// singer : {},
	// fullScreen : false,			//是否全屏
	// playList : [],				//随机播放
	// sequenceList : [],			//顺序排序
	// mode : playMode.sequence,   //默认顺序播放
	// currentIndex : -1,			//当前播放歌曲的索引
}

export default state