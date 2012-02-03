
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
			if(this.firstLoad == false)
			{
				var cuePoint = $('#cp'+qPoint.cuePoint.id);
				
				console.log(cuePoint);
				this.changePageData(cuePoint);
			}
		 },				
	
		//Changes all the data on the page - selecting the chapter, changing the content and the URL
		changePageData : function(cuePoint){
			var chapterName = cuePoint.attr("data-chapterName");
			
			$('#ctitle').text(cuePoint.attr("data-chapterTitle"));
			$('#cimage').attr("src", cuePoint.attr("data-chapterThumb"));
			$('#ctags').text("Chapter Tags: " + cuePoint.attr("data-chapterTags"));
			this.switchActiveCue(cuePoint.attr("id"));
						
			//Change the URL without refreshing the page
			window.history.pushState("CuePointClicked", "CuePointClicked", chapterName);
		}
	}
	
	// Create a more standard code convention 
	// Change to use stnadard function jsCallbackReady() {...
	
	// called by the KDP once it is ready to interact with javascript on the page:
	var jsCallbackReady = function( playerId ) {
		var player = document.getElementById(playerId);
		player.addJsListener("playerPlayed", "KalturaChaptersSample.playerPlaying");
		player.addJsListener("cuePointReached", "KalturaChaptersSample.cuePointHandler");
		player.addJsListener("mediaReady", "KalturaChaptersSample.doFirstPlay");
		
		// Cache a reference to kaltura player in a variable within my scope (my object)
		KalturaChaptersSample.myPlayer = player;
		
		//myPlayer.addJsListener("adOpportunity", "cuePointHandler"); used for Ad Cue Points
	};
	
	$('#chapters a').click(function(e) {
		var chapter = $(e.target);

		//Change the page and skip to the chapter
		KalturaChaptersSample.changePageData(chapter);
		KalturaChaptersSample.jumpToTime(chapter.attr("data-chapterStartTime"));
				
		//Prevent redirect on the page
		e.preventDefault();
		return false;
	});
