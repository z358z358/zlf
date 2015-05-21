package 
{
	//Avoider Game Tutorial, by Michael James Williams
	//http://gamedev.michaeljameswilliams.com
	
	import flash.display.MovieClip;
	import flash.events.Event;
	import flash.events.ProgressEvent;
	public class DocumentClass extends MovieClip 
	{
		public var menuScreen:MenuScreen;
		public var playScreen:AvoiderGame;
		public var gameOverScreen:GameOverScreen;
		public var loadingProgress:LoadingProgress;
		
		public function DocumentClass() 
		{
			loadingProgress = new LoadingProgress();
			loadingProgress.x = 200;
			loadingProgress.y = 150;
			addChild( loadingProgress );
			loaderInfo.addEventListener( Event.COMPLETE, onCompletelyDownloaded, false, 0, true );
			loaderInfo.addEventListener( ProgressEvent.PROGRESS, onProgressMade, false, 0, true );
			stage.stageFocusRect = false;
		}
		
		public function onCompletelyDownloaded( event:Event ):void
		{
			removeChild( loadingProgress );
			gotoAndStop(3);
			showMenuScreen();
		}
		
		public function onProgressMade( progressEvent:ProgressEvent ):void
		{
			loadingProgress.setValue( Math.floor( 100 * loaderInfo.bytesLoaded / loaderInfo.bytesTotal ) );
		}
		
		public function showMenuScreen():void
		{
			menuScreen = new MenuScreen();
			menuScreen.addEventListener( NavigationEvent.START, onRequestStart, false, 0, true );
			menuScreen.x = 0;
			menuScreen.y = 0;
			addChild( menuScreen );
			
			stage.focus = menuScreen;
		}
		
		public function onAvatarDeath( avatarEvent:AvatarEvent ):void
		{
			var finalScore:Number = playScreen.getFinalScore();
			var finalClockTime:Number = playScreen.getFinalClockTime();
			
			gameOverScreen = new GameOverScreen();
			gameOverScreen.addEventListener( NavigationEvent.RESTART, onRequestRestart, false, 0, true );
			gameOverScreen.x = 0;
			gameOverScreen.y = 0;
			gameOverScreen.setFinalScore( finalScore );
			gameOverScreen.setFinalClockTime( finalClockTime );
			addChild( gameOverScreen );
			
			removeChild( playScreen );
			playScreen = null;
			
			stage.focus = gameOverScreen;
		}
		
		public function onRequestStart( navigationEvent:NavigationEvent ):void
		{
			playScreen = new AvoiderGame();
			playScreen.addEventListener( AvatarEvent.DEAD, onAvatarDeath, false, 0, true );
			playScreen.x = 0;
			playScreen.y = 0;
			addChild( playScreen );
			
			removeChild( menuScreen );
			menuScreen = null;
			
			stage.focus = playScreen;
		}
		
		public function onRequestRestart( navigationEvent:NavigationEvent ):void
		{
			restartGame();
		}
		
		public function restartGame():void
		{
			playScreen = new AvoiderGame();
			playScreen.addEventListener( AvatarEvent.DEAD, onAvatarDeath, false, 0, true );
			playScreen.x = 0;
			playScreen.y = 0;
			addChild( playScreen );
			
			removeChild( gameOverScreen );
			gameOverScreen = null;
			
			stage.focus = playScreen;
		}
	}
}