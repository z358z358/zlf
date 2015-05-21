package 
{
	import flash.display.MovieClip;
	import flash.utils.Timer;
	import flash.events.TimerEvent;
	import flash.ui.Mouse;
	import flash.events.KeyboardEvent;
	import flash.ui.Keyboard;
	import flash.events.Event;
	import flash.media.SoundChannel;
	
	public class AvoiderGame extends MovieClip 
	{
		public var gameClock:Clock;
		public var gameScore:Score;
		public var backgroundContainer:BackgroundContainer;
		public var army:Array;
		public var enemy:Enemy;
		public var avatar:Avatar;
		public var gameTimer:Timer;
		public var useMouseControl:Boolean;
		public var downKeyIsBeingPressed:Boolean;
		public var upKeyIsBeingPressed:Boolean;
		public var leftKeyIsBeingPressed:Boolean;
		public var rightKeyIsBeingPressed:Boolean;
		public var backgroundMusic:BackgroundMusic;
		public var bgmSoundChannel:SoundChannel;	//bgm for BackGround Music
		public var enemyAppearSound:EnemyAppearSound;
		public var sfxSoundChannel:SoundChannel;	//sfx for Sound FX
		public var currentLevelData:LevelData;
		
		public function AvoiderGame() 
		{
			currentLevelData = new LevelData( 1 );
			setBackgroundImage();
			
			backgroundMusic = new BackgroundMusic();
			bgmSoundChannel = backgroundMusic.play();
			bgmSoundChannel.addEventListener( Event.SOUND_COMPLETE, onBackgroundMusicFinished, false, 0, true );
			enemyAppearSound = new EnemyAppearSound();
			
			downKeyIsBeingPressed = false;
			upKeyIsBeingPressed = false;
			leftKeyIsBeingPressed = false;
			rightKeyIsBeingPressed = false;
			
			useMouseControl = false;
			Mouse.hide();
			army = new Array();
			
			avatar = new Avatar();
			addChild( avatar );
			if ( useMouseControl )
			{
				avatar.x = mouseX;
				avatar.y = mouseY;
			}
			else
			{
				avatar.x = 200;
				avatar.y = 250;
			}
			
			gameTimer = new Timer( 25 );
			gameTimer.addEventListener( TimerEvent.TIMER, onTick, false, 0, true );
			gameTimer.start();
			
			addEventListener( Event.ADDED_TO_STAGE, onAddToStage, false, 0, true );
		}
		
		public function onBackgroundMusicFinished( event:Event ):void
		{
			bgmSoundChannel = backgroundMusic.play();
			bgmSoundChannel.addEventListener( Event.SOUND_COMPLETE, onBackgroundMusicFinished, false, 0, true );
		}
		
		public function onAddToStage( event:Event ):void
		{
			stage.addEventListener( KeyboardEvent.KEY_DOWN, onKeyPress, false, 0, true );
			stage.addEventListener( KeyboardEvent.KEY_UP, onKeyRelease, false, 0, true );
		}
		
		public function onKeyPress( keyboardEvent:KeyboardEvent ):void
		{
			if ( keyboardEvent.keyCode == Keyboard.DOWN )
			{
				downKeyIsBeingPressed = true;
			}
			else if ( keyboardEvent.keyCode == Keyboard.UP )
			{
				upKeyIsBeingPressed = true;
			}
			else if ( keyboardEvent.keyCode == Keyboard.LEFT )
			{
				leftKeyIsBeingPressed = true;
			}
			else if ( keyboardEvent.keyCode == Keyboard.RIGHT )
			{
				rightKeyIsBeingPressed = true;
			}
		}
		
		public function onKeyRelease( keyboardEvent:KeyboardEvent ):void
		{
			if ( keyboardEvent.keyCode == Keyboard.DOWN )
			{
				downKeyIsBeingPressed = false;
			}
			else if ( keyboardEvent.keyCode == Keyboard.UP )
			{
				upKeyIsBeingPressed = false;
			}
			else if ( keyboardEvent.keyCode == Keyboard.LEFT )
			{
				leftKeyIsBeingPressed = false;
			}
			else if ( keyboardEvent.keyCode == Keyboard.RIGHT )
			{
				rightKeyIsBeingPressed = false;
			}
		}
		
		public function onTick( timerEvent:TimerEvent ):void 
		{
			gameClock.addToValue( 25 );
			if ( Math.random() < currentLevelData.enemySpawnRate )
			{
				var randomX:Number = Math.random() * 400;
				var newEnemy:Enemy = new Enemy( randomX, -15 );
				army.push( newEnemy );
				addChild( newEnemy );
				gameScore.addToValue( 10 );
				sfxSoundChannel = enemyAppearSound.play();
			}
			if ( useMouseControl )
			{
				avatar.x = mouseX;
				avatar.y = mouseY;
			}
			else
			{
				if ( downKeyIsBeingPressed )
				{
					avatar.moveABit( 0, 1 );
				}
				else if ( upKeyIsBeingPressed )
				{
					avatar.moveABit( 0, -1 );
				}
				else if ( leftKeyIsBeingPressed )
				{
					avatar.moveABit( -1, 0 );
				}
				else if ( rightKeyIsBeingPressed )
				{
					avatar.moveABit( 1, 0 );
				}
			}
			
			if ( avatar.x < ( avatar.width / 2 ) )
			{
				avatar.x = avatar.width / 2;
			}
			if ( avatar.x > 400 - ( avatar.width / 2 ) )
			{
				avatar.x = 400 - ( avatar.width / 2 );
			}
			if ( avatar.y < ( avatar.height / 2 ) )
			{
				avatar.y = avatar.height / 2;
			}
			if ( avatar.y > 300 - ( avatar.height / 2 ) )
			{
				avatar.y = 300 - ( avatar.height / 2 );
			}
			
			var avatarHasBeenHit:Boolean = false;
			var i:int = army.length - 1;
			var enemy:Enemy;
			while ( i > -1 )
			{
				enemy = army[i];
				enemy.moveABit();
				if ( PixelPerfectCollisionDetection.isColliding( avatar, enemy, this, true ) ) 
				{
					gameTimer.stop();
					avatarHasBeenHit = true;
				}
				if ( enemy.y > 350 )
				{
					removeChild( enemy );
					army.splice( i, 1 );
				}
				i = i - 1;
			}
			if ( avatarHasBeenHit )
			{
				bgmSoundChannel.stop();
				dispatchEvent( new AvatarEvent( AvatarEvent.DEAD ) );
			}
			
			if ( gameScore.currentValue >= currentLevelData.pointsToReachNextLevel )
			{
				currentLevelData = new LevelData( currentLevelData.levelNum + 1 );
				setBackgroundImage();
			}
		}
		
		public function setBackgroundImage():void
		{
			if ( currentLevelData.backgroundImage == "blue" )
			{
				backgroundContainer.addChild( new BlueBackground() );
			}
			else if ( currentLevelData.backgroundImage == "red" )
			{
				backgroundContainer.addChild( new RedBackground() );
			}
		}
		
		public function getFinalScore():Number
		{
			return gameScore.currentValue;
		}
		
		public function getFinalClockTime():Number
		{
			return gameClock.currentValue;
		}
	}
}