Scanner={
	songsFound:0,
	songsScanned:0,
	startTime:null,
	endTime:null,
	stopScanning:false,
	currentIndex:-1,
	songs:[],
	findSongs:function(ready){
		$.getJSON(OC.linkTo('media','ajax/api.php')+'?action=find_music',function(songs){
			Scanner.songsFound=songs.length;
			Scanner.currentIndex=-1
			if(ready){
				ready(songs)
			}
		});
	},
	scanFile:function(path,ready){
		path=encodeURIComponent(path);
		$.getJSON(OC.linkTo('media','ajax/api.php')+'?action=get_path_info&path='+path,function(song){
			if(ready){
				ready(song);
			}
			if(song){//do this after the ready call so we dont hold up the next ajax call
				var artistId=song.song_artist;
				Scanner.songsScanned++;
				$('#scan span.songCount').text(Scanner.songsScanned);
				var progress=(Scanner.songsScanned/Scanner.songsFound)*100;
				$('#scanprogressbar').progressbar('value',progress)
				Collection.addSong(song);
			}
		});
	},
	scanCollection:function(ready){
		$('#scanprogressbar').progressbar({
			value:0,
		});
		Scanner.startTime=new Date().getTime()/1000;
		Scanner.findSongs(function(songs){
			Scanner.songs=songs;
			Scanner.start();
		});
	},
	stop:function(){
		Scanner.stopScanning=true;
	},
	start:function(ready){
		Scanner.stopScanning=false;
		var scanSong=function(){
			Scanner.currentIndex++;
			if(!Scanner.stopScanning && Scanner.currentIndex<Scanner.songs.length){
				Scanner.scanFile(Scanner.songs[Scanner.currentIndex],scanSong)
			}else{
				Scanner.endTime=new Date().getTime()/1000;
				if(ready){
					ready();
				}
			}
		}
		scanSong();
	},
	toggle:function(){
		if(Scanner.stopScanning){
			Scanner.start();
			$('#scan input.stop').val('Pause');
		}else{
			Scanner.stop();
			$('#scan input.stop').val('Resume');
		}
	}

}
