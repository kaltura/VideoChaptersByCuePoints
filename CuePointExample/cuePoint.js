
	var KalturaChaptersSample = {

		myPlayer : null,
		currentCue : null,
		firstLoad : false,
	
		playerPlaying: function() {
			if( KalturaChaptersSample.firstLoad ) {
				KalturaChaptersSample.firstLoad = false;
				var lastIndex = document.URL.lastIndexOf('enterprise');
				
				var chapterNum = 0;
				
				if(lastIndex != -1)
				{
					xUrl = document.URL.substr(lastIndex + 11); //Remove the 'enterprise/' from the string
					urlParts = xUrl.split("-");
					chapterNum = urlParts[0];
				}
				
				var element = $('ul li a').get(chapterNum);
				this.switchActiveCue(element.id);
				this.jumpToTime(element.getAttribute("data-chapterStartTime"));
				
				setTimeout( function() {
					KalturaChaptersSample.myPlayer.sendNotification("doPause");
				}, 50);
			}
		},
		
		doFirstPlay: function() {
			KalturaChaptersSample.firstLoad = true;
			this.myPlayer.sendNotification("doPlay");
		},
	
		jumpToTime : function ( timesec ) {
			if (this.myPlayer != null) {
				this.myPlayer.sendNotification("doPlay");
				this.myPlayer.sendNotification("doSeek", timesec/1000);
			}
		},
		
		switchActiveCue : function ( newId ) {
			if (this.currentCue != null) this.currentCue.className = '';
			this.currentCue = document.getElementById(newId);
			this.currentCue.className = 'selected';
			console.log(newId);
		},
  
		cuePointHandler : function( qPoint ) {
			this.switchActiveCue('cp'+qPoint.cuePoint.id);
		 },				
	}

	// Bind to cuePointReached event
	var jsCallbackReady = function( playerId ) {
		KalturaChaptersSample.myPlayer = document.getElementById(playerId);
		KalturaChaptersSample.myPlayer.addJsListener("playerPlayed", "KalturaChaptersSample.playerPlaying");
		KalturaChaptersSample.myPlayer.addJsListener("cuePointReached", "KalturaChaptersSample.cuePointHandler");
		KalturaChaptersSample.myPlayer.addJsListener("mediaReady", "KalturaChaptersSample.doFirstPlay");
		
		//myPlayer.addJsListener("adOpportunity", "cuePointHandler"); used for Ad Cue Points
	};
	
	$('#chapters a').click(function(e) {
		var chapterName = $(e.target).attr("data-chapterName");
		$('#ctitle').text($(e.target).attr("data-chapterTitle"));
		$('#cimage').attr("src", $(e.target).attr("data-chapterThumb"));
		$('#ctags').text("Chapter Tags: " + $(e.target).attr("data-chapterTags"));
		KalturaChaptersSample.jumpToTime($(e.target).attr("data-chapterStartTime"));
		KalturaChaptersSample.switchActiveCue($(e.target).attr("id"));
		window.history.pushState("CuePointClicked", "CuePointClicked", chapterName);
		e.preventDefault();
		return false;
	});
